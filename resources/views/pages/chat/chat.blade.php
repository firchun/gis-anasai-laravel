@push('css')
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
@endpush
{{-- {{ dd($room_user) }} --}}
@foreach ($room_user as $room)
    <div class="tab-pane fade" id="v-pills-{{ $room->chat_room_id }}" role="tabpanel"
        aria-labelledby="v-pills-{{ $room->chat_room_id }}-tab">
        <div class="d-flex justify-content-center container ">
            <div class="wrapper">
                <div class="main">
                    <div class="px-2 scroll" id="message-{{ $room->chat_room_id }}">
                    </div>
                    <form id="form-{{ $room->chat_room_id }}"
                        class="navbar bg-white navbar-expand-sm d-flex justify-content-between">
                        <input type="text" name="text" class="form-control" placeholder="Tulis pesan disini...">
                        <button id="submitButton" class="btn btn-success mx-3">
                            Kirim
                        </button>
                        <div id="loadingIcon" class="px-5"
                            style="display: none; font-size: 24px; color: rgb(64, 221, 64);">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        {{-- Load pusher library --}}
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
            document.addEventListener('DOMContentLoaded', function() {
                // Get chat from API
                const getChat = async () => {
                    const response = await fetch('/chat/get/{{ $room->chat_room_id }}');
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
                         <span class="name">${r.id_user == "{{ Auth::user()->id }}" ?  'Pelanggan' :'Anda' } | ${timeString}</span>
                         <p class="msg mb-0">${r.message}</p>
                         <span class="read ${r.is_read == 0 ?  'text-muted' :'text-success' } ">${r.is_read == 0 ?  'Belum di baca' :'<i class="fa fa-check"> </i> dibaca' } </span>
                     </div>
                 </div>`;
                    });

                    document.getElementById('message-{{ $room->chat_room_id }}').innerHTML = chatsHTML
                }

                const roomId = "{{ $room->chat_room_id }}";

                window.addEventListener('load', async (ev) => {
                    await getChat()
                    // Connect to pusher
                    const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                        cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                    });

                    // Connect to chat channel
                    const channel = pusher.subscribe(`chat-channel`);

                    // Listen for chat-send event
                    channel.bind('chat-send', async (data) => {
                        await getChat();
                    });
                    // Send message
                    document.getElementById(`form-${roomId}`).addEventListener('submit', async (ev) => {
                        ev.preventDefault();

                        const submitButton = document.getElementById('submitButton');
                        const loadingIcon = document.getElementById('loadingIcon');

                        submitButton.style.display = 'none';
                        loadingIcon.style.display = 'block';

                        const message = document.querySelector(
                            `#v-pills-${roomId} input[name="text"]`);
                        const response = await fetch('/chat/send', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message: message.value,
                                room: roomId
                            })
                        });

                        const data = await response.json();
                        if (data) {
                            // Get chat
                            await getChat();

                            submitButton.style.display = 'block';
                            loadingIcon.style.display = 'none';

                            message.value = '';
                        }
                    })
                });

                // Initial chat loading
                getChat();
            });
        </script>
    @endpush
@endforeach
