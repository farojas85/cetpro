var app = new Vue({
    el:'#contenido',
    data:{
        roles:{},
        usuarios:{},
        totales:'',
        offset:4,
        usuario:{
            id:'',
            name:'',
            email:'',
            password:'',
            foto:'',
            estado:'',
            role_id:''
        },
        errores:[],
        busqueda:''
    },
    computed: {
        isActived() {
            return this.usuarios.current_page;
        },
        pagesNumber() {
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
        }
    },
    methods:{
        listarRoles() {
            axios.get('/role/filtro').then(({data}) => (
                this.roles = data
            )) 
        },
        listar() {
            axios.get('/usuario/lista').then(({ data }) => (
               this.usuarios = data,
               this.totales = this.usuarios.total
            )) 
        },
        getResults(page=1) {   
            axios.get('/usuario/lista?page=' + page)
            .then(response => {
                this.usuarios = response.data
                this.totales = this.usuarios.total
            });       
        },
        changePage(page) {
            this.usuarios.current_page = page;
            this.getResults(page)
        },
        limpiar() {
            this.usuario.name = ''
            this.usuario.email =''
            this.usuario.foto = ''
            this.usuario.password = ''
            this.usuario.estado = 1
            this.usuario.role_id = ''
        },
        nuevo() {
            this.limpiar()
            this.errores=[]
            $('#modelo').modal('show')
        },
        guardar() {
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
                            $('#modelo').modal('hide')
                            this.listar()
                            this.getResults()
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
        mostrar(id) {
            axios.get('/usuario/mostrar',{params:{id:id}})
                .then((response) => {
                    let usu = response.data
                    this.usuario.id =  usu.id
                    this.usuario.name = usu.name
                    this.usuario.email = usu.email
                    this.usuario.estado = usu.estado
                    this.usuario.foto = usu.foto
                    this.usuario.role_id = (usu.roles.length==0 ) ? '' : usu.roles[0].id
                    $('#modelo-show').modal('show')
                })
        },
        editar(id) {
            axios.get('/usuario/mostrar',{params:{id:id}})
                .then((response) => {
                    let usu = response.data
                    this.usuario.id =  usu.id
                    this.usuario.name = usu.name
                    this.usuario.email = usu.email
                    this.usuario.estado = usu.estado
                    this.usuario.foto = usu.foto
                    this.usuario.role_id = (usu.roles.length==0 ) ? '' : usu.roles[0].id
                    $('#modelo-edit').modal('show')
                })
        },
        actualizar() {
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
                            this.listarRoles()
                            this.getResults()
                            $('#modelo-edit').modal('hide')
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
        eliminar(id) {
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
                    axios.post('/usuario/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Usuario',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listar(),
                                this.getResults()
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
        },
        buscar() {

        }
    },
    created() {
        this.listarRoles()
        this.listar()
        this.getResults()
    }
})