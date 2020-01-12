@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="column">
            <a href="{{ url('/marketplace/insert')  }}" class="ui basic button">
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

            @if(count($marketplaces) > 0)
                <table class="ui celled striped selectable table" style="width: 70%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Market Place</th>
                        <th>Gambar</th>
                        <th>Link Toko</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $no_marketplaces=1 @endphp
                    @foreach($marketplaces as $marketplace)
                        <tr>
                            <td class="collapsing">@php echo $no_marketplaces @endphp</td>
                            <td>{{ $marketplace->name  }}</td>
                            <td class="right aligned collapsing">
                                <img src="{{ $marketplace->image_link }}" class="ui mini image">
                            </td>
                            <td class="right aligned collapsing">{{ $marketplace->store_link }}</td>
                            <td class="collapsing center aligned">{{ $marketplace->active }}</td>
                            <td class="collapsing">
                                <a href="marketplace/edit/{{ $marketplace->id  }}">Edit</a> |
                                <a href="marketplaceDelete/{{ $marketplace->id  }}" style="color:red"
                                   onclick="return confirm(' Hapus {{ $marketplace->name }} ?');">Hapus</a>
                            </td>
                        </tr>
                        @php $no_marketplaces++ @endphp
                    @endforeach

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
