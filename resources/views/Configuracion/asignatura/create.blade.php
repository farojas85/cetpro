<!-- sample modal content -->
<div id="asignatura-create" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="asignatura-createLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="asignatura-create-title">Nueva Asignatura</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="asignatura-create-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Especialidad</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="asignatura.especialidad_id" @change="filtroModuloPorEspecialidad">
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
                        <label class="col-form-label col-md-3">M&iacute;dulo</label>
                        <div class="col-md-9">
                            <select class="form-control" v-model="asignatura.modulo_id">
                                <option value="" v-if="modulo_filtro.length==0">-Configurar-</option>
                                <option value="" v-else>-M&oacute;dulo-</option>
                                <option v-for="mod in modulo_filtro" :key="mod.id" :value="mod.id">
                                    @{{ mod.nombre }}
                                </option>
                            </select>
                            <small class="text-danger" v-for="error in errores.modulo_id">@{{ error }}</small>
                        </div>
                    </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="asignatura.nombre"
                            placeholder="Descripción Asignatura">
                        <small class="text-danger" v-for="error in errores.nombre">@{{ error }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="asignatura-create-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light"
                        @click="guardarAsignatura">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
