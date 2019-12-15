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

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
        integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ="
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>

<body>
<!-- sidebar -->
<div class="ui sidebar inverted vertical menu sidebar-menu" id="sidebar">
    <div class="item">
        <div class="header">General</div>
        <div class="menu">
            <a class="item">
                <div>
                    <i class="icon tachometer alternate"></i>
                    Dashboard
                </div>
            </a>
        </div>
    </div>
    <div class="item">
        <div class="header">
            Administration
        </div>
        <div class="menu">
            <a class="item">
                <div><i class="cogs icon"></i>Settings</div>
            </a>
            <a class="item">
                <div><i class="users icon"></i>Team</div>
            </a>
        </div>
    </div>

    <a href="#" class="item">
        <div>
            <i class="icon chart line"></i>
            Charts
        </div>
    </a>

    <a class="item">
        <div>
            <i class="icon lightbulb"></i>
            Apps
        </div>
    </a>
    <div class="item">
        <div class="header">Other</div>
        <div class="menu">
            <a href="#" class="item">
                <div>
                    <i class="icon envelope"></i>
                    Messages
                </div>
            </a>

            <a href="#" class="item">
                <div>
                    <i class="icon calendar alternate"></i>
                    Calendar
                </div>
            </a>
        </div>
    </div>

    <div class="item">
        <form action="#">
            <div class="ui mini action input">
                <input type="text" placeholder="Search..."/>
                <button class="ui mini icon button">
                    <i class=" search icon"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="ui segment inverted">
        <div class="ui tiny olive inverted progress">
            <div class="bar" style="width: 54%"></div>
            <div class="label">Monthly Bandwidth</div>
        </div>

        <div class="ui tiny teal inverted progress">
            <div class="bar" style="width:78%"></div>
            <div class="label">Disk Usage</div>
        </div>
    </div>
</div>

<!-- end sidebar -->

<!-- top nav -->

<nav class="ui top fixed inverted menu">
    <div class="left menu">
        <a href="#" class="sidebar-menu-toggler item" data-target="#sidebar">
            <i class="sidebar icon"></i>
        </a>
        <a href="#" class="header item">
            APO Pomade
        </a>
    </div>

    <div class="right menu">
        <a href="#" class="item">
            <i class="bell icon"></i>
        </a>
        <div class="ui dropdown item">
            <i class="user cirlce icon"></i>
            <div class="menu">
                <a href="#" class="item">
                    <i class="info circle icon"></i> Profile</a
                >
                <a href="#" class="item">
                    <i class="wrench icon"></i>
                    Settings</a
                >
                <a href="#" class="item">
                    <i class="sign-out icon"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- end top nav -->
<div class="pusher">
    <div class="main-content">
        @yield('content') {{-- Semua file konten kita akan ada di bagian ini --}}

    </div>
</div>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"
></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"
    integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI="
    crossorigin="anonymous"
></script>
<script src="assets/js/script.js"></script>
</body>
</html>
