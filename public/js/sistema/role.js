
var app= new Vue({
    el: '#contenido',
    data: {
        roles:{},
        accesos:[
            {'id': 'all-access','nombre': 'Acceso Total'},
            {'id': 'no-access','nombre': 'Acceso Ninguno'}
        ],
        total_roles:'',
        offset: 4,
        role:{
            id:'',
            name:'',
            slug:'',
            description:'',
            special:''
        },
        errores:[],
        busqueda:''
    },
    computed: {
        isActived() {
            return this.roles.current_page;
        },
        pagesNumber() {
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
        }
    },
    methods:{
        listarRoles() {
            axios.get('/role/lista').then(({ data }) => (
               this.roles = data,
               this.total_roles = this.roles.total
            ))
        },
        getResults(page=1) {
            axios.get('/role/lista?page=' + page)
            .then(response => {
                this.roles = response.data
                this.total_roles = this.roles.total
            });
        },
        changePage(page) {
            this.roles.current_page = page;
            this.getResults(page)
        },
        nuevoRol() {
            this.role.id='',
            this.role.name='',
            this.role.slug='',
            this.role.description='',
            this.role.special='',
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
        mostrar(id){
            axios.get('/role/mostrar/',{params:{ id: id}})
                .then(({data}) => (
                    this.role = data,
                    this.role.special = (data.special == null) ? '' : data.special,
                    $('#modelo-show').modal('show')
                ))
        },
        editar(id){
            axios.get('/role/mostrar/',{params:{ id: id}})
                .then(({data}) => (
                    this.role = data,
                    this.role.special = (data.special == null) ? '' : data.special,
                    $('#modelo-edit').modal('show')
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
                            $('#modelo-edit').modal('hide'),
                            this.listarRoles(),
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
        eliminar(id){
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
                                this.listarRoles(),
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
                //
        },
        buscar(e) {
            this.busqueda = e.target.value
            console.log(this.busqueda)
            axios.get('/role/buscar',{ busqueda : this.busqueda }).then(({ data }) => (
                this.roles = data,
                this.total_roles = this.roles.total
                //this.getResults()
            ))
        }
    },
    created() {
        this.listarRoles()
        this.getResults()
    },
})
