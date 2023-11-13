<template>
    <div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form @submit.prevent="updateCollaborator" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-hover-shadow card-border mb-3 card">
                                <div class="card-header">
                                    Información Básica
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="image" class="form-label">Foto</label>
                                                <div class="input-group">
                                                    <input @change="onChangeImage" type="file" name="image" id="image" class="form-control">
                                                </div>
                                                <span v-if="errors && errors.image" class="error text-danger" for="image">{{ errors.image[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="document_type_id" class="form-label">Tipo de documento*</label>
                                                <select v-model="document_type_id" name="document_type_id" class="form-control"  id="document_type_id">
                                                    <option value="" disabled selected hidden>Seleccionar Tipo Documento</option>
                                                    <option v-for="document_type in document_types" :value="document_type.id">{{ document_type.type }}</option>
                                                </select>
                                                <span v-if="errors && errors.document_type_id" class="error text-danger" for="document_type_id">{{ errors.document_type_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="document_number" class="form-label">Documento*</label>
                                                <input v-model="document_number" name="document_number" id="document_number" type="text" class="form-control" placeholder="Ingrese número documento">
                                                <span v-if="errors && errors.document_number" class="error text-danger" for="document_number">{{ errors.document_number[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="name" class="form-label">Nombres*</label>
                                                <input v-model="name" name="name" id="name" type="text" class="form-control" placeholder="Ingrese su(s) nombre(s)">
                                                <span v-if="errors && errors.name" class="error text-danger" for="name">{{ errors.name[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="first_surname" class="form-label">Primer apellido*</label>
                                                <input v-model="first_surname" name="first_surname" id="first_surname" type="text" class="form-control" placeholder="Ingrese su primer apellido">
                                                <span v-if="errors && errors.first_surname" class="error text-danger" for="first_surname">{{ errors.first_surname[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="second_surname" class="form-label">Segundo apellido</label>
                                                <input v-model="second_surname" name="second_surname" id="second_surname" type="text" class="form-control" placeholder="Ingrese su segundo apellido">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="document_province_id" class="form-label">Departamento De Expedición*</label>
                                                <select v-model="document_province_id" @change="getCities(document_province_id, 'document')" class="form-control" name="province" id="document_province_id">
                                                    <option value="" disabled selected hidden>Seleccionar Departamento</option>
                                                    <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.document_province_id" class="error text-danger" for="document_province_id">{{ errors.document_province_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="document_city_id" class="form-label">Municipio de Expedición*</label>
                                                <select v-model="document_city_id" class="form-control" name="document_city_id" id="document_city_id">
                                                    <!-- <option value="" :selected="cities === []" disabled selected hidden>Seleccionar Municipio</option> -->
                                                    <option value="" disabled selected hidden>Seleccionar Municipio</option>
                                                    <option v-for="city in document_cities" :value="city.id">{{ city.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.document_city_id" class="error text-danger" for="document_city_id">{{ errors.document_city_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="expedition_date" class="form-label">Fecha de Expedición*</label>
                                                <input v-model="expedition_date" name="expedition_date" id="expedition_date" type="date" class="form-control" placeholder="Ingrese fecha expedición documento">
                                                <span v-if="errors && errors.expedition_date" class="error text-danger" for="expedition_date">{{ errors.expedition_date[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="birth_province_id" class="form-label">Departamento De Nacimiento*</label>
                                                <select v-model="birth_province_id" @change="getCities(birth_province_id, 'birth')" class="form-control" name="province" id="birth_province_id">
                                                    <option value="" disabled selected hidden>Seleccionar Departamento</option>
                                                    <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.birth_province_id" class="error text-danger" for="birth_province_id">{{ errors.birth_province_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="birth_city_id" class="form-label">Municipio de Nacimiento*</label>
                                                <select v-model="birth_city_id" class="form-control" name="birth_city_id" id="birth_city_id">
                                                    <option value="" disabled selected hidden>Seleccionar Municipio</option>
                                                    <option v-for="city in birth_cities" :value="city.id">{{ city.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.birth_city_id" class="error text-danger" for="birth_city_id">{{ errors.birth_city_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="birth_date" class="form-label">Fecha de Nacimiento*</label>
                                                <input v-model="birth_date" name="birth_date" id="birth_date" type="date" class="form-control">
                                                <span v-if="errors && errors.birth_date" class="error text-danger" for="birth_date">{{ errors.birth_date[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="civil_status_type_id" class="form-label">Estado civil*</label>
                                                <select v-model="civil_status_type_id" class="form-control" name="civil_status_type_id" id="civil_status_type_id">
                                                    <option value="" disabled selected hidden>Seleccionar Sexo</option>
                                                    <option v-for="civil_status in civil_status_types" :value="civil_status.id">{{ civil_status.type }}</option>
                                                </select>
                                                <span v-if="errors && errors.civil_status_type_id" class="error text-danger" for="civil_status_type_id">{{ errors.civil_status_type_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="sex_type_id" class="form-label">Sexo*</label>
                                                <select v-model="sex_type_id" class="form-control" name="sex_type_id" id="sex_type_id">
                                                    <option value="" disabled selected hidden>Seleccionar Sexo</option>
                                                    <option v-for="sex in sex_types" :value="sex.id">{{ sex.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.sex_type_id" class="error text-danger" for="sex_type_id">{{ errors.sex_type_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="rh_type_id" class="form-label">RH*</label>
                                                <select v-model="rh_type_id" class="form-control" name="rh_type_id" id="rh_type_id">
                                                    <option value="" disabled selected hidden>Seleccionar RH</option>
                                                    <option v-for="rh in rh_types" :value="rh.id">{{ rh.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.rh_type_id" class="error text-danger" for="rh_type_id">{{ errors.rh_type_id[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="scholarship_type_id" class="form-label">Escolaridad*</label>
                                                <select v-model="scholarship_type_id" class="form-control" name="scholarship_type_id" id="scholarship_type_id">
                                                    <option value="" disabled selected hidden>Seleccionar Escolaridad</option>
                                                    <option v-for="scholarship in scholarship_types" :value="scholarship.id">{{ scholarship.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.scholarship_type_id" class="error text-danger" for="scholarship_type_id">{{ errors.scholarship_type_id[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="position-relative mb-3">
                                                <label for="observations" class="form-label">Observaciones</label>
                                                <textarea v-model="observations" name="observations" id="observations" type="text" class="form-control" placeholder="Ingrese sus observaciones" rows="4" cols="50"></textarea>
                                                <span v-if="errors && errors.observations" class="error text-danger" for="observations">{{ errors.observations[0] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-hover-shadow card-border mb-3 card">
                                <div class="card-header">
                                    Información de Domicilio
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="residence_province_id" class="form-label">Departamento De Residencia*</label>
                                                <select v-model="residence_province_id" @change="getCities(residence_province_id, 'residence')" class="form-control" name="province" id="residence_province_id">
                                                    <option value="" disabled selected hidden>Seleccionar Departamento</option>
                                                    <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.residence_province_id" class="error text-danger" for="residence_province_id">{{ errors.residence_province_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="residence_city_id" class="form-label">Municipio de Residencia*</label>
                                                <select v-model="residence_city_id" class="form-control" name="residence_city_id" id="residence_city_id">
                                                    <option value="" disabled selected hidden>Seleccionar Municipio</option>
                                                    <option v-for="city in residence_cities" :value="city.id">{{ city.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.residence_city_id" class="error text-danger" for="residence_city_id">{{ errors.residence_city_id[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mb-3">
                                                <label for="stratum_type_id" class="form-label">Estrato Social*</label>
                                                <select v-model="stratum_type_id" class="form-control" name="stratum_type_id" id="stratum_type_id">
                                                    <option value="" disabled selected hidden>Seleccionar Estrato</option>
                                                    <option v-for="stratum in stratum_types" :value="stratum.id">{{ stratum.id }} - {{ stratum.name }}</option>
                                                </select>
                                                <span v-if="errors && errors.stratum_type_id" class="error text-danger" for="stratum_type_id">{{ errors.stratum_type_id[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="position-relative mb-3">
                                                <label for="address" class="form-label">Dirección*</label>
                                                <input v-model="address" name="address" id="address" type="text" class="form-control" placeholder="Ingrese su dirección">
                                                <span v-if="errors && errors.address" class="error text-danger" for="address">{{ errors.address[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="card-hover-shadow card-border mb-3 card">
                                <div class="card-header">
                                    Información De Contacto
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative mb-3">
                                                <label for="phone" class="form-label">Teléfono fijo</label>
                                                <input v-model="phone" name="phone" id="phone" type="text" class="form-control" placeholder="Ingrese su número fijo">
                                                <span v-if="errors && errors.phone" class="error text-danger" for="phone">{{ errors.phone[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative mb-3">
                                                <label for="cellphone" class="form-label">Celular*</label>
                                                <input v-model="cellphone" name="cellphone" id="cellphone" type="text" class="form-control" placeholder="Ingrese su número celular">
                                                <span v-if="errors && errors.cellphone" class="error text-danger" for="cellphone">{{ errors.cellphone[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="position-relative mb-3">
                                                <label for="email" class="form-label">Correo electrónico*</label>
                                                <input v-model="email" name="email" id="email" type="text" class="form-control" placeholder="Ingrese su correo electrónico">
                                                <span v-if="errors && errors.email" class="error text-danger" for="email">{{ errors.email[0] }}</span>
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
</template>

<script>
export default {
    props: {
        collaborator: {
            default: null,
        },
        company_id: {
            default: null,
        },
        provinces: {
            default: null,
        },
        document_types: {
            default: null,
        },
        civil_status_types: {
            default: null,
        },
        sex_types: {
            default: null,
        },
        rh_types: {
            default: null,
        },
        scholarship_types: {
            default: null,
        },
        stratum_types: {
            default: null,
        },
    },
    data() {
        return {
            name: this.collaborator.name,
            first_surname: this.collaborator.first_surname,
            second_surname: this.collaborator.second_surname,

            document_type_id: this.collaborator.document_type_id,
            document_number: this.collaborator.document_number,
            expedition_date: this.collaborator.expedition_date,
            document_province_id: '',
            document_city_id: '',

            birth_date: this.collaborator.birth_date,
            birth_province_id: '',
            birth_city_id: '',

            civil_status_type_id: this.collaborator.civil_status_type_id,
            sex_type_id: this.collaborator.sex_type_id,
            rh_type_id: this.collaborator.rh_type_id,
            scholarship_type_id: this.collaborator.scholarship_type_id,
            stratum_type_id: this.collaborator.stratum_type_id,

            residence_province_id: '',
            residence_city_id: '',

            document_cities: [],
            birth_cities: [],
            residence_cities: [],

            address: this.collaborator.address,
            phone: this.collaborator.phone,
            cellphone: this.collaborator.cellphone,
            email: this.collaborator.email,

            image: this.collaborator.image_url,
            observations: this.collaborator.observations,

            errors: null,
            message: '',
        }
    },
    mounted () {
        this.loadInitialData()
    },
    methods: {
        loadInitialData() {
            this.document_province_id = this.collaborator.document_province_id
            this.getCities(this.document_province_id, 'document')
            this.document_city_id = this.collaborator.document_city_id

            this.birth_province_id = this.collaborator.birth_province_id
            this.getCities(this.birth_province_id, 'birth')
            this.birth_city_id = this.collaborator.birth_city_id

            this.residence_province_id = this.collaborator.residence_province_id
            this.getCities(this.residence_province_id, 'residence')
            this.residence_city_id = this.collaborator.residence_city_id
        },
        getCities(province, type) {
            let dataSend = {
                "province": province,
            }

            axios.post('/get-cities', dataSend).then(
                ({data}) => {
                    if(type == 'document') {
                        this.document_cities = data.cities
                    } else if(type == 'birth') {
                        this.birth_cities = data.cities
                    } else if(type == 'residence') {
                        this.residence_cities = data.cities
                    }
                })
        },
        onChangeImage(e) {
            this.image = e.target.files[0]
        },
        updateCollaborator() {
            let dataSend = {
                'image': this.image,
                'name': this.name,
                'first_surname': this.first_surname,
                'second_surname': this.second_surname,
                'document_type_id': this.document_type_id,
                
            }

            let fd = new FormData()

            fd.append('image', this.image)
            fd.append('name', this.name)
            fd.append('first_surname', this.first_surname)
            fd.append('second_surname', this.second_surname)
            fd.append('document_type_id', this.document_type_id)
            fd.append('document_number', this.document_number)
            fd.append('document_province_id', this.document_province_id)
            fd.append('document_city_id', this.document_city_id)
            fd.append('expedition_date', this.expedition_date)
            fd.append('birth_province_id', this.birth_province_id)
            fd.append('birth_city_id', this.birth_city_id)
            fd.append('birth_date', this.birth_date)
            fd.append('civil_status_type_id', this.civil_status_type_id)
            fd.append('sex_type_id', this.sex_type_id)
            fd.append('rh_type_id', this.rh_type_id)
            fd.append('scholarship_type_id', this.scholarship_type_id)
            fd.append('observations', this.observations)
            fd.append('residence_province_id', this.residence_province_id)
            fd.append('residence_city_id', this.residence_city_id)
            fd.append('stratum_type_id', this.stratum_type_id)
            fd.append('address', this.address)
            fd.append('phone', this.phone)
            fd.append('cellphone', this.cellphone)
            fd.append('email', this.email)
            fd.append('_method', 'PUT')

            let url = ''
            axios.post(`/collaborators/${this.collaborator.id}`, fd).then(
                (res) => {
                    console.log(res)
                    // url = `/collaborators/${res.data.collaborator.id}-success`
                    url = `/collaborators/${res.data.collaborator.id}?origin=update`
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

<script setup>
import '../../assets/select2.js';
import '../../assets/input-select.js';
</script>
