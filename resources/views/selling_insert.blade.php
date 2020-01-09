@extends('media')
@section('content')

    <form class="" method="POST" action="{{ url('/sellingPost')  }}">
        {{ csrf_field()  }}
        <div class="ui grid stackable padded">
            {{--    Detail Produk Terjual    --}}
            <div class="nine wide computer eight wide tablet sixteen wide mobile column">
                <h1>
                    Tambah Penjualan
                </h1>
                <small>Pilih Produk yang Terjual</small>
                {{--                <form class="ui form" method="POST" action="{{ url('/sellingPostTest')  }}">--}}
                {{--                    {{ csrf_field()  }}--}}
                <div class="ui form">
                    <div class="ui divided items grid" id="si_products">
                        <?php $index = 0; ?>
                        @foreach($products as $product)
                            <input type="hidden" name="capital[]" value="{{ $product->capital }}"
                                   id="capital<?php echo $index;?>">
                            <input type="hidden" name="selling_price[]" value="{{ $product->selling_price }}"
                                   id="selling_price<?php echo $index;?>">

                            <label class="eight wide column index_si_item" id="index_si_item<?php echo $index;?>"
                                   for="index<?php echo $index;?>">
                                <div class="ui tiny image" style="display: none">
                                    <img src="{{ asset('assets') }}/images/image.png">
                                </div>
                                <div class="content">
                                    <h3 class="header">{{ $product->name }}
                                        <div class="ui checkbox" style="float: right; margin-right: 2rem">
                                            <input type="checkbox" name="products_id[]" value="{{ $product->id }}"
                                                   id="index<?php echo $index;?>">
                                            <label></label>
                                        </div>
                                    </h3>
                                    <div class="meta">
                                        <span class="price" style="color: #db2828; font-weight: bold">
                                            Rp{{ number_format($product->selling_price,0,',','.') }}</span>
                                        <span class="stay">| Stok: {{ $product->stock }}</span>
                                        <span class="right aligned" style="margin-left: 2rem">

                                        </span>
                                    </div>
                                    <div class="extra">
                                        <div class="ui mini right labeled input" style="width: 6rem; display: none"
                                             id="layout_si_qty<?php echo $index;?>">
                                            <input type="number" name="qty[]" value="" placeholder="QTY"
                                                   max="{{ $product->stock }}" min="1"
                                                   id="inp_si_qty<?php echo $index;?>">
                                            <div class="ui basic label">
                                                Produk
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <?php $index++;?>
                        @endforeach
                        {{--                    <button class="ui button fluid teal" type="submit">Test</button>--}}
                    </div>
                </div>

                {{-- Products Sold Out --}}
                <h5 style="margin-top: 2rem">Produk yang Telah Habis</h5>
                <div class="ui items">
                    @foreach($productsSoldOut as $productSoldOut)
                        <div class="item">
                            <div class="ui mini image">
                                <img src="{{ asset('assets') }}/images/image.png">
                            </div>
                            <div class="middle aligned content">
                                <div>{{ $productSoldOut->name }}
                                    {{-- <div class="circular ui right floated basic primary button">--}}
                                    {{--     Tambah Stok--}}
                                    {{-- </div>--}}
                                </div>
                                <div class="meta">
                                    <span class="stay">Stok: {{ $productSoldOut->stock }}</span>
                                </div>
                                <div class="description">
                                    <p></p>
                                </div>
                                <div class="extra">

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{--                </form>--}}

            </div>
            {{--    Detail Penjualan    --}}
            <div class="seven wide computer eight wide tablet sixteen wide mobile column">
                <div class="ui fluid">
                    {{--        Form        --}}
                    <div class="ui form" id="si_sellings">
                        <input type="hidden" name="sd_capital" value="111">
                        <input type="hidden" name="sd_selling_price" value="222">
                        <input type="hidden" name="sd_qty" value="333">

                        <div class="field ten wide column">
                            <label>Tanggal Pembelian

                                <div class="ui calendar" id="example2">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name="purchase_date" placeholder="Tanggal Pembelian">
                                        @if($errors->has('purchase_date'))
                                            <div class="ui pointing orange label">
                                                {{ $errors->first('purchase_date') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

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
                        <div class="field ten wide computer sixteen wide mobile column">
                            <label>Pajak Ongkir ?</label>
                            <div class="inline fields">
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax" value="1">
                                        <label>1%</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax" value="2">
                                        <label>2%</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax" value="3">
                                        <label>3%</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax" value="0" checked>
                                        <label>Tidak Ada</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="field six wide column">
                            <label>Diskon Voucher
                                <div class="ui labeled input">
                                    <div class="ui orange label">Rp</div>
                                    <input type="number" name="voucher_discount" placeholder="Diskon Voucher" min="0">
                                    @if($errors->has('voucher_discount'))
                                        <div class="ui pointing orange label">
                                            {{ $errors->first('voucher_discount') }}
                                        </div>
                                    @endif
                                </div>
                            </label>
                        </div>
                        <div class="field ten wide column">
                            <label>Omzet
                                {{-- info  --}}
                                <small
                                    data-tooltip="Omzet = (Harga Jual X Jumlah Jual) - (Pajak Ongkir X (Harga Jual X Jumlah Jual)) - Diskon Voucher">
                                    <i class="ui info blue circle icon"></i>
                                </small>
                                {{-- Fake Turnover  --}}
                                <div class="ui huge labeled input">
                                    <div class="ui label">Rp</div>
                                    <input type="text" placeholder="Omzet" id="inp_si_omzet_fake" readonly>
                                    @if($errors->has('turnover'))
                                        <div class="ui pointing orange label">
                                            {{ $errors->first('turnover') }}
                                        </div>
                                    @endif
                                </div>
                                {{-- Real Turnover  --}}
                                <input type="hidden" name="turnover" placeholder="Omzet" id="inp_si_omzet">

                            </label>
                        </div>
                        <div class="field ten wide column">
                            <label>Untung
                                {{-- info  --}}
                                <small data-tooltip="Profit = (Omzet - (Harga Beli X Jumlah Jual) - Diskon Voucher)">
                                    <i class="ui info blue circle icon"></i>
                                </small>

                                <div class="ui labeled input">
                                    <div class="ui green label">Rp</div>
                                    <input type="text" name="profit" placeholder="Untung" id="profit" readonly>
                                    @if($errors->has('profit'))
                                        <div class="ui pointing orange label">
                                            {{ $errors->first('profit') }}
                                        </div>
                                    @endif
                                </div>

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
                            <div class="inline fields">
                                @foreach($couriers as $courier)
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="couriers_id" value="{{ $courier->id }}">
                                            <label>{{ $courier->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            <label>Sumber Transaksi</label>
                            <div class="inline fields">
                                @foreach($marketplaces as $marketplace)
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="market_places_id" value="{{ $marketplace->id }}">
                                            <label>{{ $marketplace->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            <a id="btn_si_note" style="cursor: pointer; font-weight: bold">Tambah Catatan</a>
                            <div class="ui large input focus" id="inp_si_note" style="display: none">
                                <input type="text" name="note" placeholder="Catatan Dari Pembeli..." autofocus>
                            </div>
                        </div>
                        <br>
                        <button class="ui button primary fluid disabled" type="submit" id="btn_si_ok">Tambahkan</button>
                    </div>

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
    </form>


@endsection
