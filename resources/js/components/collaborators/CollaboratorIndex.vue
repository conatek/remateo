<template>
    <div>
        <div v-if="collaborators !== null" class="row">
            <div v-for="collaborator in paginatedData" :key="collaborator.id" class="col-sm-12 col-md-12 col-lg-6">
                <div class="mb-3 text-dark card-border card bg-light">
                    <div class="card-header">{{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</div>
                    <div class="card-body">
                        {{ collaborator.id }} - {{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}
                    </div>
                    <div class="d-block text-end card-footer">
                        <button class="me-2 btn btn-link btn-sm">Cancel</button>
                        <button class="btn-shadow-primary btn btn-primary btn-lg">Submit</button>
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
                <!-- <li class="page-item active">
                    <a href="javascript:void(0);" class="page-link">2</a>
                </li> -->
                <li v-for="page in totalPages()" class="page-item" :class="this.currentPage == page ? 'active' : ''">
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

        <!-- <div v-if="collaborators !== null" class="row">
            <div v-for="collaborator in collaborators" :key="collaborator.id" class="col-sm-12 col-md-12 col-lg-6">
                <div class="mb-3 text-dark card-border card bg-light">
                    <div class="card-header">{{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</div>
                    <div class="card-body">
                        {{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}
                    </div>
                    <div class="d-block text-end card-footer">
                        <button class="me-2 btn btn-link btn-sm">Cancel</button>
                        <button class="btn-shadow-primary btn btn-primary btn-lg">Submit</button>
                    </div>
                </div>
            </div>
        </div> -->
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
        // getCollaborators(page){
        //     this.loading++
        //     axios.get(`/collaborators?page=${page}`)
        //     axios.get(`/collaborators`)
        //          .then(({data}) => {
        //              this.collaborators = data.collaborators
        //              console.log(this.collaborators)
        //          })
        // },
    },
}
</script>

<script setup>
// import { ref } from 'vue';
// import { TailwindPagination } from 'laravel-vue-pagination';

// const laravelData = ref({});

// const getResults = async (page = 1) => {
//     const response = await fetch(`https://example.com/results?page=${page}`);
//     laravelData.value = await response.json();
// }

// getResults();
</script>
