<!-- sample modal content -->
<div id="role-edit" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="role-editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="role-edit-title">Editar Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="role-edit-body">
                <input type="hidden" v-model="role.id" >
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="role.name"
                            placeholder="Nombre de Rol" >
                        <small class="text-danger" v-for="error in errores.name">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Guard Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="role.guard_name"
                            placeholder="Enlace/Slug de Rol" disabled >
                        <small class="text-danger" v-for="error in errores.guard_name">@{{ error }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="role-edit-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light" @click="actualizarRol">
                    <i class="fas fa-redo-alt"></i> Actualizar
                </button>
            </div>
        </div>
    </div>
</div>
