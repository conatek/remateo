<template>
    <div>
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-bs-toggle="tab" href="#tab-content-1">
                    <span>Información General</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-bs-toggle="tab" href="#tab-content-2">
                    <span>Información Comercial y Tributaria</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-bs-toggle="tab" href="#tab-content-3">
                    <span>Información Logística</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-bs-toggle="tab" href="#tab-content-4">
                    <span>Información de Seguridad</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-bs-toggle="tab" href="#tab-content-5">
                    <span>Documentación</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                       <!-- <div class="mb-3 text-white card-border bg-dark card"> -->
                        <div class="card-hover-shadow card-border mb-3 card">
                            <!-- <div class="card-header card-header-thot"> -->
                            <div class="card-header">
                                Datos Básicos
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-2">
                                            <label for="name" class="form-label">Tipo de cliente</label>
                                            <!-- <select v-model="client_type_id" name="client_type_id" class="multiselect-dropdown form-control"  id="client_type_id" autofocus> -->
                                            <select v-model="client_type_id" name="client_type_id" class="form-control"  id="client_type_id" autofocus>
                                                <option value="" disabled selected hidden>-- Seleccionar Tipo De Cliente --</option>
                                                <option v-for="client_type in client_types" :value="client_type.id">{{ client_type.type }}</option>
                                            </select>
                                            <span v-if="errors && errors.client_type_id" class="error text-danger" for="client_type_id">{{ errors.client_type_id[0] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-2">
                                            <label for="document_type_id" class="form-label">Tipo de documento</label>
                                            <select v-model="document_type_id" name="document_type_id" class="form-control"  id="document_type_id">
                                                <option value="" disabled selected hidden>-- Seleccionar Tipo De Documento --</option>
                                                <option v-for="document_type in document_types" :value="document_type.id">{{ document_type.type }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-2">
                                            <label for="document_number" class="form-label">Documento</label>
                                            <input v-model="document_number" name="document_number" id="document_number" type="text" class="form-control" placeholder="Ingrese número de documento">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative mb-2">
                                            <label for="name" class="form-label">Nombres</label>
                                            <input v-model="name" name="name" id="name" type="text" class="form-control" placeholder="Ingrese su(s) nombre(s)">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-2">
                                            <label for="first_surname" class="form-label">Primer apellido</label>
                                            <input v-model="first_surname" name="first_surname" id="first_surname" type="text" class="form-control" placeholder="Ingrese su primer apellido">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-2">
                                            <label for="second_surname" class="form-label">Segundo apellido</label>
                                            <input v-model="second_surname" name="second_surname" id="second_surname" type="text" class="form-control" placeholder="Ingrese su segundo apellido">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3">
                                            <label for="province_id" class="form-label">Departamento</label>
                                            <select v-model="province_id" @change="getCities(province_id)" class="form-control" name="province" id="province">
                                                <option value="" disabled selected hidden>-- Seleccionar Departamento --</option>
                                                <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3">
                                            <label for="area_id" class="form-label">Municipio</label>
                                            <select v-model="city_id" class="form-control" name="city" id="city">
                                                <option value="" :selected="cities === []" disabled selected hidden>-- Seleccionar Municipio --</option>
                                                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative mb-2">
                                            <label for="address" class="form-label">Dirección</label>
                                            <input v-model="address" name="address" id="address" type="text" class="form-control" placeholder="Ingrese su dirección">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-2">
                                            <label for="phone" class="form-label">Teléfono fijo</label>
                                            <input v-model="phone" name="phone" id="phone" type="text" class="form-control" placeholder="Ingrese su número fijo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-2">
                                            <label for="cellphone" class="form-label">Celular</label>
                                            <input v-model="cellphone" name="cellphone" id="cellphone" type="text" class="form-control" placeholder="Ingrese su número celular">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative mb-2">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input v-model="email" name="email" id="email" type="text" class="form-control" placeholder="Ingrese su correo electrónico">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative mb-2">
                                            <label for="main_activity" class="form-label">Actividad principal</label>
                                            <input v-model="main_activity" name="main_activity" id="main_activity" type="text" class="form-control" placeholder="Ingrese su actividad principal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-hover-shadow card-border mb-3 card">
                            <!-- <div class="card-header card-header-thot"> -->
                            <div class="card-header">
                                Información Adicional
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative mb-2">
                                            <label for="work_company_name" class="form-label">Empresa donde trabaja</label>
                                            <input v-model="work_company_name" name="work_company_name" id="work_company_name" type="text" class="form-control" placeholder="Ingrese el nombre de la empresa">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-hover-shadow card-border mb-3 card">
                            <!-- <div class="card-header card-header-thot"> -->
                            <div class="card-header">
                                Información De Pagos
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>

                        <div class="card-hover-shadow card-border mb-3 card">
                            <!-- <div class="card-header card-header-thot"> -->
                            <div class="card-header">
                                Información Responsable De Pagos
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <button @click="storeClient()" type="submit" class="mt-2 btn btn-primary">Guardar</button>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 card">
                            <div class="card-body">
                                <ul class="tabs-animated-shadow tabs-animated nav">
                                    <li class="nav-item">
                                        <a
                                            role="tab"
                                            class="nav-link active"
                                            id="tab-c-0"
                                            data-bs-toggle="tab"
                                            href="#tab-animated-0"
                                        >
                                            <span>Tab 1</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            role="tab"
                                            class="nav-link"
                                            id="tab-c-1"
                                            data-bs-toggle="tab"
                                            href="#tab-animated-1"
                                        >
                                            <span>Tab 2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            role="tab"
                                            class="nav-link"
                                            id="tab-c-2"
                                            data-bs-toggle="tab"
                                            href="#tab-animated-2"
                                        >
                                            <span>Tab 3</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-animated-0" role="tabpanel">
                                        <p class="mb-0">
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                                            book.
                                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                                        <p class="mb-0">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown
                                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-animated-2" role="tabpanel">
                                        <p class="mb-0">
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                                            PageMaker including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 card">
                            <div class="card-header card-header-tab-animation">
                                <ul class="nav nav-justified">
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg115-0" class="active nav-link">Tab 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg115-1" class="nav-link">Tab 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg115-2" class="nav-link">Tab 3</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg115-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg115-1" role="tabpanel">
                                        <p>
                                            Like Aldus PageMaker including versions of Lorem. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                                            essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg115-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 card">
                            <div class="card-body">
                                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link active" id="tab-c1-0"
                                           data-bs-toggle="tab" href="#tab-animated1-0">
                                            <span class="nav-text">Tab 1</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" id="tab-c1-1"
                                           data-bs-toggle="tab"  href="#tab-animated1-1">
                                            <span class="nav-text">Tab 2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" id="tab-c1-2"
                                           data-bs-toggle="tab" href="#tab-animated1-2">
                                            <span class="nav-text">Tab 3</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-animated1-0" role="tabpanel">
                                        <p class="mb-0">
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                                            book.
                                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-animated1-1" role="tabpanel">
                                        <p class="mb-0">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown
                                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-animated1-2" role="tabpanel">
                                        <p class="mb-0">
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                                            PageMaker including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header-tab-animation card-header">
                                <div class="card-header-title font-size-lg text-capitalize fw-normal">
                                    <i class="header-icon lnr-gift icon-gradient bg-love-kiss"></i>
                                    Tabs Alternate Animation
                                </div>
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg8-0" class="active nav-link">Tab 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg8-1" class="nav-link">Tab 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg8-2" class="nav-link">Tab 3</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg8-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg8-1" role="tabpanel">
                                        <p>
                                            Like Aldus PageMaker including versions of Lorem. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                                            essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg8-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block text-center card-footer">
                                <a href="javascript:void(0);" class="btn-wide btn btn-link">Link Button</a>
                                <a href="javascript:void(0);" class="btn-wide btn-shadow btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 card">
                            <div class="tabs-lg-alternate card-header">
                                <ul class="nav nav-justified">
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg9-0" class="active nav-link">
                                            <div class="widget-number">Tab 1</div>
                                            <div class="tab-subheading">
                                                                <span class="pe-2 opactiy-6">
                                                                    <i class="fa fa-comment-dots"></i>
                                                                </span>
                                                Totals
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg9-1" class="nav-link">
                                            <div class="widget-number">Tab 2</div>
                                            <div class="tab-subheading">Products</div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg9-2" class="nav-link">
                                            <div class="widget-number text-danger">Tab 3</div>
                                            <div class="tab-subheading">
                                                                <span class="pe-2 opactiy-6">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </span>
                                                Income
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-eg9-0" role="tabpanel">
                                    <div class="card-body">
                                        <p class="mb-0">
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-eg9-1" role="tabpanel">
                                    <div class="card-body">
                                        <p class="mb-0">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-eg9-2" role="tabpanel">
                                    <div class="card-body">
                                        <p class="mb-0">
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                                            PageMaker including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Basic</h5>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg10-0" class="active nav-link">Tab 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg10-1" class="nav-link">Tab 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg10-2" class="nav-link">Tab 3</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg10-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg10-1" role="tabpanel">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a
                                            galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg10-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Justified Alignment</h5>
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg11-0" class="active nav-link">Tab 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg11-1" class="nav-link">Tab 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg11-2" class="nav-link">Tab 3</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg11-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg11-1" role="tabpanel">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a
                                            galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg11-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Tabs Variations</h5>
                                <div class="mb-3">
                                    <div role="group" class="btn-group-sm nav btn-group">
                                        <a data-bs-toggle="tab" href="#tab-eg12-0" class="btn-pill ps-3 active btn btn-warning">Tab 1</a>
                                        <a data-bs-toggle="tab" href="#tab-eg12-1" class="btn btn-warning">Tab 2</a>
                                        <a data-bs-toggle="tab" href="#tab-eg12-2" class="btn-pill pe-3  btn btn-warning">Tab 3</a>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg12-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg12-1" role="tabpanel">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a
                                            galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg12-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Pills</h5>
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg13-0" class="active nav-link">Pill 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg13-1" class="nav-link">Pill 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg13-2" class="nav-link">Pill 3</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg13-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg13-1" role="tabpanel">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a
                                            galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg13-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Pills</h5>
                                <ul class="nav nav-pills nav-fill">
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg14-0" class="active nav-link">Pill 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg14-1" class="nav-link">Pill 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#tab-eg14-2" class="nav-link">Pill 3</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg14-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg14-1" role="tabpanel">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a
                                            galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg14-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Button Group Tabs</h5>
                                <div class="mb-3 text-center">
                                    <div role="group" class="btn-group-sm nav btn-group">
                                        <a data-bs-toggle="tab" href="#tab-eg15-0" class="btn-shadow active btn btn-primary">Tab 1</a>
                                        <a data-bs-toggle="tab" href="#tab-eg15-1" class="btn-shadow  btn btn-primary">Tab 2</a>
                                        <a data-bs-toggle="tab" href="#tab-eg15-2" class="btn-shadow  btn btn-primary">Tab 3</a>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg15-0" role="tabpanel">
                                        <p>
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker
                                            including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg15-1" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab-eg15-2" role="tabpanel">
                                        <p>
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has not only five centuries, but also the leap into not only five centuries, but also the leap into
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
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
        company_id: {
            default: null,
        },
        provinces: {
            default: null,
        },
        client_types: {
            default: null,
        },
        document_types: {
            default: null,
        },
    },
    data() {
        return {
            client_type_id: '',
            document_type_id: '',
            document_number: '',
            business_name: '',
            name: '',
            first_surname: '',
            second_surname: '',
            province_id: '',
            city_id: '',
            cities: null,
            address: '',
            phone: '',
            cellphone: '',
            email: '',
            main_activity: '',
            name: '',
            errors: null,
        }
    },
    mounted () {
        //
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
        storeClient() {
            let dataSend = {
                'name': this.name,
            }

            let url = ''
            axios.post('/clients', dataSend).then(
                (res) => {
                    console.log(res);
                    // url = `/clients/${res.data.client.id}`
                    // window.location.href = url;
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

<script setup>
import '../../assets/select2.js';
import '../../assets/input-select.js';
</script>
