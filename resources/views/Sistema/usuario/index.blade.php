<div class="row">
    <div class="col-md-6">
        {{-- @can('roles.create') --}}
        <button type="button" class="btn btn-danger btn-sm btn-rounded" @click="nuevoUsuario">
            <i class="fas fa-plus"></i> Nuevo Usuario
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
                        <th class="text-white">foto</th>
                        <th class="text-white">nombre</th>
                        <th class="text-white">email</th>
                        <th class="text-white">Rol</th>
                        <th class="text-white">Estado</th>
                        <th class="text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="total_usuarios == 0">
                        <td class="text-center" colspan="6">-- Datos No Registrados - Tabla Vac&iacute;a --</td>
                    </tr>
                    <tr v-else v-for="user in usuarios.data" :key="user.id">
                        <td class="text-center"><img :src="user.foto" class="img-circle img-size-32" ></td>
                        <td>@{{user.name}}</td>
                        <td>@{{user.email}}</td>
                        <td class="text-center">
                            <span v-if ="user.roles" v-for="role in user.roles">
                                <span v-if="role.name == 'super-usuario'" class="badge bg-success">@{{ role.name }}</span>
                                <span v-else-if="role.name == 'administrador'" class="badge bg-primary">@{{ role.name }}</span>
                                <span v-else-if="role.name == 'docente'" class="badge bg-info">@{{ role.name }}</span>
                                <span v-else-if="role.name == 'alumno'" class="badge bg-danger">@{{ role.name }}</span>
                                <span v-else-if="role.name == 'usuario'" class="badge bg-indigo">@{{ role.name }}</span>
                            </span>
                            <span v-else>
                                ----
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-success " v-if="user.estado==1">Activo</span>
                            <span class="badge badge-danger" v-else>Inactivo</span>
                        <td>
                            <button type="button" class="btn btn-success btn-sm"
                                title="Mostrar Usuario" @click="mostrarUsuario(user.id)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm"
                                title="Editar Usuario" @click="editarUsuario(user.id)" >
                                <i class="fas fa-edit"></i>
                            </button>
                            @can('usuarios.destroy')
                            <button type="button" class="btn btn-danger btn-sm"
                                title="Eliminar Usuario" @click="">
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
                <li v-if="usuarios.current_page > 1" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link">
                        <span><i class="fas fa-fast-backward"></i></span>
                    </a>
                </li>
                <li v-for="page in pagesNumberUsuario" class="page-item"
                    v-bind:class="[ page == isActivedUsuario ? 'active' : '']">
                    <a href="#" class="page-link"
                        @click.prevent="changePageUsuario(page)">@{{ page }}</a>
                </li>
                <li v-if="usuarios.current_page < usuarios.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                        @click.prevent="changePageUsuario(usuarios.current_page + 1)">
                        <span aria-hidden="true"><i class="fas fa-fast-forward"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
 @include('Sistema.usuario.create')
@include('Sistema.usuario.show')
@include('Sistema.usuario.edit')
