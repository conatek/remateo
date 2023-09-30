<template>
    <div>
        <!-- {{ totalPages() }} -->
        <div class="row">
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
        </div>

        <!-- <pagination :data="empleados" @pagination-change-page="getResults"></pagination> -->

    </div>

    <!-- <div>
        <ul>
        <li v-for="post in laravelData.data" :key="post.id">{{ post.title }}</li>
        </ul>

        <TailwindPagination
            :data="laravelData"
            @pagination-change-page="getResults"
        />
    </div> -->
</template>

<script>
export default {
    props: {
        company_id: {
            default: null,
        },
        collaborators: {
            default: [],
        },
    },
    data() {
        return {
            // empleados: {},
            // list: this.collaborators,
            // collaboratorsPerPage: 10,
        }
    },
    mounted () {
        this.getResults();
        console.log(empleados);
    },
    methods: {
        // totalPages() {
        //     return Math.ceil(this.list.length / this.collaboratorsPerPage)
        // },
        // getResults(page = 1) {
        //     axios.get('/collaborators?page=' + page)
        //             .then(response => {
        //                 this.empleados = response.data;
        //             });
        // }
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
