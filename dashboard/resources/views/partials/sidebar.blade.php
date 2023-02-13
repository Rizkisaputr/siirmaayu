<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            @foreach (menu() as $item)
                    <ul class="pcoded-item pcoded-left-item">
                        
                @if(isset($item['submenu']))
                            <li class="pcoded-hasmenu pcoded-trigger">
                                <a href="#" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="{{$item['icon']}}"></i></span>
                                    <span class="pcoded-mtext">{{$item['text']}}</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    @foreach ($item['submenu'] as $item)
                                        <li>
                                            <a href="{{route($item['url'])}}" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="{{$item['icon']}}"></i></span>
                                                <span class="pcoded-mtext">{{$item['text']}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                @else
                    <li>
                        <a href="{{route($item['url'])}}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="{{$item['icon']}}"></i></span>
                            <span class="pcoded-mtext">{{$item['text']}}</span>
                        </a>
                    </li>
                @endif
            </ul>
            @endforeach
        </div>
    </div>
</nav>
