<!-- sample modal content -->
<div id="asignatura-show" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="asignatura-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="asignatura-show-title">Mostrar Asignatura</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="asignatura-show-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Especialidad</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="asignatura.modulo.especialidad_id"
                                @change="filtroModuloPorEspecialidad" disabled>
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
                        <label class="col-form-label col-md-3 text-right">M&oacute;dulo</label>
                        <div class="col-md-9">
                            <select class="form-control" v-model="asignatura.modulo_id" disabled>
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
                    <label class="col-form-label col-md-3 text-right">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="asignatura.nombre"
                            placeholder="Descripción Asignatura" disabled>
                        <small class="text-danger" v-for="error in errores.nombre">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Estado</label>
                    <div class="icheck-primary d-inline col-md-9">
                        <input type="checkbox" id="checkboxPrimary1" v-model="asignatura.estado">
                        <label for="checkboxPrimary1"v-if="asignatura.estado">Activo</label>
                        <label for="checkboxPrimary1"v-else>Inactivo</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="asignatura-show-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
