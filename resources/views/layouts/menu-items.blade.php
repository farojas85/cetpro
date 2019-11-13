@if ($item['submenu'] == [])
    <li>
        <a href="javascript: void(0);">
            <i class="{{$item['icono']}}"></i>
            <span> {{$item['nombre']}} </span>
        </a>
    </li>
@else
    <li>
        <a href="javascript: void(0);">
            <i class="{{$item['icono']}}"></i>
            <span> {{$item['nombre']}} </span>
            <span class="menu-arrow"></span>
        </a>
        <ul  class="nav-second-level" aria-expanded="false">
            @foreach ($item["submenu"] as $submenu)
            <li>
                <a href="{{$submenu['ruta']}}">{{$submenu['nombre']}}</a>
            </li>
            @endforeach
        </ul>
    </li> 
@endif