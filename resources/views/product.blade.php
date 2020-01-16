@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="column">
            <a href="{{ url('/product/insert')  }}" class="ui basic button" style="margin-bottom: .5rem">
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

            @if(count($products)>0)
                <table class="ui celled selectable table" id="table_products" data-page-length='25'>
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Modal</th>
                        <th>Harga Jual</th>
                        <th>Laba Kotor</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $no_products=1 @endphp
                    @foreach($products as $product)
                        <tr>
                            <td class="collapsing">{{ $no_products }}</td>
                            <td>{{ $product->name  }}</td>
                            <td class="right aligned collapsing {{ ($product->stock<1)?'negative':'' }}">{{ $product->stock }}</td>
                            <td class="right aligned">{{ number_format($product->capital, 0, ',','.') }}</td>
                            <td class="right aligned">{{ number_format($product->selling_price,0,',','.') }}</td>
                            <td class="right aligned">{{ number_format(($product->selling_price-$product->capital),0,',','.') }}</td>
                            <td class="collapsing">
                                <a href="product/edit/{{ $product->id  }}">Edit</a> |

                                @if($product->active == 'Y')
                                    <a href="productDeactivate/{{ $product->id  }}" style="color:red"
                                       onclick="return confirm(' Hapus {{ $product->name }} ?');">Hapus</a>
                                @endif

                                {{--                                <a href="productDelete/{{ $product->id  }}" style="color:red"--}}
                                {{--                                   onclick="return confirm(' Hapus {{ $product->name }} ?');">Hapus</a>--}}

                            </td>
                        </tr>
                        @php $no_products++ @endphp
                    @endforeach

                    </tbody>
                </table>
            @else
                <img src="{{ asset('assets') }}/images/gift-box.gif" class="ui centered large image">
                <div class="ui center aligned grid">
                    <h2 class="sixteen wide mobile column">Ayo,<br> Ciptakan Produk Terbaikmu</h2>
                </div>
            @endif

        </div>
    </div>

@endsection
