@extends('layouts.app')

@section('content')
    @include('pages.landing_page.component.login')

    @include('pages.landing_page.component.header_content')
    @include('pages.landing_page.component.breadcrumb')

    @include('pages.landing_page.component.shop_detail')
@endsection
