<!-- sample modal content -->
<div id="modelo" class="modal fade" tabindex="-1" role="dialog" 
    aria-labelledby="modeloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelo-title">Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modelo-body">
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.name" 
                            placeholder="Nombre de Usuario" >
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
                            <option v-for="rol in roles" :key="rol.id" 
                                    :value="rol.id">@{{ rol.name }}</option>
                        </select>
                        <small class="text-danger" v-for="error in errores.role_id">@{{ error }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modelo-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light" @click="guardar">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>