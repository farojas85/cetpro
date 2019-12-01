<div class="card" style="border:1px solid #f1556c !important">
    <div class="card-header bg-danger py-2 text-white">
        <h5 class="card-title mb-0 text-white" v-if="menu_role.role_name">
            Menús Para:... @{{menu_role.role_name}}
        </h5>
    </div>
    <div id="cardCollpase4" class="collapse show">
        <div class="card-body">
            <div class="tab-content pt-0" id="tab-contenido">
                <dl v-for="menu in menus.data" :key="menu.id">
                    <dt v-if="menu.padre_id==0">
                        <input type="checkbox" v-model="menu_role.menu_id" :value="menu.id">
                        @{{ menu.descripcion }} <small v-if="menu.enlace!=''">Enlace(@{{menu.enlace}})</small>
                    </dt>
                    <dd v-else>
                        <input type="checkbox" v-model="menu_role.menu_id" :value="menu.id">
                        @{{ menu.descripcion }} <small v-if="menu.enlace!=''">Enlace(@{{menu.enlace}})</small>
                    </dd>
                </dl>
                <div class="row container-fluid text-center">
                    <button type="button" class="btn btn-success" @click="guardarRoleMenu">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
