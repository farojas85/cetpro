@if ($item['submenu'] == [])
    <li class="nav-item">
        <a href="{{$item['enlace']}}" class="nav-link {{ Request::path() == $item['enlace'] ? 'active' : '' }} ">
            <i class="nav-icon {{$item['imagen']}}"></i>
            <p>{{$item['descripcion']}} </p>
        </a>
    </li>
@else
    @php
        $open="";
        $active="";
    @endphp
    @foreach ($item['submenu'] as $sub)
        @if(Request::path() == $sub['enlace'])
            @php
                $open = 'menu-open';
                $active = 'active';
            @endphp
        @endif
    @endforeach
    <li class="nav-item has-treeview {{$open}}">
        <a href="" class="nav-link {{$active}}">
            <i class="{{$item['imagen']}}"></i>
            <p>{{$item['descripcion']}} </p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul  class="nav nav-treeview">
            @foreach ($item["submenu"] as $submenu)
            <li class="nav-item">
                <a href="{{$submenu['enlace']}}" class="nav-link {{ Request::path() == $submenu['enlace'] ? 'active' : '' }}">
                    <i class="nav-icon {{$submenu['imagen']}}"></i>
                    <p>{{$submenu['descripcion']}}</p>
                </a>
            </li>
            @endforeach
        </ul>
    </li>
@endif
