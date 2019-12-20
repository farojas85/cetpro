var app= new Vue({
    el: '#wrapper',
    data: {
        tipo_documentos:[],
        estudiantes:[],
        total_estudiantes:0,
        estudiante:{
            id:'',
            tipo_documento_id:'',
            numero_documento:'',
            nombres:'',
            apellido_paterno:'',
            apellido_materno:'',
            foto:'',
            sexo:'',
            direccion:'',
            telefono:'',
            estado:''
        },
        show_estudiante:'habilitados',
        offset:4,
        errores:[],
        desde:''
    },
    computed:{
        isActived() {
            return this.estudiantes.current_page;
        },
        pagesNumber() {
            if (!this.estudiantes.to) {
                return [];
            }
            var from = this.estudiantes.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.estudiantes.last_page) {
                to = this.estudiantes.last_page;
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
        listarTipoDocumentos()
        {
            axios.get('tipo-documento/filtro')
            .then((response) => {
                this.tipo_documentos = response.data
            })
        },
        listar() {
            axios.get('/estudiante/'+this.show_estudiante).then(({ data }) => (
                this.estudiantes = data,
                this.total_estudiantes = this.estudiantes.total
             ))
        },
        getResults(page=1) {
            axios.get('/estudiante/'+this.show_estudiante+'?page='+page)
            .then((response) => {
                this.estudiantes = response.data
                this.total_estudiantes = this.estudiantes.total
            })
        },
        changePage(page) {
            this.estudiantes.current_page = page;
            this.getResults(page)
        },
        mostrarTodos() {
            this.show_estudiante = 'todos'
            this.listar()
            this.getResults();
         },
         mostrarHabilitados() {
             this.show_estudiante ='habilitados'
             this.listar('')
             this.getResults()
         },
         mostrarEliminados() {
             this.show_estudiante = 'eliminados'
             this.listar()
             this.getResults()
         },
        limpiar() {
            this.errores=[]
            this.estudiante = {
                id:'',
                tipo_documento_id:'',
                numero_documento:'',
                nombres:'',
                apellido_paterno:'',
                apellido_materno:'',
                foto:'',
                sexo:'',
                direccion:'',
                telefono:''
            }
        },
        buscarDni(e)
        {
            if(e.target.value.length <= 8)
            {
                axios.get('estudiante/buscar-dni',{params:{numero_documento:e.target.value}})
                .then((response) => {
                    this.errores=[]
                    let persona = response.data
                    this.estudiante.numero_documento = persona.dni
                    this.estudiante.nombres = persona.nombres
                    this.estudiante.apellido_paterno = persona.apellidoPaterno
                    this.estudiante.apellido_materno = persona.apellidoMaterno
                })
                .catch((errors) => {
                    if(response = errors.response) {
                        this.errores = response.data.errors
                        this.estudiante.nombres =''
                        this.estudiante.apellido_paterno = ''
                        this.estudiante.apellido_materno = ''
                        console.clear()
                    }
                })
            }
        },
        buscarEstudiante(e)
        {
            axios.get('estudiante/buscar-estudiante',{params:{texto: e.target.value}})
            .then((response)=> {
                this.estudiantes = response.data
                this.total_estudiantes = this.estudiantes.total
            })
        },
        nuevo() {
            this.limpiar()
            this.listarTipoDocumentos()
            $('#estudiante-create').modal('show')
        },
        guardar() {
            axios.post('estudiante/guardar',this.estudiante)
            .then((response) => {
                swal.fire({
                    type : 'success',
                    title : 'Estudiantes',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                        $('#estudiante-create').modal('hide')
                        this.show_estudiante = 'habilitados'
                        this.listar()
                        this.getResults()
                    }
                })
            })
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors
                    console.clear()
                }
            })
        }
    },
    created() {
        this.listar()
        this.getResults()
    },
})
