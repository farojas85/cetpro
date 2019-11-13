@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="home">Psicotec</a></li>
                        <li class="breadcrumb-item">Sistema</li>
                        <li class="breadcrumb-item active">Permisos/Roles</li>
                    </ol>
                </div>
                <h4 class="page-title">Permisos por Roles</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="card"  style="border:1px solid #4fc6e1 !important">
                <div class="card-header bg-info py-2 text-white">
                    <h5 class="card-title mb-0 text-white">ROLES</h5>
                </div>
                <div id="cardCollpase6" class="collapse show">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2" v-if="roles" v-for="rol in roles" :key="rol.id" 
                                :class="{'show active' : rol.id == 1 }"
                                href="#" data-toggle="pill" @click="listarPermissionRoles(rol.id)">
                                @{{rol.name}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-sm-9">               
            @include('Sistema.permission_role.permissions')
        </div>
    </div>
@endsection

@section('scripties')
    <script src="js/sistema/permission_role.js" ></script>
@endsection