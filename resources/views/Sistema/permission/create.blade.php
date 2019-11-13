<!-- sample modal content -->
<div id="modelo" class="modal fade" tabindex="-1" role="dialog" 
    aria-labelledby="modeloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelo-title">Nuevo Permiso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modelo-body">
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="permission.name" 
                            placeholder="Nombre de Permiso" >
                        <small class="text-danger" v-for="error in errores.name">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="permission.slug" 
                            placeholder="Slug / Ruta" >
                        <small class="text-danger" v-for="error in errores.slug">@{{ error }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" v-model="permission.description" 
                            placeholder="Descripción" >
                        <small class="text-danger" v-for="error in errores.description">@{{ error }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modelo-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success waves-effect waves-light" @click="guardar">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->