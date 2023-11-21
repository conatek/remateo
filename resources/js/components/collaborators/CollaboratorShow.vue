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
                                <div class="box-label lb-16">
                                    <p class="">Tenencia:</p>
                                </div>
                                <div class="box-value vl-16">
                                    <p class="">{{ housing_tenure.type }}</p>
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
                                <div class="box-label lb-17">
                                    <p class="">Teléfono fijo:</p>
                                </div>
                                <div class="box-value vl-17">
                                    <p class="">{{ collaborator.phone }}</p>
                                </div>
                                <div class="box-label lb-18">
                                    <p class="">Celular:</p>
                                </div>
                                <div class="box-value vl-18">
                                    <p class="">{{ collaborator.cellphone }}</p>
                                </div>
                                <div class="box-label lb-19">
                                    <p class="">Email:</p>
                                </div>
                                <div class="box-value vl-19">
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
        <div v-else-if="card_selected == 'family'" >
            <div class="row">
                <div class="col-sm-12 col-xxl-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div v-if="successfully_created_message && !successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Información del familiar <strong>creada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Información del familiar <strong>actualizada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && !successfully_updated_message && successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Información del familiar <strong>eliminada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="relatives_data && relatives_data.length>0" class="row"> 
                                <div class="col-md-12 col-lg-6">
                                    <a @click="addRelativeData" class="wrapper-add-relative-data p-2 mb-3" :class="(add_relative_data && !edit_relative_data) ? 'selected shadow' : ''">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Familiar</p>
                                    </a>
                                </div>
                                <div v-for="(item, index) in relatives_data" class="col-md-12 col-lg-6">
                                    <div class="wrapper-relative mb-3 position-relative" :class="(selected_relative_data && selected_relative_data.id) == item.id ? 'selected shadow' : ''">
                                        <div @click="changeRelativeData(item.id, index)" class="box box1">
                                            <div class="preliminary-information">
                                                <p class="relative-name text-truncate w-100">{{ item.name }} {{ item.first_surname }} {{ item.second_surname }}</p>
                                                <p class="relative-relationship text-truncate w-100">{{ item.relationship }}</p>
                                                <p class="relative-age text-truncate w-100">Edad: {{ getAge(item.birth_date) }} años</p>
                                                <!-- <p class="email text-truncate w-100">{{ item.birth_date }}</p> -->
                                            </div>
                                        </div>
                                        <div class="box box2">
                                            <a class="edit-relative-data" @click="editRelativeData(item, index)"><img :src="'/images/icons/edit.svg'" alt="edit-2"></a>
                                            <a class="delete-relative-data" @click="deleteRelativeData(item, index)"><img :src="'/images/icons/trash.svg'" alt="trash"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="row">
                                <div class="col-md-12">
                                    <a @click="addRelativeData" class="wrapper-add-relative-data p-2 mb-3">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Familiar</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                    <div v-if="add_relative_data && !edit_relative_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form @submit.prevent="storeRelativeData" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-hover-shadow card-border mb-3 card add-relative-card">
                                                <div class="card-header">
                                                    Agregar Familiar
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="name" class="form-label">Nombres*</label>
                                                                <input v-model="name" name="name" id="name" type="text" class="form-control" placeholder="Ingrese nombre(s)">
                                                                <span v-if="errors_relative_data && errors_relative_data.name" class="error text-danger" for="name">{{ errors_relative_data.name[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="first_surname" class="form-label">Primer apellido*</label>
                                                                <input v-model="first_surname" name="first_surname" id="first_surname" type="text" class="form-control" placeholder="Ingrese primer apellido">
                                                                <span v-if="errors_relative_data && errors_relative_data.first_surname" class="error text-danger" for="first_surname">{{ errors_relative_data.first_surname[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="second_surname" class="form-label">Segundo apellido</label>
                                                                <input v-model="second_surname" name="second_surname" id="second_surname" type="text" class="form-control" placeholder="Ingrese segundo apellido">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="relationship_type_id" class="form-label">Parentesco*</label>
                                                                <select v-model="relationship_type_id" class="form-control" name="relationship_type_id" id="relationship_type_id">
                                                                    <option value="" disabled selected hidden>Seleccionar Parentesco</option>
                                                                    <option v-for="relationship in relationship_types" :value="relationship.id">{{ relationship.name }}</option>
                                                                </select>
                                                                <span v-if="errors_relative_data && errors_relative_data.relationship_type_id" class="error text-danger" for="relationship_type_id">{{ errors_relative_data.relationship_type_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="sex_type_id" class="form-label">Sexo*</label>
                                                                <select v-model="sex_type_id" class="form-control" name="sex_type_id" id="sex_type_id">
                                                                    <option value="" disabled selected hidden>Seleccionar Sexo</option>
                                                                    <option v-for="sex in sex_types" :value="sex.id">{{ sex.name }}</option>
                                                                </select>
                                                                <span v-if="errors_relative_data && errors_relative_data.sex_type_id" class="error text-danger" for="sex_type_id">{{ errors_relative_data.sex_type_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="occupation_type_id" class="form-label">Ocupación*</label>
                                                                <select v-model="occupation_type_id" class="form-control" name="occupation_type_id" id="occupation_type_id">
                                                                    <option value="" disabled selected hidden>Seleccionar Ocupación</option>
                                                                    <option v-for="occupation in occupation_types" :value="occupation.id">{{ occupation.name }}</option>
                                                                </select>
                                                                <span v-if="errors_relative_data && errors_relative_data.occupation_type_id" class="error text-danger" for="occupation_type_id">{{ errors_relative_data.occupation_type_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="birth_date" class="form-label">Fecha de Nacimiento*</label>
                                                                <input v-model="birth_date" name="birth_date" id="birth_date" type="date" class="form-control" placeholder="Ingrese fecha de nacimiento">
                                                                <span v-if="errors_relative_data && errors_relative_data.birth_date" class="error text-danger" for="birth_date">{{ errors_relative_data.birth_date[0] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-2 btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_relative_data && edit_relative_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form @submit.prevent="updateRelativeData" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-hover-shadow card-border mb-3 card edit-relative-card">
                                                <div class="card-header">
                                                    Editar Familiar
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="name" class="form-label">Nombres*</label>
                                                                <input v-model="name" name="name" id="name" type="text" class="form-control" placeholder="Ingrese nombre(s)">
                                                                <span v-if="errors_relative_data && errors_relative_data.name" class="error text-danger" for="name">{{ errors_relative_data.name[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="first_surname" class="form-label">Primer apellido*</label>
                                                                <input v-model="first_surname" name="first_surname" id="first_surname" type="text" class="form-control" placeholder="Ingrese primer apellido">
                                                                <span v-if="errors_relative_data && errors_relative_data.first_surname" class="error text-danger" for="first_surname">{{ errors_relative_data.first_surname[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="second_surname" class="form-label">Segundo apellido</label>
                                                                <input v-model="second_surname" name="second_surname" id="second_surname" type="text" class="form-control" placeholder="Ingrese segundo apellido">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="relationship_type_id" class="form-label">Parentesco*</label>
                                                                <select v-model="relationship_type_id" class="form-control" name="relationship_type_id" id="relationship_type_id">
                                                                    <option value="" disabled selected hidden>Seleccionar Parentesco</option>
                                                                    <option v-for="relationship in relationship_types" :value="relationship.id">{{ relationship.name }}</option>
                                                                </select>
                                                                <span v-if="errors_relative_data && errors_relative_data.relationship_type_id" class="error text-danger" for="relationship_type_id">{{ errors_relative_data.relationship_type_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="sex_type_id" class="form-label">Sexo*</label>
                                                                <select v-model="sex_type_id" class="form-control" name="sex_type_id" id="sex_type_id">
                                                                    <option value="" disabled selected hidden>Seleccionar Sexo</option>
                                                                    <option v-for="sex in sex_types" :value="sex.id">{{ sex.name }}</option>
                                                                </select>
                                                                <span v-if="errors_relative_data && errors_relative_data.sex_type_id" class="error text-danger" for="sex_type_id">{{ errors_relative_data.sex_type_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="occupation_type_id" class="form-label">Ocupación*</label>
                                                                <select v-model="occupation_type_id" class="form-control" name="occupation_type_id" id="occupation_type_id">
                                                                    <option value="" disabled selected hidden>Seleccionar Ocupación</option>
                                                                    <option v-for="occupation in occupation_types" :value="occupation.id">{{ occupation.name }}</option>
                                                                </select>
                                                                <span v-if="errors_relative_data && errors_relative_data.occupation_type_id" class="error text-danger" for="occupation_type_id">{{ errors_relative_data.occupation_type_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative mb-3">
                                                                <label for="birth_date" class="form-label">Fecha de Nacimiento*</label>
                                                                <input v-model="birth_date" name="birth_date" id="birth_date" type="date" class="form-control" placeholder="Ingrese fecha de nacimiento">
                                                                <span v-if="errors_relative_data && errors_relative_data.birth_date" class="error text-danger" for="birth_date">{{ errors_relative_data.birth_date[0] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-2 btn btn-primary">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_relative_data && !edit_relative_data && selected_relative_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card edit-relative-card">
                                            <div class="card-header">
                                                Información del Familiar
                                            </div>
                                            <div class="card-body">
                                                <div class="wrapper-relative-data mt-3">
                                                    <div class="box-label lb-20">
                                                        <p class="">Nombre:</p>
                                                    </div>
                                                    <div class="box-value vl-20">
                                                        <p class="">{{ selected_relative_data.name }} {{ selected_relative_data.first_surname }} {{ selected_relative_data.second_surname }}</p>
                                                    </div>
                                                    <div class="box-label lb-21">
                                                        <p class="">Parentesco:</p>
                                                    </div>
                                                    <div class="box-value vl-21">
                                                        <p class="">{{ selected_relative_data.relationship }}</p>
                                                    </div>
                                                    <div class="box-label lb-22">
                                                        <p class="">Sexo:</p>
                                                    </div>
                                                    <div class="box-value vl-22">
                                                        <p class="">{{ selected_relative_data.sex }}</p>
                                                    </div>
                                                    <div class="box-label lb-23">
                                                        <p class="">Ocupación:</p>
                                                    </div>
                                                    <div class="box-value vl-23">
                                                        <p class="">{{ selected_relative_data.occupation }}</p>
                                                    </div>
                                                    <div class="box-label lb-24">
                                                        <p class="">Fecha de nacimiento:</p>
                                                    </div>
                                                    <div class="box-value vl-24">
                                                        <p class="">{{ selected_relative_data.birth_date }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        housing_tenure: { default: null, },

        relationship_types: { default: null, },
        relationship_type: { default: null, },
        occupation_types: { default: null, },
        occupation_type: { default: null, },
        sex_types: { default: null, },
    },
    data() {
        return {
            card_selected: '',
            message: '',

            name: '',
            first_surname: '',
            second_surname: '',
            relationship_type_id: '',
            occupation_type_id: '',
            sex_type_id: '',
            birth_date: '',

            relatives_data: [],
            errors_relative_data: [],

            add_relative_data: false,
            edit_relative_data: false,
            selected_relative_data: null,
            relative_data_to_edit: null,

            successfully_created_message: false,
            successfully_updated_message: false,
            successfully_deleted_message: false,

            errors_relative_data: null,
        }
    },
    mounted () {
        console.log(this.collaborator.id);
        this.getRelativesData(this.collaborator.id)
    },
    methods: {
        addRelativeData() {
            if(this.add_relative_data == false) {
                this.add_relative_data = true
                this.edit_relative_data = false
            } else {
                this.edit_relative_data = false
            }

            this.selected_relative_data = null

            this.name = ''
            this.first_surname = ''
            this.second_surname = ''
            this.relationship_type_id = ''
            this.occupation_type_id = ''
            this.sex_type_id = ''
            this.birth_date = ''

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        getRelativesData(collaborator_id) {
            axios.get(`/relative-data/${collaborator_id}`)
            .then(response => {
                this.relatives_data = response.data.relatives_data;
            })
            .catch(e => {
                // 
            })
        },
        changeRelativeData(id, index) {
            let new_selection_relative_data;

            if(this.relatives_data && this.relatives_data.length>0) {
                this.relatives_data.forEach(element => {
                    if(element.id !== id) {
                        //
                    } else {
                        new_selection_relative_data = element
                    }
                }, new_selection_relative_data);
            }

            this.selected_relative_data = new_selection_relative_data

            this.add_relative_data = false
            this.edit_relative_data = false

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        storeRelativeData() {

            let dataSend = {
                'collaborator_id': this.collaborator.id,
                'name': this.name,
                'first_surname': this.first_surname,
                'second_surname': this.second_surname,
                'relationship_id': this.relationship_type_id,
                'occupation_id': this.occupation_type_id,
                'sex_type_id': this.sex_type_id,
                'birth_date': this.birth_date,
            }

            let url = ''
            axios.post('/relative-data', dataSend).then(
                (response) => {
                    this.getRelativesData(this.collaborator.id)
                    this.relative_data = response.data.relative_data;
                    this.add_relative_data = false
                    this.edit_relative_data = false

                    this.successfully_created_message = true
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = false

                    this.errors_relative_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_relative_data = error.response.data.errors
                    }
                })
        },
        editRelativeData(item, index) {
            this.relative_data_to_edit = item

            this.add_relative_data = false
            this.edit_relative_data = true

            this.name = item.name
            this.first_surname = item.first_surname
            this.second_surname = item.second_surname
            this.relationship_type_id = item.relationship_id
            this.occupation_type_id = item.occupation_id
            this.sex_type_id = item.sex_id
            this.birth_date = item.birth_date
            
        },
        updateRelativeData(){
            let dataSend = {
                'id': this.relative_data_to_edit.id,
                'collaborator_id': this.collaborator.id,
                'name': this.name,
                'first_surname': this.first_surname,
                'second_surname': this.second_surname,
                'relationship_id': this.relationship_type_id,
                'occupation_id': this.occupation_type_id,
                'sex_type_id': this.sex_type_id,
                'birth_date': this.birth_date,
            }

            let url = ''
            axios.put(`/relative-data-update/${this.relative_data_to_edit.id}`, dataSend).then(
                (response) => {
                    this.getRelativesData(this.collaborator.id)

                    this.add_relative_data = false
                    this.edit_relative_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = true
                    this.successfully_deleted_message = false

                    this.errors_personal_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_relative_data = error.response.data.errors
                    }
                })
        },
        deleteRelativeData(item, index) {
            
            axios.delete(`/relative-data-delete/${item.id}`).then(
                (response) => {
                    this.getRelativesData(this.collaborator.id)

                    this.add_relative_data = false
                    this.edit_relative_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = true

                    this.errors_personal_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_personal_data = error.response.data.errors
                    }
                })
        },
        getAge(dateString) {
            let hoy = new Date()
            let fechaNacimiento = new Date(dateString)
            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear()
            let diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth()
            if (
                diferenciaMeses < 0 ||
                (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())
            ) {
                edad--
            }
            return edad
        },
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

.main-card .wrapper-basic,
.main-card .wrapper-address,
.main-card .wrapper-contact,
.main-card .wrapper-relative-data {
    display: grid;
    grid-gap: 1px;
    /* background-color: #dee2e6; */
    background-color: #555f78;
    /* border: 1px solid #dee2e6; */
    border: 1px solid #555f78;
}

.add-relative-card,
.edit-relative-card {
    background-color: #fff;
    border: 1px solid #dee2e6;
}

@media screen and (min-width: 300px) {
    .main-card .wrapper-basic {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-1" "vl-1" "lb-2" "vl-2" "lb-3" "vl-3" "lb-4" "vl-4" "lb-5" "vl-5" "lb-6" "vl-6" "lb-7" "vl-7" "lb-8" "vl-8" "lb-9" "vl-9" "lb-10" "vl-10" "lb-11" "vl-11" "lb-12" "vl-12";
    }

    .main-card .wrapper-address {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-13" "vl-13" "lb-14" "vl-14" "lb-15" "vl-15" "lb-16" "vl-16";
    }

    .main-card .wrapper-contact {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-17" "vl-17" "lb-18" "vl-18" "lb-19" "vl-19";
    }

    .main-card .wrapper-relative-data {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-20" "vl-20" "lb-21" "vl-21" "lb-22" "vl-22" "lb-23" "vl-23" "lb-24" "vl-24";
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
                                "lb-16 vl-16 vl-16 vl-16"
        ;
    }

    .main-card .wrapper-contact {
        grid-template-columns: repeat(4, 1fr);
        grid-template-areas:    "lb-17 vl-17 vl-17 vl-17"
                                "lb-18 vl-18 vl-18 vl-18"
                                "lb-19 vl-19 vl-19 vl-19"
        ;
    }

    .main-card .wrapper-relative-data {
        grid-template-columns: repeat(4, 1fr);
        grid-template-areas:    "lb-20 vl-20 vl-20 vl-20"
                                "lb-21 vl-21 vl-21 vl-21"
                                "lb-22 vl-22 vl-22 vl-22"
                                "lb-23 vl-23 vl-23 vl-23"
                                "lb-24 vl-24 vl-24 vl-24"
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
                                "lb-16 lb-16 lb-16 vl-16 vl-16 vl-16 vl-16 vl-16 vl-16 vl-16 vl-16 vl-16"
        ;
    }

    .main-card .wrapper-contact {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-17 lb-17 lb-17 vl-17 vl-17 vl-17 lb-18 lb-18 lb-18 vl-18 vl-18 vl-18"
                                "lb-19 lb-19 lb-19 vl-19 vl-19 vl-19 vl-19 vl-19 vl-19 vl-19 vl-19 vl-19"
        ;
    }

    .main-card .wrapper-relative-data {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-20 lb-20 lb-20 vl-20 vl-20 vl-20 vl-20 vl-20 vl-20 vl-20 vl-20 vl-20"
                                "lb-21 lb-21 lb-21 vl-21 vl-21 vl-21 lb-22 lb-22 lb-22 vl-22 vl-22 vl-22"
                                "lb-23 lb-23 lb-23 vl-23 vl-23 vl-23 lb-24 lb-24 lb-24 vl-24 vl-24 vl-24"
        ;
    }
}

.main-card .wrapper-basic .box-label,
.main-card .wrapper-address .box-label,
.main-card .wrapper-contact .box-label,
.main-card .wrapper-relative-data .box-label {
    display: flex;
    flex-direction: row;
    align-items: center;
    background-color: #e0f3ff;
    /* background-color: #444054; */
    padding: 5px;
    color: #6c757d;
    /* color: #fff; */
    font-weight: bold;
}

.main-card .wrapper-basic .box-label p,
.main-card .wrapper-address .box-label p,
.main-card .wrapper-contact .box-label p,
.main-card .wrapper-relative-data .box-label p {
    margin: 0;
}

.main-card .wrapper-basic .box-value,
.main-card .wrapper-address .box-value,
.main-card .wrapper-contact .box-value,
.main-card .wrapper-relative-data .box-value {
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
.main-card .wrapper-contact .box-value p,
.main-card .wrapper-relative-data .box-value p {
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


.main-card .wrapper-contact .lb-17 { grid-area: lb-17; }
.main-card .wrapper-contact .vl-17 { grid-area: vl-17; }
.main-card .wrapper-contact .lb-18 { grid-area: lb-18; }
.main-card .wrapper-contact .vl-18 { grid-area: vl-18; }
.main-card .wrapper-contact .lb-19 { grid-area: lb-19; }
.main-card .wrapper-contact .vl-19 { grid-area: vl-19; }

.main-card .wrapper-relative-data .lb-20 { grid-area: lb-20; }
.main-card .wrapper-relative-data .vl-20 { grid-area: vl-20; }
.main-card .wrapper-relative-data .lb-21 { grid-area: lb-21; }
.main-card .wrapper-relative-data .vl-21 { grid-area: vl-21; }
.main-card .wrapper-relative-data .lb-22 { grid-area: lb-22; }
.main-card .wrapper-relative-data .vl-22 { grid-area: vl-22; }
.main-card .wrapper-relative-data .lb-23 { grid-area: lb-23; }
.main-card .wrapper-relative-data .vl-23 { grid-area: vl-23; }
.main-card .wrapper-relative-data .lb-24 { grid-area: lb-24; }
.main-card .wrapper-relative-data .vl-24 { grid-area: vl-24; }


/* INFORMACIÓN FAMILIAR */
.wrapper-add-relative-data {
    border-radius: 8px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-style: dashed;
    height: 110px;
    width: 100%;
    border-width: 1px;
    border-color: #3f6ad8;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    /* box-shadow: 0px 10px 40px 0px rgba(0, 0, 0, 0.10); */
}

.wrapper-add-relative-data.selected {
    border-width: 2px;
}

.wrapper-add-relative-data p {
    /* font-family: "gothambold"; */
    font-size: 18px;
    font-weight: bold;
    line-height: 22px;
    color: #3f6ad8;
    margin: 0px;
}

.wrapper-add-relative-data.disabled-add {
    border-color: #C7C7C7;
}

.wrapper-add-relative-data.disabled-add p {
    color: #C7C7C7;
}

.wrapper-relative {
    display: grid;
    grid-template-columns: 90% 10%;
    height: 110px;
    padding: 16px;
    background: #fff;
    border: 1px solid #3f6ad8;
    border-radius: 8px;
}

.wrapper-relative.selected {
    border: 2px solid #3f6ad8;
}

.wrapper-relative .box {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 5px;
    width: 100%;
}

.wrapper-relative .box.box1 {
    cursor: pointer;
}

.wrapper-relative .box.box2 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    align-self: stretch;
    width: 10%;
}

.wrapper-relative .box.box1 .preliminary-information {
    display: flex;
    flex-direction: column;
    align-items:center;
    justify-content: space-between;
    gap: 5px;
    width: 90%;
}

.wrapper-relative .box.box1 .preliminary-information p {
    margin: 0px;
}

.wrapper-relative .box.box1 .preliminary-information p.relative-name {
    font-weight: bold;
    font-size: 14px;
    line-height: 18px;
    text-decoration: none;
}

.wrapper-relative .box.box2 .edit-relative-data {
    cursor: pointer
}

.wrapper-relative .box.box2 .delete-relative-data {
    cursor: pointer
}

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

/* wrapper-relative-data */

</style>
