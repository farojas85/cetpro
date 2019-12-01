<div class="row">
        <div class="col-md-6">
            {{-- @can('roles.create') --}}
            <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevoModulo">
                <i class="fas fa-plus"></i> Nuevo M&oacute;dulo
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-rounded btn-sm">Filtros</button>
                <button type="button" class="btn btn-info btn-rounded btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="#" @click="mostrarModuloTodos">Todos</a>
                        <a class="dropdown-item" href="#" @click="mostrarModuloHabilitados">Habilitados</a>
                        <a class="dropdown-item" href="#" @click="mostrarModuloEliminados">Eliminados Temporalmente</a>
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
                        <th colspan="5" class="text-center text-uppercase">@{{ show_modulo }}</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th >Nombre</th>
                            <th>Especialidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="total_modulos==0">
                            <td class="text-center text-danger" colspan="5">
                                -- Datos No registrados - Tabla Vac&iacute;a --
                            </td>
                        </tr>
                        <tr v-else v-for="modulo in modulos.data">
                            <td>@{{modulo.id}}</td>
                            <td>@{{modulo.nombre}}</td>
                            <td>@{{modulo.especialidad.nombre}}</td>
                            <td class="text-center">
                                <span v-if="modulo.estado" class="badge badge-success">Activo</span>
                                <span v-else class="badge badge-danger">Inactivo</span>
                            </td>
                            <td>
                                <span v-if="modulo.deleted_at==null">
                                    <button type="button" class="btn btn-info btn-xs"
                                        title="Mostrar Módulo" @click="mostrarModulo(modulo.id)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-xs"
                                        title="Editar Módulo" @click="editarModulo(modulo.id)" >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs"
                                        title="Eliminar Módulo" @click="eliminarModulo(modulo.id)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </span>
                                <span v-else>
                                    <button type="button" class="btn btn-danger btn-xs"
                                        title="Restaurar Módulo" @click="restaurarModulo(modulo.id)">
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
                    <li v-if="modulos.current_page > 1" class="page-item">
                        <a href="#" aria-label="Previous" class="page-link"
                            @click.prevent="changePageModulos()">
                            <span><i class="fas fa-fast-backward"></i></span>
                        </a>
                    </li>
                    <li v-for="page in pagesNumberModulo" class="page-item"
                        v-bind:class="[ page == isActivedModulo ? 'active' : '']">
                        <a href="#" class="page-link"
                            @click.prevent="changePageModulos(page)">@{{ page }}</a>
                    </li>
                    <li v-if="modulos.current_page < modulos.last_page" class="page-item">
                        <a href="#" aria-label="Next" class="page-link"
                            @click.prevent="changePageModulos(modulos.current_page + 1)">
                            <span aria-hidden="true"><i class="fas fa-fast-forward"></i></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    @include('Configuracion.modulo.create')
    @include('Configuracion.modulo.show')
    @include('Configuracion.modulo.edit')
