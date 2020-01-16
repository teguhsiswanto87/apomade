@extends('base')
@section('media')
    <!-- sidebar -->
    <div class="ui sidebar inverted vertical menu sidebar-menu" id="sidebar" style="font-size: 1.2rem">
        <div class="item">
            <div class="header">General</div>
            <div class="menu">
                <a class="item {{ (request()->is('dashboard')) ? 'active' : ''  }}" href="/dashboard">
                    <div>
                        <i class="icon tachometer alternate"></i>
                        Beranda
                    </div>
                </a>
                <a class="item {{ (request()->is('product*')) ? 'active' : ''  }}" href="/product">
                    <div>
                        <i class="icon list ul"></i>
                        Produk
                    </div>
                </a>
                <a class="item {{ (request()->is('keuangan')) ? 'active' : ''  }}" href="">
                    <div>
                        <i class="icon money bill alternate"></i>
                        Keuangan
                    </div>
                </a>
            </div>
        </div>

        <div class="item">
            <div class="header">Outcome
            </div>
            <div class="menu">
                <a class="item">
                    <div><i class="shopping bag icon"></i>Belanja</div>
                </a>
                <a class="item">
                    <div><i class="chart pie icon"></i>Produksi</div>
                </a>
                <a class="item">
                    <div><i class="bullhorn icon"></i>Iklan</div>
                </a>
            </div>
        </div>

        <div class="item">
            <div class="header">
                Income
            </div>
            <div class="menu">
                <a href="/selling"
                   class="item {{ (request()->is('selling')?'active':'') }}{{ (request()->is('selling/edit/*')?'active':'') }} {{ (request()->is('selling_table/*')?'active':' ') }}">
                    <div><i class="chart line icon"></i>Transaksi</div>
                </a>
                <a href="/selling/insert" class="item {{  (request()->is('selling/insert')? 'active':'') }}">
                    <div><i class="shopping cart icon"></i>Input Penjualan</div>
                </a>
            </div>
        </div>

        {{--    hidden    --}}
        <a href="#" class="item" style="display: none">
            <div>
                <i class="icon chart line"></i>
                Charts
            </div>
        </a>

        {{--    hidden    --}}
        <a class="item" style="display: none">
            <div>
                <i class="icon lightbulb"></i>
                Apps Mobile
            </div>
        </a>
        <div class="item">
            <div class="header">Other</div>
            <div class="menu">
                <a href="/courier" class="item {{ (request()->is('courier*')?'active':'') }}">
                    <div>
                        <i class="icon shipping fast"></i>
                        Jasa Pengiriman
                    </div>
                </a>

                <a href="/marketplace" class="item {{ (request()->is('marketplace*')? 'active':'') }}">
                    <div>
                        <i class="icon building"></i>
                        Market Place
                    </div>
                </a>
            </div>
        </div>

        {{--    hidden    --}}
        <div class="item" style="display: none">
            <form action="#">
                <div class="ui mini action input">
                    <input type="text" placeholder="Search..."/>
                    <button class="ui mini icon button">
                        <i class=" search icon"></i>
                    </button>
                </div>
            </form>
        </div>
        {{--    hidden    --}}
        <div class="ui segment inverted" style="display: none">
            <div class="ui tiny olive inverted progress">
                <div class="bar" style="width: 54%"></div>
                <div class="label">Monthly Bandwidth</div>
            </div>

            <div class="ui tiny teal inverted progress">
                <div class="bar" style="width:78%"></div>
                <div class="label">Disk Usage</div>
            </div>
        </div>

    </div>
    <!-- end sidebar -->

    <!-- top nav -->

    <nav class="ui top fixed  menu">
        <div class="left menu">
            <a href="#" class="sidebar-menu-toggler item" data-target="#sidebar">
                <i class="sidebar icon"></i>
            </a>
            <a href="#" class="header item">
                APO Pomade
            </a>
        </div>

        <div class="right menu">
            <a href="#" class="item">
                <i class="bell icon"></i>
            </a>
            <div class="ui dropdown item">
                <i class="user cirlce icon"></i>
                <div class="menu">
                    <a href="{{ url('/profile/edit') }}" class="item">
                        <i class="user icon"></i> {{ Session::get('name') }}</a>
                    <a href="" class="item">
                        <i class="setting icon"></i> Pengaturan</a>
                    <a href="/logout" class="item">
                        <i class="sign-out icon"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- end top nav -->
    <div class="pusher">
        <div class="main-content">
            @yield('content') {{-- Semua file konten kita akan ada di bagian ini --}}

        </div>
    </div>
@endsection
