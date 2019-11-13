<!-- sample modal content -->
<div id="role-show" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="role-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="role-show-title">Mostrar Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="role-show-body">
                <input type="hidden" v-model="role.id" >
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="role.name"
                            placeholder="Nombre de Rol" disabled >
                        <small class="text-danger" v-for="error in errores.name">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Guard Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="role.guard_name"
                            placeholder="Enlace/Slug de Rol"  disabled>
                        <small class="text-danger" v-for="error in errores.guard_name">@{{ error }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="role-show-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
