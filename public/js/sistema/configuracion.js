var app= new Vue({
    el: '#wrapper',
    data: {
        especialidades:[],
        total_especialidades:0,
        especialidad:{
            id:'',
            nombre:'',
            estado:''
        },
        show_especialidad:'habilitados',
        offset:4,
        errores:[]
    },
    created() {
        this.mostrarEspecialidadHabilitados()
    },
    computed: {
        isActivedEspecialidad() {
            return this.especialidades.current_page;
        },
        pagesNumberEspecialidad() {
            if (!this.especialidades.to) {
                return [];
            }
            var from = this.especialidades.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.especialidades.last_page) {
                to = this.especialidades.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods: {
        listarEspecialidades() {
            axios.get('/especialidad/'+this.show_especialidad).then(({ data }) => (
               this.especialidades = data,
               this.total_especialidades = this.especialidades.total
            ))
        },
        getResultsEspecialidades(page=1) {
            switch(this.show_especialidad)
            {
                case 'todos':
                    axios.get('/especialidad/todos?page=' + page)
                    .then(response => {
                        this.especialidades = response.data
                        this.total_especialidades = this.especialidades.total
                    }) ; break;
                case 'habilitados':
                    axios.get('/especialidad/habilitados?page=' + page)
                    .then(response => {
                        this.especialidades = response.data
                        this.total_especialidades = this.especialidades.total
                    }) ; break;
                case 'eliminados':
                    axios.get('/especialidad/eliminados?page=' + page)
                    .then(response => {
                        this.especialidades = response.data
                        this.total_especialidades = this.especialidades.total
                    }) ; break;
            }
        },
        changePageEspecialidades(page) {
            this.especialidades.current_page = page;
            this.getResultsEspecialidades(page)
        },
        mostrarEspecialidadTodos() {
           this.show_especialidad = 'todos'
           this.listarEspecialidades('todos')
           this.getResultsEspecialidades();
        },
        mostrarEspecialidadHabilitados() {
            this.show_especialidad ='habilitados'
            this.listarEspecialidades('habilitados')
            this.getResultsEspecialidades()
        },
        mostrarEspecialidadEliminados() {
            this.show_especialidad = 'eliminados'
            this.listarEspecialidades('eliminados')
            this.getResultsEspecialidades()
        },
        nuevaEspecialidad() {
            this.errores=[]
            this.especialidad.id=''
            this.especialidad.nombre=''
            this.especialidad.estado=''
            $('#especialidad-create').modal('show')
        },
        guardarEspecialidad() {
            axios.post('/especialidad/guardar',this.especialidad)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Especialidades',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#especialidad-create').modal('hide'),
                            this.listarEspecialidades('habilitados')
                            this.getResultsEspecialidades(1,'habilitados')
                        }
                    })
                })
                .catch((errors) => {
                    console.log(errors.response)
                    if(response = errors.response) {
                        this.errores = response.data.errors
                        //console.clear()
                    }
                })
        },
        mostrarEspecialidad(id) {
            axios.get('especialidad/mostrar',{params: {id:id}})
            .then((response) => {
                this.especialidad =response.data
                $('#especialidad-show').modal('show')
            })
        },
        editarEspecialidad(id) {
            axios.get('especialidad/mostrar',{params: {id:id}})
            .then((response) => {
                this.especialidad =response.data
                $('#especialidad-edit').modal('show')
            })
        },
        actualizarEspecialidad() {
            axios.put('/especialidad/actualizar',this.especialidad)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Especialidades',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#especialidad-edit').modal('hide'),
                            this.listarEspecialidades()
                            this.getResultsEspecialidades()
                        }
                    })
                })
                .catch((errors) => {
                    console.log(errors.response)
                    if(response = errors.response) {
                        this.errores = response.data.errors
                        //console.clear()
                    }
                })
        },
        eliminarEspecialidad(id) {
            axios.get('especialidad/mostrar',{params: {id:id}})
            .then((response) => {
                this.especialidad =response.data
            })

            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'Especialidad: '+this.especialidad.nombre,
                type:"question",
                showCancelButton: true,
                confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
                confirmButtonColor:"#6610f2",
                cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
                cancelButtonColor:"#e3342f"
            }).then( (response) => {
                if(response.value) {
                    this.eliminarTemporal(id)
                }
                else if( response.dismiss === swal.DismissReason.cancel) {
                   this.eliminarPermanente(id)
                }
            }).catch(error => {
                swal.showValidationError(
                    `Ocurrió un Error: ${error.response.status}`
                )
            })
        },
        eliminarTemporal(id) {
            axios.post('/especialidad/eliminar-temporal',{id:id})
            .then((response) => (
                swal.fire({
                    type : 'success',
                    title : 'Especialidades',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                       this.listarEspecialidades()
                       this.getResultsEspecialidades()
                    }
                })
            ))
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors
                }
            })
        },
        eliminarPermanente(id) {
            axios.post('/especialidad/eliminar-permanente',{id:id})
            .then((response) => (
                swal.fire({
                    type : 'success',
                    title : 'Especialidades',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                        this.listarEspecialidades()
                        this.getResultsEspecialidades()
                    }
                })
            ))
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors
                    swal.fire({
                        type : 'error',
                        title : 'Especialidades',
                        text : this.errores,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    })
                }
            })
        },
        restaurarEspecialidad(id) {
            axios.get('especialidad/mostrar',{params: {id:id}})
            .then((response) => {
                this.especialidad =response.data
            })
            swal.fire({
                title:"¿Está Seguro de Restaurar?",
                text:'Especialidad: '+this.especialidad.nombre,
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#28a745",
                cancelButtonText:"No",
                cancelButtonColor:"#dc3545"
            }).then( (response) => {
                if(response.value) {
                    axios.post('/especialidad/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Especialidad: '+this.especialidad.nombre,
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.show_especialidad = 'habilitados'
                                this.listarEspecialidades()
                                this.getResultsEspecialidades()
                            }
                        })
                    ))
                    .catch((errors) => {
                        if(response = errors.response) {
                            this.errores = response.data.errors
                            swal.fire({
                                type : 'error',
                                title : 'Especialidades',
                                text : this.errores,
                                confirmButtonText: 'Aceptar',
                                confirmButtonColor:"#1abc9c",
                            })
                        }
                    })
                }
            }).catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors
                    swal.fire({
                        type : 'error',
                        title : 'Especialidades',
                        text : this.errores,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    })
                }
            })
        }
    }
})
