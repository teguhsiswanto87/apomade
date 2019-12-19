@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="six wide computer eight wide tablet sixteen wide mobile column">
            <a href="/product" class="ui labeled icon basic button">
                <i class="left chevron icon"></i>
                Batal
            </a>
            <div class="ui fluid segment">
                {{--        Title Header        --}}
                <h1 class="ui header">
                    Edit Produk
                </h1>
                {{--        Form        --}}
                @foreach($products as $p)
                    <form class="ui form" method="POST" action="{{ url('/productUpdate')  }}">
                        {{ csrf_field()  }}
                        <input type="hidden" name="id" value="{{ $p->id }}">
                        <div class="field">
                            <label>Nama Produk
                                <input type="text" name="name" placeholder="{{ $p->name }}" value="{{ $p->name  }}">
                                @if($errors->has('name'))
                                    <div class="ui pointing orange label">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </label>
                        </div>
                        <div class="field six wide column">
                            <label>Stock
                                <input type="number" name="stock" placeholder="{{ $p->stock }}"
                                       value="{{ $p->stock  }}">
                                @if($errors->has('stock'))
                                    <div class="ui pointing orange label">
                                        {{ $errors->first('stock') }}
                                    </div>
                                @endif
                            </label>
                        </div>
                        <div class="field ten wide column">
                            <label>Modal
                                <input type="number" name="capital" placeholder="{{ $p->capital }}"
                                       value="{{ $p->capital  }}">
                                @if($errors->has('capital'))
                                    <div class="ui pointing orange label">
                                        {{ $errors->first('capital') }}
                                    </div>
                                @endif
                            </label>
                        </div>
                        <div class="field ten wide column">
                            <label>Harga Jual
                                <input type="number" name="selling_price" placeholder="{{ $p->selling_price }}"
                                       value="{{ $p->selling_price  }}">
                            </label>
                        </div>
                        <div class="field ten wide column">
                            <label>Laba Kotor
                                <input type="number" name="gross_profit" placeholder="{{ $p->gross_profit }}"
                                       value="{{ $p->gross_profit  }}">
                            </label>
                        </div>

                        <button class="ui button primary fluid" type="submit">Perbarui</button>
                    </form>
                @endforeach

                {{--        warning        --}}
                {{--                @if($errors->any())--}}
                {{--                    <div class="ui warning message">--}}
                {{--                        <div class="header">Mohon periksa lagi!</div>--}}
                {{--                        <i class="close icon"></i>--}}
                {{--                        <ul class="list">--}}
                {{--                            @foreach ($errors->all() as $error)--}}
                {{--                                <li>{{ $error }}</li>--}}
                {{--                            @endforeach--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
            </div>
        </div>
    </div>

@endsection
