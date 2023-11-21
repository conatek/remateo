<template>
    <div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div v-if="collaborators !== null" class="row">
                    <div v-for="collaborator in paginatedData" :key="collaborator.id" class="col-sm-12 col-md-12 col-lg-6">
                        <div class="mb-3 text-dark card-border card bg-light">
                            <div class="card-header">{{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</div>
                            <div class="card-body">
                                {{ collaborator.id }} - {{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}
                            </div>
                            <div class="d-block text-end card-footer">
                                <!-- <a class="me-2 btn btn-link btn-sm">Cancelar</a> -->
                                <a :href="`/collaborators/${collaborator.id}`" class="btn-shadow-success btn btn-success btn-lg"><i class="fa fa-eye"></i> Ver detalle</a>
                                <a :href="`/collaborators/${collaborator.id}/edit`" class="btn-shadow-primary btn btn-primary btn-lg mx-2"><i class="fa fa-edit"></i> Editar</a>
                                <!-- <a :href="`/collaborators/${collaborator.id}/destroy`" class="btn-shadow-danger btn btn-danger btn-lg"><i class="fa fa-trash"></i> Eliminar</a> -->
                                <a @click="deleteCollaborator(collaborator.id)" class="btn-shadow-danger btn btn-danger btn-lg"><i class="fa fa-trash"></i> Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <nav v-if="collaborators !== null" class="" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a @click="getPreviousPage()" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                        </li>
                        <li v-for="page in totalPages()" class="page-item" :class="currentPage == page ? 'active' : ''">
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
        company_id: {
            default: null,
        },
        collaborators: {
            default: null,
        },
    },
    data() {
        return {
            loading: 0,
            collaboratorsData: null,
            collaboratorsPerPage: 10,
            collaboratorsWithFilter: false,
            paginatedData: [],
            currentPage: 1,
        }
    },
    mounted () {
        // if(this.collaborators === null) {
        //     this.getCollaborators(1)
        // }
        console.log(this.collaborators);
        this.getPageData(1)
    },
    methods: {
        totalPages() {
            return Math.ceil(this.collaborators.length / this.collaboratorsPerPage)
        },
        getPageData(page) {
            this.paginatedData = [];
            let start = (page * this.collaboratorsPerPage) - this.collaboratorsPerPage;
            let end = (page * this.collaboratorsPerPage);
            this.paginatedData = this.collaborators.slice(start, end);
            this.currentPage = page
        },
        getPreviousPage() {
            if(this.currentPage > 1) {
                this.currentPage--;
            }
            this.getPageData(this.currentPage);
        },
        getNextPage() {
            if(this.currentPage < this.totalPages()) {
                this.currentPage++;
            }
            this.getPageData(this.currentPage);
        },
        editCollaborator(collaborator){
            axios.get(`/collaborators/${collaborator}/edit`)
        },
        deleteCollaborator(id){
            let url = ''
            axios.delete(`/collaborators/${id}/destroy`).then(
                (res) => {
                    // console.log(res)
                    // url = `/collaborators/${res.data.collaborator.id}-success`
                    url = `/collaborators?origin=delete`
                    window.location.href = url
                    this.errors = null
                    console.log(this.message);
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
