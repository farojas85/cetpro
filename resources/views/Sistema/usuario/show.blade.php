<!-- sample modal content -->
<div id="user-show" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="user-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="user-show-title">Mostrar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="user-show-body">
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.nombres"
                            placeholder="Nombres de la Persona" disabled >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.apellidos"
                            placeholder="Apellidos Persona"  disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.dni"
                            placeholder="D.N.I. Persona"  disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="usuario.name"
                            placeholder="Nombre Usuario"  disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="email" class="form-control" v-model="usuario.email"
                            placeholder="Correo Electrónico"  disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <select class="form-control" v-model="usuario.role_id" disabled>
                            <option value="">-Rol-</option>
                            <option v-for="rol in role_filtro" :key="rol.id"
                                    :value="rol.id">@{{ rol.name }}</option>
                        </select>
                        <small class="text-danger" v-for="error in errores.role_id">@{{ error }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="user-show-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
