<!-- sample modal content -->
<div id="especialidad-show" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="especialidad-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="especialidad-show-title">Mostrar Especialidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="especialidad-show-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="especialidad.nombre"
                            placeholder="Descripción Especialidad" disabled>
                        <small class="text-danger" v-for="error in errores.nombre">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Estado</label>
                    <div class="icheck-primary d-inline col-md-9">
                        <input type="checkbox" id="checkboxPrimary1" v-model="especialidad.estado" disabled>
                        <label for="checkboxPrimary1"v-if="especialidad.estado">Activo</label>
                        <label for="checkboxPrimary1"v-else>Inactivo</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="especialidad-show-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light"
                        @click="guardarEspecialidad">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
