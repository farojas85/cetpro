<!-- sample modal content -->
<div id="modulo-edit" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="modulo-editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modulo-edit-title">Editar M&oacute;dulo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modulo-edit-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Especialidad</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="modulo.especialidad_id" >
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
                            placeholder="Descripción Módulo" >
                        <small class="text-danger" v-for="error in errores.nombre">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Estado</label>
                    <div class="col-md-9 form-control">
                        <input type="checkbox" v-model="modulo.estado">
                        <label v-if="modulo.estado">Activo</label>
                        <label v-else>Inactivo</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modulo-edit-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light"
                        @click="actualizarModulo">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
