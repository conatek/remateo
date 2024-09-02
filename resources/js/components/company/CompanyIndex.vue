<template>
    <div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div v-if="origin == 'updated'" class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="pe-2">
                                <i class="fa fa-star"></i>
                            </span>
                            Empresa actualizada correctamente!
                        </div>
                        <div v-else-if="origin == 'created'" class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="pe-2">
                                <i class="fa fa-star"></i>
                            </span>
                            Empresa creada correctamente!
                        </div>
                        <div v-else-if="origin == 'deleted'" class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="pe-2">
                                <i class="fa fa-star"></i>
                            </span>
                            Empresa eliminada correctamente!
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <div class="">
                                    <i class="fa fa-search fa-w-16 "></i>
                                </div>
                            </div>
                            <input v-model="search" @input="handleSearch" placeholder="Buscar Empresa ..." type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div v-if="companies !== null" class="row">
                    <div v-for="company in paginatedData" :key="company.id" class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
                        <div class="card-hover-shadow text-white mb-3 card bg-dark" style="border: none;">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg-heavy-rain" style="color:#495057; margin: 0; border: none; border-radius: 0;">
                                    <div class="menu-header-content">
                                        <div class="avatar-icon-wrapper me-2 avatar-icon-xl">
                                            <div v-if="company && company.image_url" class="avatar-icon rounded">
                                                <img :src="company.image_url" :alt="company.company_name">
                                            </div>
                                            <div v-else class="avatar-icon rounded">
                                                <img :src="'/images/default-profile.jpeg'" :alt="company.company_name">
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="menu-header-title text-truncate">{{ company.id }} - {{ company.company_name }}</h5>
                                            <h6 class="menu-header-subtitle text-truncate">Applications Technician</h6>
                                        </div>
                                        <div class="menu-header-btn-pane pt-1">
                                            <a :href="`/companies/${company.id}`" class="btn-shadow-dark btn-icon btn btn-dark btn-lg"><i class="fa fa-eye"></i> Ver detalle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center d-block card-footer" style="border: none;">
                                <a :href="`/companies/${company.id}/edit`" class="btn-shadow-primary btn btn-primary btn-lg mx-2"><i class="fa fa-edit"></i> Editar</a>
                                <!-- <a @click="deleteCompany(company.id)" class="btn-shadow-danger btn btn-danger btn-lg"><i class="fa fa-trash"></i> Eliminar</a> -->
                                <a @click="showDeleteAlert('deleteCompany', company.id)" class="btn-shadow-danger btn btn-danger btn-lg"><i class="fa fa-trash"></i> Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <nav v-if="companies !== null" class="" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a @click="getPreviousPage()" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                        </li>
                        <li v-for="page in totalPages" class="page-item" :class="currentPage == page ? 'active' : ''">
                            <a @click="getPageData(page)" class="page-link">{{ page }}</a>
                        </li>
                        <li class="page-item">
                            <a @click="getNextPage()" class="page-link" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        companies: {
            default: null,
        },
    },
    data() {
        return {
            loading: 0,

            message: '',

            companiesData: null,
            companiesPerPage: 12,
            companiesWithFilter: false,
            paginatedData: [],
            currentPage: 1,
            totalPages: 0,
            search: '',
            filteredCompanies: [],

            origin: '',
        }
    },
    mounted () {
        this.getOrigin()

        this.getTotalPages(this.companies)
        this.getPageData(1)
    },
    methods: {
        showDeleteAlert(action, item) {
            // Ver ejemplos en: https://sweetalert2.github.io/#examples
            this.$swal({
                title: "¿Seguro que deseas eliminar este registro?",
                text: "¡No podrás revertir esto!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3f6ad8",
                cancelButtonColor: "#444054",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
            if (result.isConfirmed) {
                if(action == 'deleteCompany') {
                    this.deleteCompany(item)
                }
                this.$swal({
                    title: "Eliminado!",
                    text: "Su registro ha sido borrado.",
                    icon: "success"
                });
            }
            });
        },
        getMessage(msg) {
            if(msg != '' && msg != null) {
                this.message = msg
            }

            setTimeout(() => {
                this.message = ''

                this.successfully_created_message = false
                this.successfully_updated_message = false
                this.successfully_deleted_message = false


            }, 3000)
        },
        getOrigin() {
            const origin = localStorage.getItem('origin');
            if (origin !== null) {
                this.origin = origin;
                localStorage.removeItem('origin');
            }
            setTimeout(() => {
                this.origin = '';
            }, 3000);
        },
        handleSearch() {
            if (this.search.length > 0) {
                this.companiesWithFilter = true;

                this.filteredCompanies = this.companies.filter(company => 
                    company.company_name.toLowerCase().includes(this.search.toLowerCase())
                    // company.first_surname.toLowerCase().includes(this.search.toLowerCase()) ||
                    // company.second_surname.toLowerCase().includes(this.search.toLowerCase()) ||
                    // company.document_number.toLowerCase().includes(this.search.toLowerCase()) ||
                    // company.email.toLowerCase().includes(this.search.toLowerCase()) ||
                    // company.cellphone.toLowerCase().includes(this.search.toLowerCase())
                );

                this.getTotalPages(this.filteredCompanies);
                this.getPageData(1); // Siempre muestra la primera página después de buscar
            } else {
                this.companiesWithFilter = false;
                this.getTotalPages(this.companies);
                this.getPageData(1); // Muestra la primera página al limpiar la búsqueda
            }
        },
        getTotalPages(data) {
            this.totalPages = Math.ceil(data.length / this.companiesPerPage)
        },
        getPageData(page) {
            this.paginatedData = [];
            let start = (page * this.companiesPerPage) - this.companiesPerPage;
            let end = (page * this.companiesPerPage);

            // Utiliza las empresas filtradas si hay una búsqueda activa, de lo contrario usa todas las empresas
            const data = this.companiesWithFilter ? this.filteredCompanies : this.companies;
            
            this.paginatedData = data.slice(start, end);
            this.currentPage = page;
        },
        getPreviousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
            this.getPageData(this.currentPage);
        },

        getNextPage() {
            const data = this.companiesWithFilter ? this.filteredCompanies : this.companies;
            if (this.currentPage < Math.ceil(data.length / this.companiesPerPage)) {
                this.currentPage++;
            }
            this.getPageData(this.currentPage);
        },
        deleteCompany(id){
            // console.log('Eliminar empresa: ' + id);

            let url = ''
            axios.delete(`/companies/${id}/destroy`).then(
                (res) => {
                    localStorage.setItem('origin', 'deleted');

                    // this.getMessage(res.data.message)

                    url = `/companies`
                    window.location.href = url
                    this.errors = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors = error.response.data.errors
                    }
                })
        },
    },
}
</script>

<style scoped>
    .message-success {
        width: 100%;
        background: #D8FFDC;
        border-radius: 4px;
        padding: 10px;
    }

    .message-success .content {
        align-items: flex-start;
        justify-content: center;
        border-left: 5px solid #00660A;
    }

    .message-success .content p {
        font-size: 16px;
        line-height: 16px;
    }
</style>
