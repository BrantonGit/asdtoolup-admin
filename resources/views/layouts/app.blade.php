<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>3M Tool Up Admin - @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{asset('images/favicons/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/favicons/apple-icon-144x144.pn')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('images/favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app">
        <header>
            <div class="nav-head">
                <div class="logo">
                    <a href="{{url('/dashboard')}}"><img src="{{ asset('images/3M-logo.svg') }}" alt='3M Science. Applied to Life.'/></a>
                </div>
                <div class="profile">
                    <button class="profile-title">
                    @if(Auth::user())   
                <p>{{ Auth::user()->fname }}</p>
                <!-- <img src="{{ asset('images/icons/dropdown-icon.svg') }}" alt="Dropdown Icon"> -->
                @endif
                <!-- <img src="{{ asset('images/icons/dropdown-icon.svg') }}" alt="Dropdown Icon"> -->
</button>
                <div class="options">
                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
                </div>
            </div>
            <div class="nav-map dropShadow">
                <div class="nav">
                    <nav>
                        <ul>
       
            
                              <li @if(Request::is('dashboard')) class='active' @endif><a href="{{url('/dashboard')}}"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20.03 20.03" xml:space="preserve"><path id="Path_357" d="M19.51,6.49l-8.77-6.26c-0.44-0.31-1.02-0.31-1.45,0L0.52,6.49c-0.56,0.4-0.69,1.18-0.29,1.75s1.18,0.69,1.75,0.29L2.5,8.16v10.62c0,0.69,0.56,1.25,1.25,1.25c0,0,0,0,0,0h12.53c0.69,0,1.25-0.56,1.25-1.25v0V8.16c0.34,0.34,0.78,0.55,1.25,0.61c0.69,0,1.25-0.56,1.25-1.25C20.04,7.11,19.84,6.73,19.51,6.49z M15.03,17.53h-2.5v-3.76c0-1.38-1.12-2.5-2.5-2.5s-2.5,1.12-2.5,2.5v3.76h-2.5V6.37l5.01-3.58l5.01,3.58L15.03,17.53z"/></svg>
                              <span>Dashboard</span></a>
                              </li>
                              <li @if(Request::is('submissions') || Request::is('submissions/*')) class='active' @endif><a href="{{url('/submissions')}}"><svg xmlns="http://www.w3.org/2000/svg" width="17.53" height="20.035" viewBox="0 0 17.53 20.035"><path id="Path_102" data-name="Path 102" d="M17.278,0H2.252A1.183,1.183,0,0,0,1,1.252V20.035l3.756-2.5,2.5,2.5,2.5-2.5,2.5,2.5,2.5-2.5,3.756,2.5V1.252A1.183,1.183,0,0,0,17.278,0Zm-2.5,12.522H4.756v-2.5H14.774Zm0-5.009H4.756v-2.5H14.774Z" transform="translate(-1 0)"/></svg>
                              <span>Submissions</span></a>
                              </li>
                              <li @if(Request::is('payments') || Request::is('payments/*')) class='active' @endif><a href="{{url('/payments')}}"><svg xmlns="http://www.w3.org/2000/svg" width="23.136" height="23.136" viewBox="0 0 23.136 23.136"><path id="Path_107" data-name="Path 107" d="M11.568,0A11.568,11.568,0,1,0,23.136,11.568,11.6,11.6,0,0,0,11.568,0Zm0,14.46a2.892,2.892,0,1,1,2.892-2.892A2.9,2.9,0,0,1,11.568,14.46Zm0-11.568a8.436,8.436,0,0,1,3.76.868l-2.25,2.25a5.193,5.193,0,0,0-3.021,0L7.808,3.76A8.436,8.436,0,0,1,11.568,2.892ZM2.892,11.568a8.436,8.436,0,0,1,.868-3.76l2.25,2.25a5.193,5.193,0,0,0,0,3.021L3.76,15.327A8.436,8.436,0,0,1,2.892,11.568Zm8.676,8.676a8.436,8.436,0,0,1-3.76-.868l2.25-2.25a5.193,5.193,0,0,0,3.021,0l2.249,2.25A8.436,8.436,0,0,1,11.568,20.244Zm7.808-4.916-2.25-2.25a5.193,5.193,0,0,0,0-3.021l2.25-2.249a8.58,8.58,0,0,1,0,7.519Z" transform="translate(0)"/></svg>
                              <span>Purchases</span></a>
                              </li>

                              <li @if(Request::is('certificates') || Request::is('certificates/*')) class='active' @endif><a href="{{url('/certificates')}}"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477 477" style="enable-background:new 0 0 477 477;" xml:space="preserve"> <path d="M462,55H15C6.716,55,0,61.715,0,70v298c0,8.284,6.716,15,15,15h263.7v29c0,3.449,1.777,6.654,4.702,8.481 c1.614,1.009,3.453,1.519,5.298,1.519c1.497,0,2.998-0.336,4.387-1.014l28.393-13.858l28.394,13.858 c3.103,1.515,6.763,1.322,9.685-0.505c2.925-1.827,4.702-5.032,4.702-8.481v-29H462c8.284,0,15-6.716,15-15V70 C477,61.715,470.284,55,462,55z M278.172,270.692c0-23.879,19.428-43.307,43.307-43.307c23.88,0,43.308,19.428,43.308,43.307 c0,23.88-19.428,43.308-43.308,43.308C297.6,314,278.172,294.572,278.172,270.692z M364.26,317.308 c12.608-11.58,20.526-28.188,20.526-46.616c0-34.907-28.399-63.307-63.308-63.307c-34.907,0-63.307,28.399-63.307,63.307 c0,18.429,7.92,35.038,20.528,46.618V324H102.072C97.978,302.228,80.771,285.022,59,280.927V157.072 c21.771-4.095,38.978-21.301,43.072-43.072h272.855c4.095,21.771,21.301,38.978,43.072,43.072v123.855 c-21.771,4.095-38.978,21.301-43.072,43.072H364.26V317.308z M344.26,395.991l-18.394-8.978c-2.77-1.352-6.004-1.352-8.773,0 l-18.393,8.978v-66.247c7.074,2.738,14.75,4.256,22.778,4.256c8.03,0,15.707-1.519,22.781-4.257V395.991z M447,353h-82.74v-9H384 c5.522,0,10-4.478,10-10c0-18.748,15.252-34,34-34c5.522,0,10-4.478,10-10V148c0-5.522-4.478-10-10-10c-18.748,0-34-15.252-34-34 c0-5.522-4.478-10-10-10H93c-5.522,0-10,4.478-10,10c0,18.748-15.252,34-34,34c-5.522,0-10,4.478-10,10v142c0,5.522,4.478,10,10,10 c18.748,0,34,15.252,34,34c0,5.522,4.478,10,10,10h185.7v9H30V85h417V353z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                <span>Redemptions</span></a>
                                </li>
                              
                              <li @if(Request::is('customers') || Request::is('customers/*')) class='active' @endif><a href="{{url('/customers')}}"><svg xmlns="http://www.w3.org/2000/svg" width="17.529" height="20.035" viewBox="0 0 17.529 20.035"><path id="Union_10" data-name="Union 10" d="M0,20.035a7.535,7.535,0,0,1,7.512-7.513h2.5a7.535,7.535,0,0,1,7.513,7.513ZM3.255,17.53H14.4a5.05,5.05,0,0,0-4.383-2.5H7.637A5.052,5.052,0,0,0,3.255,17.53Zm.5-11.269V5.008a5.009,5.009,0,0,1,10.017,0V6.26a5.009,5.009,0,1,1-10.017,0Zm2.5-1.252V6.26a2.5,2.5,0,1,0,5.009,0V5.008a2.5,2.5,0,0,0-5.009,0Z" transform="translate(0 -0.001)"/></svg>
                              <span>Customers</span></a>
                              </li>
                              <!-- <li @if(Request::is('settings')) class='active' @endif><a href="{{url('/settings')}}"><svg xmlns="http://www.w3.org/2000/svg" width="20.034" height="20.035" viewBox="0 0 20.034 20.035"><path id="Path_108" data-name="Path 108" d="M16.654,6.511l1.377-2.63L16.278,2.129l-2.63,1.377a4.486,4.486,0,0,0-1.377-.5L11.269,0h-2.5l-1,2.88a5.233,5.233,0,0,0-1.252.5L3.882,2,2,3.882l1.377,2.63a5.233,5.233,0,0,0-.5,1.252L0,8.765v2.5l2.88,1c.125.5.376.877.5,1.377L2,16.278l1.753,1.753,2.63-1.377a4.486,4.486,0,0,0,1.377.5l1,2.88h2.5l1-2.88c.5-.125.877-.376,1.377-.5l2.63,1.377,1.753-1.753-1.377-2.63a4.486,4.486,0,0,0,.5-1.377l2.88-1v-2.5l-2.88-1A5.233,5.233,0,0,0,16.654,6.511Zm-6.636,7.263a3.689,3.689,0,0,1-3.756-3.756,3.689,3.689,0,0,1,3.756-3.756,3.689,3.689,0,0,1,3.756,3.756A3.689,3.689,0,0,1,10.017,13.774Z" transform="translate(0 0)"/></svg>
                              <span>Settings</span></a>
                              </li> -->
              
                        </ul>
                        <small class="version">V1.0.24</small>
                    </nav>
                </div>
            </div>
            <hr class='mmm-gradient'>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
