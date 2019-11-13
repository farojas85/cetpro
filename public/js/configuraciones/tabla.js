var app = new Vue({
    el:'#contenido',
    data:{
        habilidadSocials:{},
        total_habilidadSocial:'',
        habilidad_social:{
            id:'',
            nombre:'',
            descripcion:'',
            estado:'',
        },
        estiloAprendizajes:{},
        total_aprendizajes:'',
        estilo_aprendizaje:{
            id:'',
            nombre:'',
            descripcion:'',
            estado:''
        },
        areas:{},
        areas_filtro:{},
        total_areas:'',
        area:{
            id:'',
            nombre:'',
            siglas:'',
            estado:''
        },
        personalidads:{},
        personalidads_filtro:{},
        total_personalidads:'',
        personalidad:{
            id:'',
            codigo:'',
            nombre:'',
            estado:''
        },
        ocupaciones:{},
        total_ocupaciones:'',
        ocupacion:{
            id:'',
            nombre:'',
            area_id:'',
            personalidad_id:'',
            estado:''
        },
        showdeletes:false,
        showdeletes_estilo:false,
        showdeletes_area:false,
        showdeletes_personalidad:false,
        showdeletes_ocupacion:false,
        errores:[],
        offset:4
    },
    computed: {
        isActivedHabilidad() {
            return this.habilidadSocials.current_page;
        },
        pagesNumberHabilidad() {
            if (!this.habilidadSocials.to) {
                return [];
            }
            var from = this.habilidadSocials.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.habilidadSocials.last_page) {
                to = this.habilidadSocials.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedEstilo() {
            return this.estiloAprendizajes.current_page;
        },
        pagesNumberEstilo() {
            if (!this.estiloAprendizajes.to) {
                return [];
            }
            var from = this.estiloAprendizajes.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.estiloAprendizajes.last_page) {
                to = this.estiloAprendizajes.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedArea() {
            return this.areas.current_page;
        },
        pagesNumberArea() {
            if (!this.areas.to) {
                return [];
            }
            var from = this.areas.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.areas.last_page) {
                to = this.areas.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedPersonalidad() {
            return this.personalidads.current_page;
        },
        pagesNumberPersonalidad() {
            if (!this.personalidads.to) {
                return [];
            }
            var from = this.personalidads.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.personalidads.last_page) {
                to = this.personalidads.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        isActivedOcupacion() {
            return this.ocupaciones.current_page;
        },
        pagesNumberOcupacion() {
            if (!this.ocupaciones.to) {
                return [];
            }
            var from = this.ocupaciones.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.ocupaciones.last_page) {
                to = this.ocupaciones.last_page;
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
        listarHabilidades() {
            axios.get('/habilidad-social/lista').then(({ data }) => (
                this.habilidadSocials = data,
                this.total_habilidadSocial = this.habilidadSocials.total
             ))
        },
        getResultsHabilidades(page=1) {   
            if(this.showdeletes == false) {
                axios.get('/habilidad-social/lista?page=' + page)
                .then(response => {
                    this.habilidadSocials = response.data
                    this.total_habilidadSocial = this.habilidadSocials.total
                }); 
            }
            else {
                axios.get('/habilidad-social/mostrarEliminados?page=' + page)
                .then(response => {
                    this.habilidadSocials = response.data
                    this.total_habilidadSocial = this.habilidadSocials.total
                });
            }
        },
        changePageHabilidades(page) {
            this.habilidadSocials.current_page = page
            this.getResultsHabilidades(page)
        },
        limpiar(tabla){
            this.errores=[]
            switch(tabla){
                case 'habilidad-social':
                    this.habilidad_social.id=''
                    this.habilidad_social.nombre=''
                    this.habilidad_social.descripcion=''
                    this.habilidad_social.estado=''
                    break
                case 'estilo-aprendizaje':
                    this.estilo_aprendizaje.id=''
                    this.estilo_aprendizaje.nombre=''
                    this.estilo_aprendizaje.descripcion=''
                    this.estilo_aprendizaje.estado=''
                    break
                case 'area':
                    this.area.id=''
                    this.area.siglas=''
                    this.area.nombre=''
                    this.area.estado=''
                    break
                case 'personalidad':
                    this.personalidad.id=''
                    this.personalidad.codigo=''
                    this.personalidad.nombre=''
                    this.personalidad.estado=''
                case 'ocupacion': 
                    this.ocupacion.id=''
                    this.ocupacion.nombre=''
                    this.ocupacion.area_id=''
                    this.ocupacion.personalidad_id=''
                    this.ocupacion.estado=''
            }
        },
        nuevaHabilidadSocial()
        {
            this.limpiar('habilidad-social')
            $('#habilidad-create').modal('show')
        },
        guardarHabilidadSocial() {
            axios.post('/habilidad-social/guardar',this.habilidad_social)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Habilidades Sociales',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#habilidad-create').modal('hide'),
                            this.listarHabilidades(),
                            this.getResultsHabilidades()
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
        mostrarHabilidadSocial(id) {
            this.limpiar('habilidad-social')
            axios.get('/habilidad-social/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.habilidad_social.id =  men.id
                this.habilidad_social.nombre = men.nombre
                this.habilidad_social.descripcion = men.descripcion
                this.habilidad_social.estado = men.estado
                $('#habilidad-show').modal('show')
            })
        },
        editarHabilidadSocial(id) {
            this.limpiar('habilidad-social')
            axios.get('/habilidad-social/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.habilidad_social.id =  men.id
                this.habilidad_social.nombre = men.nombre
                this.habilidad_social.descripcion = men.descripcion
                this.habilidad_social.estado = men.estado
                $('#habilidad-edit').modal('show')
            })
        },
        actualizarHabilidadSocial() {
            axios.put('/habilidad-social/actualizar',this.habilidad_social)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Habilidad Social',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarHabilidades(),
                            this.getResultsHabilidades()
                            $('#habilidad-edit').modal('hide')
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
        eliminarHabilidadSocial(id) {
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
                    axios.post('/habilidad-social/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Menú',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarHabilidades(),
                                this.getResultsHabilidades()
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
        mostrarEliminadosHabilidadSocial()
        {
            this.showdeletes = true
            axios.get('/habilidad-social/mostrarEliminados').then(({ data }) => (
                this.habilidadSocials = data,
                this.total_habilidadSocial = this.habilidadSocials.total
            ))
            this.getResultsHabilidades()
        },
        restaurarHabilidadSocial(id) {
            swal.fire({
                title:"¿Está Seguro de Restaurar el Registro?",
                text:'No podrás revertirlo',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/habilidad-social/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Habilidad Social',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes = false;
                                this.listarHabilidades(),
                                this.getResultsHabilidades()
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
        listarEstilos() {
            axios.get('/estilo-aprendizaje/lista').then(({ data }) => (
                this.estiloAprendizajes = data,
                this.total_aprendizajes = this.estiloAprendizajes.total
             ))
        },
        getResultsEstilos(page=1) {   
            if(this.showdeletes_estilo == false) {
                axios.get('/estilo-aprendizaje/lista?page=' + page)
                .then(response => {
                    this.estiloAprendizajes = response.data
                    this.total_aprendizajes = this.estiloAprendizajes.total
                }); 
            }
            else {
                axios.get('/estilo-aprendizaje/mostrarEliminados?page=' + page)
                .then(response => {
                    this.estiloAprendizajes = response.data
                    this.total_aprendizajes = this.estiloAprendizajes.total
                });
            }
        },
        changePageEstilos(page) {
            this.estiloAprendizajes.current_page = page
            this.getResultsEstilos(page)
        },
        nuevoEstiloAprendizaje() {
            this.limpiar('estilo-aprendizaje')
            $('#estilo-create').modal('show')
        },
        guardarEstiloAprendizaje() {
            axios.post('/estilo-aprendizaje/guardar',this.estilo_aprendizaje)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Estilo de Aprendizaje',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#estilo-create').modal('hide'),
                            this.listarEstilos(),
                            this.getResultsEstilos()
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
        mostrarEstiloAprendizaje(id) {
            this.limpiar('estilo-aprendizaje')
            axios.get('/estilo-aprendizaje/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.estilo_aprendizaje.id =  men.id
                this.estilo_aprendizaje.nombre = men.nombre
                this.estilo_aprendizaje.descripcion = men.descripcion
                this.estilo_aprendizaje.estado = men.estado
                $('#estilo-show').modal('show')
            })
        },
        editarEstiloAprendizaje(id) {
            this.limpiar('estilo-aprendizaje')
            axios.get('/estilo-aprendizaje/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.estilo_aprendizaje.id =  men.id
                this.estilo_aprendizaje.nombre = men.nombre
                this.estilo_aprendizaje.descripcion = men.descripcion
                this.estilo_aprendizaje.estado = men.estado
                $('#estilo-edit').modal('show')
            })
        },
        actualizarEstiloAprendizaje() {
            axios.put('/estilo-aprendizaje/actualizar',this.estilo_aprendizaje)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Estilo de Aprendizaje',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarEstilos(),
                            this.getResultsEstilos()
                            $('#estilo-edit').modal('hide')
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
        eliminarEstiloAprendizaje(id) {
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'Puede Restaurarlo a posteriori',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/estilo-aprendizaje/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Estilo de Aprendizaje',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarEstilos(),
                                this.getResultsEstilos()
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
        mostrarEliminadosEstiloAprendizaje() {
            this.showdeletes_estilo = true
            axios.get('/estilo-aprendizaje/mostrarEliminados').then(({ data }) => (
                this.estiloAprendizajes = data,
                this.total_aprendizajes = this.estiloAprendizajes.total
            ))
            this.getResultsEstilos()
        },
        restaurarEstiloAprendizaje(id) {
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
                    axios.post('/estilo-aprendizaje/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Estilo de Aprendizaje',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes_estilo = false;
                                this.listarEstilos(),
                                this.getResultsEstilos()
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
        listarAreas() {
            axios.get('/area/lista').then(({ data }) => (
                this.areas = data,
                this.total_areas = this.areas.total
            ))
        },
        getResultsAreas(page=1) {   
            if(this.showdeletes_area == false) {
                axios.get('/area/lista?page=' + page)
                .then(response => {
                    this.areas = response.data
                    this.total_areas = this.areas.total
                }); 
            }
            else {
                axios.get('/area/mostrarEliminados?page=' + page)
                .then(response => {
                    this.areas = response.data
                    this.total_areas = this.areas.total
                });
            }
        },
        changePageAreas(page) {
            this.areas.current_page = page
            this.getResultsAreas(page)
        },
        filtroArea(){
            axios.get('/area/filtro').then(({ data }) => (
                this.areas_filtro = data
            ))
        },
        nuevaArea()
        {
            this.limpiar('area')
            $('#area-create').modal('show')
        },
        guardarArea() {
            axios.post('/area/guardar',this.area)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Áreas',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#area-create').modal('hide'),
                            this.listarAreas(),
                            this.getResultsAreas()
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
        mostrarArea(id) {
            this.limpiar('area')
            axios.get('/area/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.area.id =  men.id
                this.area.nombre = men.nombre
                this.area.siglas = men.siglas
                this.area.estado = men.estado
                $('#area-show').modal('show')
            })
        },
        editarArea(id) {
            this.limpiar('area')
            axios.get('/area/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.area.id =  men.id
                this.area.nombre = men.nombre
                this.area.siglas = men.siglas
                this.area.estado = men.estado
                $('#area-edit').modal('show')
            })
        },
        actualizarArea() {
            axios.put('/area/actualizar',this.area)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Áreas',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarAreas(),
                            this.getResultsAreas()
                            $('#area-edit').modal('hide')
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
        eliminarArea(id) {
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'Puede Restaurarlo Luego, si lo desea',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/area/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Áreas',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarAreas(),
                                this.getResultsAreas()
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
        mostrarEliminadosArea() {
            this.showdeletes_area = true
            axios.get('/area/mostrarEliminados').then(({ data }) => (
                this.areas = data,
                this.total_areas = this.areas.total
            ))
            this.getResultsAreas()
        },
        restaurarArea(id) {
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
                    axios.post('/area/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Áreas',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes_area = false;
                                this.listarAreas(),
                                this.getResultsAreas()
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
        listarPersonalidades() {
            axios.get('/personalidad/lista').then(({ data }) => (
                this.personalidads = data,
                this.total_personalidads = this.personalidads.total
             ))
        },
        getResultsPersonalidades(page=1) {   
            if(this.showdeletes_personalidad == false) {
                axios.get('/personalidad/lista?page=' + page)
                .then(response => {
                    this.personalidads = response.data
                    this.total_personalidads = this.personalidads.total
                }); 
            }
            else {
                axios.get('/personalidad/mostrarEliminados?page=' + page)
                .then(response => {
                    this.personalidads = response.data
                    this.total_personalidads = this.personalidads.total
                });
            }
        },
        changePagePersonalidades(page) {
            this.personalidads.current_page = page
            this.getResultsPersonalidades(page)
        },
        filtroPersonalidad(){
            axios.get('/personalidad/filtro').then(({ data }) => (
                this.personalidads_filtro = data
            ))
        },
        nuevaPersonalidad()
        {
            this.limpiar('personalidad')
            $('#personalidad-create').modal('show')
        },
        guardarPersonalidad() {
            axios.post('/personalidad/guardar',this.personalidad)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Personalidad',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#personalidad-create').modal('hide'),
                            this.listarPersonalidades(),
                            this.getResultsPersonalidades()
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
        mostrarPersonalidad(id) {
            this.limpiar('personalidad')
            axios.get('/personalidad/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.personalidad.id =  men.id
                this.personalidad.nombre = men.nombre
                this.personalidad.codigo = men.codigo
                this.personalidad.estado = men.estado
                $('#personalidad-show').modal('show')
            })
        },
        editarPersonalidad(id) {
            this.limpiar('personalidad')
            axios.get('/personalidad/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.personalidad.id =  men.id
                this.personalidad.nombre = men.nombre
                this.personalidad.codigo = men.codigo
                this.personalidad.estado = men.estado
                $('#personalidad-edit').modal('show')
            })
        },
        actualizarPersonalidad() {
            axios.put('/personalidad/actualizar',this.personalidad)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Personalidad',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarPersonalidades(),
                            this.getResultsPersonalidades()
                            $('#personalidad-edit').modal('hide')
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
        eliminarPersonalidad(id) {
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'Puede Restaurarlo Luego, si lo desea',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/personalidad/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Personalidad',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarPersonalidades(),
                                this.getResultsPersonalidades()
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
        mostrarEliminadosPersonalidad() {
            this.showdeletes_personalidad = true
            axios.get('/personalidad/mostrarEliminados').then(({ data }) => (
                this.personalidads = data,
                this.total_personalidads = this.personalidads.total
            ))
            this.getResultsPersonalidades()
        },
        mostrarActivosPersonalidad() {
            this.showdeletes_personalidad=false;
            this.listarPersonalidades()
            this.getResultsPersonalidades()
        },
        restaurarPersonalidad(id) {
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
                    axios.post('/personalidad/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Personalidad',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes_personalidad = false;
                                this.listarPersonalidades(),
                                this.getResultsPersonalidades()
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
        listarOcupaciones() {
            axios.get('/ocupacion/lista').then(({ data }) => (
                this.ocupaciones = data,
                this.total_ocupaciones = this.ocupaciones.total
            ))
        },
        getResultsOcupaciones(page=1) {   
            if(this.showdeletes_ocupacion == false) {
                axios.get('/ocupacion/lista?page=' + page)
                .then(response => {
                    this.ocupaciones = response.data
                    this.total_ocupaciones = this.ocupaciones.total
                }); 
            }
            else {
                axios.get('/ocupacion/mostrarEliminados?page=' + page)
                .then(response => {
                    this.ocupaciones = response.data
                    this.total_ocupaciones = this.ocupaciones.total
                });
            }
        },
        changePageOcupaciones(page) {
            this.ocupaciones.current_page = page
            this.getResultsOcupaciones(page)
        },
        nuevaOcupacion()
        {

            this.limpiar('ocupacion')
            this.filtroArea()
            this.filtroPersonalidad()
            $('#ocupacion-create').modal('show')
        },
        guardarOcupacion() {
            axios.post('/ocupacion/guardar',this.ocupacion)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Ocupación',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            $('#ocupacion-create').modal('hide'),
                            this.listarOcupaciones(),
                            this.getResultsOcupaciones()
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
        mostrarOcupacion(id) {
            this.limpiar('ocupacion')
            this.filtroArea()
            this.filtroPersonalidad()
            axios.get('/ocupacion/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.ocupacion.id =  men.id
                this.ocupacion.nombre = men.nombre
                this.ocupacion.area_id = men.area_id
                this.ocupacion.personalidad_id = men.personalidad_id
                this.ocupacion.estado = men.estado
                $('#ocupacion-show').modal('show')
            })
        },
        editarOcupacion(id) {
            this.limpiar('ocupacion')
            this.filtroArea()
            this.filtroPersonalidad()
            axios.get('/ocupacion/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.ocupacion.id =  men.id
                this.ocupacion.nombre = men.nombre
                this.ocupacion.area_id = men.area_id
                this.ocupacion.personalidad_id = men.personalidad_id
                this.ocupacion.estado = men.estado
                $('#ocupacion-edit').modal('show')
            })
        },
        actualizarOcupacion() {
            axios.put('/ocupacion/actualizar',this.ocupacion)
                .then((response) => (
                    swal.fire({
                        type : 'success',
                        title : 'Ocupación',
                        text : response.data.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor:"#1abc9c",
                    }).then(respuesta => {
                        if(respuesta.value) {
                            this.listarOcupaciones(),
                            this.getResultsOcupaciones()
                            $('#ocupacion-edit').modal('hide')
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
        eliminarOcupacion(id) {
            swal.fire({
                title:"¿Está Seguro de Eliminar?",
                text:'Puede Restaurarlo Luego, si lo desea',
                type:"question",
                showCancelButton: true,
                confirmButtonText:"Si",
                confirmButtonColor:"#38c172",
                cancelButtonText:"No",
                cancelButtonColor:"#e3342f"
            }).then( response => {
                if(response.value){
                    axios.post('/ocupacion/eliminar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Ocupación',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.listarOcupaciones(),
                                this.getResultsOcupaciones()
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
        mostrarEliminadosOcupacion() {
            this.showdeletes_ocupacion = true
            axios.get('/ocupacion/mostrarEliminados').then(({ data }) => (
                this.ocupaciones = data,
                this.total_ocupaciones = this.ocupaciones.total
            ))
            this.getResultsOcupaciones()
        },
        mostrarActivosOcupacion() {
            this.showdeletes_ocupacion=false;
            this.listarOcupaciones()
            this.getResultsOcupaciones()
        },
        restaurarOcupacion(id) {
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
                    axios.post('/ocupacion/restaurar',{id:id})
                    .then((response) => (
                        swal.fire({
                            type : 'success',
                            title : 'Ocupación',
                            text : response.data.mensaje,
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor:"#1abc9c",
                        }).then(respuesta => {
                            if(respuesta.value) {
                                this.showdeletes_ocupacion = false;
                                this.listarOcupaciones(),
                                this.getResultsOcupaciones()
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
    },
    created() {
        this.listarHabilidades()
        this.getResultsHabilidades()
        this.listarEstilos()
        this.getResultsEstilos()
        this.listarAreas()
        this.getResultsAreas()
        this.listarPersonalidades()
        this.getResultsPersonalidades()
        this.listarOcupaciones()
        this.getResultsOcupaciones()
    }
})