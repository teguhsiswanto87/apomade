<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>APO Pomade - Manajemen</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
        integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q="
        crossorigin="anonymous"
    />

    {{--  CDN Font : source sans pro  --}}
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

    <script src="https://apis.google.com/js/client.js"></script>

    {{--  Data Tables CSS + Semantic UI  --}}
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.semanticui.min.css" rel="stylesheet" type="text/css">

    {{--    <link--}}
    {{--        rel="stylesheet"--}}
    {{--        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"--}}
    {{--        integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ="--}}
    {{--        crossorigin="anonymous"--}}
    {{--    />--}}

    <link rel="stylesheet" href="{{ asset('assets')  }}/css/style.css"/>
    <link rel="stylesheet" href="{{ asset('assets')  }}/css/app.css"/>
    <link rel="stylesheet" href="{{ asset('assets')  }}/css/calendar.min.css"/>

</head>

<body>

@yield('media') {{-- Semua file body / base hanya untuk pemanggilan link css & script java --}}
@yield('login') {{-- Menampung Login Form --}}
@yield('register') {{-- Menampung Login Form --}}


<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"
></script>

{{-- data tables --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.semanticui.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"
    integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI="
    crossorigin="anonymous"
></script>

{{-- calendar for semantic ui --}}
<script type="text/javascript" src="{{ asset('assets')  }}/js/calendar.min.js"></script>

<script src="{{ asset('assets')  }}/js/script.js"></script>
</body>
</html>
