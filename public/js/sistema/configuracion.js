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
        especialidad_filtro:[],
        modulos:[],
        total_modulos:0,
        modulo:{
            id:'',
            especialidad_id:'',
            nombre:'',
            estado:'',
        },
        show_modulo:'habilitados',
        modulo_filtro:[],
        asignaturas:[],
        total_asignaturas:0,
        asignatura:{
            id:'',
            modulo:{
                especialidad_id:''
            },
            especialidad:'',
            modulo_id:'',
            nombre:'',
            estado:''
        },
        show_asignatura:'habilitados',
        offset:4,
        errores:[]
    },
    created() {
        this.mostrarEspecialidadHabilitados()
        this.mostrarModuloHabilitados()
        this.mostrarAsignaturaHabilitados()
    },
    computed: {
        isActivedModulo() {
            return this.modulos.current_page;
        },
        pagesNumberModulo() {
            if (!this.modulos.to) {
                return [];
            }
            var from = this.modulos.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.modulos.last_page) {
                to = this.modulos.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
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
        isActivedAsignatura() {
            return this.asignaturas.current_page;
        },
        pagesNumberAsignatura() {
            if (!this.asignaturas.to) {
                return [];
            }
            var from = this.asignaturas.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.asignaturas.last_page) {
                to = this.asignaturas.last_page;
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
        },
        filtroEspecialidad()
        {
            axios.get('/especialidad/filtro').then(({ data }) => (
                this.especialidad_filtro = data
            ))
        },
        listarModulos() {
            axios.get('/modulo/'+this.show_modulo).then(({ data }) => (
               this.modulos = data,
               this.total_modulos = this.modulos.total
            ))
        },
        getResultsModulos(page=1) {
            switch(this.show_modulo)
            {
                case 'todos':
                    axios.get('/modulo/todos?page=' + page)
                    .then(response => {
                        this.modulos = response.data
                        this.total_modulos = this.modulos.total
                    }) ; break;
                case 'habilitados':
                    axios.get('/modulo/habilitados?page=' + page)
                    .then(response => {
                        this.modulos = response.data
                        this.total_modulos = this.modulos.total
                    }) ; break;
                case 'eliminados':
                    axios.get('/modulo/eliminados?page=' + page)
                    .then(response => {
                        this.modulos = response.data
                        this.total_modulos = this.modulos.total
                    }) ; break;
            }
        },
        changePageModulos(page) {
            this.modulos.current_page = page;
            this.getResultsModulos(page)
        },
        mostrarModuloTodos() {
           this.show_modulo = 'todos'
           this.listarModulos()
           this.getResultsModulos();
        },
        mostrarModuloHabilitados() {
            this.show_modulo ='habilitados'
            this.listarModulos()
            this.getResultsModulos()
        },
        mostrarModuloEliminados() {
            this.show_modulo = 'eliminados'
            this.listarModulos()
            this.getResultsModulos()
        },
        nuevoModulo() {
            this.errores=[]
            this.modulo.id=''
            this.modulo.especialidad_id=''
            this.modulo.nombre=''
            this.modulo.estado=''
            this.filtroEspecialidad()
            $('#modulo-create').modal('show')
        },
        guardarModulo() {
            axios.post('/modulo/guardar',this.modulo)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Módulos',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#modulo-create').modal('hide'),
                            this.listarModulos('habilitados')
                            this.getResultsModulos(1,'habilitados')
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
        mostrarModulo(id) {
            axios.get('modulo/mostrar',{params: {id:id}})
            .then((response) => {
                this.filtroEspecialidad()
                this.modulo =response.data
                $('#modulo-show').modal('show')
            })
        },
        editarModulo(id) {
            axios.get('modulo/mostrar',{params: {id:id}})
            .then((response) => {
                this.modulo =response.data
                $('#modulo-edit').modal('show')
            })
        },
        actualizarModulo() {
            axios.put('/modulo/actualizar',this.modulo)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Módulos',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#modulo-edit').modal('hide'),
                            this.listarModulos()
                            this.getResultsModulos()
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
        eliminarModulo(id) {
            axios.get('modulo/mostrar',{params: {id:id}})
            .then((response) => {
                this.modulo =response.data
            })
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'Módulo: '+this.modulo.nombre,
                type:"question",
                showCancelButton: true,
                confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
                confirmButtonColor:"#6610f2",
                cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
                cancelButtonColor:"#e3342f"
            }).then( (response) => {
                if(response.value) {
                    this.eliminarTemporalModulo(id)
                }
                else if( response.dismiss === swal.DismissReason.cancel) {
                   this.eliminarPermanenteModulo(id)
                }
            }).catch(error => {
                swal.showValidationError(
                    `Ocurrió un Error: ${error.response.status}`
                )
            })
        },
        eliminarTemporalModulo(id) {
            axios.post('/modulo/eliminar-temporal',{id:id})
            .then((response) => (
                swal.fire({
                    type : 'success',
                    title : 'Módulos',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                       this.listarModulos()
                       this.getResultsModulos()
                    }
                })
            ))
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors
                }
            })
        },
        eliminarPermanenteModulo(id) {
            axios.post('/modulo/eliminar-permanente',{id:id})
            .then((response) => (
                swal.fire({
                    type : 'success',
                    title : 'Módulos',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                        this.listarModulos()
                        this.getResultsModulos()
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
        restaurarModulo(id) {
            axios.get('modulo/mostrar',{params: {id:id}})
            .then((response) => {
                this.modulo =response.data
            })
            swal.fire({
                title:"¿Está Seguro de Restaurar?",
                text:'Módulo: '+this.modulo.nombre,
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#28a745",
                cancelButtonText:"No",
                cancelButtonColor:"#dc3545"
            }).then( (response) => {
                if(response.value) {
                    axios.post('/modulo/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Módulo: '+this.especialidad.nombre,
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.mostrarModuloHabilitados()
                            }
                        })
                    ))
                    .catch((errors) => {
                        if(response = errors.response) {
                            this.errores = response.data.errors
                            swal.fire({
                                type : 'error',
                                title : 'Módulos',
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
                        title : 'Módulos',
                        text : this.errores,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    })
                }
            })
        },
        filtroModulo()
        {
            axios.get('/modulo/filtro').then(({ data }) => (
                this.modulo_filtro = data
            ))
        },
        filtroModuloPorEspecialidad(e) {
            axios.get('/modulo/filtro-especialidad', {params: {id :e.target.value}})
            .then(({ data }) => (
                this.modulo_filtro = data
            ))
        },
        listarAsignaturas() {
            axios.get('/asignatura/'+this.show_asignatura).then(({ data }) => (
               this.asignaturas = data,
               this.total_asignaturas = this.asignaturas.total
            ))
        },
        getResultsAsignaturas(page=1) {
            switch(this.show_asignatura)
            {
                case 'todos':
                    axios.get('/asignatura/todos?page=' + page)
                    .then(response => {
                        this.asignaturas = response.data
                        this.total_asignaturas = this.asignaturas.total
                    }) ; break;
                case 'habilitados':
                    axios.get('/asignatura/habilitados?page=' + page)
                    .then(response => {
                        this.asignaturas = response.data
                        this.total_asignaturas = this.asignaturas.total
                    }) ; break;
                case 'eliminados':
                    axios.get('/asignatura/eliminados?page=' + page)
                    .then(response => {
                        this.asignaturas = response.data
                        this.total_asignaturas = this.asignaturas.total
                    }) ; break;
            }
        },
        changePageAsignaturas(page) {
            this.asignaturas.current_page = page;
            this.getResultsAsignaturas(page)
        },
        mostrarAsignaturaTodos() {
           this.show_asignatura = 'todos'
           this.listarAsignaturas()
           this.getResultsAsignaturas();
        },
        mostrarAsignaturaHabilitados() {
            this.show_asignatura ='habilitados'
            this.listarAsignaturas()
            this.getResultsAsignaturas()
        },
        mostrarAsignaturaEliminados() {
            this.show_asignatura = 'eliminados'
            this.listarAsignaturas()
            this.getResultsAsignaturas()
        },
        nuevaAsignatura() {
            this.errores=[]
            this.asignatura.id=''
            this.asignatura.especialidad_id=''
            this.asignatura.modulo_id=''
            this.asignatura.nombre=''
            this.asignatura.estado=''
            this.filtroEspecialidad()
            $('#asignatura-create').modal('show')
        },
        guardarAsignatura() {
            axios.post('/asignatura/guardar',this.asignatura)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Asignaturas',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#asignatura-create').modal('hide'),
                            this.listarAsignaturas()
                            this.getResultsAsignaturas()
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
        mostrarAsignatura(id) {
            axios.get('asignatura/mostrar',{params: {id:id}})
            .then((response) => {
                this.filtroEspecialidad()
                this.filtroModulo()
                this.asignatura =response.data
                $('#asignatura-show').modal('show')
            })
        },
        editarAsignatura(id) {
            axios.get('asignatura/mostrar',{params: {id:id}})
            .then((response) => {
                this.filtroEspecialidad()
                this.filtroModulo()
                this.asignatura =response.data
                $('#asignatura-edit').modal('show')
            })
        },
        actualizarAsignatura() {
            axios.put('/asignatura/actualizar',this.asignatura)
                .then((response) => {
                    swal.fire({
                        type : 'success',
                        title : 'Asignaturas',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#asignatura-edit').modal('hide'),
                            this.listarAsignaturas()
                            this.getResultsAsignaturas()
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
        eliminarAsignatura(id) {
            axios.get('asignatura/mostrar',{params: {id:id}})
            .then((response) => {
                this.asignatura =response.data
            })
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'Asignatura: '+this.asignatura.nombre,
                type:"question",
                showCancelButton: true,
                confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
                confirmButtonColor:"#6610f2",
                cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
                cancelButtonColor:"#e3342f"
            }).then( (response) => {
                if(response.value) {
                    this.eliminarTemporalAsignatura(id)
                }
                else if( response.dismiss === swal.DismissReason.cancel) {
                   this.eliminarPermanenteAsignatura(id)
                }
            }).catch(error => {
                swal.showValidationError(
                    `Ocurrió un Error: ${error.response.status}`
                )
            })
        },
        eliminarTemporalAsignatura(id) {
            axios.post('/asignatura/eliminar-temporal',{id:id})
            .then((response) => (
                swal.fire({
                    type : 'success',
                    title : 'Asignaturas',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                       this.listarAsignaturas()
                       this.getResultsAsignaturas()
                    }
                })
            ))
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors
                }
            })
        },
        eliminarPermanenteAsignatura(id) {
            axios.post('/asignatura/eliminar-permanente',{id:id})
            .then((response) => (
                swal.fire({
                    type : 'success',
                    title : 'Asignatura',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                        this.listarAsignaturas()
                        this.getResultsAsignaturas()
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
        restaurarAsignatura(id) {
            axios.get('asignatura/mostrar',{params: {id:id}})
            .then((response) => {
                this.asignatura =response.data
            })
            swal.fire({
                title:"¿Está Seguro de Restaurar?",
                text:'Asignatura: '+this.asignatura.nombre,
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#28a745",
                cancelButtonText:"No",
                cancelButtonColor:"#dc3545"
            }).then( (response) => {
                if(response.value) {
                    axios.post('/asignatura/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Asignatura: '+this.asignatura.nombre,
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.mostrarAsignaturaHabilitados()
                            }
                        })
                    ))
                    .catch((errors) => {
                        if(response = errors.response) {
                            this.errores = response.data.errors
                            swal.fire({
                                type : 'error',
                                title : 'Módulos',
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
                        title : 'Módulos',
                        text : this.errores,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    })
                }
            })
        },
    }
})
