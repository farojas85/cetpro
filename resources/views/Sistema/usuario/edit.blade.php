<!-- sample modal content -->
<div id="user-edit" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="user-editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="user-edit-title">Editar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="user-edit-body">
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.nombres"
                            placeholder="Nombres de la Persona" >
                        <small class="text-danger" v-for="error in errores.nombres">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.apellidos"
                            placeholder="Apellidos Persona" >
                        <small class="text-danger" v-for="error in errores.apellidos">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.dni"
                            placeholder="D.N.I. Persona" >
                        <small class="text-danger" v-for="error in errores.dni">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.name"
                            placeholder="Nombre Usuario" >
                        <small class="text-danger" v-for="error in errores.name">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="email" class="form-control" v-model="usuario.email"
                            placeholder="Correo Electrónico" >
                        <small class="text-danger" v-for="error in errores.email">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="password" class="form-control" v-model="usuario.password"
                            placeholder="Contraseña" >
                        <small class="text-danger" v-for="error in errores.password">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <select class="form-control" v-model="usuario.role_id">
                            <option value="">-Rol-</option>
                            <option v-for="rol in role_filtro" :key="rol.id"
                                    :value="rol.id">@{{ rol.name }}</option>
                        </select>
                        <small class="text-danger" v-for="error in errores.role_id">@{{ error }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="user-edit-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light" @click="actualizarUsuario">
                    <i class="fa fa-save"></i> Actualizar
                </button>
            </div>
        </div>
    </div>
</div>
