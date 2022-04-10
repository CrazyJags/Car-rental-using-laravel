@extends('main')
@section('title', 'Admin Home')

@section('another-script')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
    @if (auth()->check())
        <div class="layout" id="wrapper">
            <div class="header bg-primary text-white">
                <div class="left">
                    <div class="logo">
                        <span>Lo</span>
                        <i class="fas fa-car"></i>
                        <span>tion</span>
                    </div>
                    <button type="button" id="sidebarCollapse" class="btn ">
                        <i class="fas fa-arrow-circle-left toggleSidebar"></i>
                        <span id="sidebarIndication">Hide sidebar</span>
                    </button>
                </div>
                <div class="right">
                    <div class="dropdown">
                        <button class="btn btn-rounded btn-light" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> {{auth()->user()->name}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="/admin/logout" method="post" class="dropdown-item">@csrf
                                <button type="submit" role="button" class="btn btn-light"
                                        style="background-color: transparent; border:none"><i
                                        class="fa fa-sign-out"></i> Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="sidebar" id="sidebar">
                    <div class="user">
                        <div class="gravatar bg-secondary text-light">
                            {{ auth()->user()->name[0] }}
                        </div>
                        {{ auth()->user()->name }}
                    </div>
                    <hr class="divider">
                    <a class="link" href="/admin">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                    <hr class="divider">
                    <a class="link" href="/admin/cars">
                        <i class="fa-solid fa-car"></i> Cars
                    </a>
                    <hr class="divider">
                    <a class="link" href="/admin/rents">
                        <i class="fa-solid fa-money-bill"></i> Rents
                    </a>
                    <hr class="divider">
                    <a class="link" href="/admin/users">
                        <i class="fa-solid fa-user-group"></i> Users
                    </a>
                    <hr class="divider">
                </div>
                <div class="page">
                    @yield('page')
                </div>
            </div>
        </div>
    @endif
@endsection
