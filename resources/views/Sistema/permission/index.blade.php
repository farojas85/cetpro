<div class="row">
    <div class="col-md-6">
        {{-- @can('roles.create') --}}
        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevoPermiso">
            <i class="fas fa-plus"></i> Nuevo Permiso
        </button>
        {{-- @endcan --}}
    </div>
    <div class="col-md-6 text-right">
        <div class="input-group input-group-sm">
            <input type="text"
                class="form-control"  placeholder="Buscar..." @change="">
            <div class="input-group-append">
                <button type="button" class="btn btn-info">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead class="bg-dark">
                    <tr>
                        <th>#</th>
                        <th class="text-white">Nombre</th>
                        <th class="text-white">Guard Name</th>
                        <th class="text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="total_permissions == 0">
                        <td class="text-center" colspan="6">-- Datos No Registrados - Tabla Vac&iacute;a --</td>
                    </tr>
                    <tr v-else v-for="(permission,index) in permissions.data" :key="permission.id">
                        <td>@{{ index+1 }}</td>
                        <td>@{{permission.name}}</td>
                        <td class="text-center">@{{permission.guard_name}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm"
                                title="Mostrar Permiso" @click="">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm"
                                title="Editar Permiso" @click="" >
                                <i class="fas fa-edit"></i>
                            </button>
                            @can('permisos.destroy')
                            <button type="button" class="btn btn-danger btn-sm"
                                title="Eliminar Permiso" @click="eliminarPermiso(permission.id)">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endcan
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
                        <span><i class="mfas fa-fast-backward"></i></span>
                    </a>
                </li>
                <li v-for="page in pagesNumberPermission" class="page-item"
                    v-bind:class="[ page == isActivedPermission ? 'active' : '']">
                    <a href="#" class="page-link"
                        @click.prevent="changePagePermission(page)">@{{ page }}</a>
                </li>
                <li v-if="permissions.current_page < permissions.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                        @click.prevent="changePage(permissions.current_page + 1)">
                        <span aria-hidden="true"><i class="fas fa-fast-forward"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
 @include('Sistema.permission.create')
{{--@include('Sistema.permission.show')
@include('Sistema.permission.edit') --}}
