<template>
    <div>
        <div class="card-shadow-primary profile-responsive card-border mb-3 card">
            <div class="dropdown-menu-header">
                <div class="dropdown-menu-header-inner bg-focus">
                    <div class="menu-header-image opacity-3" style="background-image: url('');"></div>
                    <div class="menu-header-content btn-pane-right">
                        <div class="avatar-icon-wrapper me-2 avatar-icon-xl">
                            <!-- <div v-if="collaborator && collaborator.image_url" class="avatar-icon rounded">
                                <img :src="collaborator.image_url" :alt="collaborator.name">
                            </div>
                            <div v-else class="avatar-icon rounded">
                                <img :src="'/images/default-profile.jpeg'" :alt="collaborator.name">
                            </div> -->
                        </div>
                        <div>
                            <!-- <h5 class="menu-header-title">{{ collaborator.name }}</h5>
                            <h6 class="menu-header-subtitle">{{ collaborator.email }}</h6> -->
                        </div>
                        <div class="menu-header-btn-pane">
                            <!-- <a :href="`/collaborators/${collaborator.id}/edit`" class="ladda-button btn btn-pill btn-light" data-style="slide-right">
                                <span class="ladda-label">Editar</span>
                                <span class="ladda-spinner"></span>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="p-0 list-group-item">
                    <div class="grid-menu grid-menu-2col">
                        <div class="g-0 row">
                            <div class="col-sm-6">
                                <a @click="card_selected = 'general'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-apartment btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    <!-- <span class="lnr lnr-apartment"></span> -->
                                    Información General
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a @click="card_selected = 'campus'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-pushpin btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    Sedes
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a @click="card_selected = 'areas'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-crop btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    Áreas
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a @click="card_selected = 'positions'" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-rocket btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    Cargos
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-if="card_selected == 'general'" class="main-card mb-3 card">
            <div class="card-body">
                <p>Este es el card de Información General</p>
            </div>
        </div>
        <div v-else-if="card_selected == 'campus'">
            <div class="row">
                <div class="col-sm-12 col-xxl-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div v-if="successfully_created_message && !successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Sede <strong>creada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Sede <strong>actualizada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && !successfully_updated_message && successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Sede <strong>eliminada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="campuses_data && campuses_data.length>0" class="row"> 
                                <div class="col-md-12 col-lg-6">
                                    <a @click="addCampusData" class="wrapper-add-campus-data p-2 mb-3" :class="(add_campus_data && !edit_campus_data) ? 'selected shadow' : ''">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Sede</p>
                                    </a>
                                </div>
                                <div v-for="(item, index) in campuses_data" class="col-md-12 col-lg-6">
                                    <div class="wrapper-campus mb-3 position-relative" :class="(selected_campus_data && selected_campus_data.id) == item.id ? 'selected shadow' : ''">
                                        <div @click="changeCampusData(item.id, index)" class="box box1">
                                            <div class="preliminary-information">
                                                <p class="campus-name text-truncate w-100">{{ item.name }}</p>
                                                <p class="campus-relationship text-truncate w-100">{{ item.address }}</p>
                                                <p class="campus-age text-truncate w-100">{{ item.city.name }} ({{ item.province.name }})</p>
                                            </div>
                                        </div>
                                        <div class="box box2">
                                            <a class="edit-campus-data" @click="editCampusData(item, index)"><img :src="'/images/icons/edit.svg'" alt="edit"></a>
                                            <a class="delete-campus-data" @click="deleteCampusData(item, index)"><img :src="'/images/icons/trash.svg'" alt="trash"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="row">
                                <div class="col-md-12">
                                    <a @click="addCampusData" class="wrapper-add-campus-data p-2 mb-3">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Sede</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                    <div v-if="add_campus_data && !edit_campus_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card add-campus-card">
                                            <div class="card-header">
                                                Agregar Sede
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input v-model="name" name="name" id="name" placeholder="Ingresar nombre" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_campus_data && errors_campus_data.name" class="error text-danger" for="name">{{ errors_campus_data.name[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="address" class="form-label">Dirección</label>
                                                            <input v-model="address" name="address" id="address" placeholder="Ingresar dirección" type="text" class="form-control">
                                                            <span v-if="errors_campus_data && errors_campus_data.address" class="error text-danger" for="address">{{ errors_campus_data.address[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="area_id" class="form-label">Departamento</label>
                                                            <select v-model="province_id" @change="getCities(province_id)" class="form-control" name="province" id="province">
                                                                <option value="">-- Seleccionar Departamento --</option>
                                                                <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                                                            </select>
                                                            <span v-if="errors_campus_data && errors_campus_data.province_id" class="error text-danger" for="province">{{ errors_campus_data.province_id[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="area_id" class="form-label">Municipio</label>
                                                            <select v-model="city_id" class="form-control" name="city" id="city">
                                                                <option value="" :selected="cities === []">-- Seleccionar Municipio --</option>
                                                                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                                                            </select>
                                                            <span v-if="errors_campus_data && errors_campus_data.city_id" class="error text-danger" for="city">{{ errors_campus_data.city_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="phone" class="form-label">Teléfono</label>
                                                            <input v-model="phone" name="phone" id="phone" placeholder="Ingresar teléfono" type="text" class="form-control">
                                                            <span v-if="errors_campus_data && errors_campus_data.phone" class="error text-danger" for="phone">{{ errors_campus_data.phone[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input v-model="email" name="email" id="email" placeholder="Ingresar email" type="text" class="form-control">
                                                            <span v-if="errors_campus_data && errors_campus_data.email" class="error text-danger" for="email">{{ errors_campus_data.email[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="storeCampus()" type="submit" class="mt-2 btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_campus_data && edit_campus_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card edit-campus-card">
                                            <div class="card-header">
                                                Editar Sede
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input v-model="name" name="name" id="name" placeholder="Ingresar nombre" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_campus_data && errors_campus_data.name" class="error text-danger" for="name">{{ errors_campus_data.name[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="address" class="form-label">Dirección</label>
                                                            <input v-model="address" name="address" id="address" placeholder="Ingresar dirección" type="text" class="form-control">
                                                            <span v-if="errors_campus_data && errors_campus_data.address" class="error text-danger" for="address">{{ errors_campus_data.address[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="area_id" class="form-label">Departamento</label>
                                                            <select v-model="province_id" @change="getCities(province_id)" class="form-control" name="province" id="province">
                                                                <option value="">-- Seleccionar Departamento --</option>
                                                                <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                                                            </select>
                                                            <span v-if="errors_campus_data && errors_campus_data.province_id" class="error text-danger" for="province">{{ errors_campus_data.province_id[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="area_id" class="form-label">Municipio</label>
                                                            <select v-model="city_id" class="form-control" name="city" id="city">
                                                                <option value="" :selected="cities === []">-- Seleccionar Municipio --</option>
                                                                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                                                            </select>
                                                            <span v-if="errors_campus_data && errors_campus_data.city_id" class="error text-danger" for="city">{{ errors_campus_data.city_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="phone" class="form-label">Teléfono</label>
                                                            <input v-model="phone" name="phone" id="phone" placeholder="Ingresar teléfono" type="text" class="form-control">
                                                            <span v-if="errors_campus_data && errors_campus_data.phone" class="error text-danger" for="phone">{{ errors_campus_data.phone[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input v-model="email" name="email" id="email" placeholder="Ingresar email" type="text" class="form-control">
                                                            <span v-if="errors_campus_data && errors_campus_data.email" class="error text-danger" for="email">{{ errors_campus_data.email[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <button type="submit" class="mt-2 btn btn-primary">Actualizar</button> -->
                                <button @click="updateCampus()" type="submit" class="mt-2 btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_campus_data && !edit_campus_data && selected_campus_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card edit-campus-card">
                                            <div class="card-header">
                                                Información de la Sede
                                            </div>
                                            <div class="card-body">
                                                <div class="wrapper-campus-data mt-3">
                                                    <div class="box-label lb-20">
                                                        <p class="">Nombre:</p>
                                                    </div>
                                                    <div class="box-value vl-20">
                                                        <p class="">{{ selected_campus_data.name }}</p>
                                                    </div>
                                                    <div class="box-label lb-21">
                                                        <p class="">Ubicación:</p>
                                                    </div>
                                                    <div class="box-value vl-21">
                                                        <p class="">{{ selected_campus_data.city.name }} ({{ selected_campus_data.province.name }})</p>
                                                    </div>
                                                    <div class="box-label lb-22">
                                                        <p class="">Dirección:</p>
                                                    </div>
                                                    <div class="box-value vl-22">
                                                        <p class="">{{ selected_campus_data.address }}</p>
                                                    </div>
                                                    <div class="box-label lb-23">
                                                        <p class="">Teléfono:</p>
                                                    </div>
                                                    <div class="box-value vl-23">
                                                        <p class="">{{ selected_campus_data.phone }}</p>
                                                    </div>
                                                    <div class="box-label lb-24">
                                                        <p class="">Correo electrónico:</p>
                                                    </div>
                                                    <div class="box-value vl-24">
                                                        <p class="">{{ selected_campus_data.email }}</p>
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
        <div v-else-if="card_selected == 'areas'">
            <div class="row">
                <div class="col-sm-12 col-xxl-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div v-if="successfully_created_message && !successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Área <strong>creada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Área <strong>actualizada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && !successfully_updated_message && successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Área <strong>eliminada</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="areas_data && areas_data.length>0" class="row"> 
                                <div class="col-md-12 col-lg-6">
                                    <a @click="addAreaData" class="wrapper-add-area-data p-2 mb-3" :class="(add_area_data && !edit_area_data) ? 'selected shadow' : ''">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Área</p>
                                    </a>
                                </div>
                                <div v-for="(item, index) in areas_data" class="col-md-12 col-lg-6">
                                    <div class="wrapper-area mb-3 position-relative" :class="(selected_area_data && selected_area_data.id) == item.id ? 'selected shadow' : ''">
                                        <div @click="changeAreaData(item.id, index)" class="box box1">
                                            <div class="preliminary-information">
                                                <p class="area-name text-truncate w-100">{{ item.name }}</p>
                                                <p class="area-campus text-truncate w-100">Sede: {{ item.campus.name }}</p>
                                                <p class="area-leader text-truncate w-100">Líder: {{ item.leader.name }} {{ item.leader.first_surname }} {{ item.leader.second_surname }}</p>
                                            </div>
                                        </div>
                                        <div class="box box2">
                                            <a class="edit-area-data" @click="editAreaData(item, index)"><img :src="'/images/icons/edit.svg'" alt="edit"></a>
                                            <a class="delete-area-data" @click="deleteAreaData(item, index)"><img :src="'/images/icons/trash.svg'" alt="trash"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="row">
                                <div class="col-md-12">
                                    <a @click="addAreaData" class="wrapper-add-area-data p-2 mb-3">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Área</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                    <div v-if="add_area_data && !edit_area_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card add-campus-card">
                                            <div class="card-header">
                                                Agregar Área
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input v-model="area_name" name="name" id="name" placeholder="Ingresar nombre" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_area_data && errors_area_data.name" class="error text-danger" for="name">{{ errors_area_data.name[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="campus" class="form-label">Sede</label>
                                                            <select v-model="area_campus_id" class="form-control" name="campus_id" id="campus">
                                                                <option value="">-- Seleccionar Sede --</option>
                                                                <option v-for="campus in campuses_data" :value="campus.id">{{ campus.name }}</option>
                                                            </select>
                                                            <span v-if="errors_area_data && errors_area_data.campus_id" class="error text-danger" for="campus">{{ errors_area_data.campus_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="leader" class="form-label">Líder de área</label>
                                                            <select v-model="area_leader_id" class="form-control" name="leader_id" id="leader">
                                                                <option value="">-- Seleccionar Líder --</option>
                                                                <option v-for="collaborator in collaborators_data" :value="collaborator.id">{{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</option>
                                                            </select>
                                                            <span v-if="errors_area_data && errors_area_data.leader_id" class="error text-danger" for="leader">{{ errors_area_data.leader_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="description" class="form-label">Descripción</label>
                                                            <input v-model="area_description" name="description" id="description" placeholder="Ingresar descripción" type="text" class="form-control">
                                                            <span v-if="errors_area_data && errors_area_data.description" class="error text-danger" for="description">{{ errors_area_data.description[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="storeArea()" type="submit" class="mt-2 btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_area_data && edit_area_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card edit-area-card">
                                            <div class="card-header">
                                                Editar Área
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input v-model="area_name" name="name" id="name" placeholder="Ingresar nombre" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_area_data && errors_area_data.name" class="error text-danger" for="name">{{ errors_area_data.name[0] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="campus" class="form-label">Sede</label>
                                                            <select v-model="area_campus_id" class="form-control" name="campus_id" id="campus">
                                                                <option value="">-- Seleccionar Sede --</option>
                                                                <option v-for="campus in campuses_data" :value="campus.id">{{ campus.name }}</option>
                                                            </select>
                                                            <span v-if="errors_area_data && errors_area_data.campus_id" class="error text-danger" for="campus">{{ errors_area_data.campus_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="leader" class="form-label">Líder de área</label>
                                                            <select v-model="area_leader_id" class="form-control" name="leader_id" id="leader">
                                                                <option value="">-- Seleccionar Líder --</option>
                                                                <option v-for="collaborator in collaborators_data" :value="collaborator.id">{{ collaborator.name }} {{ collaborator.first_surname }} {{ collaborator.second_surname }}</option>
                                                            </select>
                                                            <span v-if="errors_area_data && errors_area_data.leader_id" class="error text-danger" for="leader">{{ errors_area_data.leader_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="description" class="form-label">Descripción</label>
                                                            <input v-model="area_description" name="description" id="description" placeholder="Ingresar descripción" type="text" class="form-control">
                                                            <span v-if="errors_area_data && errors_area_data.description" class="error text-danger" for="description">{{ errors_area_data.description[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="updateArea()" type="submit" class="mt-2 btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_area_data && !edit_area_data && selected_area_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card edit-area-card">
                                            <div class="card-header">
                                                Información del Área
                                            </div>
                                            <div class="card-body">
                                                <div class="wrapper-area-data mt-3">
                                                    <div class="box-label lb-25">
                                                        <p class="">Nombre:</p>
                                                    </div>
                                                    <div class="box-value vl-25">
                                                        <p class="">{{ selected_area_data.name }}</p>
                                                    </div>
                                                    <div class="box-label lb-26">
                                                        <p class="">Sede:</p>
                                                    </div>
                                                    <div class="box-value vl-26">
                                                        <p class="">{{ selected_area_data.campus.name }}</p>
                                                    </div>
                                                    <div class="box-label lb-27">
                                                        <p class="">Líder:</p>
                                                    </div>
                                                    <div class="box-value vl-27">
                                                        <p class="">{{ selected_area_data.leader.name }} {{ selected_area_data.leader.first_surname }} {{ selected_area_data.leader.second_surname }}</p>
                                                    </div>
                                                    <div class="box-label lb-28">
                                                        <p class="">Descripción:</p>
                                                    </div>
                                                    <div class="box-value vl-28">
                                                        <p class="">{{ selected_area_data.description }}</p>
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
        <div v-else-if="card_selected == 'positions'">
            <div class="row">
                <div class="col-sm-12 col-xxl-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div v-if="successfully_created_message && !successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Cargo <strong>creado</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && successfully_updated_message && !successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Cargo <strong>actualizado</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="!successfully_created_message && !successfully_updated_message && successfully_deleted_message" class="message-success mb-3">
                                <div class="content d-flex align-items-start p-2">
                                    <p class="mb-0" style="font-size: 14px;"> Cargo <strong>eliminado</strong> exitosamente!.</p>
                                </div>
                            </div>
                            <div v-if="positions_data && positions_data.length>0" class="row"> 
                                <div class="col-md-12 col-lg-6">
                                    <a @click="addPositionData" class="wrapper-add-position-data p-2 mb-3" :class="(add_position_data && !edit_position_data) ? 'selected shadow' : ''">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Cargo</p>
                                    </a>
                                </div>
                                <div v-for="(item, index) in positions_data" class="col-md-12 col-lg-6">
                                    <div class="wrapper-position mb-3 position-relative" :class="(selected_position_data && selected_position_data.id) == item.id ? 'selected shadow' : ''">
                                        <div @click="changePositionData(item.id, index)" class="box box1">
                                            <div class="preliminary-information">
                                                <p class="position-name text-truncate w-100">{{ item.name }}</p>
                                                <p class="position-campus text-truncate w-100">Área: {{ item.area.name }}</p>
                                                <p class="position-leader text-truncate w-100">Salario estimado: $ {{ numberFormat(Math.round(item.estimated_salary)) }}</p>
                                            </div>
                                        </div>
                                        <div class="box box2">
                                            <a class="edit-position-data" @click="editPositionData(item, index)"><img :src="'/images/icons/edit.svg'" alt="edit"></a>
                                            <a class="delete-position-data" @click="deletePositionData(item, index)"><img :src="'/images/icons/trash.svg'" alt="trash"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="row">
                                <div class="col-md-12">
                                    <a @click="addPositionData" class="wrapper-add-position-data p-2 mb-3">
                                        <p><i class="fa fa-plus" aria-hidden="true"></i></p>
                                        <p>Agregar Cargo</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                    <div v-if="add_position_data && !edit_position_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card add-campus-card">
                                            <div class="card-header">
                                                Agregar Cargo
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input v-model="position_name" name="name" id="name" placeholder="Ingresar nombre" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_position_data && errors_position_data.name" class="error text-danger" for="name">{{ errors_position_data.name[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="area" class="form-label">Área</label>
                                                            <select v-model="position_area_id" class="form-control" name="area_id" id="area">
                                                                <option value="">-- Seleccionar Área --</option>
                                                                <option v-for="area in areas_data" :value="area.id">{{ area.name }}</option>
                                                            </select>
                                                            <span v-if="errors_position_data && errors_position_data.area_id" class="error text-danger" for="area">{{ errors_position_data.area_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="estimated_salary" class="form-label">Salario estimado</label>
                                                            <input v-model="position_estimated_salary" name="estimated_salary" id="estimated_salary" placeholder="Ingresar salario estimado" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_position_data && errors_position_data.estimated_salary" class="error text-danger" for="estimated_salary">{{ errors_position_data.estimated_salary[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="criticality_level" class="form-label">Nivel de criticidad</label>
                                                            <select v-model="position_criticality_level_id" class="form-control" name="criticality_level_id" id="criticality_level">
                                                                <option value="">-- Seleccionar Criticidad --</option>
                                                                <option v-for="criticality_level in criticality_levels" :value="criticality_level.id">{{ criticality_level.level }}</option>
                                                            </select>
                                                            <span v-if="errors_position_data && errors_position_data.criticality_level_id" class="error text-danger" for="criticality_level">{{ errors_position_data.criticality_level_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="risk_class" class="form-label">Clase de riesgo</label>
                                                            <select v-model="position_risk_class_id" class="form-control" name="risk_class_id" id="risk_class">
                                                                <option value="">-- Seleccionar Riesgo --</option>
                                                                <option v-for="risk_class in risk_classes" :value="risk_class.id">{{ risk_class.class }} - {{ risk_class.description }}</option>
                                                            </select>
                                                            <span v-if="errors_position_data && errors_position_data.risk_class_id" class="error text-danger" for="risk_class">{{ errors_position_data.risk_class_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="description" class="form-label">Descripción</label>
                                                            <input v-model="position_description" name="description" id="description" placeholder="Ingresar descripción" type="text" class="form-control">
                                                            <span v-if="errors_position_data && errors_position_data.description" class="error text-danger" for="description">{{ errors_position_data.description[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="storePosition()" type="submit" class="mt-2 btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_position_data && edit_position_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card add-campus-card">
                                            <div class="card-header">
                                                Editar Cargo
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input v-model="position_name" name="name" id="name" placeholder="Ingresar nombre" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_position_data && errors_position_data.name" class="error text-danger" for="name">{{ errors_position_data.name[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="area" class="form-label">Área</label>
                                                            <select v-model="position_area_id" class="form-control" name="area_id" id="area">
                                                                <option value="">-- Seleccionar Área --</option>
                                                                <option v-for="area in areas_data" :value="area.id">{{ area.name }}</option>
                                                            </select>
                                                            <span v-if="errors_position_data && errors_position_data.area_id" class="error text-danger" for="area">{{ errors_position_data.area_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="estimated_salary" class="form-label">Salario estimado</label>
                                                            <input v-model="position_estimated_salary" name="estimated_salary" id="estimated_salary" placeholder="Ingresar salario estimado" type="text" class="form-control" autofocus>
                                                            <span v-if="errors_position_data && errors_position_data.estimated_salary" class="error text-danger" for="estimated_salary">{{ errors_position_data.estimated_salary[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="criticality_level" class="form-label">Nivel de criticidad</label>
                                                            <select v-model="position_criticality_level_id" class="form-control" name="criticality_level_id" id="criticality_level">
                                                                <option value="">-- Seleccionar Criticidad --</option>
                                                                <option v-for="criticality_level in criticality_levels" :value="criticality_level.id">{{ criticality_level.level }}</option>
                                                            </select>
                                                            <span v-if="errors_position_data && errors_position_data.criticality_level_id" class="error text-danger" for="criticality_level">{{ errors_position_data.criticality_level_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative mb-3">
                                                            <label for="risk_class" class="form-label">Clase de riesgo</label>
                                                            <select v-model="position_risk_class_id" class="form-control" name="risk_class_id" id="risk_class">
                                                                <option value="">-- Seleccionar Riesgo --</option>
                                                                <option v-for="risk_class in risk_classes" :value="risk_class.id">{{ risk_class.class }} - {{ risk_class.description }}</option>
                                                            </select>
                                                            <span v-if="errors_position_data && errors_position_data.risk_class_id" class="error text-danger" for="risk_class">{{ errors_position_data.risk_class_id[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative mb-3">
                                                            <label for="description" class="form-label">Descripción</label>
                                                            <input v-model="position_description" name="description" id="description" placeholder="Ingresar descripción" type="text" class="form-control">
                                                            <span v-if="errors_position_data && errors_position_data.description" class="error text-danger" for="description">{{ errors_position_data.description[0] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="updatePosition()" type="submit" class="mt-2 btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="!add_position_data && !edit_position_data && selected_position_data" class="">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-hover-shadow card-border mb-3 card edit-area-card">
                                            <div class="card-header">
                                                Información del Cargo
                                            </div>
                                            <div class="card-body">
                                                <div class="wrapper-position-data mt-3">
                                                    <div class="box-label lb-29">
                                                        <p class="">Nombre:</p>
                                                    </div>
                                                    <div class="box-value vl-29">
                                                        <p class="">{{ selected_position_data.name }}</p>
                                                    </div>
                                                    <div class="box-label lb-30">
                                                        <p class="">Área:</p>
                                                    </div>
                                                    <div class="box-value vl-30">
                                                        <p class="">{{ selected_position_data.area.name }}</p>
                                                    </div>
                                                    <div class="box-label lb-31">
                                                        <p class="">Salario:</p>
                                                    </div>
                                                    <div class="box-value vl-31">
                                                        <p class="">$ {{ numberFormat(selected_position_data.estimated_salary) }}</p>
                                                    </div>
                                                    <div class="box-label lb-32">
                                                        <p class="">Criticidad:</p>
                                                    </div>
                                                    <div class="box-value vl-32">
                                                        <p class="">{{ selected_position_data.criticality_level.level }}</p>
                                                    </div>
                                                    <div class="box-label lb-33">
                                                        <p class="">Riesgo:</p>
                                                    </div>
                                                    <div class="box-value vl-33">
                                                        <p class="">{{ selected_position_data.risk_class.class }} - {{ selected_position_data.risk_class.description }}</p>
                                                    </div>
                                                    <div class="box-label lb-34">
                                                        <p class="">Descripción:</p>
                                                    </div>
                                                    <div class="box-value vl-34">
                                                        <p class="">{{ selected_position_data.description }}</p>
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
    </div>
</template>

<script>
export default {
    props: {
        company: { default: null, },
        provinces: { default: null, },
    },
    data() {
        return {
            card_selected: '',
            message: '',

            province_id: '',
            city_id: '',
            cities: null,
            name: '',
            address: '',
            phone: '',
            email: '',

            area_campus: '',
            area_campus_id: '',
            area_leader_id: '',
            area_name: '',
            area_description: '',

            position_area_id: '',
            position_criticality_level_id: '',
            position_risk_class_id: '',
            position_name: '',
            position_estimated_salary: '',
            position_description: '',

            criticality_levels: [],
            risk_classes: [],

            campuses_data: [],
            areas_data: [],
            positions_data: [],
            collaborators_data: [],

            add_campus_data: false,
            edit_campus_data: false,
            selected_campus_data: null,
            campus_data_to_edit: null,

            add_area_data: false,
            edit_area_data: false,
            selected_area_data: null,
            area_data_to_edit: null,

            add_position_data: false,
            edit_position_data: false,
            selected_position_data: null,
            position_data_to_edit: null,

            successfully_created_message: false,
            successfully_updated_message: false,
            successfully_deleted_message: false,

            errors_campus_data: null,
            errors_area_data: null,
            errors_position_data: null,
        }
    },
    mounted () {
        // console.log(this.company.id);
        this.getCampusesData(this.company.id)
        this.getAreasData(this.company.id)
        this.getPositionsData(this.company.id)
        this.getCollaboratorsData(this.company.id)
    },
    methods: {
        getCities(province) {
            let dataSend = {
                "province": province,
            }

            this.city_id = ''

            axios.post('/get-cities', dataSend).then(
                ({data}) => {
                    this.cities = data.cities
                })
        },
        addCampusData() {
            if(this.add_campus_data == false) {
                this.add_campus_data = true
                this.edit_campus_data = false
            } else {
                this.edit_campus_data = false
            }

            this.selected_campus_data = null

            this.name = ''
            this.address = ''
            this.province_id = ''
            this.city_id = ''
            this.phone = ''
            this.email = ''

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        addAreaData() {
            if(this.add_area_data == false) {
                this.add_area_data = true
                this.edit_area_data = false
            } else {
                this.edit_area_data = false
            }

            this.selected_area_data = null

            this.area_campus_id = ''
            this.area_leader_id = ''
            this.area_name = ''
            this.area_description = ''

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        addPositionData() {
            if(this.add_position_data == false) {
                this.add_position_data = true
                this.edit_position_data = false
            } else {
                this.edit_position_data = false
            }

            this.selected_position_data = null

            this.position_area_id = ''
            this.position_criticality_level_id = ''
            this.position_risk_class_id = ''
            this.position_name = ''
            this.position_estimated_salary = ''
            this.position_description = ''

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        getCampusesData(company_id) {
            axios.get(`/campus-data/${company_id}`)
            .then(response => {
                this.campuses_data = response.data.campuses;
            })
            .catch(e => {
                // 
            })
        },
        getAreasData(company_id) {
            axios.get(`/areas-data/${company_id}`)
            .then(response => {
                this.areas_data = response.data.areas;
            })
            .catch(e => {
                // 
            })
        },
        getPositionsData(company_id) {
            axios.get(`/positions-data/${company_id}`)
            .then(response => {
                this.positions_data = response.data.positions;
                this.criticality_levels = response.data.criticality_levels;
                this.risk_classes = response.data.risk_classes;
            })
            .catch(e => {
                // 
            })
        },
        getCollaboratorsData(company_id) {
            axios.get(`/collaborators-data/${company_id}`)
            .then(response => {
                this.collaborators_data = response.data.collaborators;
            })
            .catch(e => {
                // 
            })
        },
        changeCampusData(id, index) {
            let new_selection_campus_data;

            if(this.campuses_data && this.campuses_data.length>0) {
                this.campuses_data.forEach(element => {
                    if(element.id !== id) {
                        //
                    } else {
                        new_selection_campus_data = element
                    }
                }, new_selection_campus_data);
            }

            this.selected_campus_data = new_selection_campus_data
            console.log(this.selected_campus_data);

            this.add_campus_data = false
            this.edit_campus_data = false

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        changeAreaData(id, index) {
            let new_selection_area_data;

            if(this.areas_data && this.areas_data.length>0) {
                this.areas_data.forEach(element => {
                    if(element.id !== id) {
                        //
                    } else {
                        new_selection_area_data = element
                    }
                }, new_selection_area_data);
            }

            this.selected_area_data = new_selection_area_data
            console.log(this.selected_area_data);

            this.add_area_data = false
            this.edit_area_data = false

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        changePositionData(id, index) {
            let new_selection_position_data;

            if(this.positions_data && this.positions_data.length>0) {
                this.positions_data.forEach(element => {
                    if(element.id !== id) {
                        //
                    } else {
                        new_selection_position_data = element
                    }
                }, new_selection_position_data);
            }

            this.selected_position_data = new_selection_position_data
            console.log(this.selected_position_data);

            this.add_position_data = false
            this.edit_position_data = false

            this.successfully_created_message = false
            this.successfully_updated_message = false
            this.successfully_deleted_message = false
        },
        storeCampus() {
            let dataSend = {
                'company_id': this.company.id,
                'province_id': this.province_id,
                'city_id': this.city_id,
                'name': this.name,
                'address': this.address,
                'phone': this.phone,
                'email': this.email,
            }

            let url = ''
            axios.post('/campuses', dataSend).then(
                (response) => {
                    this.getCampusesData(this.company.id)
                    this.campus_data = response.data.campus_data;
                    this.add_campus_data = false
                    this.edit_campus_data = false

                    this.successfully_created_message = true
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = false

                    this.errors_campus_data = null

                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log('//////////////////////////////////////////////');
                        console.log(error.response.data.errors)
                        this.errors_campus_data = error.response.data.errors
                    }
                })
        },
        storeArea() {
            let dataSend = {
                'company_id': this.company.id,
                'campus_id': this.area_campus_id,
                'leader_id': this.area_leader_id,
                'name': this.area_name,
                'description': this.area_description,
            }

            let url = ''
            axios.post('/areas', dataSend).then(
                (response) => {
                    this.getAreasData(this.company.id)
                    this.area_data = response.data.area_data;
                    this.add_area_data = false
                    this.edit_area_data = false

                    this.successfully_created_message = true
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = false

                    this.errors_area_data = null

                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log('//////////////////////////////////////////////');
                        console.log(error.response.data.errors)
                        this.errors_area_data = error.response.data.errors
                    }
                })
        },
        storePosition() {
            let dataSend = {
                'company_id': this.company.id,
                'area_id': this.position_area_id,
                'criticality_level_id': this.position_criticality_level_id,
                'risk_class_id': this.position_risk_class_id,
                'name': this.position_name,
                'estimated_salary': this.position_estimated_salary,
                'description': this.position_description,
            }

            let url = ''
            axios.post('/positions', dataSend).then(
                (response) => {
                    this.getPositionsData(this.company.id)
                    this.position_data = response.data.position_data;
                    this.add_position_data = false
                    this.edit_position_data = false

                    this.successfully_created_message = true
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = false

                    this.errors_position_data = null

                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log('//////////////////////////////////////////////');
                        console.log(error.response.data.errors)
                        this.errors_position_data = error.response.data.errors
                    }
                })
        },
        editCampusData(item, index) {
            let new_selection_campus_data;
            
            if(this.campuses_data && this.campuses_data.length>0) {
                this.campuses_data.forEach(element => {
                    if(element.id !== item.id) {
                        //
                    } else {
                        new_selection_campus_data = element
                    }
                }, new_selection_campus_data);
            }
            this.selected_campus_data = new_selection_campus_data

            this.campus_data_to_edit = item

            this.add_campus_data = false
            this.edit_campus_data = true

            this.name = item.name
            this.address = item.address
            this.province_id = this.campus_data_to_edit.province_id
            this.getCities(this.province_id)
            this.city_id = this.campus_data_to_edit.city_id
            this.phone = item.phone
            this.email = item.email
            
        },
        editAreaData(item, index) {
            let new_selection_area_data;
            
            if(this.areas_data && this.areas_data.length>0) {
                this.areas_data.forEach(element => {
                    if(element.id !== item.id) {
                        //
                    } else {
                        new_selection_area_data = element
                    }
                }, new_selection_area_data);
            }
            this.selected_area_data = new_selection_area_data
            
            this.area_data_to_edit = item

            this.add_area_data = false
            this.edit_area_data = true

            this.area_campus_id = item.campus_id
            this.area_leader_id = item.leader_id
            this.area_name = item.name
            this.area_description = item.description
        },
        editPositionData(item, index) {
            let new_selection_position_data;
            
            if(this.positions_data && this.positions_data.length>0) {
                this.positions_data.forEach(element => {
                    if(element.id !== item.id) {
                        //
                    } else {
                        new_selection_position_data = element
                    }
                }, new_selection_position_data);
            }
            this.selected_position_data = new_selection_position_data
            
            this.position_data_to_edit = item

            this.add_position_data = false
            this.edit_position_data = true

            this.position_area_id = item.area_id
            this.position_criticality_level_id = item.criticality_level_id
            this.position_risk_class_id = item.risk_class_id
            this.position_name = item.name
            this.position_estimated_salary = item.estimated_salary
            this.position_description = item.description
        },
        updateCampus() {
            let dataSend = {
                'id': this.campus_data_to_edit.id,
                'company_id': this.company.id,
                'province_id': this.province_id,
                'city_id': this.city_id,
                'name': this.name,
                'address': this.address,
                'phone': this.phone,
                'email': this.email,
            }

            let url = ''
            axios.put(`/campuses/${this.campus_data_to_edit.id}`, dataSend).then(
                (response) => {
                    this.getCampusesData(this.company.id)

                    this.add_campus_data = false
                    this.edit_campus_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = true
                    this.successfully_deleted_message = false

                    this.errors_campus_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_campus_data = error.response.data.errors
                    }
                })
        },
        updateArea() {
            let dataSend = {
                'id': this.area_data_to_edit.id,
                'company_id': this.company.id,
                'campus_id': this.area_campus_id,
                'leader_id': this.area_leader_id,
                'name': this.area_name,
                'description': this.area_description,
            }

            let url = ''
            axios.put(`/areas/${this.area_data_to_edit.id}`, dataSend).then(
                (response) => {
                    this.getAreasData(this.company.id)

                    this.add_area_data = false
                    this.edit_area_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = true
                    this.successfully_deleted_message = false

                    this.errors_area_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_area_data = error.response.data.errors
                    }
                })
        },
        updatePosition() {
            let dataSend = {
                'id': this.position_data_to_edit.id,
                'company_id': this.company.id,
                'area_id': this.position_area_id,
                'criticality_level_id': this.position_criticality_level_id,
                'risk_class_id': this.position_risk_class_id,
                'name': this.position_name,
                'estimated_salary': this.position_estimated_salary,
                'description': this.position_description,
            }

            let url = ''
            axios.put(`/positions/${this.position_data_to_edit.id}`, dataSend).then(
                (response) => {
                    this.getPositionsData(this.company.id)

                    this.add_position_data = false
                    this.edit_position_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = true
                    this.successfully_deleted_message = false

                    this.errors_position_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_position_data = error.response.data.errors
                    }
                })
        },
        deleteCampusData(item, index) {
            
            axios.delete(`/campus-data-delete/${item.id}`).then(
                (response) => {
                    this.getCampusesData(this.company.id)

                    this.add_campus_data = false
                    this.edit_campus_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = true

                    this.errors_campus_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_campus_data = error.response.data.errors
                    }
                })
        },
        deleteAreaData(item, index) {
            
            axios.delete(`/area-data-delete/${item.id}`).then(
                (response) => {
                    this.getAreasData(this.company.id)

                    this.add_area_data = false
                    this.edit_area_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = true

                    this.errors_area_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_area_data = error.response.data.errors
                    }
                })
        },
        deletePositionData(item, index) {
            
            axios.delete(`/position-data-delete/${item.id}`).then(
                (response) => {
                    this.getPositionsData(this.company.id)

                    this.add_position_data = false
                    this.edit_position_data = false

                    this.successfully_created_message = false
                    this.successfully_updated_message = false
                    this.successfully_deleted_message = true

                    this.errors_position_data = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        console.log(error.response.data.errors)
                        this.errors_position_data = error.response.data.errors
                    }
                })
        },
        numberFormat(number) {
            const exp = /(\d)(?=(\d{3})+(?!\d))/g
            const rep = '$1.'
            let arr = number.toString().split('.')
            arr[0] = arr[0].replace(exp,rep)
            return arr[1] ? arr.join('.'): arr[0]
        },
    },
}
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
.main-card .wrapper-campus-data,
.main-card .wrapper-area-data,
.main-card .wrapper-position-data {
    display: grid;
    grid-gap: 1px;
    /* background-color: #dee2e6; */
    background-color: #555f78;
    /* border: 1px solid #dee2e6; */
    border: 1px solid #555f78;
}

.add-campus-card,
.edit-campus-card {
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

    .main-card .wrapper-campus-data {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-20" "vl-20" "lb-21" "vl-21" "lb-22" "vl-22" "lb-23" "vl-23" "lb-24" "vl-24";
    }

    .main-card .wrapper-area-data {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-25" "vl-25" "lb-26" "vl-26" "lb-27" "vl-27" "lb-28" "vl-28";
    }

    .main-card .wrapper-position-data {
        grid-template-columns: repeat(1, 1fr);
        grid-template-areas:    "lb-29" "vl-29" "lb-30" "vl-30" "lb-31" "vl-31" "lb-32" "vl-32" "lb-33" "vl-33" "lb-34" "vl-34";
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

    .main-card .wrapper-campus-data {
        grid-template-columns: repeat(4, 1fr);
        grid-template-areas:    "lb-20 vl-20 vl-20 vl-20"
                                "lb-21 vl-21 vl-21 vl-21"
                                "lb-22 vl-22 vl-22 vl-22"
                                "lb-23 vl-23 vl-23 vl-23"
                                "lb-24 vl-24 vl-24 vl-24"
        ;
    }

    .main-card .wrapper-area-data {
        grid-template-columns: repeat(4, 1fr);
        grid-template-areas:    "lb-25 vl-25 vl-25 vl-25"
                                "lb-26 vl-26 vl-26 vl-26"
                                "lb-27 vl-27 vl-27 vl-27"
                                "lb-28 vl-28 vl-28 vl-28"
        ;
    }

    .main-card .wrapper-position-data {
        grid-template-columns: repeat(4, 1fr);
        grid-template-areas:    "lb-29 vl-29 vl-29 vl-29"
                                "lb-30 vl-30 vl-30 vl-30"
                                "lb-31 vl-31 vl-31 vl-31"
                                "lb-32 vl-32 vl-32 vl-32"
                                "lb-33 vl-33 vl-33 vl-33"
                                "lb-34 vl-34 vl-34 vl-34"
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

    .main-card .wrapper-campus-data {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-20 lb-20 lb-20 vl-20 vl-20 vl-20 lb-21 lb-21 lb-21 vl-21 vl-21 vl-21"
                                "lb-22 lb-22 lb-22 vl-22 vl-22 vl-22 vl-22 vl-22 vl-22 vl-22 vl-22 vl-22"
                                "lb-23 lb-23 lb-23 vl-23 vl-23 vl-23 lb-24 lb-24 lb-24 vl-24 vl-24 vl-24"
        ;
    }

    .main-card .wrapper-area-data {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-25 lb-25 lb-25 vl-25 vl-25 vl-25 lb-26 lb-26 lb-26 vl-26 vl-26 vl-26"
                                "lb-27 lb-27 lb-27 vl-27 vl-27 vl-27 vl-27 vl-27 vl-27 vl-27 vl-27 vl-27"
                                "lb-28 lb-28 lb-28 vl-28 vl-28 vl-28 vl-28 vl-28 vl-28 vl-28 vl-28 vl-28"
        ;
    }

    .main-card .wrapper-position-data {
        grid-template-columns: repeat(12, 1fr);
        grid-template-areas:    "lb-29 lb-29 lb-29 vl-29 vl-29 vl-29 vl-29 vl-29 vl-29 vl-29 vl-29 vl-29"
                                "lb-30 lb-30 lb-30 vl-30 vl-30 vl-30 lb-31 lb-31 lb-31 vl-31 vl-31 vl-31"
                                "lb-32 lb-32 lb-32 vl-32 vl-32 vl-32 lb-33 lb-33 lb-33 vl-33 vl-33 vl-33"
                                "lb-34 lb-34 lb-34 vl-34 vl-34 vl-34 vl-34 vl-34 vl-34 vl-34 vl-34 vl-34"
        ;
    }
}

.main-card .wrapper-basic .box-label,
.main-card .wrapper-address .box-label,
.main-card .wrapper-contact .box-label,
.main-card .wrapper-campus-data .box-label,
.main-card .wrapper-area-data .box-label,
.main-card .wrapper-position-data .box-label {
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
.main-card .wrapper-campus-data .box-label p,
.main-card .wrapper-area-data .box-label p,
.main-card .wrapper-position-data .box-label p {
    margin: 0;
}

.main-card .wrapper-basic .box-value,
.main-card .wrapper-address .box-value,
.main-card .wrapper-contact .box-value,
.main-card .wrapper-campus-data .box-value,
.main-card .wrapper-area-data .box-value,
.main-card .wrapper-position-data .box-value {
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
.main-card .wrapper-campus-data .box-value p,
.main-card .wrapper-area-data .box-value p,
.main-card .wrapper-position-data .box-value p {
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

.main-card .wrapper-campus-data .lb-20 { grid-area: lb-20; }
.main-card .wrapper-campus-data .vl-20 { grid-area: vl-20; }
.main-card .wrapper-campus-data .lb-21 { grid-area: lb-21; }
.main-card .wrapper-campus-data .vl-21 { grid-area: vl-21; }
.main-card .wrapper-campus-data .lb-22 { grid-area: lb-22; }
.main-card .wrapper-campus-data .vl-22 { grid-area: vl-22; }
.main-card .wrapper-campus-data .lb-23 { grid-area: lb-23; }
.main-card .wrapper-campus-data .vl-23 { grid-area: vl-23; }
.main-card .wrapper-campus-data .lb-24 { grid-area: lb-24; }
.main-card .wrapper-campus-data .vl-24 { grid-area: vl-24; }

.main-card .wrapper-area-data .lb-25 { grid-area: lb-25; }
.main-card .wrapper-area-data .vl-25 { grid-area: vl-25; }
.main-card .wrapper-area-data .lb-26 { grid-area: lb-26; }
.main-card .wrapper-area-data .vl-26 { grid-area: vl-26; }
.main-card .wrapper-area-data .lb-27 { grid-area: lb-27; }
.main-card .wrapper-area-data .vl-27 { grid-area: vl-27; }
.main-card .wrapper-area-data .lb-28 { grid-area: lb-28; }
.main-card .wrapper-area-data .vl-28 { grid-area: vl-28; }

.main-card .wrapper-position-data .lb-29 { grid-area: lb-29; }
.main-card .wrapper-position-data .vl-29 { grid-area: vl-29; }
.main-card .wrapper-position-data .lb-30 { grid-area: lb-30; }
.main-card .wrapper-position-data .vl-30 { grid-area: vl-30; }
.main-card .wrapper-position-data .lb-31 { grid-area: lb-31; }
.main-card .wrapper-position-data .vl-31 { grid-area: vl-31; }
.main-card .wrapper-position-data .lb-32 { grid-area: lb-32; }
.main-card .wrapper-position-data .vl-32 { grid-area: vl-32; }
.main-card .wrapper-position-data .lb-33 { grid-area: lb-33; }
.main-card .wrapper-position-data .vl-33 { grid-area: vl-33; }
.main-card .wrapper-position-data .lb-34 { grid-area: lb-34; }
.main-card .wrapper-position-data .vl-34 { grid-area: vl-34; }


/* INFORMACIÓN FAMILIAR */
.wrapper-add-campus-data,
.wrapper-add-area-data,
.wrapper-add-position-data {
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

.wrapper-add-campus-data.selected,
.wrapper-add-area-data.selected,
.wrapper-add-position-data.selected {
    border-width: 2px;
}

.wrapper-add-campus-data p,
.wrapper-add-area-data p,
.wrapper-add-position-data p {
    /* font-family: "gothambold"; */
    font-size: 18px;
    font-weight: bold;
    line-height: 22px;
    color: #3f6ad8;
    margin: 0px;
}

.wrapper-add-campus-data.disabled-add,
.wrapper-add-area-data.disabled-add,
.wrapper-add-position-data.disabled-add {
    border-color: #C7C7C7;
}

.wrapper-add-campus-data.disabled-add p,
.wrapper-add-area-data.disabled-add p,
.wrapper-add-position-data.disabled-add p {
    color: #C7C7C7;
}

.wrapper-campus,
.wrapper-area,
.wrapper-position {
    display: grid;
    grid-template-columns: 90% 10%;
    height: 110px;
    padding: 16px;
    background: #fff;
    border: 1px solid #3f6ad8;
    border-radius: 8px;
}

.wrapper-campus.selected,
.wrapper-area.selected,
.wrapper-position.selected {
    border: 2px solid #3f6ad8;
}

.wrapper-campus .box,
.wrapper-area .box,
.wrapper-position .box {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 5px;
    width: 100%;
}

.wrapper-campus .box.box1,
.wrapper-area .box.box1,
.wrapper-position .box.box1 {
    cursor: pointer;
}

.wrapper-campus .box.box2,
.wrapper-area .box.box2,
.wrapper-position .box.box2 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    align-self: stretch;
    width: 10%;
}

.wrapper-campus .box.box1 .preliminary-information,
.wrapper-area .box.box1 .preliminary-information,
.wrapper-position .box.box1 .preliminary-information {
    display: flex;
    flex-direction: column;
    align-items:center;
    justify-content: space-between;
    gap: 5px;
    width: 90%;
}

.wrapper-campus .box.box1 .preliminary-information p,
.wrapper-area .box.box1 .preliminary-information p,
.wrapper-position .box.box1 .preliminary-information p {
    margin: 0px;
}

.wrapper-campus .box.box1 .preliminary-information p.campus-name,
.wrapper-area .box.box1 .preliminary-information p.area-name,
.wrapper-position .box.box1 .preliminary-information p.position-name {
    font-weight: bold;
    font-size: 14px;
    line-height: 18px;
    text-decoration: none;
}

.wrapper-campus .box.box2 .edit-campus-data,
.wrapper-area .box.box2 .edit-area-data,
.wrapper-position .box.box2 .edit-position-data {
    cursor: pointer
}

.wrapper-campus .box.box2 .delete-campus-data,
.wrapper-area .box.box2 .delete-area-data,
.wrapper-position .box.box2 .delete-position-data {
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

/* wrapper-campus-data */

</style>
