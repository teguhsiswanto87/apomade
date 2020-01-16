@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="eight wide computer twelve wide tablet sixteen wide mobile column">
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

            @php $no_couriers=1 @endphp
            @if(count($couriers) > 0)
                <table class="ui celled selectable table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jasa Pengiriman</th>
                        <th>Gambar</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($couriers as $courier)
                        <tr class="{{ ($courier->active == 'N')?'warning':'' }}">
                            <td class="collapsing">{{ $no_couriers }}</td>
                            <td>{{ $courier->name  }}</td>
                            <td class="right aligned collapsing">
                                <img src="{{ $courier->image_link }}" class="ui mini image">
                            </td>
                            <td class="collapsing center aligned">{{ $courier->active }}</td>
                            <td class="collapsing">
                                <a href="courier/edit/{{ $courier->id  }}">Edit</a> |

                                @if($courier->active == 'N')
                                    <a href="courierActivate/{{ $courier->id  }}" style="color:green"
                                       onclick="return confirm(' Aktifkan {{ $courier->name }} ?');">Aktifkan</a>
                                @endif

                                {{--                                <a href="courierDelete/{{ $courier->id  }}" style="color:red"--}}
                                {{--                                   onclick="return confirm(' Hapus {{ $courier->name }} ?');">Hapus</a>--}}

                            </td>
                        </tr>
                        @php $no_couriers++ @endphp
                    @endforeach

                    </tbody>
                </table>
            @else
                <img src="{{ asset('assets') }}/images/person-emptystates.gif" class="ui centered large image">
                <div class="ui center aligned grid">
                    <h2 class="sixteen wide mobile column">Sepertinya,<br> Kurir Anda Sedang Berlibur</h2>
                </div>
            @endif

        </div>
    </div>


@endsection
