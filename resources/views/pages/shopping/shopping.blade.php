@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="ten wide computer twelve wide tablet sixteen wide mobile column">
            <a href="{{ url('/shopping/insert')  }}" class="ui basic button">
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

            @if(2 > 0)
                <table class="ui celled selectable table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>12-12-2020</td>
                        <td>Asep Dummy</td>
                        <td>Rp 1.000.000</td>
                        <td>Edit | Delete</td>
                    </tbody>
                </table>
            @else
                <img src="{{ asset('assets') }}/images/paper-emptystates.gif" class="ui centered large image">
                <div class="ui center aligned grid">
                    <h2 class="sixteen wide mobile column">Mulai Aja Dulu<br> Urusan Rezeki Udah Ada yang Ngatur
                    </h2>
                </div>
            @endif

        </div>
    </div>


@endsection
