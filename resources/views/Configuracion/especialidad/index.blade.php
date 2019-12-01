<div class="row">
    <div class="col-md-6">
        {{-- @can('roles.create') --}}
        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevaEspecialidad">
            <i class="fas fa-plus"></i> Nueva Especialidad
        </button>
        <div class="btn-group">
            <button type="button" class="btn btn-info btn-rounded btn-sm">Filtros</button>
            <button type="button" class="btn btn-info btn-rounded btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="#" @click="mostrarEspecialidadTodos">Todos</a>
                    <a class="dropdown-item" href="#" @click="mostrarEspecialidadHabilitados">Habilitados</a>
                    <a class="dropdown-item" href="#" @click="mostrarEspecialidadEliminados">Eliminados Temporalmente</a>
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
                    <th colspan="4" class="text-center text-uppercase">@{{ show_especialidad }}</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th >Nombre</th>
                        <th >Estado</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="total_especialidades==0">
                        <td class="text-center text-danger" colspan="4">
                            -- Datos No registrados - Tabla Vac&iacute;a --
                        </td>
                    </tr>
                    <tr v-else v-for="espe in especialidades.data">
                        <td>@{{espe.id}}</td>
                        <td>@{{espe.nombre}}</td>
                        <td class="text-center">
                            <span v-if="espe.estado" class="badge badge-success">Activo</span>
                            <span v-else class="badge badge-danger">Inactivo</span>
                        </td>
                        <td>
                            <span v-if="espe.deleted_at==null">
                                <button type="button" class="btn btn-info btn-xs"
                                    title="Mostrar Especialidad" @click="mostrarEspecialidad(espe.id)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-xs"
                                    title="Editar Especialidad" @click="editarEspecialidad(espe.id)" >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs"
                                    title="Eliminar Especialidad" @click="eliminarEspecialidad(espe.id)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </span>
                            <span v-else>
                                <button type="button" class="btn btn-danger btn-xs"
                                    title="Restaurar Especialidad" @click="restaurarEspecialidad(espe.id)">
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
                <li v-if="especialidades.current_page > 1" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link"
                        @click.prevent="changePageEspecialidades()">
                        <span><i class="fas fa-fast-backward"></i></span>
                    </a>
                </li>
                <li v-for="page in pagesNumberEspecialidad" class="page-item"
                    v-bind:class="[ page == isActivedEspecialidad ? 'active' : '']">
                    <a href="#" class="page-link"
                        @click.prevent="changePageEspecialidades(page)">@{{ page }}</a>
                </li>
                <li v-if="especialidades.current_page < especialidades.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                        @click.prevent="changePageEspecialidades(especialidades.current_page + 1)">
                        <span aria-hidden="true"><i class="fas fa-fast-forward"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@include('Configuracion.especialidad.create')
@include('Configuracion.especialidad.show')
@include('Configuracion.especialidad.edit')
