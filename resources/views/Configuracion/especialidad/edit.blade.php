<!-- sample modal content -->
<div id="especialidad-edit" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="especialidad-editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="especialidad-edit-title">Editar Especialidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="especialidad-edit-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="especialidad.nombre"
                            placeholder="Descripción Especialidad">
                        <small class="text-danger" v-for="error in errores.nombre">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Estado</label>
                    <div class="col-md-9 form-control">
                        <input type="checkbox" v-model="especialidad.estado">
                        <label v-if="especialidad.estado">Activo</label>
                        <label v-else>Inactivo</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="especialidad-edit-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light"
                        @click="actualizarEspecialidad">
                    <i class="fa fa-save"></i> Actualizar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
