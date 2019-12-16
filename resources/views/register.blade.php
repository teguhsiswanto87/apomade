@extends('base')
@section('register')

    <div class="ui centered stackable grid">
        <div class="six wide column">
            <h2 class="ui image header">
                <div class="content" style="margin-top: 3rem">
                    Register APO Account
                </div>
            </h2>

            @if($errors->any())
                <div class="ui icon warning message">
                    <i class="lock icon"></i>
                    <div class="content">
                        <div class="header">
                            Login failed!
                        </div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="ui fluid card">
                <div class="content">
                    <form class="ui form" method="POST" action="{{ url('/registerPost') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <label>Fullname</label>
                            <input type="text" name="nama" placeholder="Fullname">
                        </div>
                        <div class="field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <div class="field">
                            <label>Confirmation password</label>
                            <input type="password" name="confirmation" placeholder="Confirmation password">
                        </div>
                        <button class="ui teal labeled icon button large fluid" type="submit">
                            <i class="unlock alternate icon"></i>
                            Register
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
