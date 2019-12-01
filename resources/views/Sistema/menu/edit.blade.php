<!-- sample modal content -->
<div id="menu-edit" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="menu-editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="menu-edit-title">Editar Men&uacute;</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="menu-edit-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="menu.descripcion"
                            placeholder="Descripción Menú">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Enlace</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="menu.enlace"
                            placeholder="Ruta del Menú">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Imagen</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="menu.imagen"
                            placeholder="Ícono del Menú">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Padre</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="menu.padre_id" >
                            <option value="">-MEN&Uacute; PADRE-</option>
                            <option v-for="parent in padres" :key="parent.id" :value="parent.id">
                                @{{parent.descripcion}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 text-right">Estado</label>
                    <div class="col-md-9 form-control">
                        <input type="checkbox" v-model="menu.estado">
                        <label v-if="menu.estado">Activo</label>
                        <label v-else>Inactivo</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="menu-edit-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light" @click="actualizarMenu">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
