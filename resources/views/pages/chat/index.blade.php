@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@extends('layouts.admin')

@section('main-content')
    <section class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- subscribe start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">{{ $title }}</h5>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">

                                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        @foreach ($room_user as $item)
                                            <li>
                                                @php
                                                    $chat_user = App\Models\ChatRoomUser::where(
                                                        'chat_room_id',
                                                        $item->chat_room_id,
                                                    )
                                                        ->where('id_user', '!=', Auth::user()->id)
                                                        ->first();
                                                    $waktu = App\Models\Chat::where('chat_room_id', $item->chat_room_id)
                                                        ->latest()
                                                        ->first();
                                                @endphp
                                                <a class="nav-link text-left border shadow shadow-sm"
                                                    id="v-pills-{{ $item->chat_room_id }}-tab" data-toggle="pill"
                                                    href="#v-pills-{{ $item->chat_room_id }}" role="tab"
                                                    aria-controls="v-pills-{{ $item->id }}" aria-selected="false">
                                                    <i class="fa fa-user"></i>
                                                    {{ Str::limit($chat_user->user->name, 15) }}<br>
                                                    <small
                                                        style="margin-left: 20px;">{{ $waktu ? $waktu->created_at->diffForhumans() : '?' }}</small>
                                                </a>
                                            </li>
                                            {{-- {{ dd($waktu) }} --}}
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @include('pages.chat.chat')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- subscribe end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=date]");
    </script>
@endpush
