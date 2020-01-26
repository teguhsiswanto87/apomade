@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="column">
            {{--            <a class="ui basic button" style="margin-bottom: .5rem">--}}
            {{--                <i class="icon plus"></i>--}}
            {{--                Tambah--}}
            {{--            </a>--}}
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

            <h2 class="ui header">Saldo : Rp 13.000.000
                <a class="ui mini button orange" href="{{ url('/finance/mutation') }}">Lihat Mutasi</a>
            </h2>

            <div class="ui grid">

                <div class="row">
                    <div class="column mobile only">
                        <button class="ui small primary button"><i class="icon plus"></i>Penambahan Saldo</button>
                        <button class="ui small primary basic button" style="margin-top: 0.25rem">
                            <i class="icon minus"></i>Pengeluaran Saldo
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="ten wide computer ten wide tablet sixteen wide mobile column">
                        {{-- Selling This Month --}}
                        <h4>Penjualan Bulan Ini</h4>
                        <table class="ui celled selectable green table">
                            <thead>
                            <tr>
                                <th>Transaksi</th>
                                <th>Omzet (Rp)</th>
                                <th>Iklan</th>
                                <th>Untung Bersih (Rp)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $no_test=1 @endphp
                            @foreach($market_places_transaction_distinct  as $mp_transaction_distinct )
                                <tr>
                                    {{-- Transaction --}}
                                    <td class="collapsing">
                                        {{ $mp_transaction_distinct->mp_name }} :
                                        {{ count($sellings->where('market_places_id',$mp_transaction_distinct->mp_id)) }}
                                        Transaksi
                                    </td>
                                    {{-- Turnover --}}
                                    <td class="right aligned">
                                        @php
                                            $omzet_kotor = ($selling_details->whereIn('id',$sellings->where('market_places_id',$mp_transaction_distinct->mp_id)->pluck('id'))->sum('turnover'));
                                            $pajak = ($selling_details->whereIn('id',$sellings->where('market_places_id',$mp_transaction_distinct->mp_id)->pluck('id'))->sum('tax'));
                                            $diskon_voucher = ($sellings->where('market_places_id', $mp_transaction_distinct->mp_id)->sum('voucher_discount'));
                                            $modal = ($selling_details->whereIn('id',$sellings->where('market_places_id',$mp_transaction_distinct->mp_id)->pluck('id'))->sum('capital'));

                                            $omzet = $omzet_kotor-$pajak-$diskon_voucher;

                                        @endphp
                                        <h5>{{ number_format($omzet,0,',','.') }}</h5>
                                    </td>
                                    {{-- Advertisement --}}
                                    <td>

                                    </td>
                                    {{-- Net Profit --}}
                                    <td class="right aligned">
                                        <h5>{{ number_format($omzet-$modal-$diskon_voucher,0,',','.') }}</h5>
                                    </td>
                                </tr>
                                @php $no_test++ @endphp
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>
                                    <b>Total : {{ count($sellings) }} Transaksi</b>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    {{-- Add Balance --}}
                    <div class="six wide column mobile hidden" style="border-left: 0px solid #bbbbbb">
                        <div class="ui fluid raised card">
                            <div class="content">
                                <div class="header">Penambahan Saldo</div>
                                <div class="description">
                                    <form class="ui form" method="POST" action="{{ url('/finance/addBalance') }}"
                                          id="form_fin_addBalance">
                                        {{ csrf_field()  }}
                                        <div class="field twelve wide column">
                                            <label style="color: #7D7D7D">Tanggal
                                                <div class="ui calendar" id="example2">
                                                    <div class="ui input left icon">
                                                        <i class="calendar icon"></i>
                                                        <input type="text" name="date"
                                                               placeholder="Tanggal Penambahan Saldo" required>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="field">
                                            <label style="color: #7D7D7D">Jumlah
                                                <div class="ui labeled input">
                                                    <div class="ui label">Rp</div>
                                                    <input type="number" name="balance" placeholder="Berapa ya?" min="1"
                                                           required>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="field">
                                            <label style="color: #7D7D7D">Keterangan
                                                <textarea type="text" name="information" rows="2"
                                                          placeholder="Penambahan Saldo dari mana ya?"></textarea>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <button class="ui basic primary button" type="reset" form="form_fin_addBalance">
                                        Reset
                                    </button>
                                    <button class="ui primary button" type="submit" form="form_fin_addBalance">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="ten wide computer ten wide tablet sixteen wide mobile column">
                        {{-- Shopping This Month --}}
                        <h4>Belanja Bulan Ini</h4>
                        <table class="ui celled selectable orange table">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>2020-01-01</td>
                                <td class="right aligned">99</td>
                                <td>Data Dummy</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Withdraw Balance --}}
                    <div class="six wide column mobile hidden" style="border-left: 0px solid #bbbbbb">
                        <div class="ui fluid raised card">
                            <div class="content">
                                <div class="header">Pengeluaran Saldo</div>
                                <div class="description">
                                    <form class="ui form" method="POST" action="{{ url('/finance/subtactBalance') }}"
                                          id="form_fin_subtactBalance">
                                        {{ csrf_field()  }}
                                        <div class="field twelve wide column">
                                            <label style="color: #7D7D7D">Tanggal
                                                <div class="ui calendar" id="example3">
                                                    <div class="ui input left icon">
                                                        <i class="calendar icon"></i>
                                                        <input type="text" name="date"
                                                               placeholder="Tanggal Pengeluaran Saldo" required>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="field">
                                            <label style="color: #7D7D7D">Jumlah
                                                <div class="ui labeled input">
                                                    <div class="ui label">Rp</div>
                                                    <input type="number" name="balance" placeholder="Berapa ya?" min="1"
                                                           required>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="field">
                                            <label style="color: #7D7D7D">Keterangan
                                                <textarea type="text" name="information" rows="2"
                                                          placeholder="Informasi pengeluaran"></textarea>
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <button class="ui basic primary button" type="reset" form="form_fin_subtactBalance">
                                        Reset
                                    </button>
                                    <button class="ui primary button" type="submit" form="form_fin_subtactBalance">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{--            <img src="{{ asset('assets') }}/images/miracle-box.gif" class="ui centered large image">--}}
                {{--            <div class="ui center aligned grid">--}}
                {{--                <h2 class="sixteen wide mobile column">Keuangan adalah perduitan</h2>--}}
                {{--            </div>--}}

            </div>

        </div>
    </div>

@endsection
