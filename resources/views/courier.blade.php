@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="column">
            <a href="{{ url('/courier/insert')  }}" class="ui basic button">
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
                    <th>Nama Jasa Pengiriman</th>
                    <th>Link Gambar</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($couriers as $courier)
                    <tr>
                        <td class="collapsing">{{ $courier->id }}</td>
                        <td>{{ $courier->name  }}</td>
                        <td class="right aligned collapsing">{{ $courier->image_link }}</td>
                        <td class="collapsing center aligned">{{ $courier->active }}</td>
                        <td class="collapsing">
                            <a href="courier/edit/{{ $courier->id  }}">Edit</a> |
                            <a href="courierDelete/{{ $courier->id  }}" style="color:red"
                               onclick="return confirm(' Hapus {{ $courier->name }} ?');">Hapus</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


        </div>
    </div>


@endsection
