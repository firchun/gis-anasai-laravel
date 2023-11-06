@extends('layouts.app')

@section('content')
    @include('pages.landing_page.component.login')

    @include('pages.landing_page.component.header_content')
    @include('pages.landing_page.component.search')
    @include('pages.landing_page.component.wisata_all')

    @include('pages.landing_page.component.kegiatan_all')
@endsection
