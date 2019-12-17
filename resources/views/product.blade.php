@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="column">
            <a href="{{ url('/product/insert')  }}" class="ui basic button">
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
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Modal</th>
                    <th>Harga Jual</th>
                    <th>Laba Kotor</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="collapsing">{{ $product->id }}</td>
                        <td>{{ $product->name  }}</td>
                        <td class="right aligned collapsing">{{ $product->stock }}</td>
                        <td class="right aligned">{{ number_format($product->capital, 0, ',','.') }}</td>
                        <td class="right aligned">{{ number_format($product->selling_price,0,',','.') }}</td>
                        <td class="right aligned">{{ number_format($product->gross_profit,0,',','.') }}</td>
                        <td class="collapsing">
                            <a href="product/edit/{{ $product->id  }}">Edit</a> |
                            <a href="productDelete/{{ $product->id  }}"
                               onclick="return confirm(' Hapus {{ $product->name }} ?');">Hapus</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


        </div>
    </div>

@endsection
