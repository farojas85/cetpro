@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-user-graduate"></i> Estudiante</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Cetpro</a></li>
                    <li class="breadcrumb-item ">Matr&iacute;cula</li>
                    <li class="breadcrumb-item active">Estudiante</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-user-graduate"></i> Listado de Estudiantes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- @can('roles.create') --}}
                                <button type="button" class="btn btn-primary btn-sm" @click="nuevo">
                                    <i class="fas fa-plus"></i> Nuevo Estudiante
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-rounded btn-sm">Filtros</button>
                                    <button type="button" class="btn btn-info btn-rounded btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="#" @click="mostrarTodos">Todos</a>
                                            <a class="dropdown-item" href="#" @click="mostrarHabilitados">Habilitados</a>
                                            <a class="dropdown-item" href="#" @click="mostrarEliminados">Eliminados Temporalmente</a>
                                        </div>
                                    </button>
                                </div>
                                {{-- @endcan --}}
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control"  placeholder="Buscar..." @change="buscarEstudiante">
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
                                        <thead class="bg-navy">
                                            <tr>
                                            <th colspan="6" class="text-center text-uppercase">@{{ show_estudiante }}</th>
                                            </tr>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Foto</th>
                                                <th >Estudiante</th>
                                                <th>Fecha Nacimiento</th>
                                                <th >N&uacute;mero Documento</th>
                                                <th >Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-if="total_estudiantes==0">
                                                <td class="text-danger text-center" colspan="6"> --Datos No Registrados -- </td>
                                            </tr>
                                            <tr v-else v-for="(estudiante,index) in estudiantes.data" :key="estudiante.id">
                                                <td>@{{index+1}}</td>
                                                <td class="text-center"><img :src="estudiante.foto" class="img-circle img-size-32" ></td>
                                                <td>@{{estudiante.apellido_paterno}} @{{estudiante.apellido_materno}} @{{estudiante.nombres}}</td>
                                                <td>@{{estudiante.fecha_nacimiento}}</td>
                                                <td>@{{estudiante.numero_documento}}</td>
                                                <td>
                                                    <span v-if="estudiante.deleted_at==null">
                                                        <button type="button" class="btn btn-info btn-xs"
                                                            title="Mostrar Estudiante" @click="">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-warning btn-xs"
                                                            title="Editar Estudiante" @click="" >
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                            title="Eliminar Estudiante" @click="">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </span>
                                                    <span v-else>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                            title="Restaurar Estudiante" @click="">
                                                            <i class="fas fa-trash-restore"></i>
                                                        </button>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    <ul class="pagination">
                                        <li v-if="estudiantes.current_page > 1" class="page-item">
                                            <a href="#" aria-label="Previous" class="page-link"
                                                @click.prevent="changePage()">
                                                <span><i class="fas fa-fast-backward"></i></span>
                                            </a>
                                        </li>
                                        <li v-for="page in pagesNumber" class="page-item"
                                            v-bind:class="[ page == isActived ? 'active' : '']">
                                            <a href="#" class="page-link"
                                                @click.prevent="changePage(page)">@{{ page }}</a>
                                        </li>
                                        <li v-if="estudiantes.current_page < estudiantes.last_page" class="page-item">
                                            <a href="#" aria-label="Next" class="page-link"
                                                @click.prevent="changePage(estudiantes.current_page + 1)">
                                                <span aria-hidden="true"><i class="fas fa-fast-forward"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('estudiante.create')
    @include('estudiante.show')
    @include('estudiante.edit')
</section>
@endsection
@section('scripties')
<script src="js/sistema/estudiante.js"></script>
@endsection

