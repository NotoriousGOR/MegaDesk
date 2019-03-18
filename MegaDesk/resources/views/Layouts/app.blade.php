{{-- /*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\Layouts\app.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Wednesday, December 5th 2018, 9:00:59 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: Thu Dec 20 2018
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2018 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2018 Avuncular Digital
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	----------------------------------------------------------
 * 2019-01-29	GOR	ALL RIGHTS RESERVED UNDER CC LICENSE https://notificationsounds.com/message-tones/oringz-w445-180
 * 2019-01-09	GOR	ALL Rights RESERVED AUDIO WAS USED FROM https://notificationsounds.com/message-tones/appointed-529
 */ --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('svg/megadesklogo.ico')}}">
    <title>{{config('app.name','MegaDesk')}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
</head>

<body>
     @php
        date_default_timezone_set('America/Chicago');
    @endphp
    <div id="cover" class="row justify-content-center align-items-center">
        <div class="lds-dual-ring "></div>
    </div>
    <div id="app" class="page-wrapper chiller-theme">
        @include('inc.navbar')
        <!-- sidebar-wrapper  -->
        <main class="p-4">

            <div class="container-fluid">
                <example-component></example-component>
                @include('inc.messages')
                @yield('content')
                <div id="CISDLOGO"></div>
            </div>
            @auth
                @cannot('technician', auth()->user())
                    <button id="newcall" type="button" data-toggle="tooltip" data-placement="bottom" title="New Call" class="btn btn-info d-none d-lg-block" onclick="window.open('/callEntry/','_blank','width=650,height=800');">
                        <i class="fas fa-phone"></i>
                    </button>
                @endcannot
            @endauth
        </main>
        <!-- page-content" -->
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
    @stack('scripts')

    <script>
        $(document).ready(function () {

            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this)
                    .parent()
                    .hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                    .parent()
                    .removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                    .next(".sidebar-submenu")
                    .slideDown(200);
                    $(this)
                    .parent()
                    .addClass("active");
                }
            });

            $('#modalLoginForm').modal({backdrop: 'static', keyboard: false}).modal('show');

            $('#modalRegisterForm').modal('show');

            $('[data-toggle="tooltip"]').tooltip()

            $("#close-sidebar").click(function() {
                $(".page-wrapper").removeClass("toggled");
            });

            $("#show-sidebar").click(function() {
                $(".page-wrapper").addClass("toggled");
            });

            $(window).on('load', function() {
                $("#cover").animate({
                    opacity: 0
                }, 500, function() {
                    $(this).css('display','none')
                })
            });
        });
    </script>
</body>

</html>
