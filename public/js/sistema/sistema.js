var app= new Vue({
    el: '#wrapper',
    data: {
        roles:[],
        role:{
            id:'',
            name:'',
            guard_name:''
        },
        total_roles:0,
        role_filtro:[],
        usuarios:[],
        usuario:{
            id:'',
            name:'',
            nombres:'',
            apellidos:'',
            dni:'',
            email:'',
            password:'',
            foto:'',
            estado:'',
            role_id:'',
            roles:[],
        },
        total_usuarios:0,
        permissions:[],
        permission:{
            id:'',
            name:'',
            guard_name:''
        },
        total_permissions:0,
        permission_role:{
            role_id:'',
            role_name:'',
            permission_name:[]
        },
        menus:[],
        menu:{
            id:'',
            descripcion:'',
            enlace:'',
            imagen:'',
            padre_id:'',
            orden:'',
            estado:'',
            padre:{}
        },
        total_menus:0,
        showdeletes_menu:false,
        padres:[],
        offset: 4,
        errores:[]
    },
    computed: {
        isActivedRole() {
            return this.roles.current_page;
        },
        pagesNumberRole() {
            if (!this.roles.to) {
                return [];
            }
            var from = this.roles.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.roles.last_page) {
                to = this.roles.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedUsuario() {
            return this.usuarios.current_page;
        },
        pagesNumberUsuario() {
            if (!this.usuarios.to) {
                return [];
            }
            var from = this.usuarios.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.usuarios.last_page) {
                to = this.usuarios.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedPermission() {
            return this.permissions.current_page;
        },
        pagesNumberPermission() {
            if (!this.permissions.to) {
                return [];
            }
            var from = this.permissions.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.permissions.last_page) {
                to = this.permissions.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedMenu() {
            return this.menus.current_page;
        },
        pagesNumberMenu() {
            if (!this.menus.to) {
                return [];
            }
            var from = this.menus.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.menus.last_page) {
                to = this.menus.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods:{
        listarRoles() {
            axios.get('/role/lista').then(({ data }) => (
               this.roles = data,
               this.total_roles = this.roles.total
            ))
        },
        getResultsRoles(page=1) {
            axios.get('/role/lista?page=' + page)
            .then(response => {
                this.roles = response.data
                this.total_roles = this.roles.total
            });
        },
        changePageRoles(page) {
            this.roles.current_page = page;
            this.getResultsRoles(page)
        },
        nuevoRol() {
            this.role.id='',
            this.role.name='',
            this.role.guard_name=''
            this.errores=[]
            $('#modelo').modal('show')
        },
        guardarRol() {
            axios.post('/role/guardar',this.role)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Roles',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#modelo').modal('hide'),
                            this.listarRoles(),
                            this.getResultsRoles()
                        }
                    })
                ))
                .catch((errors) => {
                    if(response = errors.response) {
                        this.errores = response.data.errors,
                        console.clear()
                    }
                })
        },
        mostrarRol(id){
            axios.get('/role/mostrar/',{params:{ id: id}})
                .then(({data}) => (
                    this.role = data,
                    $('#role-show').modal('show')
                ))
        },
        editarRol(id){
            axios.get('/role/mostrar/',{params:{ id: id}})
                .then(({data}) => (
                    this.role = data,
                    this.role.special = (data.special == null) ? '' : data.special,
                    $('#role-edit').modal('show')
                ))
        },
        actualizarRol() {
            axios.put('/role/actualizar',this.role)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Roles',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#role-edit').modal('hide')
                            this.listarRoles()
                            this.getResultsRoles()
                        }
                    })
                ))
                .catch((errors) => {
                    if(response = errors.response) {
                        this.errores = response.data.errors,
                        console.clear()
                    }
                })
        },
        eliminarRol(id){
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'No podrás revertirlo',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/role/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Roles',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarRoles()
                                this.getResultsRoles()
                            }
                        })
                    ))
                    .catch((errors) => {
                        if(response = errors.response) {
                            this.errores = response.data.errors
                        }
                    })
                }
            }).catch(error => {
                this.$Progress.fail()
                swal.showValidationError(
                    `Ocurrió un Error: ${error.response.status}`
                )
            })
                //
        },
        filtroRoles() {
            axios.get('/role/filtro').then(({ data }) => (
                this.role_filtro = data
             ))
        },
        listarUsuario() {
            axios.get('/usuario/lista').then(({ data }) => (
               this.usuarios = data,
               this.total_usuarios = this.usuarios.total
            ))
        },
        getResultsUsuario(page=1) {
            axios.get('/usuario/lista?page=' + page)
            .then(response => {
                this.usuarios = response.data
                this.total_usuarios = this.usuarios.total
            });
        },
        changePageUsuario(page) {
            this.usuarios.current_page = page;
            this.getResultsUsuario(page)
        },
        nuevoUsuario() {
            this.usuario.id='',
            this.usuario.name='',
            this.usuario.nombres='',
            this.usuario.apellidos='',
            this.usuario.email='',
            this.usuario.password='',
            this.usuario.dni='',
            this.errores=[]
            this.filtroRoles()
            $('#user-create').modal('show')
        },
        guardarUsuario() {
            axios.post('/usuario/guardar',this.usuario)
            .then((response) => (
                //console.log(response.data)
                swal.fire({
                    type : 'success',
                    title : 'Usuarios',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                        $('#user-create').modal('hide')
                        this.listarUsuario()
                        this.getResultsUsuario()
                    }
                })
            ))
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors,
                    console.clear()
                }
            })
        },
        mostrarUsuario(id){
            this.filtroRoles()
            axios.get('/usuario/mostrar/',{params:{ id: id}})
            .then(({data}) => (
                this.usuario = data,
                this.usuario.roles.forEach( role => {
                    this.usuario.role_id =  role.id
                }),
                $('#user-show').modal('show')
            ))
        },
        editarUsuario(id) {
            axios.get('/usuario/mostrar',{params:{id:id}})
                .then((response) => {
                    let usu = response.data
                    this.usuario = usu
                    this.usuario.roles.forEach( role => {
                        this.usuario.role_id =  role.id
                    }),
                    this.filtroRoles()
                    $('#user-edit').modal('show')
                })
        },
        actualizarUsuario() {
            axios.put('/usuario/actualizar',this.usuario)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Usuario',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarUsuario()
                            this.getResultsUsuario()
                            $('#user-edit').modal('hide')
                        }
                    })
                ))
                .catch((errors) => {
                    if(response = errors.response) {
                        this.errores = response.data.errors
                        //console.clear()
                    }
                })
        },
        listarPermission() {
            axios.get('/permission/lista').then(({ data }) => (
               this.permissions = data,
               this.total_permissions = this.permissions.total
            ))
        },
        getResultsPermission(page=1) {
            axios.get('/permission/lista?page=' + page)
            .then(response => {
                this.permissions = response.data
                this.total_permissions = this.permissions.total
            });
        },
        changePagePermission(page) {
            this.permissions.current_page = page;
            this.getResultsPermission(page)
        },
        nuevoPermiso() {
            this.permission.id='',
            this.permission.name='',
            this.permission.guard_name=''
            this.errores=[]
            $('#permission-create').modal('show')
        },
        guardarPermiso() {
            axios.post('/permission/guardar',this.permission)
            .then((response) => (
                swal.fire({
                    type : 'success',
                    title : 'PERMISOS',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                        $('#permission-create').modal('hide'),
                        this.listarPermission()
                        this.getResultsPermission()
                    }
                })
            ))
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors,
                    console.clear()
                }
            })
        },
        eliminarPermiso(id){
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'No podrás revertirlo',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/permission/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Permisos',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarPermission(),
                                this.getResultsPermission()
                            }
                        })
                    ))
                    .catch((errors) => {
                        if(response = errors.response) {
                            this.errores = response.data.errors
                        }
                    })
                }
            }).catch(error => {
                this.$Progress.fail()
                swal.showValidationError(
                    `Ocurrió un Error: ${error.response.status}`
                )
            })
                //
        },
        filtroPermisos(){
            axios.get('/permission/filtro').then(({ data }) => (
                this.permissions = data
            ))
        },
        listarPermissionRoles(id) {
            this.permission_role.role_id = id
            axios.get('/permission-role/listarPermissionRoles',{params: {id: id}})
                .then((response ) => {
                    let permisos =response.data
                    this.permission_role.permission_name = []
                    this.permission_role.role_name = permisos[0].name
                    if(permisos.length >0 )
                    {
                        if(permisos[0].permissions.length > 0)
                        {
                            for(let i=0; i<permisos[0].permissions.length; i++)
                            {
                                this.permission_role.permission_name.push(permisos[0].permissions[i].name)
                            }
                        }
                    }
                })
        },
        guardarRolePermission()
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
        },
        listarMenus() {
            axios.get('/menu/lista').then(({ data }) => (
               this.menus = data,
               this.total_menus = this.menus.total
            ))
        },
        listarMenuPadres() {
            axios.get('/menu/padres').then(({ data }) => (
                this.padres = data
            ))
        },
        getResultsMenus(page=1) {
            if(this.showdeletes_menu == false) {
                axios.get('/menu/lista?page=' + page)
                .then(response => {
                    this.menus = response.data
                    this.total_menus = this.menus.total
                });
            }
            else {
                axios.get('/menu/mostrarEliminados?page=' + page)
                .then(response => {
                    this.menus = response.data
                    this.total_menus = this.menus.total
                });
            }
        },
        changePageMenus(page) {
            this.menus.current_page = page;
            this.getResultsMenus(page)
        },
        nuevoMenu() {
            this.menu.id=''
            this.menu.descripcion=''
            this.menu.enlace=''
            this.menu.imagen=''
            this.menu.padre_id=''
            this.menu.orden=''
            this.menu.estado=1
            this.errores=[]
            this.listarMenuPadres()
            $('#menu-create').modal('show')
        },
        guardarMenu() {
            axios.post('/menu/guardar',this.menu)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Menús',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#menu-create').modal('hide'),
                            this.listarMenus(),
                            this.getResultsMenus()
                        }
                    })
                })
                .catch((errors) => {
                    if(response = errors.response) {
                        this.errores = response.data.errors,
                        console.clear()
                    }
                })
        },
        mostrarMenu(id){
            axios.get('/menu/mostrar/',{params:{ id: id}})
                .then(({data}) => (
                    this.menu = data,
                    this.menu.padre_id  = (this.menu.padre_id == 0) ? '' : this.menu.padre_id,
                    $('#menu-show').modal('show')
                ))
        },
        editarMenu(id){
            axios.get('/menu/mostrar/',{params:{ id: id}})
                .then(({data}) => (
                    this.menu = data,
                    this.menu.padre_id  = (this.menu.padre_id == 0) ? '' : this.menu.padre_id,
                    this.listarMenuPadres(),
                    $('#menu-edit').modal('show')
                ))
        },
        actualizarMenu() {
            axios.put('/menu/actualizar',this.menu)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Menús',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarMenus()
                            this.getResultsMenus()
                            $('#menu-edit').modal('hide')
                        }
                    })
                })
                .catch((errors) => {
                    if(response = errors.response) {
                        this.errores = response.data.errors
                        //console.clear()
                    }
                })
        },
        eliminarMenu(id){
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'No podrás revertirlo',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/menu/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Menús',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarMenus()
                                this.getResultsMenus()
                            }
                        })
                    ))
                    .catch((errors) => {
                        if(response = errors.response) {
                            this.errores = response.data.errors
                        }
                    })
                }
            }).catch(error => {
                this.$Progress.fail()
                swal.showValidationError(
                    `Ocurrió un Error: ${error.response.status}`
                )
            })
                //
        },
        mostrarEliminados() {
            this.showdeletes_menu = true
            axios.get('/menu/mostrarEliminados')
            .then(response => {
                this.menus = response.data
                this.total_menus = this.menus.total
                this.listarMenus()
                this.getResultsMenus()
            });
        },
        mostrarHabilitados() {
            this.showdeletes_menu = false
            axios.get('/menu/lista')
            .then(response => {
                this.menus = response.data
                this.total_menus = this.menus.total
                this.listarMenus()
                this.getResultsMenus()
            });
        },
        mostrarTodos() {
            this.showdeletes_menu = false
            axios.get('/menu/todos')
            .then(response => {
                this.menus = response.data
                this.total_menus = this.menus.total
                //this.getResultsMenus()
            });
        },
        restaurarMenu(id) {
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'No podrás revertirlo',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/menu/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Menús',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes_menu = false
                                this.listarMenus()
                                this.getResultsMenus()
                            }
                        })
                    ))
                    .catch((errors) => {
                        if(response = errors.response) {
                            this.errores = response.data.errors
                        }
                    })
                }
            }).catch(error => {
                this.$Progress.fail()
                swal.showValidationError(
                    `Ocurrió un Error: ${error.response.status}`
                )
            })
        }
    },
    created() {
        this.listarRoles()
        this.getResultsRoles()
        this.listarUsuario()
        this.getResultsUsuario()
        this.listarPermission()
        this.getResultsPermission()
        this.filtroRoles()
        this.listarMenus()
        this.getResultsMenus()
    },
})
