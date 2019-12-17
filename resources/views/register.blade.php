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
                    <i class="close icon"></i>
                    <i class="lock icon"></i>
                    <div class="content">
                        <div class="header">
                            Register failed!
                        </div>
                        <p>Mohon isi kembali ya...</p>
                    </div>
                </div>
            @endif
            <div class="ui fluid card">
                <div class="content">
                    <form class="ui form" method="POST" action="{{ url('/registerPost') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <label>Nama Lengkap
                                <input type="text" name="name" placeholder="Nama Lengkap">
                                @if($errors->has('name'))
                                    <div class="ui pointing basic yellow label">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </label>
                        </div>
                        <div class="field">
                            <label>Email
                                <input type="email" name="email" placeholder="Email">
                                @if($errors->has('email'))
                                    <div class="ui pointing basic yellow label">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </label>
                        </div>
                        <div class="field">
                            <label>Password
                                <input type="password" name="password" placeholder="Password">
                                @if($errors->has('password'))
                                    <div class="ui pointing basic yellow label">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </label>
                        </div>
                        <div class="field">
                            <label>Confirmation password
                                <input type="password" name="confirmation" placeholder="Confirmation password">
                                @if($errors->has('confirmation'))
                                    <div class="ui pointing basic yellow label">
                                        {{ $errors->first('confirmation') }}
                                    </div>
                                @endif
                            </label>
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
