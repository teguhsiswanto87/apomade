@extends('media')
@section('content')

    @foreach($sellingdetails as $sd)
        <div class="ui grid stackable padded">
            {{--    Detail Produk Terjual    --}}
            <div class="nine wide computer eight wide tablet sixteen wide mobile column">
                <div class="ui equal width fluid card grid">
                    <div class="column">{{ $sd->purchase_date }}</div>

                </div>
            </div>
            {{--    Detail Penjualan    --}}
            <div class="seven wide computer eight wide tablet sixteen wide mobile column">

            </div>
        </div>
    @endforeach

@endsection
