@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        {{--    Detail Produk Terjual    --}}
        <div class="nine wide computer eight wide tablet sixteen wide mobile column">
            <a href="{{ url('/selling') }}" class="ui labeled icon basic button">
                <i class="left chevron icon"></i>
                Kembali
            </a>
            <h1>
                Edit Penjualan
            </h1>
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
            <small>Daftar Produk yang Terjual ({{ count($selling_details) }})</small>
            <input type="hidden" id="data_se_sumProductSold" value="{{ count($selling_details) }}">

            <div class="ui centered grid" style="margin-top: 1rem">
                <?php $index_increaseQty = 0; ?>
                @foreach($selling_details as $selling_detail)
                    <input type="hidden" value="{{ $selling_detail->sellings_id }}"
                           id="data_se_sellings_id<?php echo $index_increaseQty;?>">
                    <input type="hidden" value="{{ $selling_detail->products_id }}"
                           id="data_se_products_id<?php echo $index_increaseQty;?>">
                    <input type="hidden" value="{{ $selling_detail->qty }}"
                           id="data_se_qty<?php echo $index_increaseQty;?>">

                    <input type="hidden" value="{{ $selling_detail->capital*$selling_detail->qty }}"
                           id="data_se_capitalxqty<?php echo $index_increaseQty;?>">
                    <input type="hidden" value="{{ $selling_detail->selling_price*$selling_detail->qty }}"
                           id="data_se_sellingricexqty<?php echo $index_increaseQty;?>">

                    <div class="ten wide computer twelve wide tablet column"
                         id="items_se_product<?php echo $index_increaseQty?>">
                        <div class="ui items">
                            <div class="item">
                                <div class="ui mini image">
                                    <img src="{{ asset('assets') }}/images/image.png">
                                </div>
                                <div class="content">
                                    <div class="header">
                                        {{ $selling_detail->p_name }}
                                    </div>
                                    <div class="meta">
                                            <span class="price"
                                                  style="color: #db2828; font-weight: bold">Rp {{ number_format($selling_detail->selling_price,0,',','.') }}</span>
                                        <span class="stay">| Qty: {{ $selling_detail->qty }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="six wide computer four wide tablet column">
                        <div class="ui small basic icon buttons">
                            <button
                                id="btn_se_increaseQty<?php echo $index_increaseQty; ?>"
                                class="ui button {{ ($selling_detail->p_stock < 1)?'disabled':'' }}">
                                <i class="plus blue icon"></i>
                            </button>
                            <button
                                id="btn_se_decreaseQty<?php echo $index_increaseQty; ?>"
                                class="ui button {{ ($selling_detail->qty < 2)?'disabled':'' }}">
                                <i class="minus orange icon"></i>
                            </button>
                            <a href="{{ url('/sellingdetailDelete/'.$selling_detail->sellings_id.'&'.$selling_detail->products_id) }}"
                               onclick="return confirm(' Hapus produk `{{ $selling_detail->p_name }}` dari penjualan ini ?');"
                               class="ui button"><i class="trash red icon"></i></a>
                        </div>
                    </div>
                    <?php $index_increaseQty++; ?>
                @endforeach
                <div class="five wide computer fourteen wide tablet sixteen wide mobile center aligned column">
                    <button class="ui basic teal button" id="btn_se_insertdetailproduct">Tambah Produk</button>
                </div>
            </div>
        </div>
        {{--    Rincian Penjualan    --}}
        <div class="seven wide computer eight wide tablet sixteen wide mobile column">
            <div class="ui fluid">
                {{--        Form        --}}
                <form class="" method="POST" action="{{ url('/sellingUpdate')  }}" id="form_se_edit_sellings">
                    {{ csrf_field()  }}
                    <input type="hidden" name="id" value="{{ $sellings->id }}">

                    <div class="ui form" id="se_sellings">
                        <input type="hidden" id="se_sd_shoppingTotal">
                        <input type="hidden" id="se_sd_capital">
                        <input type="hidden" id="se_sd_shippingTax">

                        <div class="field">
                            <div class="ui floating message">Diperbarui pada: <b>
                                    {{ \Carbon\Carbon::parse($sellings->updated_at)->format('l, d M Y | H:i') }}
                                </b>
                            </div>
                        </div>
                        <div class="field ten wide column">
                            <label>Tanggal Pembelian

                                <div class="ui calendar" id="example2">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name="purchase_date" placeholder="Tanggal Pembelian"
                                               value="{{ $sellings->purchase_date }}">
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
                                <input type="text" name="buyers_name" placeholder="Nama Pembeli"
                                       value="{{ $sellings->buyers_name }}">
                                @if($errors->has('buyers_name'))
                                    <div class="ui pointing orange label">
                                        {{ $errors->first('buyers_name') }}
                                    </div>
                                @endif
                            </label>
                        </div>
                        <div class="field ten wide computer sixteen wide mobile column">
                            <label>Pajak Ongkir ? <span id="span_se_shippingTax" class="ui label"></span></label>
                            <div class="inline fields">
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax"
                                               value="1" {{ ($sellings->shipping_tax==1)?'checked':'' }}>
                                        <label>1%</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax"
                                               value="2" {{ ($sellings->shipping_tax==2)?'checked':'' }}>
                                        <label>2%</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax"
                                               value="3" {{ ($sellings->shipping_tax==3)?'checked':'' }}>
                                        <label>3%</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="shipping_tax"
                                               value="0" {{ ($sellings->shipping_tax==0)?'checked':'' }}>
                                        <label>Tidak Ada</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="field six wide column">
                            <label>Diskon Voucher
                                <div class="ui labeled input">
                                    <div class="ui orange label">Rp</div>
                                    <input type="number" name="voucher_discount" placeholder="Diskon Voucher" min="0"
                                           value="{{ $sellings->voucher_discount }}" id="se_voucher_discount">
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
                                {{--info--}}
                                <small
                                    data-tooltip="Omzet = (Harga Jual X Jumlah Jual) - (Pajak Ongkir X (Harga Jual X Jumlah Jual)) - Diskon Voucher">
                                    <i class="ui info blue circle icon"></i>
                                </small>
                                {{--Fake Turnover--}}
                                <div class="ui huge labeled input">
                                    <div class="ui label">Rp</div>
                                    <input type="text" placeholder="Omzet" id="inp_se_omzet_fake" readonly>
                                    @if($errors->has('turnover'))
                                        <div class="ui pointing orange label">
                                            {{ $errors->first('turnover') }}
                                        </div>
                                    @endif
                                </div>
                                {{--Real Turnover--}}
                                {{--<input type="hidden" name="turnover" placeholder="Omzet" id="inp_se_omzet">--}}

                            </label>
                        </div>
                        <div class="field ten wide column">
                            <label>Untung
                                {{--info--}}
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
                                        <input type="radio" name="selling_status"
                                               value="process" {{ ($sellings->selling_status=='process')?'checked':'' }}>
                                        <label>Dalam proses</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="selling_status"
                                               value="done" {{ ($sellings->selling_status=='done')?'checked':'' }}>
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
                                            <input type="radio" name="couriers_id" value="{{ $courier->id }}"
                                                {{ ($sellings->couriers_id==$courier->id)?'checked':'' }}>
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
                                            <input type="radio" name="market_places_id" value="{{ $marketplace->id }}"
                                                {{ ($sellings->market_places_id==$marketplace->id)?'checked':'' }}>
                                            <label>{{ $marketplace->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            <label>Tambah Catatan
                                <div class="ui large input focus" id="inp_si_note">
                                    <input type="text" name="note" placeholder="Catatan Dari Pembeli..."
                                           value="{{ $sellings->note }}">
                                </div>
                            </label>
                        </div>

                        <br>
                        <button class="ui button primary fluid" type="submit" id="btn_se_ok">Perbarui</button>
                    </div>
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

    {{-- Modal Insert Detail Products --}}
    <div class="ui tiny modal" id="modal_se_insertdetailproduct">

        <div class="header">Tambah Produk Terjual</div>
        <div class="scrolling content" style="padding-top: 0rem">
            <form class="" method="POST" action="{{ url('/sellingdetailsPost')  }}" id="form_se_insertdetailproducts">
                {{ csrf_field()  }}
                <input type="hidden" name="id" value="{{ $sellings->id }}">
                <div class="ui items grid" id="se_products">
                    <?php $index = 0;?>
                    @foreach($products as $product)
                        <input type="hidden" name="sellings_id[]" value="{{ $sellings->id }}">

                        <label class="sixteen wide column index_si_item" id="index_se_item<?php echo $index; ?>"
                               for="index_se<?php echo $index; ?>">
                            <div class="ui mini image" style="float: left; margin-right: 1rem">
                                <img src="{{ asset('assets') }}/images/image.png">
                            </div>
                            <div class="content">
                                <h4 class="header">{{ $product->name }}
                                    @if($product->stock <= 0)
                                        <div
                                            style="padding: 1rem 2rem 1rem 0rem; color: #BDBEBE; float: right; font-size: 1.4rem;">
                                            Habis
                                        </div>
                                    @endif
                                    @if($product->stock > 0)
                                        <div class="ui checkbox" style="float: right; margin-right: 1rem">
                                            <input type="checkbox" name="products_id[]" value="{{ $product->id }}"
                                                   id="index_se<?php echo $index; ?>">
                                            <label></label>
                                        </div>
                                    @endif
                                </h4>
                                <div class="meta" style="margin-left: 3.5rem">
                                    <div style="float: left">
                                        <small
                                            class="price">Rp {{ number_format($product->selling_price, 0,',','.') }}</small>|
                                        <small class="stay">Stok: {{ $product->stock }}</small>
                                    </div>
                                    @if($product->stock > 0)
                                        <span class="extra" style="margin-left: 3rem; float: left">
                                            <div class="ui mini right labeled input" style="width: 6rem; display: none"
                                                 id="layout_se_qty<?php echo $index; ?>">
                                                <input type="number" name="qty[]" value="" placeholder="QTY"
                                                       max="{{ $product->stock }}" min="1"
                                                       id="inp_se_qty<?php echo $index; ?>">
                                                <div class="ui basic label">
                                                    Produk
                                                </div>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </label>
                        <?php $index++;?>
                    @endforeach
                    @foreach($productsSoldOut as $productSoldOut)
                        <label class="sixteen wide column" style="background-color: #f1f1f1; opacity: 0.7">
                            <div class="ui mini image" style="float: left; margin-right: 1rem">
                                <img src="{{ asset('assets') }}/images/image.png">
                            </div>
                            <div class="content">
                                <h4 class="header">{{ $productSoldOut->name }}
                                    <div
                                        style="padding: 1rem 2rem 1rem 0rem; color: #BDBEBE; float: right; font-size: 1.4rem;">
                                        Habis
                                    </div>
                                </h4>
                                <div class="meta" style="margin-left: 3.5rem">
                                    <small
                                        class="price">Rp {{ number_format($productSoldOut->selling_price, 0,',','.') }}</small>|
                                    <small class="stay">Stok: {{ $productSoldOut->stock }}</small>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="actions">
            <button class="ui basic primary cancel button" id="btn_se_insertdetailproducts_cancel">Batal</button>
            <button class="ui primary approve button" type="submit"
                    id="btn_se_insertdetailproducts_ok">Tambahkan
            </button>
        </div>
    </div>

    {{-- Modal increase qty of detail product  --}}
    <?php $index_increaseQty_modal = 0;?>
    @foreach($selling_details as $selling_detail)
        <div class="ui mini modal" id="modal_se_increaseQty<?php echo $index_increaseQty_modal;?>">
            <div class="header">Tambah Jumlah "{{ $selling_detail->p_name }}"</div>
            <div class="content">
                <form method="POST" action="{{ url('/sellingdetailProductQtyIncrease') }}" class="ui form"
                      id="form_se_increaseQty<?php echo $index_increaseQty_modal?>">
                    {{ csrf_field()  }}
                    <span>Tersedia: {{ $selling_detail->p_stock }}</span>
                    <input type="hidden" name="sellings_id"
                           value="{{ $selling_detail->sellings_id }}">
                    <input type="hidden" name="products_id"
                           value="{{ $selling_detail->products_id }}">
                    <input type="number" placeholder="Mau nambah berapa?" name="qty" min="1"
                           max="{{ $selling_detail->p_stock }}">
                </form>
            </div>
            <div class="actions">
                <div class="ui cancel basic primary button">Batal</div>
                <div class="ui approve primary button">Tambah</div>
            </div>
        </div>
        <?php $index_increaseQty_modal++;?>
    @endforeach

    {{-- Modal decrease qty of detail product  --}}
    <div class="ui mini modal" id="modal_se_decreaseQty">
        <div class="header">Kurangi Jumlah</div>
        <div class="content">
            <form method="POST" action="{{ url('/sellingdetailProductQtyDecrease') }}" class="ui form"
                  id="form_se_decreaseQty">
                {{ csrf_field()  }}
                <span id="data_se_decreaseQty_qtyNow">Jumlah sekarang: </span>
                <input type="hidden" name="sellings_id" id="data_se_decreaseQty_sellings_id">
                <input type="hidden" name="products_id" id="data_se_decreaseQty_products_id">
                <input type="number" placeholder="Mau dikurangi berapa?" name="qty" min="1"
                       id="data_se_decreaseQty_qty">
            </form>
        </div>
        <div class="actions">
            <div class="ui cancel primary button">Batal</div>
            <div class="ui approve basic orange button">Oke, Kurangi</div>
        </div>
    </div>

@endsection
