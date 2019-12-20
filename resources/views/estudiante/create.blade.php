<!-- sample modal content -->
<div id="estudiante-create" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="estudiante-createLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="estudiante-create-title">Nuevo Estudiante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="estudiante-create-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Tipo Doc.</label>
                            <div class="col-md-9">
                                <select class="form-control" v-model="estudiante.tipo_documento_id">
                                    <option value="">-TIPO DOCUMENTO-</option>
                                    <option v-for="tipo in tipo_documentos" :key="tipo.id" :value="tipo.id">
                                        @{{tipo.nombre_corto}}
                                    </option>
                                </select>
                                <small class="text-danger" v-for="error in errores.tipo_documento_id">@{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Num. Doc.</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="estudiante.numero_documento"
                                    placeholder="Número de Documento" @change="buscarDni">
                                <small class="text-danger" v-for="error in errores.numero_documento">@{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Nombres</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="estudiante.nombres"
                                    placeholder="Nombres">
                                <small class="text-danger" v-for="error in errores.nombres">@{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Ap. Paterno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="estudiante.apellido_paterno"
                                    placeholder="Apellido Paterno">
                                <small class="text-danger" v-for="error in errores.apellido_paterno">@{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Ap. Materno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="estudiante.apellido_materno"
                                    placeholder="Apellido Materno">
                                <small class="text-danger" v-for="error in errores.apellido_materno">@{{ error }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Fecha N.</label>
                            <div class="col-md-9" title="Fecha Nacimiento">
                                <input type="date" v-model="estudiante.fecha_nacimiento" class="form-control">
                                <small class="text-danger" v-for="error in errores.fecha_nacimiento">@{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Sexo</label>
                            <div class="col-md-9" title="Sexo">
                                <select class="form-control" v-model="estudiante.sexo">
                                    <option value="">-Sexo-</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                <small class="text-danger" v-for="error in errores.sexo">@{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Tel&eacute;fono</label>
                            <div class="col-md-9" title="Teléfono">
                                <input type="text" v-model="estudiante.telefono" class="form-control"
                                    placeholder="Teléfono">
                                <small class="text-danger" v-for="error in errores.telefono">@{{ error }}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Direcci&oacute;n</label>
                            <div class="col-md-9" title="Teléfono">
                                <textarea class="form-control" v-model="estudiante.direccion" rows="3"
                                    placeholder="Dirección" title="Dirección" ></textarea>
                                <small class="text-danger" v-for="error in errores.direccion">@{{ error }}</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer" id="estudiante-create-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light"
                        @click="guardar">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
