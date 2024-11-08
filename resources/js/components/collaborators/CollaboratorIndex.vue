<template>
    <div>
        <div class="app-page-title">
            <div v-if="selected_collaborator == null && add_collaborator == false && edit_collaborator == false" class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users text-success"></i>
                    </div>
                    <div>
                        Listado de Colaboradores
                    </div>
                </div>
                <div class="page-title-actions">
                    <!-- <a href="{{ route('collaborators.create') }}" type="button" class="btn-shadow me-3 btn btn-info">
                        <i class="fa fa-plus"></i>
                        Agregar
                    </a> -->
                    <button @click="addCollaborator()" class="btn-shadow me-3 btn btn-info">
                        <i class="fa fa-plus"></i>
                        Agregar
                    </button>
                </div>
            </div>
            <div v-else-if="selected_collaborator != null && add_collaborator == false && edit_collaborator == false" class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user text-success"></i>
                    </div>
                    <div>
                        Detalle del Colaborador
                    </div>
                </div>
                <div class="page-title-actions">
                    <button @click="returnToList()" class="btn-shadow me-3 btn btn-info">
                        <i class="fa fa-arrow-left"></i>
                        Volver al listado
                    </button>
                </div>
            </div>
            <div v-else-if="selected_collaborator == null && add_collaborator == true && edit_collaborator == false" class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user text-success"></i>
                    </div>
                    <div>
                        Agregar Colaborador
                    </div>
                </div>
                <div class="page-title-actions">
                    <button @click="returnToList()" class="btn-shadow me-3 btn btn-info">
                        <i class="fa fa-arrow-left"></i>
                        Volver al listado
                    </button>
                </div>
            </div>
            <div v-else-if="selected_collaborator != null && add_collaborator == false && edit_collaborator == true" class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user text-success"></i>
                    </div>
                    <div>
                        Editar Colaborador
                    </div>
                </div>
                <div class="page-title-actions">
                    <button @click="returnToList()" class="btn-shadow me-3 btn btn-info">
                        <i class="fa fa-arrow-left"></i>
                        Volver al listado
                    </button>
                </div>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div v-if="origin == 'updated'" class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="pe-2">
                                <i class="fa fa-star"></i>
                            </span>
                            Colaborador actualizado correctamente!
                        </div>
                        <div v-else-if="origin == 'created'" class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="pe-2">
                                <i class="fa fa-star"></i>
                            </span>
                            Colaborador creado correctamente!
                        </div>
                        <div v-else-if="origin == 'deleted'" class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="pe-2">
                                <i class="fa fa-star"></i>
                            </span>
                            Colaborador eliminado correctamente!
                        </div>
                    </div>
                </div>
                <div v-if="selected_collaborator == null && add_collaborator == false && edit_collaborator == false">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <div class="">
                                        <i class="fa fa-search fa-w-16 "></i>
                                    </div>
                                </div>
                                <input v-model="search" @input="handleSearch" placeholder="Buscar Colaborador ..." type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div v-if="collaborators !== null" class="row">
                        <div v-for="collaborator in paginatedData" :key="collaborator.id" class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <!-- <div class="card-hover-shadow text-white mb-3 card bg-dark" style="border: none;">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-heavy-rain" style="color:#495057; margin: 0; border: none; border-radius: 0;">
                                        <div class="menu-header-content">
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
                                                <button @click="getCollaborator(collaborator.id)" class="btn-shadow-dark btn-icon btn btn-dark btn-lg"><i class="fa fa-eye"></i> Ver detalle</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center d-block card-footer" style="border: none;">
                                    <button @click="editCollaborator(collaborator.id)" class="btn-shadow-primary btn btn-primary btn-lg mx-2"><i class="fa fa-edit"></i> Editar</button>
                                    <button @click="showDeleteAlert('deleteCollaborator', collaborator.id)" class="btn-shadow-danger btn btn-danger btn-lg"><i class="fa fa-trash"></i> Eliminar</button>
                                </div>
                            </div> -->


                            <div class="card-profile mb-3">
                                <div class="img-avatar">
                                    <img v-if="collaborator && collaborator.image_url" :src="collaborator.image_url" :alt="collaborator.name">
                                    <img v-else :src="'/images/default-profile.jpeg'" :alt="collaborator ? collaborator.name : 'Default profile'">
                                </div>
                                <!-- <div class="img-avatar-2">
                                    <img v-if="collaborator && collaborator.image_url" :src="collaborator.image_url" :alt="collaborator.name">
                                    <img v-else :src="'/images/default-profile.jpeg'" :alt="collaborator ? collaborator.name : 'Default profile'">
                                </div> -->
                                <div class="card-profile-text">
                                    <div class="portada"></div>
                                    <div class="title-total">
                                        <div class="title text-truncate">Cargo del Colaborador</div>
                                        <div class="name-profile text-truncate">{{ collaborator ? collaborator.name : '' }}</div>
                                        <div class="surname-profile text-truncate mb-3">{{ collaborator ? collaborator.first_surname : '' }} {{ collaborator ? collaborator.second_surname : '' }}</div>
                                        <div class="email-profile text-truncate">{{ collaborator ? collaborator.email : '' }}</div>
                                        <div class="cellphone-profile text-truncate">{{ collaborator ? collaborator.cellphone : '' }}</div>

                                        <!-- <div class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident eius quo omnis excepturi harum repudiandae nisi maiores dicta suscipit quaerat. Sunt accusamus numquam necessitatibus praesentium deserunt dolores expedita impedit ducimus.</div> -->
                                        <div class="desc"></div>
                                        <div class="actions">
                                            <button v-if="collaborator" @click="getCollaborator(collaborator.id)"><i class="fa fa-eye"></i></button>
                                            <button v-if="collaborator" @click="editCollaborator(collaborator.id)"><i class="fa fa-edit"></i></button>
                                            <button v-if="collaborator" @click="showDeleteAlert('deleteCollaborator', collaborator.id)"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
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
                <div v-else-if="selected_collaborator != null && add_collaborator == false && edit_collaborator == false && collaboratorData">
                    <collaborator-show
                        @editCollaborator="editCollaborator"
                        :collaborator="selected_collaborator"
                        :document_type="collaboratorData.document_type"
                        :document_province="collaboratorData.document_province"
                        :document_city="collaboratorData.document_city"
                        :birth_province="collaboratorData.birth_province"
                        :birth_city="collaboratorData.birth_city"
                        :residence_province="collaboratorData.residence_province"
                        :residence_city="collaboratorData.residence_city"
                        :civil_status="collaboratorData.civil_status"
                        :sex_type="collaboratorData.sex_type"
                        :rh_type="collaboratorData.rh_type"
                        :stratum_type="collaboratorData.stratum_type"
                        :highest_academic_achievement="collaboratorData.highest_academic_achievement"
                        :housing_tenure="collaboratorData.housing_tenure"
                        :relationship_types="collaboratorData.relationship_types"
                        :occupation_types="collaboratorData.occupation_types"
                        :sex_types="collaboratorData.sex_types"
                        :achievement_types="collaboratorData.achievement_types"
                        :examination_types="collaboratorData.examination_types"
                        :home_visit_types="collaboratorData.home_visit_types"
                        :contractual_documents_types="collaboratorData.contractual_documents_types"
                    ></collaborator-show>
                </div>
                <div v-else-if="selected_collaborator == null && add_collaborator == true && edit_collaborator == false && selectsDataCreate">
                    <collaborator-create
                        :document_types="selectsDataCreate.document_types"
                        :sex_types="selectsDataCreate.sex_types"
                        :civil_status_types="selectsDataCreate.civil_status_types"
                        :rh_types="selectsDataCreate.rh_types"
                        :stratum_types="selectsDataCreate.stratum_types"
                        :housing_tenure_types="selectsDataCreate.housing_tenure_types"
                        :provinces="selectsDataCreate.provinces"
                    ></collaborator-create>
                </div>
                <div v-else-if="selected_collaborator != null && add_collaborator == false && edit_collaborator == true && collaboratorDataEdit">
                    <!-- <p>Editar</p> -->
                    <!-- <ComponenteHijo @my-event="manejarEvento" /> -->

                    <collaborator-edit
                        :collaborator="selected_collaborator"
                        :document_types="collaboratorDataEdit.document_types"
                        :sex_types="collaboratorDataEdit.sex_types"
                        :civil_status_types="collaboratorDataEdit.civil_status_types"
                        :rh_types="collaboratorDataEdit.rh_types"
                        :stratum_types="collaboratorDataEdit.stratum_types"
                        :housing_tenure_types="collaboratorDataEdit.housing_tenure_types"
                        :provinces="collaboratorDataEdit.provinces"
                        :position_types="collaboratorDataEdit.position_types"
                        :contract_types="collaboratorDataEdit.contract_types"
                        :bank_types="collaboratorDataEdit.bank_types"
                        :eps_types="collaboratorDataEdit.eps_types"
                        :afp_types="collaboratorDataEdit.afp_types"
                        :arl_types="collaboratorDataEdit.arl_types"
                        :ccf_types="collaboratorDataEdit.ccf_types"
                    ></collaborator-edit>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { create } from 'lodash';

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

            message: '',

            selected_collaborator: null,
            add_collaborator: false,
            edit_collaborator: false,

            collaboratorData: null,
            collaboratorDataEdit: null,
            selectsDataCreate: null,

            collaboratorsData: null,
            collaboratorsPerPage: 12,
            collaboratorsWithFilter: false,
            paginatedData: [],
            currentPage: 1,
            totalPages: 0,
            search: '',
            filteredCollaborators: [],

            origin: '',
        }
    },
    mounted () {
        this.getOrigin()

        this.getTotalPages(this.collaborators)
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
                if(action == 'deleteCollaborator') {
                    this.deleteCollaborator(item)
                }
                this.$swal({
                    title: "Eliminado!",
                    text: "Su registro ha sido borrado.",
                    icon: "success"
                });
            }
            });
        },
        returnToList() {
            this.selected_collaborator = null
            this.add_collaborator = false
            this.edit_collaborator = false
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
                this.collaboratorsWithFilter = true;

                this.filteredCollaborators = this.collaborators.filter(collaborator =>
                    collaborator.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    collaborator.first_surname.toLowerCase().includes(this.search.toLowerCase()) ||
                    collaborator.second_surname.toLowerCase().includes(this.search.toLowerCase()) ||
                    collaborator.document_number.toLowerCase().includes(this.search.toLowerCase()) ||
                    collaborator.email.toLowerCase().includes(this.search.toLowerCase()) ||
                    collaborator.cellphone.toLowerCase().includes(this.search.toLowerCase())
                );

                this.getTotalPages(this.filteredCollaborators);
                this.getPageData(1); // Siempre muestra la primera página después de buscar
            } else {
                this.collaboratorsWithFilter = false;
                this.getTotalPages(this.collaborators);
                this.getPageData(1); // Muestra la primera página al limpiar la búsqueda
            }
        },
        getTotalPages(data) {
            this.totalPages = Math.ceil(data.length / this.collaboratorsPerPage)
        },
        getPageData(page) {
            this.paginatedData = [];
            let start = (page * this.collaboratorsPerPage) - this.collaboratorsPerPage;
            let end = (page * this.collaboratorsPerPage);

            // Utiliza los colaboradores filtrados si hay una búsqueda activa, de lo contrario usa todos los colaboradores
            const data = this.collaboratorsWithFilter ? this.filteredCollaborators : this.collaborators;

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
            const data = this.collaboratorsWithFilter ? this.filteredCollaborators : this.collaborators;
            if (this.currentPage < Math.ceil(data.length / this.collaboratorsPerPage)) {
                this.currentPage++;
            }
            this.getPageData(this.currentPage);
        },
        getCollaborator(collaborator){
            this.selected_collaborator = this.collaborators.find(c => c.id === collaborator)
            this.add_collaborator = false
            this.edit_collaborator = false

            axios.get(`/collaborators/${collaborator}`).then(
                (res) => {
                    this.collaboratorData = res.data
                    // localStorage.setItem('origin', 'deleted');

                    // url = `/collaborators`
                    // window.location.href = url

                    this.errors = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    }
                })
        },
        addCollaborator(){
            // this.$router.push({ name: 'collaborators.create' })
            this.selected_collaborator = null
            this.add_collaborator = true
            this.edit_collaborator = false

            axios.get(`/collaborators/create`).then(
                (res) => {
                    this.selectsDataCreate = res.data
                    this.errors = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    }
                })
        },
        editCollaborator(collaborator){
            this.selected_collaborator = this.collaborators.find(c => c.id === collaborator)
            this.add_collaborator = false
            this.edit_collaborator = true

            // axios.get(`/collaborators/${collaborator}/edit`)
            axios.get(`/collaborators/${collaborator}/edit`).then(
                (res) => {
                    this.collaboratorDataEdit = res.data
                    this.errors = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    }
                })
        },
        deleteCollaborator(id){
            let url = ''
            axios.delete(`/collaborators/${id}/destroy`).then(
                (res) => {
                    localStorage.setItem('origin', 'deleted');

                    url = `/collaborators`
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

<style scoped>
.card-profile {
    height: 230px;
    background: #fff;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
    display: flex;
    flex-direction: row;
    border-radius: 5px;
    position: relative;
}

.card-profile .name-profile {
    margin: 0;
    padding: 0 1rem;
    font-weight: bold;
    font-size: 1.2rem;
}

.card-profile .surname-profile {
    margin: 0;
    padding: 0 1rem;
    font-weight: bold;
    color: #8e8e8e;
}

.card-profile .email-profile {
    margin: 0;
    padding: 0 1rem;
}

.card-profile .cellphone-profile {
    margin: 0;
    padding: 0 1rem;
}

.card-profile .title {
    padding: 1rem;
    text-align: right;
    color: #12b338;
    font-weight: bold;
    font-size: 12px;
}

.card-profile .desc {
    padding: 0.5rem 1rem;
    font-size: 12px;
}

.card-profile .actions {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    align-items: center;
    padding: 0.5rem 1rem;
}

.img-avatar>img {
    width: 80px;
    height: 80px;
    position: absolute;
    border-radius: 50%;
    border: 6px solid white;
    background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
    top: 15px;
    left: 15px;
    transition:.5s;
    &:hover{
        transform: rotate(22deg)
    }
}

/* .img-avatar-2>img {
    width: 50px;
    height: 50px;
    position: absolute;
    border-radius: 50%;
    border: 6px solid white;
    background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
    top: 160px;
    left: 30px;
} */

.card-profile-text {
    width: 100%;
    display: flex;
}

.title-total {
    flex: 1;
    /* padding: 2.5em 1.5em 1.5em 1.5em; */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.portada {
    flex-shrink: 0;
    width: 110px;
    height: 100%;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    background-image: url("/images/card-image-bk.png");
    background-position: bottom center;
    background-size: cover;
}

.actions>button {
    border: none;
    background: none;
    font-size: 24px;
    color: #12b338;
    cursor: pointer;
    transition:.5s;
    &:hover{
        color: #0d7726  ;
        transform: rotate(22deg)
    }
}
</style>
