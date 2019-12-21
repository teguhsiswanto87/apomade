@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="twelve wide computer sixteen wide tablet sixteen wide mobile column">
            <a href="{{ url('/selling/insert')  }}" class="ui basic button">
                <i class="icon plus"></i>
                Tambah
            </a>
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
            @foreach($sellings as $selling)
                {{--    Detail Produk Terjual    --}}
                <div class="column" style="margin-bottom: 1.5rem">
                    <div class="ui card fluid">
                        <div class="content">
                            <div class="right floated meta">
                                <b>{{ \Carbon\Carbon::parse($selling->purchase_date)->format('d M Y') }}</b>
                            </div>
                            <img class="ui avatar image"
                                 src="{{ $selling->mp_image_link }}">
                            <label class="ui left pointing label">{{ $selling->c_name }}</label>
                        </div>
                        <div class="image" style="background: white">
                            <div class="ui grid padded">

                                <div class="row">
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
                                                Rp {{ number_format($selling->turnover,0,',','.') }}</h3>
                                        </label>
                                    </div>
                                </div>
                                <div class="ui section divider"></div>

                                <div class="row">
                                    <div class="twelve wide computer twelve wide tablet sixteen wide mobile column">
                                        <div class="ui divided items">
                                            @foreach($products->where('s_id', $selling->id) as $product)
                                                <div class="item">
                                                    <div class="ui tiny image">
                                                        <img src="https://semantic-ui.com/images/wireframe/image.png">
                                                    </div>
                                                    <div class="content">
                                                        <a class="header">{{ $product->name }}</a>
                                                        <span class="meta right floated">
                                                                <label style="font-size: .9rem">Total Harga Produk
                                                                    <h5 style="color: #f2711c">
                                                                        Rp {{ number_format($product->selling_price*$product->sd_qty,0,',','.') }}
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
                                            <h5>
                                                {{ $selling->shopping_tax }}%
                                                {{--                                                Rp {{ ($selling->turnover*$selling->shopping_tax) }}--}}
                                            </h5>
                                        </label>
                                        <div class="ui divider"></div>
                                        <label style="font-size: .9rem">Diskon Voucher
                                            <h5>Rp {{ ($selling->voucher_discount)?$selling->voucher_discount:0 }}</h5>
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
                            <i class="edit icon"></i>
                            Edit Detail
                        </div>
                        <div class="extra content">
                            <div class="ui large transparent left icon input">
                                <i class="sticky note outline icon"></i>
                                <input type="text" placeholder="Catatan Dari Pembeli...">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--    Detail Penjualan    --}}
            <div class="seven wide computer eight wide tablet sixteen wide mobile column">

            </div>
            {{--            <table class="ui celled striped selectable table">--}}
            {{--                <thead>--}}
            {{--                <tr>--}}
            {{--                    <th>ID</th>--}}
            {{--                    <th>Tanggal Pembelian</th>--}}
            {{--                    <th>Pembeli</th>--}}
            {{--                    <th>Pajak Ongkir</th>--}}
            {{--                    <th>Diskon Voucher</th>--}}
            {{--                    <th>Omzet</th>--}}
            {{--                    <th>Status</th>--}}
            {{--                    <th>MP</th>--}}
            {{--                    <th>Kurir</th>--}}
            {{--                    <th>Aksi</th>--}}
            {{--                </tr>--}}
            {{--                </thead>--}}
            {{--                <tbody>--}}
            {{--                @foreach($sellings as $selling)--}}
            {{--                    <tr>--}}
            {{--                        <td class="collapsing">{{ $selling->id }}</td>--}}
            {{--                        <td class="collapsing">{{ $selling->purchase_date  }}</td>--}}
            {{--                        <td class="">{{ $selling->buyers_name }}</td>--}}
            {{--                        <td class="right aligned collapsing">{{ $selling->shopping_tax }}%</td>--}}
            {{--                        <td class="right aligned collapsing">{{ $selling->voucher_discount }}</td>--}}
            {{--                        <td class="right aligned ">{{ number_format($selling->turnover, 0,',','.') }}</td>--}}
            {{--                        <td class="collapsing">{{ $selling->selling_status }}</td>--}}
            {{--                        <td class="collapsing">--}}
            {{--                            {{ $selling->mp_name }}--}}
            {{--                        </td>--}}
            {{--                        <td class="collapsing">{{ $selling->c_name }}</td>--}}
            {{--                        <td class="collapsing">--}}
            {{--                            <a href="selling/edit/{{ $selling->id  }}" style="color: #f2711c;">Edit</a> |--}}
            {{--                            <a href="selling/detail/{{ $selling->id  }}">Detail</a>--}}

            {{--                            --}}{{--                            <a href="sellingDelete/{{ $selling->id  }}" style="color:red"--}}
            {{--                            --}}{{--                               onclick="return confirm(' Hapus {{ $selling->buyers_name }} ?');">Hapus</a>--}}
            {{--                        </td>--}}
            {{--                    </tr>--}}
            {{--                @endforeach--}}

            {{--                </tbody>--}}
            {{--            </table>--}}


        </div>
    </div>

@endsection
