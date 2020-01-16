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
            {{--        Data Profile        --}}
            <div class="ui form">

                <div class="field">
                    <label>Username
                        <h4>{{ $user->username }}</h4>
                    </label>
                </div>
                <div class="field">
                    <label>Nama Lengkap
                        <h4>{{ $user->name }}</h4>
                    </label>
                </div>
                <div class="field six wide column">
                    <label>Jenis Kelamin
                        <h4>{{ ($user->gender == 'L')?'Laki-laki':'Perempuan' }}</h4>
                    </label>
                </div>
                <div class="field ten wide column">
                    <label>Jabatan
                        <h4 data-tooltip="Jabatan ditentukan oleh boss" data-inverted>
                            {{ ($user->position == '')?'-':$user->position }}
                        </h4>
                    </label>
                </div>

                <a href="{{ url('/profile/edit') }}" class="ui button">Edit Profile</a>

                <div class="ui divider" style="margin-top: 2rem; margin-bottom: 2rem"></div>

                <div class="field ten wide column">
                    <label>Email
                    <h4>{{ ($user->email == '')?'-':$user->email }} 
                    </h4> 
                        @if($user->email == '')
                            <button class="ui button mini" id="btn_profile_addemail">Tambah Email</button>
                        @else
                            <small style="color: #f2711c">
                                {{ ($user->email_verified_at != '')?'verified':'Not Verified' }}
                            </small>
                            <br/>
                            <br/>
                            <a href="{{ url('/profileDeleteEmail') }}" class="ui basic red mini button" style="cursor: pointer"
                                onclick="return confirm('Hapus email {{ $user->email }} ?')">
                                <i class="trash icon"></i>
                            </a>
                            <button class="ui basic mini button" id="btn_profile_changeemail">Ganti Email</button>
                            <button class="ui mini button" id="btn_profile_verify">Verifikasi</button>
                        @endif
                    </label>
                </div>

                <div class="ui divider" style="margin-top: 2rem; margin-bottom: 2rem"></div>

                <div class="field ten wide column">
                    <label>Password</label>
                    <button class="ui button mini ">Ganti Password</button>
                </div>


            </div>

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

{{-- Modal Add Email  --}}
<div class="ui mini modal" id="modal_profile_addemail">
    <div class="header">Tambah Email</div>
    <div class="content">
        <form method="POST" action="{{ url('/profileInsertEmail') }}" class="ui form" id="form_profile_addemail">
            {{ csrf_field()  }}

            <input type="email" placeholder="example@mail.com" name="email" required>
        </form>
    </div>
    <div class="actions">
        <div class="ui cancel basic primary button">Batal</div>
        <button class="ui primary button" type="submit" form="form_profile_addemail">Oke, Tambah</button>
    </div>
</div>

{{-- Modal Change Email  --}}
<div class="ui mini modal" id="modal_profile_changeemail">
    <div class="header">Ganti Email</div>
    <div class="content">
        <form method="POST" action="{{ url('/profileChangeEmail') }}" class="ui form" id="form_profile_changeemail">
            {{ csrf_field()  }}
        <label>Sebelumnya : <b>{{ $user->email }}</b>
            <input type="email" placeholder="{{ $user->email }}" name="email" required>
        </label>
        </form>
    </div>
    <div class="actions">
        <div class="ui cancel basic primary button">Batal</div>
        <button class="ui primary button" type="submit" form="form_profile_changeemail">Oke, Ganti</button>
    </div>
</div>

@endsection