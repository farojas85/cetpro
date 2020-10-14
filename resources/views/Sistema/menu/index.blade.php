<div class="row">
    <div class="col-md-6">
        {{-- @can('roles.create') --}}
        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevoMenu">
            <i class="fas fa-plus"></i> Nuevo Men&uacute;
        </button>
        <div class="btn-group">
            <button type="button" class="btn btn-info btn-rounded btn-sm">Filtros</button>
            <button type="button" class="btn btn-info btn-rounded btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="#" @click="mostrarTodos">Todos</a>
                    <a class="dropdown-item" href="#" @click="mostrarHabilitados">Habilitados</a>
                    <a class="dropdown-item" href="#" @click="mostrarEliminados">Eliminados</a>
                </div>
            </button>
        </div>
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
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead class="bg-dark">
                    <tr>
                        <th>#</th>
                        <th >Nombre</th>
                        <th >Enlace</th>
                        <th >Icono</th>
                        <th >Padre</th>
                        <th >Estado</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="total_menus==0">
                        <td colspan="7" class="text-danger text-center">--DATOS NO REGISTRADOS TABLA VAC&Iacute;A--</td>
                    </tr>
                    <tr v-else v-for="menu in menus.data" :key="menu.id">
                        <td>@{{menu.id}}</td>
                        <td>@{{menu.descripcion}}</td>
                        <td>@{{menu.enlace}}</td>
                        <td class="text-center"><i :class="menu.imagen"></i></td>
                        <td class="text-center">
                            <span v-if="menu.padre_id == 0">--</span>
                            <span v-else>@{{ menu.padre.descripcion }}</span>
                        </td>
                        <td class="text-center">
                            <span v-if="menu.estado" class="badge badge-success">Activo</span>
                            <span v-else class="badge badge-danger">Inactivo</span>
                        </td>
                        <td>
                            <span v-if="menu.deleted_at==null">
                            <button type="button" class="btn btn-info btn-xs"
                                title="Mostrar Menú" @click="mostrarMenu(menu.id)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs"
                                title="Editar Menú" @click="editarMenu(menu.id)" >
                                <i class="fas fa-edit"></i>
                            </button>
                            @can('menus.destroy')
                            <button type="button" class="btn btn-danger btn-xs"
                                title="Eliminar Menú" @click="eliminarMenu(menu.id)">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endcan
                            </span>
                            <span v-else>
                                @can('menus.restore')
                                <button type="button" class="btn btn-danger btn-xs"
                                    title="Restaurar Menú" @click="restaurarMenu(menu.id)">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                                @endcan
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li v-if="menus.current_page > 1" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link">
                        <span><i class="fas fa-fast-backward"></i></span>
                    </a>
                </li>
                <li v-for="page in pagesNumberMenu" class="page-item"
                    v-bind:class="[ page == isActivedMenu ? 'active' : '']">
                    <a href="#" class="page-link"
                        @click.prevent="changePagemenus(page)">@{{ page }}</a>
                </li>
                <li v-if="menus.current_page < menus.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                        @click.prevent="changePageMenus(menus.current_page + 1)">
                        <span aria-hidden="true"><i class="fas fa-fast-forward"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@include('Sistema.menu.create')
@include('Sistema.menu.show')
@include('Sistema.menu.edit')
