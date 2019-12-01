<!-- sample modal content -->
<div id="menu-show" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="menu-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="menu-show-title">Ver Men&uacute;</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="menu-show-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="menu.descripcion"
                            placeholder="Descripción Menú" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Enlace</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="menu.enlace"
                            placeholder="Ruta del Menú" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Imagen</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="menu.imagen"
                            placeholder="Ícono del Menú" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Padre</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="menu.padre_id" disabled >
                            <option value="">-MEN&Uacute; PADRE-</option>
                            <option v-for="parent in padres" :key="parent.id" :value="parent.id">
                                @{{parent.descripcion}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Estado</label>
                    <div class="icheck-primary d-inline col-md-9">
                        <input type="checkbox" id="checkboxPrimary1" v-model="menu.estado" disabled>
                        <label for="checkboxPrimary1" class="col-m-d-3" v-if="menu.estado">Activo</label>
                        <label for="checkboxPrimary1" class="col-m-d-3" v-else>Inactivo</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="menu-show-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
