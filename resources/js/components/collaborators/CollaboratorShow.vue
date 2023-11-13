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

        <div v-if="card_selected == 'basic'">
            <div class="row">
                <div class="col-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">
                            Información Básica
                        </div>
                        <div class="card-body">
                            <div class="wrapper-basic mt-3">
                                <div class="box-label lb-1">
                                    <p class="">Nombre completo:</p>
                                </div>
                                <div class="box-value vl-1">
                                    <p class="">{{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</p>
                                </div>
                                <div class="box-label lb-2">
                                    <p class="">Tipo de documento:</p>
                                </div>
                                <div class="box-value vl-2">
                                    <p class="">{{ document_type.type }}</p>
                                </div>
                                <div class="box-label lb-3">
                                    <p class="">Número de documento:</p>
                                </div>
                                <div class="box-value vl-3">
                                    <p class="">{{ collaborator.document_number }}</p>
                                </div>
                                <div class="box-label lb-4">
                                    <p class="">Lugar de expedición:</p>
                                </div>
                                <div class="box-value vl-4">
                                    <p class="">{{ document_city.name }} ({{ document_province.name }})</p>
                                </div>
                                <div class="box-label lb-5">
                                    <p class="">Fecha de expedición:</p>
                                </div>
                                <div class="box-value vl-5">
                                    <p class="">{{ collaborator.expedition_date }}</p>
                                </div>
                                <div class="box-label lb-6">
                                    <p class="">Lugar de nacimiento:</p>
                                </div>
                                <div class="box-value vl-6">
                                    <p class="">{{ birth_city.name }} ({{ birth_province.name }})</p>
                                </div>
                                <div class="box-label lb-7">
                                    <p class="">Fecha de nacimiento:</p>
                                </div>
                                <div class="box-value vl-7">
                                    <p class="">{{ collaborator.birth_date }}</p>
                                </div>
                                <div class="box-label lb-8">
                                    <p class="">Estado civil:</p>
                                </div>
                                <div class="box-value vl-8">
                                    <p class="">{{ civil_status.type }}</p>
                                </div>
                                <div class="box-label lb-9">
                                    <p class="">Sexo:</p>
                                </div>
                                <div class="box-value vl-9">
                                    <p class="">{{ sex_type.name }}</p>
                                </div>
                                <div class="box-label lb-10">
                                    <p class="">Tipo de sangre:</p>
                                </div>
                                <div class="box-value vl-10">
                                    <p class="">{{ rh_type.name }}</p>
                                </div>
                                <div class="box-label lb-11">
                                    <p class="">Escolaridad:</p>
                                </div>
                                <div class="box-value vl-11">
                                    <p class="">{{ scholarship_type.name }}</p>
                                </div>
                                <div class="box-label lb-12">
                                    <p class="">Observaciones</p>
                                </div>
                                <div class="box-value vl-12">
                                    <p class="">{{ collaborator.observations }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="main-card mb-3 card">
                        <div class="card-header">
                            Información de Domicilio
                        </div>
                        <div class="card-body">
                            <div class="wrapper-address mt-3">
                                <div class="box-label lb-13">
                                    <p class="">Lugar de residencia:</p>
                                </div>
                                <div class="box-value vl-13">
                                    <p class="">{{ residence_city.name }} ({{ residence_province.name }})</p>
                                </div>
                                <div class="box-label lb-14">
                                    <p class="">Estrato social:</p>
                                </div>
                                <div class="box-value vl-14">
                                    <p class="">{{ stratum_type.id }} - {{ stratum_type.name }}</p>
                                </div>
                                <div class="box-label lb-15">
                                    <p class="">Dirección:</p>
                                </div>
                                <div class="box-value vl-15">
                                    <p class="">{{ collaborator.address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-12 col-lg-6">
                    <div class="main-card mb-3 card">
                        <div class="card-header">
                            Información de Contacto
                        </div>
                        <div class="card-body">
                            <div class="wrapper-contact mt-3">
                                <div class="box-label lb-16">
                                    <p class="">Teléfono fijo:</p>
                                </div>
                                <div class="box-value vl-16">
                                    <p class="">{{ collaborator.phone }}</p>
                                </div>
                                <div class="box-label lb-17">
                                    <p class="">Celular:</p>
                                </div>
                                <div class="box-value vl-17">
                                    <p class="">{{ collaborator.cellphone }}</p>
                                </div>
                                <div class="box-label lb-18">
                                    <p class="">Email:</p>
                                </div>
                                <div class="box-value vl-18">
                                    <p class="">{{ collaborator.email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
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
        residence_province: { default: null, },
        residence_city: { default: null, },
        civil_status: { default: null, },
        sex_type: { default: null, },
        rh_type: { default: null, },
        scholarship_type: { default: null, },
        stratum_type: { default: null, },
    },
    data() {
        return {
            card_selected: '',
            message: '',
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
    border-radius: 5px;
    background-color: #ffffff;
    margin-bottom: 10px;
}

/* .main-card .wrapper-basic {
    display: grid;
    grid-gap: 1px;
    background-color: #dee2e6;
    border: 1px solid #dee2e6;
} */

.main-card .wrapper-basic,
.main-card .wrapper-address,
.main-card .wrapper-contact {
    display: grid;
    grid-gap: 1px;
    background-color: #dee2e6;
    border: 1px solid #dee2e6;
}

@media screen and (min-width: 300px) {
    .main-card .wrapper-basic {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-1" "vl-1" "lb-2" "vl-2" "lb-3" "vl-3" "lb-4" "vl-4" "lb-5" "vl-5" "lb-6" "vl-6" "lb-7" "vl-7" "lb-8" "vl-8" "lb-9" "vl-9" "lb-10" "vl-10" "lb-11" "vl-11" "lb-12" "vl-12";
    }

    .main-card .wrapper-address {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-13" "vl-13" "lb-14" "vl-14" "lb-15" "vl-15";
    }

    .main-card .wrapper-contact {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-16" "vl-16" "lb-17" "vl-17" "lb-18" "vl-18";
    }
}

@media screen and (min-width: 768px) {
    .main-card .wrapper-basic {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-1 lb-1 lb-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1"
                                "lb-2 lb-2 lb-2 vl-2 vl-2 vl-2 lb-3 lb-3 lb-3 vl-3 vl-3 vl-3"
                                "lb-4 lb-4 lb-4 vl-4 vl-4 vl-4 lb-5 lb-5 lb-5 vl-5 vl-5 vl-5"
                                "lb-6 lb-6 lb-6 vl-6 vl-6 vl-6 lb-7 lb-7 lb-7 vl-7 vl-7 vl-7"
                                "lb-8 lb-8 lb-8 vl-8 vl-8 vl-8 lb-9 lb-9 lb-9 vl-9 vl-9 vl-9"
                                "lb-10 lb-10 lb-10 vl-10 vl-10 vl-10 lb-11 lb-11 lb-11 vl-11 vl-11 vl-11"
                                "lb-12 lb-12 lb-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12"
        ;
    }

    .main-card .wrapper-address {
        grid-template-columns: repeat(4, 1fr);
        grid-template-areas:    "lb-13 vl-13 vl-13 vl-13"
                                "lb-14 vl-14 vl-14 vl-14"
                                "lb-15 vl-15 vl-15 vl-15"
        ;
    }

    .main-card .wrapper-contact {
        grid-template-columns: repeat(4, 1fr);
        grid-template-areas:    "lb-16 vl-16 vl-16 vl-16"
                                "lb-17 vl-17 vl-17 vl-17"
                                "lb-18 vl-18 vl-18 vl-18"
        ;
    }
}

@media screen and (min-width: 1200px) {
    .main-card .wrapper-basic {
        grid-template-columns: repeat(24, 1fr);
        grid-template-areas:    "lb-1 lb-1 lb-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1 vl-1 lb-2 lb-2 lb-2 vl-2 vl-2 vl-2 lb-3 lb-3 lb-3 vl-3 vl-3 vl-3"
                                "lb-4 lb-4 lb-4 vl-4 vl-4 vl-4 lb-5 lb-5 lb-5 vl-5 vl-5 vl-5 lb-6 lb-6 lb-6 vl-6 vl-6 vl-6 lb-7 lb-7 lb-7 vl-7 vl-7 vl-7"
                                "lb-8 lb-8 lb-8 vl-8 vl-8 vl-8 lb-9 lb-9 lb-9 vl-9 vl-9 vl-9 lb-10 lb-10 lb-10 vl-10 vl-10 vl-10 lb-11 lb-11 lb-11 vl-11 vl-11 vl-11"
                                "lb-12 lb-12 lb-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12 vl-12"
        ;
    }

    .main-card .wrapper-address {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-13 lb-13 lb-13 vl-13 vl-13 vl-13 lb-14 lb-14 lb-14 vl-14 vl-14 vl-14"
                                "lb-15 lb-15 lb-15 vl-15 vl-15 vl-15 vl-15 vl-15 vl-15 vl-15 vl-15 vl-15"
        ;
    }

    .main-card .wrapper-contact {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-16 lb-16 lb-16 vl-16 vl-16 vl-16 lb-17 lb-17 lb-17 vl-17 vl-17 vl-17"
                                "lb-18 lb-18 lb-18 vl-18 vl-18 vl-18 vl-18 vl-18 vl-18 vl-18 vl-18 vl-18"
        ;
    }
}

.main-card .wrapper-basic .box-label,
.main-card .wrapper-address .box-label,
.main-card .wrapper-contact .box-label {
    display: flex;
    flex-direction: row;
    align-items: center;
    /* background-color: #efefef; */
    background-color: #e0f3ff;
    padding: 5px;
    color: #6c757d;
    font-weight: bold;
}

.main-card .wrapper-basic .box-label p,
.main-card .wrapper-address .box-label p,
.main-card .wrapper-contact .box-label p {
    margin: 0;
}

.main-card .wrapper-basic .box-value,
.main-card .wrapper-address .box-value,
.main-card .wrapper-contact .box-value {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    padding: 5px;
    text-align: center;
}

.main-card .wrapper-basic .box-value p,
.main-card .wrapper-address .box-value p,
.main-card .wrapper-contact .box-value p {
    margin: 0;
}

.main-card .wrapper-basic .lb-1 { grid-area: lb-1; }
.main-card .wrapper-basic .vl-1 { grid-area: vl-1; }
.main-card .wrapper-basic .lb-2 { grid-area: lb-2; }
.main-card .wrapper-basic .vl-2 { grid-area: vl-2; }
.main-card .wrapper-basic .lb-3 { grid-area: lb-3; }
.main-card .wrapper-basic .vl-3 { grid-area: vl-3; }
.main-card .wrapper-basic .lb-4 { grid-area: lb-4; }
.main-card .wrapper-basic .vl-4 { grid-area: vl-4; }
.main-card .wrapper-basic .lb-5 { grid-area: lb-5; }
.main-card .wrapper-basic .vl-5 { grid-area: vl-5; }
.main-card .wrapper-basic .lb-6 { grid-area: lb-6; }
.main-card .wrapper-basic .vl-6 { grid-area: vl-6; }
.main-card .wrapper-basic .lb-7 { grid-area: lb-7; }
.main-card .wrapper-basic .vl-7 { grid-area: vl-7; }
.main-card .wrapper-basic .lb-8 { grid-area: lb-8; }
.main-card .wrapper-basic .vl-8 { grid-area: vl-8; }
.main-card .wrapper-basic .lb-9 { grid-area: lb-9; }
.main-card .wrapper-basic .vl-9 { grid-area: vl-9; }
.main-card .wrapper-basic .lb-10 { grid-area: lb-10; }
.main-card .wrapper-basic .vl-10 { grid-area: vl-10; }
.main-card .wrapper-basic .lb-11 { grid-area: lb-11; }
.main-card .wrapper-basic .vl-11 { grid-area: vl-11; }
.main-card .wrapper-basic .lb-12 { grid-area: lb-12; }
.main-card .wrapper-basic .vl-12 { grid-area: vl-12; }


.main-card .wrapper-address .lb-13 { grid-area: lb-13; }
.main-card .wrapper-address .vl-13 { grid-area: vl-13; }
.main-card .wrapper-address .lb-14 { grid-area: lb-14; }
.main-card .wrapper-address .vl-14 { grid-area: vl-14; }
.main-card .wrapper-address .lb-15 { grid-area: lb-15; }
.main-card .wrapper-address .vl-15 { grid-area: vl-15; }
.main-card .wrapper-address .lb-16 { grid-area: lb-16; }
.main-card .wrapper-address .vl-16 { grid-area: vl-16; }


.main-card .wrapper-contact .lb-16 { grid-area: lb-16; }
.main-card .wrapper-contact .vl-16 { grid-area: vl-16; }
.main-card .wrapper-contact .lb-17 { grid-area: lb-17; }
.main-card .wrapper-contact .vl-17 { grid-area: vl-17; }
.main-card .wrapper-contact .lb-18 { grid-area: lb-18; }
.main-card .wrapper-contact .vl-18 { grid-area: vl-18; }

</style>
