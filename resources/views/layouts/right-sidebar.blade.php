<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3 control-sidebar-content">
        <h5>Personalizar Temas</h5>
        <button type="button" class="btn btn-info" onclick="resetear({{Auth::user()->id}})">Resetear</button>
        <hr class="mb-2"/>
        <h6>Navbar: Colores</h6>
        <div class="d-flex"></div>
        <div class="d-flex flex-wrap mb-3">
            @foreach ($navbar_color as $nbc)
            <div class="{{$nbc['color']}} elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;"
                        onclick="actualizar_navbar({{Auth::user()->id}},{{$nbc['id']}})">
            </div>
            @endforeach
        </div>
        <h6>Sidebar: Temas Oscuros</h6>
        <div class="d-flex"></div>
        <div class="d-flex flex-wrap mb-3">
            @foreach ($sidebar_dark_color as $sdc)
            <div class="{{$sdc['color']}} elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;"
                        onclick="actualizar_sidebar_dark({{Auth::user()->id}},{{$sdc['id']}})">
            </div>
            @endforeach
        </div>
        <h6>Sidebar: Temas Claros</h6>
        <div class="d-flex"></div>
        <div class="d-flex flex-wrap mb-3">
            @foreach ($sidebar_light_color as $slc)
            <div class="{{$slc['color']}} elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;"
                        onclick="actualizar_sidebar_light({{Auth::user()->id}},{{$slc['id']}})">
            </div>
            @endforeach
        </div>
        <h6>BrandLogo: Colores</h6>
        <div class="d-flex"></div>
        <div class="d-flex flex-wrap mb-3">
            @foreach ($brandlogo_color as $blc)
            <div class="{{$blc['color']}} elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;"
                        onclick="actualizar_brandlogo({{Auth::user()->id}},{{$blc['id']}})">
            </div>
            @endforeach
        </div>
    </div>
</aside>
