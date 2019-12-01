<!-- sample modal content -->
<div id="modulo-show" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="modulo-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modulo-show-title">Mostrar M&oacute;dulo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modulo-show-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Especialidad</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="modulo.especialidad_id" disabled>
                            <option value="" v-if="especialidad_filtro.length==0">-Configurar-</option>
                            <option value="" v-else>-Especialidad-</option>
                            <option v-for="espe in especialidad_filtro" :key="espe.id" :value="espe.id">
                                @{{ espe.nombre }}
                            </option>
                        </select>
                        <small class="text-danger" v-for="error in errores.especialidad_id">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="modulo.nombre"
                            placeholder="Descripción Módulo" disabled>
                        <small class="text-danger" v-for="error in errores.nombre">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Estado</label>
                    <div class="icheck-primary d-inline col-md-9">
                        <input type="checkbox" id="checkboxPrimary1" v-model="modulo.estado">
                        <label for="checkboxPrimary1"v-if="modulo.estado">Activo</label>
                        <label for="checkboxPrimary1"v-else>Inactivo</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modulo-show-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
