@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-cogs"></i> Configuraciones Sistema</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Cetpro</a></li>
                    <li class="breadcrumb-item active">Sistema</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                    href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                    aria-selected="true">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-three-profile" role="tab"
                                    aria-controls="custom-tabs-three-profile" aria-selected="false">Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-three-messages" role="tab"
                                    aria-controls="custom-tabs-three-messages" aria-selected="false">Permisos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                                    href="#custom-tabs-three-settings" role="tab"
                                    aria-controls="custom-tabs-three-settings" aria-selected="false">Permisos/Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="menus-view-tab" data-toggle="pill"
                                    href="#menus-view" role="tab"
                                    aria-controls="menus-view" aria-selected="false">Men&uacute;s</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" id="menu-role-view-tab" data-toggle="pill"
                                        href="#menu-role-view" role="tab"
                                        aria-controls="menus-view" aria-selected="false">Men&uacute;s/Roles</a>
                                </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                aria-labelledby="custom-tabs-three-home-tab">
                                @include('Sistema.role.index')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-three-profile-tab">
                                @include('Sistema.usuario.index')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-three-messages-tab">
                                @include('Sistema.permission.index')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel"
                                aria-labelledby="custom-tabs-three-settings-tab">
                                @include('Sistema.permission_role.index')
                            </div>
                            <div class="tab-pane fade" id="menus-view" role="tabpanel"
                                aria-labelledby="custom-tabs-three-settings-tab">
                                @include('Sistema.menu.index')
                            </div>
                            <div class="tab-pane fade" id="menu-role-view" role="tabpanel"
                                aria-labelledby="custom-tabs-three-settings-tab">
                                @include('Sistema.menu_role.index')
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripties')
<script src="js/sistema/sistema.js"></script>
@endsection
