var app = new Vue({
    el:'#contenido',
    data:{
        alumno:{
            apellido_paterno:'',
            apellido_materno:'',
            nombres:'',
            departamentos:[],
        }
    },
    methods:{
        buscarDni(event) {
            let dni = event.target.value
            if(dni.length == 8) {
                axios.get('/buscar-dni',{params: {dni :dni }})
                .then(response => {
                    if(response.data!="false")
                    {
                       this.alumno.apellido_paterno = response.data.apellidoPaterno
                       this.alumno.apellido_materno = response.data.apellidoMaterno
                       this.alumno.nombres = response.data.nombres
                    }
                });
            }
        },
        listarDepartamentos() {
            axios.get('/buscar-departamento')
                .then(response => {
                   this.departamentos = response.data
                });
        }
    },
    created() {
        this.listarDepartamentos()
    }
})