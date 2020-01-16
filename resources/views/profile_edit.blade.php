@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="eight wide computer thirteen wide tablet sixteen wide mobile column">

            @if(Session::has('alert-success'))
                <div class="ui positive small message">
                    <i class="close icon"></i>
                    <div class="header">
                        <i class="check icon"></i>
                        {{ Session::get('alert-success') }}
                    </div>
                </div>
            @endif
            @if(Session::has('alert-warning'))
                <div class="ui warning small message">
                    <i class="close icon"></i>
                    <div class="header">
                        <i class="info circle icon"></i>
                        {{ Session::get('alert-warning') }}
                    </div>
                </div>
            @endif

            <div class="ui fluid segment">
                {{--        Title Header        --}}
                <h1 class="ui header">
                    Profil Saya
                </h1>
                {{--        Form        --}}

                <form class="ui form" method="POST" action="{{ url('/profileUpdate') }}">
                    {{ csrf_field()  }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="username" value="{{ Session::get('username') }}">
                    <div class="field">
                        <label>Nama Lengkap
                            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ $user->name }}">
                            @if($errors->has('name'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field six wide column">
                        <div class="grouped fields">
                            <label>Jenis Kelamin</label>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="gender" value="L"
                                        {{ ($user->gender == 'L')?'checked':'' }}>
                                    <label>Laki-Laki</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="gender" value="P"
                                        {{ ($user->gender == 'P')?'checked':'' }}>
                                    <label>Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field ten wide column">
                        <label>Email
                            <input type="email" name="email" placeholder="Email" value="{{ $user->email }}">
                            <small style="color: #f2711c">
                                {{ ($user->email_verified_at != '')?'verified':'Not Verified' }}
                            </small>
                            @if($errors->has('email'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field ten wide column">
                        <label>Jabatan
                            <input type="text" name="position" placeholder="Jabatan" value="{{ $user->position }}">
                            @if($errors->has('position'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('position') }}
                                </div>
                            @endif
                        </label>
                    </div>

                    <button class="ui button primary fluid" type="submit">Simpan</button>
                </form>

                                @if($errors->any())
                                    <div class="ui warning message">
                                        <div class="header">Mohon periksa lagi!</div>
                                        <i class="close icon"></i>
                                        <ul class="list">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

            </div>
        </div>
    </div>
@endsection
