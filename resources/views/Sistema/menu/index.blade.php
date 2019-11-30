<div class="row">
    <div class="col-md-6">
        {{-- @can('roles.create') --}}
        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevoMenu">
            <i class="fas fa-plus"></i> Nuevo Men&uacute;
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
                    <tr v-else v-for="(menu in menus.data" :key="menu.id">
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
                            <button type="button" class="btn btn-info btn-xs"
                                title="Mostrar Permiso" @click="">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs"
                                title="Editar Permiso" @click="" >
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs"
                                title="Eliminar Permiso" @click="">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('Sistema.menu.create')
