<template>
    <div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div v-if="collaborators !== null" class="row">
                    <div v-for="collaborator in paginatedData" :key="collaborator.id" class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
                        <!-- <div class="mb-3 text-dark card-border card bg-light">
                            <div class="card-header">{{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</div>
                            <div class="card-body">
                                {{ collaborator.id }} - {{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}
                            </div>
                            <div class="d-block text-end card-footer">
                                <a :href="`/collaborators/${collaborator.id}`" class="btn-shadow-success btn btn-success btn-lg"><i class="fa fa-eye"></i> Ver detalle</a>
                                <a :href="`/collaborators/${collaborator.id}/edit`" class="btn-shadow-primary btn btn-primary btn-lg mx-2"><i class="fa fa-edit"></i> Editar</a>
                                <a @click="deleteCollaborator(collaborator.id)" class="btn-shadow-danger btn btn-danger btn-lg"><i class="fa fa-trash"></i> Eliminar</a>
                            </div>
                        </div> -->


                        <!-- <div class="card-hover-shadow card-border text-white mb-3 card bg-dark" style="border:1px solid #495057;"> -->
                        <div class="card-hover-shadow text-white mb-3 card bg-dark" style="border: none;">
                            <div class="dropdown-menu-header">
                                <!-- <div class="dropdown-menu-header-inner" style="background-color: #cbcbcb; color:#495057;"> -->
                                <div class="dropdown-menu-header-inner bg-heavy-rain" style="color:#495057; margin: 0; border: none; border-radius: 0;">
                                    <div class="menu-header-content">
                                        <!-- <div class="avatar-icon-wrapper mb-3 avatar-icon-xl">
                                            <div class="avatar-icon">
                                                <img src="images/avatars/2.jpg" alt="Avatar 5">
                                            </div>
                                        </div> -->
                                        <div class="avatar-icon-wrapper me-2 avatar-icon-xl">
                                            <div v-if="collaborator && collaborator.image_url" class="avatar-icon rounded">
                                                <img :src="collaborator.image_url" :alt="collaborator.name">
                                            </div>
                                            <div v-else class="avatar-icon rounded">
                                                <img :src="'/images/default-profile.jpeg'" :alt="collaborator.name">
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="menu-header-title text-truncate">{{ collaborator.id }} - {{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</h5>
                                            <h6 class="menu-header-subtitle text-truncate">Applications Technician</h6>
                                        </div>
                                        <div class="menu-header-btn-pane pt-1">
                                            <!-- <button class="btn-icon btn btn-dark btn-sm">
                                                <i class="pe-7s-config btn-icon-wrapper"></i>
                                                Ver detalle
                                            </button> -->
                                            <a :href="`/collaborators/${collaborator.id}`" class="btn-shadow-dark btn-icon btn btn-dark btn-lg"><i class="fa fa-eye"></i> Ver detalle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center d-block card-footer" style="border: none;">
                                <!-- <button class="btn-shadow-dark btn-wider btn btn-dark">Send Message</button> -->

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
                    url = `/collaborators?origin=delete`
                    window.location.href = url
                    this.errors = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    }
                })
        },
    },
}
</script>
