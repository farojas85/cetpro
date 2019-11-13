var app = new Vue({
    el:'#contenido',
    data:{
        roles:{},
        permissions:{},
        permission_role:{
            role_id:'',
            role_name:'',
            permission_id:[]
        }
    },
    methods:{
        listarRoles() {
            axios.get('/role/filtro').then(({ data }) => (
                this.roles = data
            ))
        },
        listarPermisos(){
            axios.get('/permission/filtro').then(({ data }) => (
                this.permissions = data
            ))
        },
        listarPermissionRoles(id) {
            this.permission_role.role_id = id
            axios.get('/permission-role/listarPermissionRoles',{params: {id: id}})
                .then((response ) => {
                    let permisos =response.data
                    this.permission_role.permission_id = []
                    this.permission_role.role_name = permisos[0].name
                    if(permisos.length >0 )
                    {                        
                        if(permisos[0].permissions.length > 0)
                        {
                            for(let i=0; i<permisos[0].permissions.length; i++)
                            {
                                this.permission_role.permission_id.push(permisos[0].permissions[i].id)
                            }
                        }
                    }
                })
        },
        guardar()
        {
            axios.post('/permission-role/guardar',this.permission_role)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'PERMISOS',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarPermissionRoles(this.permission_role.role_id)
                        }
                    })
                ))
                .catch((errors) => {
                    if(response = errors.response) {
                        this.errores = response.data.errors,
                        console.clear()
                    }
                })
        }
    },
    created() {
        this.listarRoles()
        this.listarPermisos()
        this.listarPermissionRoles(1)
    }
})