<nav class="navbar navbar-light p-0" id="navbar-example2">
    <h5 class="txt-dark pt-2">Si-PALUI EKSIS</h5>
    <ul class="landing-menu nav nav-pills">
        <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item">
            <a class="nav-link" href="https://geoportal.kalselprov.go.id/SIG-SipaluiEksis/">
                Geo Spasial
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('distribution') }}">Sebaran</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('assistance') }}">Bantuan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('strategy') }}">Strategi</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('evaluation') }}">Evaluasi</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('nomination') }}">Nominasi</a></li>
    </ul>
    <div class="buy-block">
        <a class="btn-landing" href="{{ route('login') }}">
            <i class="bi bi-box-arrow-in-right"></i>
            Login</a>
        <div class="toggle-menu"><i class="fa fa-bars"></i></div>
    </div>
</nav>


