@extends('layouts.app')

@section('auth')


    @if(\Request::is('static-sign-up'))
        @include('layouts.navbars.guest.nav')
        @yield('content')
        @include('layouts.footers.guest.footer')

    @elseif (\Request::is('static-sign-in'))
        @include('layouts.navbars.guest.nav')
            @yield('content')
        @include('layouts.footers.guest.footer')

    @else
        @if (\Request::is('rtl'))
            @include('layouts.navbars.auth.sidebar-rtl')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('layouts.navbars.auth.nav-rtl')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

        @elseif (\Request::is('profile'))
            @include('layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                @include('layouts.navbars.auth.nav')
                @yield('content')
            </div>


        @else
            @include('layouts.navbars.auth.sidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.nav')

                {{-- Demo Mode Banner --}}
                @auth
                    @if(auth()->user()->is_demo)
                        <div class="demo-banner" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 0.75rem 1.5rem; text-align: center; color: white; font-weight: 500; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin: 0.5rem 1rem; border-radius: 0.75rem; animation: slideDown 0.5s ease-out;">
                            <i class="fas fa-info-circle me-2"></i>
                            <span>DEMO MODE - Read Only Access</span>
                            <span style="font-size: 0.875rem; opacity: 0.9; margin-left: 1rem;">| You can view everything but cannot create, edit, or delete data</span>
                        </div>
                    @endif
                @endauth

                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
        @endif

        {{-- Disabled Soft UI Configurator to use custom dark theme --}}
        {{-- @include('components.fixed-plugin') --}}
    @endif



@endsection
