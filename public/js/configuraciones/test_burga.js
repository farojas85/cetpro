var app = new Vue({
    el:'#contenido',
    data:{
        offset:4,
        errores:[],
        burga_alternativa:{
            id:'',
            nombre:''
        },
        burga_alternativas:[],
        total_burga_alternativas:'',
        showdeletes_burga_alternativa:false,
        burga_afirmacion:{
            id:'',
            nombre:''
        },
        burga_afirmaciones:[],
        total_burga_afirmaciones:'',
        showdeletes_burga_afirmacion:false,
        habilidad_socials:[],
        total_habilidad:'',
        afirmaciones:[],
        total_afirmacion:'',
        afirmacion_habilidad:{
            habilidad_social_id:'',
            nombre_habilidad:'',
            burga_afirmacion_id:[]
        }
    },
    computed:{
        isActivedBurgaAlt() {
            return this.burga_alternativas.current_page;
        },
        pagesNumberBurgaAlt() {
            if (!this.burga_alternativas.to) {
                return [];
            }
            var from = this.burga_alternativas.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.burga_alternativas.last_page) {
                to = this.burga_alternativas.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedAfirmacion() {
            return this.burga_afirmaciones.current_page;
        },
        pagesNumberAfirmacion() {
            if (!this.burga_afirmaciones.to) {
                return [];
            }
            var from = this.burga_afirmaciones.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.burga_afirmaciones.last_page) {
                to = this.burga_afirmaciones.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods:{
        listarAlternativas() {
            axios.get('/burga-alternativa/lista').then(({ data }) => (
                this.burga_alternativas = data,
                this.total_burga_alternativas = this.burga_alternativas.total
             ))
        },
        getResultsAlternativas(page=1) {   
            if(this.showdeletes_burga_alternativa == false) {
                axios.get('/burga-alternativa/lista?page=' + page)
                .then(response => {
                    this.burga_alternativas = response.data
                    this.total_burga_alternativas = this.burga_alternativas.total
                }); 
            }
            else {
                axios.get('/burga-alternativa/mostrarEliminados?page=' + page)
                .then(response => {
                    this.burga_alternativas = response.data
                    this.total_burga_alternativas = this.burga_alternativas.total
                });
            }
        },
        changePageburgaAlt(page) {
            this.burga_alternativas.current_page = page
            this.getResultsAlternativas(page)
        },
        limpiar(tabla){
            this.errores=[]
            switch(tabla){
                case 'burga-alternativa':
                    this.burga_alternativa.id=''
                    break
                case 'burga-afirmacion':
                    this.burga_afirmacion.id=''
                    this.burga_afirmacion.nombre=''
                    break
            }
        },
        nuevaAlternativa()
        {
            this.limpiar('burga-alternativa')
            $('#alternativa-create').modal('show')
        },
        guardarAlternativa() {
            axios.post('/burga-alternativa/guardar',this.burga_alternativa)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Burga Alternativas',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#alternativa-create').modal('hide'),
                            this.listarAlternativas(),
                            this.getResultsAlternativas()
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
        mostrarAlternativa(id) {
            this.limpiar('burga-alternativa')
            axios.get('/burga-alternativa/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.burga_alternativa.id =  men.id
                this.burga_alternativa.nombre = men.nombre
                $('#alternativa-show').modal('show')
            })
        },
        editarAlternativa(id) {
            this.limpiar('burga-alternativa')
            axios.get('/burga-alternativa/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.burga_alternativa.id =  men.id
                this.burga_alternativa.nombre = men.nombre
                $('#alternativa-edit').modal('show')
            })
        },
        actualizarAlternativa() {
            axios.put('/burga-alternativa/actualizar',this.burga_alternativa)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Alternativa',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarAlternativas(),
                            this.getResultsAlternativas()
                            $('#alternativa-edit').modal('hide')
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
        eliminarAlternativa(id) {
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
                    axios.post('/burga-alternativa/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Alternativa',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarAlternativas(),
                                this.getResultsAlternativas()
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
        mostrarEliminadosAlternativa() {
            this.showdeletes_burga_alternativa = true
            axios.get('/burga-alternativa/mostrarEliminados').then(({ data }) => (
                this.burga_alternativas = data,
                this.total_burga_alternativas = this.burga_alternativas.total
            ))
            this.getResultsAlternativas()
        },
        mostrarActivosAlternativa() {
            this.showdeletes_burga_alternativa=false;
            this.listarAlternativas()
            this.getResultsAlternativas()
        },
        restaurarAlternativa(id) {
            swal.fire({
                title:"¿Está Seguro de Restaurar el Registro?",
                text:'Puede Eliminarlo Cuando desee',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/burga-alternativa/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Alternativas',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes_burga_alternativa = false;
                                this.listarAlternativas(),
                                this.getResultsAlternativas()
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
        listarAfirmaciones() {
            axios.get('/burga-afirmacion/lista').then(({ data }) => (
                this.burga_afirmaciones = data,
                this.total_burga_afirmaciones = this.burga_afirmaciones.total
             ))
        },
        getResultsAfirmaciones(page=1) {   
            if(this.showdeletes_burga_afirmacion == false) {
                axios.get('/burga-afirmacion/lista?page=' + page)
                .then(response => {
                    this.burga_afirmaciones = response.data
                    this.total_burga_afirmaciones = this.burga_afirmaciones.total
                }); 
            }
            else {
                axios.get('/burga-afirmacion/mostrarEliminados?page=' + page)
                .then(response => {
                    this.burga_afirmaciones = response.data
                    this.total_burga_afirmaciones = this.burga_afirmaciones.total
                });
            }
        },
        changePageAfirmaciones(page) {
            this.burga_afirmaciones.current_page = page
            this.getResultsAfirmaciones(page)
        },
        nuevaAfirmacion()
        {
            this.limpiar('burga-afirmacion')
            $('#afirmacion-create').modal('show')
        },
        guardarAfirmacion() {
            axios.post('/burga-afirmacion/guardar',this.burga_afirmacion)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Burga Afirmaciones',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#afirmacion-create').modal('hide'),
                            this.listarAfirmaciones(),
                            this.getResultsAfirmaciones()
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
        mostrarAfirmacion(id) {
            this.limpiar('burga-afirmacion')
            axios.get('/burga-afirmacion/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.burga_afirmacion.id =  men.id
                this.burga_afirmacion.nombre = men.nombre
                $('#afirmacion-show').modal('show')
            })
        },
        editarAfirmacion(id) {
            this.limpiar('burga-afirmacion')
            axios.get('/burga-afirmacion/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.burga_afirmacion.id =  men.id
                this.burga_afirmacion.nombre = men.nombre
                $('#afirmacion-edit').modal('show')
            })
        },
        actualizarAfirmacion() {
            axios.put('/burga-afirmacion/actualizar',this.burga_afirmacion)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Afirmación',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarAfirmaciones(),
                            this.getResultsAfirmaciones()
                            $('#afirmacion-edit').modal('hide')
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
        eliminarAfirmacion(id) {
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
                    axios.post('/burga-afirmacion/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Afirmación',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarAfirmaciones(),
                                this.getResultsAfirmaciones()
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
        mostrarEliminadosAfirmacion() {
            this.showdeletes_burga_afirmacion = true
            axios.get('/burga-afirmacion/mostrarEliminados').then(({ data }) => (
                this.burga_afirmaciones = data,
                this.total_burga_afirmaciones = this.burga_afirmaciones.total
            ))
            this.getResultsAfirmaciones()
        },
        mostrarActivosAfirmacion() {
            this.showdeletes_burga_afirmacion=false;
            this.listarAfirmaciones()
            this.getResultsAfirmaciones()
        },
        restaurarAfirmacion(id) {
            swal.fire({
                title:"¿Está Seguro de Restaurar el Registro?",
                text:'Puede Eliminarlo Cuando desee',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/burga-afirmacion/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Afirmacipón',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes_burga_afirmacion = false;
                                this.listarAfirmaciones(),
                                this.getResultsAfirmaciones()
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
        filtarHabilidades() {
            axios.get('/habilidad-social/filtro').then(({ data }) => (
                this.habilidad_socials = data,
                this.total_habilidad = this.habilidad_socials.length
            ))
        },
        filtarAfirmaciones() {
            axios.get('/burga-afirmacion/filtro').then(({ data }) => (
                this.afirmaciones = data,
                this.total_afirmacion = this.afirmaciones.length
            ))
        },
        listarAfirmacionesHabilidad(id) {
            this.afirmacion_habilidad.habilidad_social_id = id
            axios.get('/burga-afirmacion/listarAfirmacionesHabilidad',{params: {id: id}})
                .then((response ) => {
                    var afirmaciones = response.data
                    this.afirmacion_habilidad.burga_afirmacion_id = []
                    this.afirmacion_habilidad.nombre_habilidad = afirmaciones[0].nombre
                    if(afirmaciones.length >0 )
                    {                        
                        if(afirmaciones[0].burga_afirmacions.length > 0)
                        {
                            for(let i=0; i<afirmaciones[0].burga_afirmacions.length; i++)
                            {
                                this.afirmacion_habilidad.burga_afirmacion_id.push(afirmaciones[0].burga_afirmacions[i].id)
                            }
                        }
                    }
                })
        },
        guardar()
        {
            axios.post('/burga-afirmacion/guardarAfirmaciones',this.afirmacion_habilidad)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Afirmaciones / Habilidad Social',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarAfirmacionesHabilidad(this.afirmacion_habilidad.habilidad_social_id)
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
        this.listarAlternativas()
        this.getResultsAlternativas()
        this.listarAfirmaciones()
        this.getResultsAfirmaciones()
        this.filtarHabilidades()
        this.filtarAfirmaciones()
        this.listarAfirmacionesHabilidad(1)
    }
})