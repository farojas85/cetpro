<div class="row">
    <div class="col-md-6">
        {{-- @can('roles.create') --}}
        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevaAsignatura">
            <i class="fas fa-plus"></i> Nueva Asignatura
        </button>
        <div class="btn-group">
            <button type="button" class="btn btn-info btn-rounded btn-sm">Filtros</button>
            <button type="button" class="btn btn-info btn-rounded btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="#" @click="mostrarAsignaturaTodos">Todos</a>
                    <a class="dropdown-item" href="#" @click="mostrarAsignaturaHabilitados">Habilitados</a>
                    <a class="dropdown-item" href="#" @click="mostrarAsignaturaEliminados">Eliminados Temporalmente</a>
                </div>
            </button>
        </div>
        {{-- @endcan --}}
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead class="bg-navy">
                    <tr>
                        <th colspan="6" class="text-center text-uppercase">@{{ show_asignatura }}</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th >Nombre</th>
                        <th >M&oacute;dulo</th>
                        <th>Especialidad</th>
                        <th >Estado</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="total_asignaturas==0">
                        <td class="text-center text-danger" colspan="6">
                            -- Datos No registrados - Tabla Vac&iacute;a --
                        </td>
                    </tr>
                    <tr v-else v-for="asignatura in asignaturas.data">
                        <td>@{{asignatura.id}}</td>
                        <td>@{{asignatura.nombre}}</td>
                        <td>@{{asignatura.modulo.nombre}}</td>
                        <td>@{{asignatura.modulo.especialidad.nombre}}</td>
                        <td class="text-center">
                            <span v-if="asignatura.estado" class="badge badge-success">Activo</span>
                            <span v-else class="badge badge-danger">Inactivo</span>
                        </td>
                        <td>
                            <span v-if="asignatura.deleted_at==null">
                                <button type="button" class="btn btn-info btn-xs"
                                    title="Mostrar Asignatura" @click="mostrarAsignatura(asignatura.id)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-xs"
                                    title="Editar Asignatura" @click="editarAsignatura(asignatura.id)" >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs"
                                    title="Eliminar Asignatura" @click="eliminarAsignatura(asignatura.id)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </span>
                            <span v-else>
                                <button type="button" class="btn btn-danger btn-xs"
                                    title="Restaurar Asignatura" @click="restaurarAsignatura(asignatura.id)">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li v-if="asignaturas.current_page > 1" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link"
                        @click.prevent="changePageAsignaturas()">
                        <span><i class="fas fa-fast-backward"></i></span>
                    </a>
                </li>
                <li v-for="page in pagesNumberAsignatura" class="page-item"
                    v-bind:class="[ page == isActivedAsignatura ? 'active' : '']">
                    <a href="#" class="page-link"
                        @click.prevent="changePageAsignaturas(page)">@{{ page }}</a>
                </li>
                <li v-if="asignaturas.current_page < asignaturas.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                        @click.prevent="changePageAsignaturas(asignaturas.current_page + 1)">
                        <span aria-hidden="true"><i class="fas fa-fast-forward"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@include('Configuracion.asignatura.create')
@include('Configuracion.asignatura.show')
@include('Configuracion.asignatura.edit')
