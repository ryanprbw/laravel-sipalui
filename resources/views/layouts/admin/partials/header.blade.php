<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="#">

                </a>
            </div>
            <div class="dark-logo-wrapper">
                <h5 class="txt-white pt-2">Si-PALUI EKSIS</h5>
            </div>
            <div class="toggle-sidebar bg-white">
                <i class="bi bi-layout-text-sidebar-reverse" id="sidebar-toggle"></i>
            </div>
        </div>
        <div class="left-menu-header col">
            <ul>
                <li>
                    <form class="form-inline search-form">
                        <div class="search-bg"><i class="fa fa-search"></i>
                            <input class="form-control-plaintext" placeholder="Search here.....">
                        </div>
                    </form>
                    <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
                </li>
            </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li>
                    <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="bi bi-fullscreen"></i></a>
                </li>
                <li class="onhover-dropdown p-0">
                    <button data-url="{{ route('logout') }}" class="btn btn-primary-light btn-logout" type="button">
                        <i class="bi bi-box-arrow-left"></i> Login
                    </button>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
