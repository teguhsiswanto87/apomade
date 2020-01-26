@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="column">
            <h2 class="ui header">
                <a href="{{ url('/finance') }}" class="ui basic button" style="margin-bottom: .5rem; margin-right: 1rem">
                    <i class="icon left chevron"></i>Kembali</a>
                Keuangan - Mutasi
            </h2>
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

            <div class="ui grid">
                <div class="row">
                    <div class="twelve wide column">
                        {{-- Shopping This Month --}}
                        <h4>Januari 2020</h4>
                        <table class="ui celled selectable orange table">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>2020-01-01</td>
                                <td>99.000</td>
                                <td class="positive">Pemasukan</td>
                                <td>Data Dummy</td>
                            </tr>
                            <tr>
                                <td>2020-01-02</td>
                                <td>77.000</td>
                                <td class="warning">Pengeluaran</td>
                                <td>Data Dummy 2 </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{--            <img src="{{ asset('assets') }}/images/miracle-box.gif" class="ui centered large image">--}}
            {{--            <div class="ui center aligned grid">--}}
            {{--                <h2 class="sixteen wide mobile column">Keuangan adalah perduitan</h2>--}}
            {{--            </div>--}}


        </div>
    </div>

@endsection
