<header class="main-nav">
    <div class="sidebar-user text-center">
        <img
            class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt=""/>
        <a href="#"><h6 class="mt-3 f-14 f-w-600">
                {{auth()->user()['name']}}
            </h6></a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    @foreach($permissions as $i => $menuParent)
                        @if($menuParent['parent'] == '0' )
                            @if($menuParent['link'] != '#' )
                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav " href="{{ $menuParent['link'] }}">
                                        <i class="{{$menuParent['icon']}}"></i> <span>{{$menuParent['name']}}</span></a>
                                </li>
                            @else
                                <li class="dropdown">
                                    <a class="nav-link menu-title" href="javascript:void(0)">
                                        <i class="{{$menuParent['icon']}}"></i> <span>{{$menuParent['name']}} </span>
                                    </a>
                                    <ul class="nav-submenu menu-content">
                                        @foreach($permissions as $i => $menuChild)
                                            @if($menuParent['menu_id'] == $menuChild['parent'])
                                                <li>
                                                    <a href="{{ $menuChild['link'] }}">
                                                        <i class="{{$menuChild['icon']}}"></i>
                                                        <span> {{ $menuChild['name'] }} </span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
