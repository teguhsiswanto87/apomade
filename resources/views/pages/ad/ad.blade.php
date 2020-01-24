@extends('media')
@section('content')

    <div class="ui grid stackable padded">
        <div class="column">
            <a class="ui basic button" style="margin-bottom: .5rem">
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


            <img src="{{ asset('assets') }}/images/miracle-box.gif" class="ui centered large image">
            <div class="ui center aligned grid">
                <h2 class="sixteen wide mobile column">Tak Kenal Maka Tak Sayang. <br> Iklan masih kosong</h2>
            </div>

        </div>
    </div>

@endsection
