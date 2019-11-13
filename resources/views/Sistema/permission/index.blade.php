@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="home">Psicotec</a></li>
                        <li class="breadcrumb-item">Sistema</li>
                        <li class="breadcrumb-item active">Permisos</li>
                    </ol>
                </div>
                <h4 class="page-title">Permisos</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title mb-4">Listado de Men&uacute;s</h4>
                <div class="row">
                    <div class="col-md-6">
                        {{-- @can('roles.create') --}}
                        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevo">
                            <i class="fas fa-plus"></i> Nuevo Permiso 
                        </button>
                        {{-- @endcan --}}
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="input-group input-group-sm">
                            <input type="text" v-model="busqueda"
                                class="form-control"  placeholder="Buscar..." @change="buscar">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">Nombre</th>
                                        <th class="text-white">Enlace</th>
                                        <th class="text-white">Descripci&oacute;n</th>                                         
                                        <th class="text-white">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="total_permissions == 0">
                                        <td class="text-center" colspan="6">-- Datos No Registrados - Tabla Vac&iacute;a --</td>
                                    </tr>
                                    <tr v-else v-for="permission in permissions.data" :key="permission.id">
                                        <td>@{{permission.name}}</td>
                                        <td class="text-center">@{{permission.slug}}</td>
                                        <td>@{{permission.description}}</td>
                                        <td>
                                            <button type="button" class="btn btn-blue btn-xs"
                                                title="Mostrar Permiso" @click="mostrar(permission.id)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-xs"
                                                title="Editar Permiso" @click="editar(permission.id)" >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs"
                                                title="Eliminar Permiso" @click="eliminar(permission.id)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <nav>
                            <ul class="pagination">
                                <li v-if="permissions.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link">
                                        <span><i class="mdi mdi-skip-previous"></i></span>
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber" class="page-item"
                                    v-bind:class="[ page == isActived ? 'active' : '']">
                                    <a href="#" class="page-link"
                                        @click.prevent="changePage(page)">@{{ page }}</a>
                                </li>
                                <li v-if="permissions.current_page < permissions.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="changePage(permissions.current_page + 1)">
                                        <span aria-hidden="true"><i class="mdi mdi-skip-next"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Sistema.permission.create')
    @include('Sistema.permission.show')
    @include('Sistema.permission.edit')
@endsection

@section('scripties')
    <script src="js/sistema/permission.js"></script>
@endsection