<template>
    <div>
        <div class="app-page-title">
            <div v-if="selected_user == null && add_user == false && edit_user == false" class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users text-success"></i>
                    </div>
                    <div>
                        Listado de Usuarios
                    </div>
                </div>
                <div class="page-title-actions">
                    <button @click="addUser()" class="btn btn-mh-dark-blue me-3">
                        <i class="fa fa-plus"></i>
                        Agregar
                    </button>
                </div>
            </div>
            <div v-else-if="selected_user != null && add_user == false && edit_user == false" class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users text-success"></i>
                    </div>
                    <div>
                        Detalle de Usuario
                    </div>
                </div>
                <div class="page-title-actions">
                    <button @click="returnToList()" class="btn btn-mh-dark-blue me-3">
                        <i class="fa fa-arrow-left"></i>
                        Volver al listado
                    </button>
                </div>
            </div>
            <div v-else-if="selected_user != null && add_user == false && edit_user == true" class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users text-success"></i>
                    </div>
                    <div>
                        Editar Usuario
                    </div>
                </div>
                <div class="page-title-actions">
                    <button @click="returnToList()" class="btn btn-mh-dark-blue me-3">
                        <i class="fa fa-arrow-left"></i>
                        Volver al listado
                    </button>
                </div>
            </div>
        </div>

        <div v-if="selected_user == null && add_user == false && edit_user == false" class="main-card mb-3 card">
            <div class="card-body table-responsive">
                <table style="width: 100%;" id="dt_users" class="table table-cntk table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Roles</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.company.company_name }}</td>
                            <td class="text-center">
                                <div v-for="role in user.roles" :key="role.id">
                                    <span v-if="role" class="badge bg-success" style="min-width: 100px;">{{ role.name }}</span>
                                    <span v-else class="badge bg-danger" style="min-width: 100px;">Sin rol</span>
                                </div>
                            </td>
                            <td class="align-middle text-end">
                                <!-- <button v-if="user" @click="showUser(user.id)" class="me-2 btn-icon btn btn-sm btn-success">
                                    <i class="fa fa-eye"></i> Mostrar
                                </button> -->
                                <button v-if="user" @click="editUser(user.id)" class="me-2 btn-icon btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i> Editar
                                </button>
                                <button v-if="user" @click="deleteUser(user.id)" class="btn-icon btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Roles</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </tfoot>
                </table>

                <!-- {{-- {{ $users->onEachSide(2)->links() }} --}} -->
            </div>
        </div>

        <div v-else-if="selected_user != null && add_user == false && edit_user == false" class="main-card mb-3 card">
            <div class="card-body table-responsive">
                <p>Mostrar</p>
            </div>
        </div>

        <div v-else-if="selected_user != null && add_user == false && edit_user == true && userData">
            <div class="col-md-12">
                <div class="card-shadow-primary card-border text-white mb-3 card bg-primary">
                    <div class="card-body mx-auto">
                        <div class="avatar-icon-wrapper avatar-icon-xl d-flex mb-3 justify-content-center">
                            <div class="avatar-icon">
                                <!-- <img v-if="userData && userData.image_url" :src="userData.image_url" :alt="userData.name">
                                <img v-else :src="userData && userData.image_url ? userData.image_url : '/images/default-profile.jpeg'" :alt="userData.name"> -->

                                <img
                                    :src="userData.image_url ? userData.image_url : '/images/default-profile.jpeg'"
                                    :alt="userData.name ? userData.name : 'Perfil predeterminado'">
                            </div>
                        </div>
                        <div>
                            <h5 class="menu-header-title text-center">{{ userData.name }}</h5>
                            <h6 class="menu-header-subtitle text-center">{{ userData.email }}</h6>
                            <h6 class="menu-header-subtitle text-center">{{ selected_user.company.company_name }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form @submit.prevent="updateUser" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input v-model="name" name="name" id="name" type="text" class="form-control" autofocus>
                                    <span v-if="errors && errors.name" class="error text-danger" for="name">{{ errors.name[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input v-model="email" name="email" id="email" type="email" class="form-control">
                                    <span v-if="errors && errors.email" class="error text-danger" for="email">{{ errors.email[0] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative mb-3">
                                    <label for="image" class="form-label">Imagen</label>
                                    <div class="input-group">
                                        <input @change="onChangeImage" type="file" name="image" id="image" class="form-control">
                                        <span v-if="errors && errors.image" class="error text-danger" for="image">{{ errors.image[0] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input v-model="password" name="password" id="password" type="password" class="form-control" placeholder="Ingrese la contraseña solo si desea modificar">
                                    <span v-if="errors && errors.password" class="error text-danger" for="password">{{ errors.password[0] }}</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="mt-2 btn btn-primary">Actualizar</button>
                        <hr>
                        <p>Asignar Roles</p>
                        <div v-if="roles" class="row">
                            <div v-for="role in roles" :key="role.id" class="col-lg-3 col-md-4 col-sm-6 py-1">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <!-- <p>{{ role.name }}</p> -->
                                        <input type="checkbox" :id="'checkbox_' + role.name"
                                            :value="role.id" v-model="selected_roles">
                                        <label :for="'checkbox_' + role.name">{{ role.name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { usersDatatable } from '../../assets/js/tables.js';

export default {
    props: {
        users: {
            default: null,
        },
        roles: {
            default: null,
        },
    },
    data() {
        return {
            selected_user: null,
            add_user: false,
            edit_user: false,

            userData: null,

            selected_roles: [],
            company_id: null,
            name: null,
            email: null,
            image: null,
            password: null,

            errors: null,
            message: '',
        };
    },
    mounted() {
        usersDatatable();
    },
    watch: {
        userData: {
            immediate: true,
            handler(newUserData) {
                if (newUserData?.roles) {
                    this.selected_roles = newUserData.roles.map(role => role.id);
                }
            }
        }
    },
    methods: {
        returnToList() {
            this.selected_user = null
            this.add_user = false
            this.edit_user = false

            usersDatatable();
        },
        onChangeImage(e) {
            this.image = e.target.files[0]
        },
        showUser(user) {
            this.selected_user = this.users.find(u => u.id === user);
            this.add_user = false;
            this.edit_user = false;

            axios.get(`/users/${user}`).then(
                (res) => {
                    this.userData = res.data
                    this.errors = null
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    }
                })
        },
        editUser(user) {
            this.selected_user = this.users.find(u => u.id === user);
            this.add_user = false;
            this.edit_user = true;

            this.company_id = this.selected_user.company_id;
            this.name = this.selected_user.name;
            this.email = this.selected_user.email;

            axios.get(`/users/${user}/edit`).then(
                (res) => {
                    this.userData = res.data.user;
                    this.errors = null;
                }).catch(
                (error) => {
                    if(error && error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    }
                })
        },
        updateUser() {
            let fd = new FormData()

            fd.append('company_id', this.company_id)
            fd.append('name', this.name)
            fd.append('email', this.email)
            fd.append('image', this.image)
            // fd.append('password', this.password)
            if (this.password) {
                fd.append('password', this.password); // Solo añade el campo si tiene valor
            }
            // fd.append('roles', this.selected_roles)
            this.selected_roles.forEach((role, index) => {
                fd.append(`roles[${index}]`, role);
            });
            fd.append('_method', 'PUT')

            let url = ''
            console.log(`/users/${this.selected_user.id}`);
            axios.post(`/users/${this.selected_user.id}`, fd).then(
                (res) => {
                    localStorage.setItem('origin', 'updated');

                    // url = `/collaborators/${res.data.collaborator.id}`
                    url = `/users`
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
    created() {
        // Add your created hook logic here
    }
};
</script>

<style scoped>
    @import './../../assets/css/custom.css';
</style>
