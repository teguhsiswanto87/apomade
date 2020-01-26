@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="sixteen wide computer sixteen wide tablet sixteen wide mobile column">
            <a href="{{ url('/selling/insert/'.(basename(url()->current())))  }}" class="ui basic button">
                <i class="icon plus"></i>
                Tambah
            </a>

            {{-- mode? --}}
            <div class="ui icon buttons right floated">
                <a href="all" class="ui {{ (request()->is('selling_table/*')?'grey':'') }} button">
                    <i class="table icon"></i>
                </a>
                <a href="../selling" class="ui {{ (request()->is('selling')?'grey':'') }} button">
                    <i class="list alternate outline icon"></i>
                </a>
            </div>

            {{-- filter? --}}
            <div class="ui floating mini labeled icon dropdown right floated button mobile only tablet only"
                 style="margin-right: .5rem">
                <i class="filter icon"></i>
                <span class="text">
                    {{ (basename(url()->current()) <> 'all')?$marketplaces->where('id', basename(url()->current()))->pluck('name')->first():'Semua' }}
                </span>
                <div class="menu">
                    <div class="header">
                        Filter by market place
                    </div>
                    <div class="divider"></div>
                    @foreach($marketplaces as $marketplace)
                        <a href="{{ url('selling_table/'.$marketplace->id) }}" class="item">{{ $marketplace->name }}</a>
                    @endforeach
                </div>
            </div>

            {{-- market place? --}}
            <div class="ui buttons right floated tablet hidden mobile hidden" style="margin-right: 1rem">
                <a href="all" class="ui button {{ (request()->is('selling_table/all')?'grey':'') }}">Semua</a>
                @foreach($marketplaces as $marketplace)
                    <a href="{{ url('selling_table/'.$marketplace->id) }}"
                       class="ui button {{
                            (request()->is('selling_table/'.$marketplace->id)?'grey':'')
                            }}">{{ $marketplace->name }}</a>
                @endforeach
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

            @if(count($sellings) > 0)
                <table class="ui celled striped selectable compact table" id="table_sellings_details">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Beli</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Jual</th>
                        <th>Harga Jual</th>
                        <th>Pajak & DV</th>
                        <th>Omzet</th>

                        <th>Modal</th>
                        <th>Untung</th>
                        <th>Pembeli</th>

                        <th>MP | Kurir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no_sellings = 1;?>
                    @foreach($sellings as $selling)
                        <tr>
                            <td class="collapsing"><?php echo $no_sellings;?></td>
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
                                {{ $selling->shipping_tax }}% <br>
                                <label class="ui tiny label">{{ number_format($selling->voucher_discount,0,',','.') }}</label>
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
                            <td class="collapsing"><label class="ui label">{{ $selling->mp_name }}</label>
                                <br>{{ $selling->c_name }}</td>
                            {{--  Selling Status  --}}
                            <td class="collapsing {{ ($selling->selling_status == 'done')?'positive':'' }}">
                                <i class="icon {{ ($selling->selling_status == 'done')?'checkmark':'' }}"></i>
                                {{ $selling->selling_status }}
                            </td>
                            <td class="collapsing">
                                <a href="{{ url('selling/edit/'.$selling->id.'/'.(request()->is('selling_table/all')?'0':$selling->market_places_id)) }}"
                                   style="color: #f2711c;">Edit</a> <br>
                                <a>Detail</a><br>
                                <a href="{{ url('sellingDelete/'.$selling->id ) }}" style="color:red"
                                   onclick="return confirm(' Hapus penjualan ini ?');">Hapus</a>
                            </td>
                        </tr>
                        <?php $no_sellings++; ?>
                    @endforeach

                    </tbody>
                </table>
            @else
                <img src="{{ asset('assets') }}/images/empty.gif" class="ui centered medium image"
                     style="margin-top: 5rem">
                <div class="ui center aligned grid">
                    <h2 class="sixteen wide mobile column">Hati boleh kosong,<br> tapi penjualan tidak boleh kosong</h2>
                </div>
            @endif
        </div>
    </div>

@endsection
