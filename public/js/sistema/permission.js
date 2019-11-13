var app = new Vue({
    el:'#contenido',
    data:{
        busqueda:'',
        permissions:{},
        total_permissions:'',
        offset:4,
        permission:{
            id:'',
            name:'',
            slug:'',
            description:''
        },
        errores:[]
    },
    computed: {
        isActived() {
            return this.permissions.current_page;
        },
        pagesNumber() {
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
        }
    },
    methods:{
        listar() {
            axios.get('/permission/lista').then(({ data }) => (
               this.permissions = data,
               this.total_permissions = this.permissions.total
            )) 
        },
        getResults(page=1) {   
            axios.get('/permission/lista?page=' + page)
            .then(response => {
                this.permissions = response.data
                this.total_permissions = this.permissions.total
            });       
        },
        changePage(page) {
            this.permissions.current_page = page
            this.getResults(page)
        },
        limpiar() {
            this.errores=[]
            this.permission.id = ''
            this.permission.name= ''
            this.permission.slug=''
            this.permission.description=''
        },
        nuevo() {
            this.limpiar()
            $('#modelo').modal('show')
        },
        guardar() {
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
                        $('#modelo').modal('hide'),
                        this.listar(),
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
        mostrar(id)
        {
            this.limpiar()
            axios.get('/permission/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.permission= men
                $('#modelo-show').modal('show')
            })
        },
        editar(id)
        {
            this.limpiar()
            axios.get('/permission/mostrar',{params:{id:id}})
            .then((response) => {
                let men = response.data
                this.permission= men
                $('#modelo-edit').modal('show')
            })
        },
        actualizar() {

        },
        buscar() {

        }
    },
    created() {
        this.listar()
        this.getResults()
    }
})