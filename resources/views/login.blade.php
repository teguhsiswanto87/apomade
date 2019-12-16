@extends('base')
@section('login')

    <div class="ui centered stackable grid">
        <div class="six wide column">
            <h2 class="ui image header">
                <div class="content" style="margin-top: 3rem">
                    Log-in to your account
                </div>
            </h2>
            @if(\Session::has('alert'))
                <div class="ui icon warning message">
                    <i class="lock icon"></i>
                    <div class="content">
                        <div class="header">
                            Login failed!
                        </div>
                        <p>{{Session::get('alert')}}</p>
                    </div>
                </div>
            @endif
            @if(\Session::has('alert-success'))
                <div class="ui icon success message">
                    <i class="lock icon"></i>
                    <div class="content">
                        <div class="header">
                            Login success
                        </div>
                        <p>{{Session::get('alert-success')}}</p>
                    </div>
                </div>
            @endif
            <div class="ui fluid card">
                <div class="content">
                    <form class="ui form" method="POST" action="{{ url('/loginPost') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <button class="ui primary labeled icon large button fluid" type="submit">
                            <i class="unlock alternate icon"></i>
                            Login
                        </button>
                    </form>
                </div>
            </div>
            <div class="ui message center aligned">
                New to us? <a href="{{url('register')}}">Register</a>
            </div>
        </div>
    </div>

@endsection
