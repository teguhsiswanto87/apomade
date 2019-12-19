@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="six wide computer eight wide tablet sixteen wide mobile column">
            <a href="/courier" class="ui labeled icon basic button">
                <i class="left chevron icon"></i>
                Kembali
            </a>
            <div class="ui fluid segment">
                {{--        Title Header        --}}
                <h1 class="ui header">
                    Tambah Jasa Pengiriman
                </h1>
                {{--        Form        --}}
                <form class="ui form" method="POST" action="{{ url('/courierPost')  }}">
                    {{ csrf_field()  }}
                    <div class="field">
                        <label>Nama
                            <input type="text" name="name" placeholder="Nama">
                            @if($errors->has('name'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field">
                        <label>Link Gambar
                            <input type="text" name="image_link" placeholder="image_link">
                            @if($errors->has('image_link'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('image_link') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field">
                        <label>Aktif</label>
                        <div class="ui toggle checkbox">
                            <input type="checkbox" name="active" value="Y" checked>
                            <label>Tampil di input penjualan</label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <button class="ui button primary fluid" type="submit">Tambahkan</button>
                </form>

                {{--        warning        --}}
                {{--                @if($errors->any())--}}
                {{--                    <div class="ui warning message">--}}
                {{--                        <div class="header">Mohon periksa lagi!</div>--}}
                {{--                        <i class="close icon"></i>--}}
                {{--                        <ul class="list">--}}
                {{--                            @foreach ($errors->all() as $error)--}}
                {{--                                <li>{{ $error }}</li>--}}
                {{--                            @endforeach--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
            </div>
        </div>
    </div>

@endsection
