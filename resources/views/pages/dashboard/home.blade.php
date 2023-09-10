@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    @include('layouts.component.alert')
    @include('layouts.component.alert_validate')
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kadis')
        <div class="alert alert-warning border-left-warning alert-dismissible fade show mb-2 d-md-none" role="alert">
            Halaman ini lebih optimal ketika dilihat pada perangkat komputer atau laptop
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @include('pages.dashboard.component.title')
    @include('pages.dashboard.component.search')
    <div class="container">
        @if ($data)
            @include('pages.dashboard.component.data_results')
        @else
            @include('pages.dashboard.component.card')
        @endif
    </div>
@endsection
