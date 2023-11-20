@extends('layouts.app')

@section('content')
    <style>
        ::-webkit-scrollbar {
            width: 10px
        }

        ::-webkit-scrollbar-track {
            background: #eee
        }

        ::-webkit-scrollbar-thumb {
            background: #888
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555
        }

        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main {
            background-color: #eee;
            width: 100%;
            position: relative;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }

        .scroll {
            overflow-y: scroll;
            scroll-behavior: smooth;
            height: 400px
        }

        .name {
            font-size: 10px
        }

        .read {
            font-size: 10px
        }

        .msg {
            background-color: #fff;
            font-size: 14px;
            padding: 5px;
            border-radius: 5px;
            font-weight: 500;
            color: #3e3c3c
        }
    </style>
    @include('pages.landing_page.component.header_content')
    <div class="mt-5 container">
        <button id="backButton" class="btn btn-secondary py-2">
            Kembali
        </button>
        {{-- <button class="btn btn-success py-2 float-right">
            <i class=" fa fa-check"></i> Tandai telah dibaca
        </button> --}}
    </div>
    <div class="d-flex justify-content-center container mt-3 mb-5">
        <div class="wrapper">
            <div class="main">
                <div style="background-color: #f25601;" class="p-2 text-white">
                    {{ $title }}
                </div>
                <div class="px-2 scroll pt-3" id="message">
                    <!-- Isi pesan akan ditampilkan di sini -->
                </div>
                <div style="background-color: #f25601;">
                    <form id="form" class="navbar-expand-sm d-flex justify-content-between py-3 mx-2">
                        <input type="text" name="text" class="form-control" placeholder="Tulis pesan disini...">
                        <button id="submitButton" class="btn btn-light py-2 mx-2">
                            Kirim
                        </button>
                        <div id="loadingIcon" class="px-5" style="display: none; font-size: 24px; color: white;">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Load pusher library --}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            // Kembali ke halaman sebelumnya
            window.history.back();
        });
    </script>
    <script>
        function scrollToBottom() {
            var scrollElement = document.querySelector('.scroll');
            scrollElement.scrollTop = scrollElement.scrollHeight;
        }

        // Panggil scrollToBottom setelah dokumen selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
        });

        // Panggil scrollToBottom setiap kali konten diubah
        document.addEventListener('DOMSubtreeModified', function() {
            scrollToBottom();
        });
    </script>
    <script>
        // Get chat from API
        const getChat = async () => {
            const response = await fetch('/chat/get/{{ $room->id }}')
            const data = await response.json()

            let chatsHTML = '';

            data.map(r => {
                const createdAt = new Date(r.created_at);
                const timeString = createdAt.toLocaleTimeString('en-US', {
                    hour: 'numeric',
                    minute: 'numeric'
                });
                chatsHTML += `
                 <div class="d-flex align-items-center 
                 ${r.id_user == "{{ Auth::user()->id }}" ? 'text-right justify-content-end' : ''}">
                     <div class="pr-2 ${r.id_user == "{{ Auth::user()->id }}" ? '' : 'pl-1'}"> 
                         <span class="name">${r.id_user == "{{ Auth::user()->id }}" ?  'Anda' :'Lapak' } | ${timeString}</span>
                         <p class="msg mb-0">${r.message}</p>
                         <span class="read ${r.is_read == 0 ?  'text-muted' :'text-success' } ">${r.is_read == 0 ?  'Belum di baca' :'<i class="fa fa-check"> </i> dibaca' } </span>
                     </div>
                 </div>`;
            });

            document.getElementById('message').innerHTML = chatsHTML;
        }

        window.addEventListener('load', async (ev) => {
            await getChat();

            const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
            })

            const channel = pusher.subscribe('chat-channel');

            channel.bind('chat-send', async (data) => {
                await getChat();
            });

            document.getElementById('form').addEventListener('submit', async (ev) => {
                ev.preventDefault();

                const submitButton = document.getElementById('submitButton');
                const loadingIcon = document.getElementById('loadingIcon');

                submitButton.style.display = 'none';
                loadingIcon.style.display = 'block';

                const message = document.querySelector('input[name="text"]');
                const response = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: message.value,
                        room: '{{ $room->id }}'
                    })
                });

                const data = await response.json();

                if (data) {
                    await getChat();

                    submitButton.style.display = 'block';
                    loadingIcon.style.display = 'none';

                    message.value = '';
                }
            });
        })
    </script>
@endsection
