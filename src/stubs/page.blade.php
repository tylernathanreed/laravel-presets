@extends('layouts.app')

@section('app')

    <div class="flex-center position-ref full-height">

        @optional('content')
            @yield('content')
        @else
            @include('partials.header')

            <div class="content">
                @yield('page.content')
            </div>
        @endoptional

    </div>

@endsection