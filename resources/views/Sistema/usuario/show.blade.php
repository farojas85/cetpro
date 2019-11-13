<!-- sample modal content -->
<div id="modelo-show" class="modal fade" tabindex="-1" role="dialog" 
    aria-labelledby="modelo-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelo-show-title">Mostrar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modelo-show-body">
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.name" 
                            placeholder="Nombre de Usuario" disabled >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="email" class="form-control" v-model="usuario.email" 
                            placeholder="Correo Electrónico" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <select class="form-control" v-model="usuario.role_id" disabled>
                            <option value="">-Rol-</option>
                            <option v-for="rol in roles" :key="rol.id" 
                                    :value="rol.id">@{{ rol.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="checkbox checkbox-success mb-2">
                            <input id="estado" type="checkbox" v-model="usuario.estado" disabled>
                            <label for="estado" v-if="usuario.estado == 1">Activo</label>
                            <label for="estado" v-else>Inactivo</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modelo-show-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>