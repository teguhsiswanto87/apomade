@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="sixteen wide computer sixteen wide tablet sixteen wide mobile column">
            <a href="{{ url('/selling/insert')  }}" class="ui basic button">
                <i class="icon plus"></i>
                Tambah
            </a>
            {{-- mode --}}
            <div class="ui icon buttons right floated">
                <a href="all" class="ui {{ (request()->is('selling_table/*')?'grey':'') }} button">
                    <i class="table icon"></i>
                </a>
                <a href="../selling" class="ui {{ (request()->is('selling')?'grey':'') }} button">
                    <i class="list alternate outline icon"></i>
                </a>
            </div>
            {{-- mode --}}
            <div class="ui buttons right floated" style="margin-right: 1rem">
                <a href="all" class="ui button ">Semua</a>
                <a href="bukalapak" class="ui button ">Bukalapak</a>
                <a href="shopee" class="ui button orange">Shopee</a>
            </div>

            <table class="ui celled striped selectable table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Beli</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Jual</th>
                    <th>Harga Jual</th>
                    <th>Pajak</th>
                    <th>Omzet</th>

                    <th>Modal</th>
                    <th>Untung</th>
                    <th>Pembeli</th>

                    <th>Kurir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellings->where('market_places_id', 2) as $selling)
                    <tr>
                        <td class="collapsing">{{ $selling->id }}</td>
                        {{--  Purchase Date  --}}
                        <td class="collapsing">
                            <h4>
                                {{ \Carbon\Carbon::parse($selling->purchase_date)->format('d M')  }}
                            </h4>
                            {{ \Carbon\Carbon::parse($selling->purchase_date)->format('Y')  }}
                        </td>
                        {{--  Products sold  --}}
                        <td>
                            @foreach($products->where('s_id', $selling->id) as $product)
                                <small>
                                    {{ $product->name }} ({{ $product->sd_qty }})<br>
                                </small>
                            @endforeach
                        </td>
                        {{--  QTY  --}}
                        <td class="collapsing">
                            {{ $products->where('s_id', $selling->id)->sum('sd_qty') }}<br>
                        </td>
                        {{--  Selling Price  --}}
                        <td class="right aligned collapsing">
                            @foreach($products->where('s_id', $selling->id) as $product)
                                <small>
                                    {{ number_format($product->selling_price,0,',','.') }}<br>
                                </small>
                            @endforeach
                        </td>
                        {{--  Shipping Tax  --}}
                        <td class="right aligned collapsing">
                            {{ $selling->shipping_tax }}%
                        </td>
                        {{--  Turnover  --}}
                        <td class="right aligned collapsing">
                            {{ number_format(($products->where('s_id', $selling->id)->sum('turnover')-
                                                    $selling->voucher_discount-
                                                    ($products->where('s_id', $selling->id)->sum('turnover')*($selling->shipping_tax/100))),0,',','.') }}

                        </td>
                        {{--  Capitals  --}}
                        <td class="right aligned collapsing">
                            {{ number_format(($products->where('s_id', $selling->id)->sum('capitals')),0,',','.') }}
                        </td>
                        {{--  Profit  --}}
                        <td class="right aligned collapsing">
                            {{ number_format(($products->where('s_id', $selling->id)->sum('turnover')-
                            $selling->voucher_discount-
                            ($products->where('s_id', $selling->id)->sum('turnover')*($selling->shipping_tax/100)))-
                            ($products->where('s_id', $selling->id)->sum('capitals'))-
                            $selling->voucher_discount,0,',','.') }}

                        </td>
                        {{--  Buyers Name  --}}
                        <td>{{ $selling->buyers_name }}</td>
                        {{--  Couriers  --}}
                        <td class="collapsing">{{ $selling->c_name }}</td>
                        {{--  Selling Status  --}}
                        <td class="collapsing">{{ $selling->selling_status }}</td>
                        <td class="collapsing">
                            <a href="edit/{{ $selling->id  }}" style="color: #f2711c;">Edit</a> <br>
                            <a>Detail</a><br>
                            <a href="sellingDelete/{{ $selling->id  }}" style="color:red"
                               onclick="return confirm(' Hapus penjualan ini ?');">Hapus</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
