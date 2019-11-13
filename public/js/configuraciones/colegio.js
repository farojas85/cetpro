var app = new Vue({
    el:'#contenido',
    data:{
        busqueda:'',
        errores:[],
        offset:4,
        colegios:[],
        colegio:{},
        total_colegios:'',
        excel_file:'',
        procesar:false
    },
    computed:{
        isActived() {
            return this.colegios.current_page;
        },
        pagesNumber() {
            if (!this.colegios.to) {
                return [];
            }
            var from = this.colegios.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.colegios.last_page) {
                to = this.colegios.last_page;
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
        listar() {
            axios.get('/colegio/lista').then(({ data }) => (
                this.colegios = data,
                this.total_colegios = this.colegios.total
             ))
        },
        getResults(page=1) {   
            axios.get('/colegio/lista?page=' + page)
            .then(response => {
                this.colegios = response.data
                this.total_colegios = this.colegios.total
            });
        },
        changePage(page) {
            this.colegios.current_page = page
            this.getResults(page)
        },
        cargarArchivo(e)
        {
            this.excel_file = e.target.files[0]
        },
        subir() {
            let fromData = new FormData();
            fromData.append('file',this.excel_file);
            axios.post('/colegio/subir',fromData  )
            .then((response) => {
                swal.fire({
                    type : 'success',
                    title : 'Importar Colegios',
                    text : response.data.mensaje,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:"#1abc9c",
                }).then(respuesta => {
                    if(respuesta.value) {
                        this.listar()
                        this.getResults()
                    }
                })
            })
            .catch((errors) => {
                if(response = errors.response) {
                    this.errores = response.data.errors
                }
            })
        }
    },
    created() {
        this.listar()
        this.getResults()
    }
})