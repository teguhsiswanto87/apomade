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

            <table class="ui celled striped selectable table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Market Place</th>
                    <th>Link Gambar</th>
                    <th>Link Toko</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($marketplaces as $marketplace)
                    <tr>
                        <td class="collapsing">{{ $marketplace->id }}</td>
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
                @endforeach

                </tbody>
            </table>


        </div>
    </div>


@endsection
