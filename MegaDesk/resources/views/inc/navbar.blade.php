{{--
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\inc\navbar.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Thursday, January 10th 2019, 12:33:08 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 04/01/2019, 8:08:42
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2019 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2019 Avuncular Digital
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
 */
 --}}


<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
</a>

<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <img id="logo" class="img-responsive img-rounded" src="{{asset('svg/MegaDeskLogo.svg')}}" alt="User picture">
            <a href="/">MegaDesk</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="{{asset('svg/TechLogo.svg')}}" alt="User picture" />
            </div>
            <div class="user-info">
                @if(Auth::check()) {{Auth::user()->name}}
                    @else John Smith
                @endif

                <span class="user-role">
                    @if(Auth::check())
                        @php
                            $role = "";
                            switch(Auth::user()->authLvl) {
                                case 1:
                                    $role = "Administrator";
                                    break;
                                case 2:
                                    $role = "Call Center";
                                    break;
                                case 3:
                                    $role = "Technician";
                                    break;
                            }
                            echo $role
                        @endphp
                    @else
                        Guest
                    @endif
                </span>
            </div>
        </div>
        <!-- sidebar-header  -->

        <!-- sidebar-search  -->
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="/">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/queue/">
                        <i class="fas fa-tasks"></i>
                        <span>Queue</span>
                    </a>
                </li>
                <li>
                    <a href="/reports/">
                        <i class="far fa-file-alt"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li>
                    <a href="/search/">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </a>
                </li>
                @auth
                    @cannot('technician', auth()->user())
                    <li class="header-menu">
                            <span>Privileges</span>
                    </li>
                    @endcannot
                @endauth
                @auth
                    @can('administrator', auth()->user())
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-lock-open"></i>
                            <span>Admin</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="/admin-settings">
                                        <i class="fas fa-terminal"></i>
                                        <span>Admin Console</span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="/users">
                                        <i class="fas fa-users"></i>
                                        <span>User Management</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                @endauth
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
        @if (Auth::guest())
            <a href="/login" data-toggle="tooltip" data-placement="top" title="Login">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        @else
            <a href="/users/{{Auth::user()->id}}" id="settings" data-toggle="tooltip" data-placement="top" title="Settings">
                <i class="fa fa-cog"></i>
            </a>
            <a href="/logout" data-toggle="tooltip" data-placement="top" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        @endif

    </div>
</nav>
