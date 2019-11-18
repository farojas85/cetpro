
<div class="row">
    <div class="col-md-6">
        {{-- @can('roles.create') --}}
        <button type="button" class="btn btn-primary btn-sm" @click="nuevoRol">
            <i class="fas fa-plus"></i> Nuevo Rol
        </button>
        {{-- @endcan --}}
    </div>
    <div class="col-md-6 text-right">
        <div class="input-group input-group-sm">
            <input type="text" class="form-control"  placeholder="Buscar..." @change="">
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
                        <th class="text-center text-white">#</th>
                        <th class="text-white">Nombre</th>
                        <th class="text-white">Guard Name</th>
                        <th class="text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="total_roles == 0">
                        <td class="text-center" colspan="5">-- Datos No Registrados - Tabla Vac&iacute;a --</td>
                    </tr>
                    <tr v-else v-for="rol in roles.data" :key="rol.id">
                        <td class="text-center">@{{rol.id}}</td>
                        <td>@{{rol.name}}</td>
                        <td>@{{rol.guard_name}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm"
                                title="Mostrar Roles" @click="mostrarRol(rol.id)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm"
                                title="Editar Roles" @click="editarRol(rol.id)" >
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"
                                title="Eliminar Roles" @click="eliminarRol(rol.id)">
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
                <li v-if="roles.current_page > 1" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link">
                        <span><i class="mdi mdi-skip-previous"></i></span>
                    </a>
                </li>
                <li v-for="page in pagesNumberRole" class="page-item"
                    v-bind:class="[ page == isActivedRole ? 'active' : '']">
                    <a href="#" class="page-link"
                        @click.prevent="changePageRoles(page)">@{{ page }}</a>
                </li>
                <li v-if="roles.current_page < roles.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                        @click.prevent="changePageRoles(roles.current_page + 1)">
                        <span aria-hidden="true"><i class="mdi mdi-skip-next"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@include('Sistema.role.create')
@include('Sistema.role.show')
@include('Sistema.role.edit')
