@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="twelve wide computer sixteen wide tablet sixteen wide mobile column">
            <a href="{{ url('/selling/insert')  }}" class="ui basic button">
                <i class="icon plus"></i>
                Tambah
            </a>
            {{-- mode --}}
            <div class="ui icon buttons right floated">
                <a href="selling_table/all" class="ui {{ (request()->is('selling_table')?'grey':'') }} button">
                    <i class="table icon"></i>
                </a>
                <a href="selling" class="ui {{ (request()->is('selling')?'grey':'') }} button">
                    <i class="list alternate outline icon"></i>
                </a>
            </div>

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
            <br>
            <br>
            @if(count($sellings) < 1)
                <img src="{{ asset('assets') }}/images/empty.gif" class="ui centered large image">
                <div class="ui center aligned grid">
                    <h2 class="sixteen wide mobile column">Hati boleh kosong,<br> tapi penjualan tidak boleh kosong</h2>
                </div>
            @endif
            @foreach($sellings as $selling)
                {{--    Detail Produk Terjual    --}}
                <div class="column" style="margin-bottom: 1.5rem">
                    <div class="ui inverted card fluid">
                        <div class="content" style="margin-bottom: -1rem;">
                            <div class="right floated meta" style="margin-top: -0.8rem;">
                                <a class="ui right ribbon label {{ ($selling->selling_status == 'done')?'green':'orange' }}">
                                    <b>{{ \Carbon\Carbon::parse($selling->purchase_date)->format('D, d M Y') }}</b>
                                </a>
                            </div>
                            <img class="ui avatar image" style="margin-top: -1.5rem;"
                                 src="{{ $selling->mp_image_link }}" alt="{{ $selling->mp_name }}">
                            <label class="ui left pointing label" style="top: -.7rem;">{{ $selling->c_name }}</label>
                        </div>
                        <div class="image" style="background: white; margin-top: -0.5rem;">
                            <div class="ui grid padded">

                                <div class="row" style="margin-bottom: -1rem;">
                                    <div class="five wide computer four wide tablet sixteen wide mobile column">
                                        <h3 style="color: #2185d0">{{ $selling->buyers_name }}</h3>
                                    </div>
                                    <div class="five wide computer six wide tablet sixteen wide mobile column">
                                        Status
                                        <h2>{{ (($selling->selling_status == 'process')? 'Diproses' : 'Penjualan Selesai') }}</h2>
                                    </div>
                                    <div
                                        class="five wide computer six wide tablet sixteen wide mobile column center aligned">
                                        <label style="font-size: .9rem">Total Belanja
                                            <h3 style="color: #f2711c">
                                                Rp {{ number_format($products->where('s_id', $selling->id)->sum('turnover'),0,',','.') }}
                                                <i class="chevron right icon"></i>
                                                <span style="color: #2185d0" data-tooltip="Omzet Anda" data-inverted="">
                                                    Rp {{ number_format(($products->where('s_id', $selling->id)->sum('turnover')-
                                                    $selling->voucher_discount-
                                                    ($products->where('s_id', $selling->id)->sum('turnover')*($selling->shipping_tax/100))),0,',','.') }}
                                                </span>
                                            </h3>
                                        </label>
                                    </div>
                                </div>
                                <div class="ui section divider"></div>

                                <div class="row" style="margin-bottom: -2.5rem;">
                                    <div class="twelve wide computer twelve wide tablet sixteen wide mobile column">
                                        <div class="ui divided items">
                                            @foreach($products->where('s_id', $selling->id) as $product)
                                                <div class="item">
                                                    <div class="ui mini image">
                                                        <img src="https://semantic-ui.com/images/wireframe/image.png">
                                                    </div>
                                                    <div class="content">
                                                        <a class="header">{{ $product->name }}</a>
                                                        <span class="meta right floated">
                                                                <label style="font-size: .9rem">Total Harga Produk
                                                                    <h5 style="color: #f2711c">
                                                                        Rp {{ number_format($product->sd_selling_price*$product->sd_qty,0,',','.') }}
                                                                    </h5>
                                                                </label>
                                                            </span>
                                                        <div class="meta">
                                                            <span class="" style="color: #db2828;">
                                                                Rp {{ number_format($product->selling_price,0,',','.') }}
                                                            </span>
                                                            <span class="stay">{{ $product->sd_qty }} Produk</span>
                                                        </div>
                                                        <div class="extra">

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div
                                        class="four wide computer twelve wide tablet sixteen wide mobile column right aligned">
                                        <label style="font-size: .9rem">Pajak Ongkir
                                            <b>{{ $selling->shipping_tax }}%</b>
                                            <label class="ui label">
                                                Rp {{ number_format($products->where('s_id', $selling->id)->sum('turnover')*($selling->shipping_tax/100),0,',','.') }}
                                            </label>
                                        </label>
                                        <div class="ui divider" style="margin-top: .4rem; margin-bottom: 0.2rem"></div>
                                        <label style="font-size: .9rem">Diskon Voucher
                                            <h5>
                                                Rp {{ number_format(($selling->voucher_discount)?$selling->voucher_discount:0, 0,',','.') }}</h5>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">

                                </div>

                            </div>
                        </div>
                        <div class="content">
                            <a class="right floated" style="color: #db2828" href="sellingDelete/{{ $selling->id }}"
                               onclick="return confirm(' Hapus Pembelian {{ $selling->buyers_name }} ?');">
                                <i class="trash alternate outline icon"></i>
                                Hapus
                            </a>
                            @if($selling->selling_status != 'done')
                                <i class="edit icon"></i>
                                <a href="{{ url('selling/edit/'.$selling->id) }}">
                                    Edit Detail</a>
                            @endif
                        </div>
                        <div class="extra content">
                            @if($selling->note <> '')
                                <div class="ui large transparent left icon input">
                                    <i class="sticky note outline icon"></i>
                                    <input type="text" placeholder="Catatan Dari Pembeli..."
                                           value="{{ $selling->note }}"
                                           readonly>
                                </div>
                            @endif
                            @if($selling->selling_status == 'process')
                                <a href="selling/changeToDone/{{ $selling->id }}&{{ $selling->buyers_name }}"
                                   onclick="return confirm('Konfirmasi pesanan ini selesai ?')"
                                   class="ui mini primary circular button right floated">Ubah ke Selesai
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            {{--    Detail Penjualan    --}}
            <div class="seven wide computer eight wide tablet sixteen wide mobile column">

            </div>
        </div>
    </div>

@endsection
