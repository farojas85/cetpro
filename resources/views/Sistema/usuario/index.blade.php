@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="home">Psicotec</a></li>
                        <li class="breadcrumb-item">Sistema</li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
                <h4 class="page-title">Usuario</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title mb-4">Listado de Usuarios</h4>
                <div class="row">
                    <div class="col-md-6">
                        {{-- @can('roles.create') --}}
                        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevo">
                            <i class="fas fa-plus"></i> Nuevo Usuario 
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
                                        <th class="text-white">foto</th>
                                        <th class="text-white">nombre</th>
                                        <th class="text-white">email</th>
                                        <th class="text-white">Rol</th>
                                        <th class="text-white">Estado</th>                                                 
                                        <th class="text-white">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="totales == 0">
                                        <td class="text-center" colspan="6">-- Datos No Registrados - Tabla Vac&iacute;a --</td>
                                    </tr>
                                    <tr v-else v-for="user in usuarios.data" :key="user.id">
                                        <td class="text-center"><img :src="user.foto" class="rounded-circle avatar-sm" ></td>
                                        <td>@{{user.name}}</td>
                                        <td>@{{user.email}}</td>
                                        <td class="text-center">
                                            <span class="badge badge-success" v-if="user.roles[0].slug == 'admin'">@{{user.roles[0].name}}</span>
                                            <span class="badge badge-info" v-if="user.roles[0].slug == 'supervisor'">@{{user.roles[0].name}}</span>
                                            <span class="badge badge-blue" v-if="user.roles[0].slug == 'tutor'">@{{user.roles[0].name}}</span>
                                            <span class="badge badge-primary" v-if="user.roles[0].slug == 'estudiante'">@{{user.roles[0].name}}</span>
                                            <span class="badge badge-danger" v-if="user.roles[0].slug == 'usuario'">@{{user.roles[0].name}}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-soft-success text-success" v-if="user.estado==1">Activo</span>
                                            <span class="badge bg-soft-danger text-danger" v-else>Inactivo</span>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs"
                                                title="Mostrar Usuario" @click="mostrar(user.id)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-xs"
                                                title="Editar Usuario" @click="editar(user.id)" >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs"
                                                title="Eliminar Usuario" @click="eliminar(user.id)">
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
                                <li v-if="usuarios.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link">
                                        <span><i class="mdi mdi-skip-previous"></i></span>
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber" class="page-item"
                                    v-bind:class="[ page == isActived ? 'active' : '']">
                                    <a href="#" class="page-link"
                                        @click.prevent="changePage(page)">@{{ page }}</a>
                                </li>
                                <li v-if="usuarios.current_page < usuarios.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="changePage(usuarios.current_page + 1)">
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
    @include('Sistema.usuario.create')
    @include('Sistema.usuario.show')
    @include('Sistema.usuario.edit')
@endsection

@section('scripties')
    <script src="js/sistema/usuario.js"></script>
@endsection