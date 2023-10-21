<template>
    <div>
        <div class="card-shadow-primary profile-responsive card-border mb-3 card">
            <div class="dropdown-menu-header">
                <div class="dropdown-menu-header-inner bg-focus">
                    <div class="menu-header-image opacity-3" style="background-image: url('images/dropdown-header/city4.jpg');"></div>
                    <div class="menu-header-content btn-pane-right">
                        <div class="avatar-icon-wrapper me-2 avatar-icon-xl">
                            <div v-if="collaborator && collaborator.image_url" class="avatar-icon rounded">
                                    <img :src="collaborator.image_url" :alt="collaborator.name">
                            </div>
                            <div v-else class="avatar-icon rounded">
                                <img :src="'/images/default-profile.jpeg'" :alt="collaborator.name">
                            </div>
                        </div>
                        <div>
                            <h5 class="menu-header-title">{{ collaborator.name }}</h5>
                            <h6 class="menu-header-subtitle">{{ collaborator.email }}</h6>
                        </div>
                        <div class="menu-header-btn-pane">
                            <a :href="`/collaborators/${collaborator.id}/edit`" class="ladda-button btn btn-pill btn-light" data-style="slide-right">
                                <span class="ladda-label">Editar</span>
                                <span class="ladda-spinner"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="p-0 list-group-item">
                    <div class="grid-menu grid-menu-2col">
                        <div class="g-0 row">
                            <div class="col-sm-6">
                                <a @click="card_selected = 'basic'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-smile btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    Información Básica
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a @click="card_selected = 'contract'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-layers btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    Información Contractual
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a @click="card_selected = 'family'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-heart btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    Información Familiar
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a @click="card_selected = 'documents'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-map btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    Documentos
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-if="card_selected == 'basic'" class="main-card mb-3 card">
            <div class="card-body">
                <div class="wrapper-basic mt-3">
                    <!-- <div class="box box1">
                        <div class="box-content">
                            <p class="title-summary">INFORMACIÓN BÁSICA</p>
                        </div>
                    </div> -->
                    <div class="box box2">
                        <div class="box-content">
                            <p class="rotulo">Nombre(s):</p>
                            <p class="valor">{{ collaborator.name }}</p>
                        </div>
                    </div>
                    <div class="box box3">
                        <div class="box-content">
                            <p class="rotulo">Primer apellido:</p>
                            <p class="valor">{{ collaborator.first_surname }}</p>
                        </div>
                    </div>
                    <div class="box box4">
                        <div class="box-content">
                            <p class="rotulo">Segundo apellido:</p>
                            <p class="valor">{{ collaborator.second_surname }}</p>
                        </div>
                    </div>
                    <div class="box box5">
                        <div class="box-content">
                            <p class="rotulo">Tipo de documento:</p>
                            <p class="valor">{{ document_type.type }}</p>
                        </div>
                    </div>
                    <div class="box box6">
                        <div class="box-content">
                            <p class="rotulo">Número de documento:</p>
                            <p class="valor">{{ collaborator.document_number }}</p>
                        </div>
                    </div>
                    <div class="box box7">
                        <div class="box-content">
                            <p class="rotulo">Estado civil:</p>
                            <p class="valor">{{ civil_status.type }}</p>
                        </div>
                    </div>
                    <div class="box box8">
                        <div class="box-content">
                            <p class="rotulo">Departamento de expedición:</p>
                            <p class="valor">{{ document_province.name }}</p>
                        </div>
                    </div>
                    <div class="box box9">
                        <div class="box-content">
                            <p class="rotulo">Municipio de expedición:</p>
                            <p class="valor">{{ document_city.name }}</p>
                        </div>
                    </div>
                    <div class="box box10">
                        <div class="box-content">
                            <p class="rotulo">Fecha de expedición:</p>
                            <p class="valor">{{ collaborator.expedition_date }}</p>
                        </div>
                    </div>
                    <div class="box box11">
                        <div class="box-content">
                            <p class="rotulo">Departamento de nacimiento:</p>
                            <p class="valor">{{ birth_province.name }}</p>
                        </div>
                    </div>
                    <div class="box box12">
                        <div class="box-content">
                            <p class="rotulo">Municipio de nacimiento:</p>
                            <p class="valor">{{ birth_city.name }}</p>
                        </div>
                    </div>
                    <div class="box box13">
                        <div class="box-content">
                            <p class="rotulo">Fecha de nacimiento:</p>
                            <p class="valor">{{ collaborator.birth_date }}</p>
                        </div>
                    </div>
                    <div class="box box14">
                        <div class="box-content">
                            <p class="rotulo">Sexo:</p>
                            <p class="valor">{{ sex_type.name }}</p>
                        </div>
                    </div>
                    <div class="box box15">
                        <div class="box-content">
                            <p class="rotulo">Tipo de sangre:</p>
                            <p class="valor">{{ rh_type.name }}</p>
                        </div>
                    </div>
                    <div class="box box16">
                        <div class="box-content">
                            <p class="rotulo">Escolaridad:</p>
                            <p class="valor">{{ scholarship_type.name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="card-body">
                <h5 class="card-title">INFORMACIÓN BÁSICA</h5>
                <table class="mb-0 table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row"><b>Nombre(s)</b></th>
                            <td>{{ collaborator.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Primer apellido</b></th>
                            <td>{{ collaborator.first_surname }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Segundo apellido</b></th>
                            <td>{{ collaborator.second_surname }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Tipo de documento</b></th>
                            <td>{{ document_type.type }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Número de documento</b></th>
                            <td>{{ collaborator.document_number }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Departamento de expedición</b></th>
                            <td>{{ document_province.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Municipio de expedición</b></th>
                            <td>{{ document_city.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Fecha de expedición documento</b></th>
                            <td>{{ collaborator.expedition_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Departamento de nacimiento</b></th>
                            <td>{{ birth_province.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Municipio de nacimiento</b></th>
                            <td>{{ birth_city.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Fecha de nacimiento</b></th>
                            <td>{{ collaborator.birth_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Estado civil</b></th>
                            <td>{{ civil_status.type }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Sexo</b></th>
                            <td>{{ sex_type.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Tipo de sangre</b></th>
                            <td>{{ rh_type.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Escolaridad</b></th>
                            <td>{{ scholarship_type.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><b>Observaciones</b></th>
                            <td>{{ collaborator.observations }}</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->
        </div>
        <div v-else-if="card_selected == 'contract'" class="main-card mb-3 card">
            <div class="card-body">
                <p>Este es el card de Información Contractual</p>
            </div>
        </div>
        <div v-else-if="card_selected == 'family'" class="main-card mb-3 card">
            <div class="card-body">
                <p>Este es el card de Información Familiar</p>
            </div>
        </div>
        <div v-else-if="card_selected == 'documents'" class="main-card mb-3 card">
            <div class="card-body">
                <p>Este es el card de Documentos</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        collaborator: { default: null, },
        document_type: { default: null, },
        document_province: { default: null, },
        document_city: { default: null, },
        birth_province: { default: null, },
        birth_city: { default: null, },
        civil_status: { default: null, },
        sex_type: { default: null, },
        rh_type: { default: null, },
        scholarship_type: { default: null, },
    },
    data() {
        return {
            card_selected: '',
        }
    },
    mounted () {
        // 
    },
    methods: {
        // 
    },
}
</script>

<script setup>
import '../../assets/select2.js';
import '../../assets/input-select.js';
</script>

<style scoped>

.main-card {
    box-shadow: 0px 10px 40px rgba(0, 0, 0, 0.1);
    padding: 0px;
    border-radius: 10px;
    background-color: #ffffff;
    margin-bottom: 10px;
}

/* .main-card .wrapper-basic {
    display: grid;
    padding: 10px;
    grid-gap: 0px;
    grid-template-columns: 1fr 1fr 1fr;
} */

.main-card .wrapper-basic {
    display: grid;
    padding: 1px;
    grid-gap: 1px;
    /* grid-auto-rows: 22rem; */
    background-color: #dee2e6;
    /* grid-auto-flow: dense; */
    /* grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr)); */
    grid-template-columns: 1fr;
}

@media screen and (max-width: 767px) {
    .main-card .wrapper-basic {
        grid-template-columns: repeat(1, 1fr);
    }
}

@media screen and (min-width: 768px) {
    .main-card .wrapper-basic {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media screen and (min-width: 992px) {
    .main-card .wrapper-basic {
        grid-template-columns: repeat(3, 1fr);
    }
}

.main-card .wrapper-basic .box {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 4px 8px;
    font-size: 14px;
    background-color: #ffffff;
}

.main-card .wrapper-basic .box .box-content {
    color: #6c757d;
    width: 100%;
}

.main-card .wrapper-basic .box .box-content .title-summary {
    text-align: center;
    font-weight: bold;
    font-size: 18px;
    margin: 0px;
}

.main-card .wrapper-basic .box .box-content .rotulo {
    text-align: left;
    font-weight: bold;
    font-size: 14px;
    line-height: 17px;
    margin-bottom: 2px;
}

.main-card .wrapper-basic .box .box-content .valor {
    text-align: right;
    font-weight: normal;
    font-size: 14px;
    line-height: 17px;
    margin-bottom: 2px;
}

@media screen and (min-width: 768px ) and (max-width: 991px) {
    .main-card .wrapper-basic .box16 {
        grid-column-start: 1;
        grid-column-end: 3;
        /* grid-row-start: 6;
        grid-row-end: 7; */
    }
}

.main-card .wrapper-basic .box1 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 1;
    grid-column-end: 4;
    grid-row-start: 1;
    grid-row-end: 2; */
}

.main-card .wrapper-basic .box2 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 1;
    grid-column-end: 2;
    grid-row-start: 2;
    grid-row-end: 3; */
}

.main-card .wrapper-basic .box3 {
    /* border: 1px dotted #b3b3b3;
    border-bottom: 1px dotted #b3b3b3;
    border-left: 1px dotted #b3b3b3;
    border-right: 1px dotted #b3b3b3;
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 2;
    grid-row-end: 3; */
}

.main-card .wrapper-basic .box4 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 3;
    grid-column-end: 4;
    grid-row-start: 2;
    grid-row-end: 3; */
}

.main-card .wrapper-basic .box5 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 1;
    grid-column-end: 2;
    grid-row-start: 3;
    grid-row-end: 4; */
}

.main-card .wrapper-basic .box6 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    border-left: 1px dotted #b3b3b3;
    border-right: 1px dotted #b3b3b3;
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 3;
    grid-row-end: 4; */
}

.main-card .wrapper-basic .box7 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 3;
    grid-column-end: 4;
    grid-row-start: 3;
    grid-row-end: 4; */
}

.main-card .wrapper-basic .box8 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 1;
    grid-column-end: 2;
    grid-row-start: 4;
    grid-row-end: 5; */
}

.main-card .wrapper-basic .box9 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    border-left: 1px dotted #b3b3b3;
    border-right: 1px dotted #b3b3b3;
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 4;
    grid-row-end: 5; */
}

.main-card .wrapper-basic .box10 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 3;
    grid-column-end: 4;
    grid-row-start: 4;
    grid-row-end: 5; */
}

.main-card .wrapper-basic .box11 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 1;
    grid-column-end: 2;
    grid-row-start: 5;
    grid-row-end: 6; */
}

.main-card .wrapper-basic .box12 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    border-left: 1px dotted #b3b3b3;
    border-right: 1px dotted #b3b3b3;
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 5;
    grid-row-end: 6; */
}

.main-card .wrapper-basic .box13 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 3;
    grid-column-end: 4;
    grid-row-start: 5;
    grid-row-end: 6; */
}

.main-card .wrapper-basic .box14 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 1;
    grid-column-end: 2;
    grid-row-start: 6;
    grid-row-end: 7; */
}

.main-card .wrapper-basic .box15 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    border-left: 1px dotted #b3b3b3;
    border-right: 1px dotted #b3b3b3;
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 6;
    grid-row-end: 7; */
}

.main-card .wrapper-basic .box16 {
    /* border: 1px dotted #b3b3b3; */
    /* border-bottom: 1px dotted #b3b3b3;
    grid-column-start: 3;
    grid-column-end: 4;
    grid-row-start: 6;
    grid-row-end: 7; */
}

</style>
