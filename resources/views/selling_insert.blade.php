@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        {{--    Detail Produk Terjual    --}}
        <div class="nine wide computer eight wide tablet sixteen wide mobile column">
            <h1>
                Tambah Penjualan
            </h1>

            <div class="ui divided relaxed items">
                @foreach($products as $product)
                    <div class="item">
                        <div class="ui tiny image">
                            <img src="https://semantic-ui.com/images/wireframe/image.png">
                        </div>
                        <div class="middle aligned content">
                            <a class="header">{{ $product->name }}</a>
                            <div class="meta">
                                <span class="price">Rp{{ $product->selling_price }}</span>
                                <span class="stay">| Stock: {{ $product->stock }}</span>
                                <span class="right floated">
                                    <div class="ui checkbox header">
                                        <input type="checkbox" name="selling_products[]">
                                        <label></label>
                                    </div>
                                </span>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        {{--    Detail Penjualan    --}}
        <div class="seven wide computer eight wide tablet sixteen wide mobile column">
            {{--            <a href="{{ url()->previous() }}" class="ui labeled icon basic button">--}}
            {{--                <i class="left chevron icon"></i>--}}
            {{--                Kembali--}}
            {{--            </a>--}}
            <div class="ui fluid">
                {{--        Form        --}}
                <form class="ui form" method="POST" action="{{ url('/productPost')  }}">
                    {{ csrf_field()  }}
                    <div class="field ten wide column">
                        <label>Tanggal Pembelian
                            <input type="date" name="purchase_date" placeholder="Tanggal Pembelian">
                            @if($errors->has('purchase_date'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('purchase_date') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field">
                        <label>Nama Pembeli
                            <input type="text" name="buyers_name" placeholder="Nama Pembeli">
                            @if($errors->has('buyers_name'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('buyers_name') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field ten wide column">
                        <label>Pajak Ongkir ?</label>
                        <div class="inline fields">
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="shopping_tax" value="1">
                                    <label>1%</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="shopping_tax" value="2">
                                    <label>2%</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="shopping_tax" value="3">
                                    <label>3%</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="shopping_tax" value="0" checked>
                                    <label>Tidak Ada</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="field six wide column">
                        <label>Diskon Voucher
                            <input type="number" name="voucher_discount" placeholder="Diskon Voucher">
                            @if($errors->has('voucher_discount'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('voucher_discount') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field ten wide column">
                        <label>Omzet
                            <input type="number" name="turnover" placeholder="Omzet">
                            @if($errors->has('turnover'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('turnover') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field ten wide column">
                        <label>Untung
                            <input type="number" name="profit" placeholder="Untung">
                            @if($errors->has('profit'))
                                <div class="ui pointing orange label">
                                    {{ $errors->first('profit') }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="field">
                        <label>Status Transaksi</label>
                        <div class="inline fields">
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="selling_status" value="process">
                                    <label>Dalam proses</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="selling_status" value="done">
                                    <label>Beres</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Jasa Kirim</label>

                    </div>
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
