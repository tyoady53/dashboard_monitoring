<template>
    <Head>
        <title>Permissions - Wynacom Information System</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 rounded-3 shadow border-top-purple">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> Permissions</span>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="input-group mb-3">
                                    <Link href="/apps/roles/create" class="btn btn-primary input-group-text" data-bs-toggle="modal" data-bs-target="#add_dataModal"> <i class="fa fa-plus-circle me-2"></i> NEW</Link>
                                    <input type="text" class="form-control" placeholder="search by role name . . .">

                                    <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered display">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Permissions</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(permission, index) in permissions" :key="index">
                                        <td>
                                            {{ index+1 }}
                                        </td>
                                        <td>
                                            {{ permission.name }}
                                        </td>
                                        <td class="text-center">
                                            <Link href="#" class="btn btn-danger btn-sm me-2" @click="deletePermission(permission.id)"><i class="fa fa-trash me-1"></i> Delete</Link>
                                            <!-- <button @click.prevent="destroy(role.id)" v-if="hasAnyPermission(['roles.delete'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> DELETE</button> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- The Modal Add Data [NEW]-->
    <div class="modal" id="add_dataModal" ref="add_dataModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Permissions</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="page-loader" v-if="saveData_loading">
                    <div class="loading-spinner"></div>
                    <h3> {{ loading_label }} </h3>
                </div>
                <div class="modal-body">
                    <form  @submit.prevent="submit">
                        <!-- <input type="hidden" name="_token" :value="csrfToken"> -->
                        <div>
                            <label class="fw-bold">Permission Name</label>
                            <input class="form-control"  v-model="form.base_name" name="permission_name" type="text" required>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3 text-center">
                                <label class="fw-bold">Index</label><br>
                                <input v-model="form.index" name="index" type="checkbox">
                            </div>
                            <div class="col-3 text-center">
                                <label class="fw-bold">Create</label><br>
                                <input v-model="form.create" name="create" type="checkbox">
                            </div>
                            <div class="col-3 text-center">
                                <label class="fw-bold">Edit</label><br>
                                <input v-model="form.edit" name="edit" type="checkbox">
                            </div>
                            <div class="col-3 text-center">
                                <label class="fw-bold">Delete</label><br>
                                <input v-model="form.delete" name="delete" type="checkbox">
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-6">
                                <button class="btn btn-primary" type="button" @click="add_new"><i class="fa fa-plus"></i>&nbsp Add New</button>
                            </div>
                            <div class="col-6" v-if="additional > 0">
                                <button class="btn btn-danger" type="button" @click="remove_one"><i class="fa fa-minus"></i>&nbsp Remove One</button>
                            </div>
                        </div>
                        <div v-if="additional > 0" class="mt-2 mb-2">
                            <div v-for="addition in array_additional"  class="mt-2">
                                <label class="fw-bold">Additional Name</label>
                                <input class="form-control" v-model="form.additional_name[addition-1]" type="text">
                            </div>
                        </div>
                        <div class="modal-footer mt-2">
                            <button class="btn btn-primary shadow-sm rounded-sm" @click="performAction" type="submit">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>
    <!-- End of Modal Add Data -->
</template>

<script>
    import LayoutApp from '../../../Layouts/App.vue';

    import { Head, Link } from '@inertiajs/inertia-vue3';

    import { ref,onMounted,reactive } from "vue";

    import { Inertia } from '@inertiajs/inertia';

    import axios from 'axios';

    import Swal from 'sweetalert2';

    export default {
        //layout
        layout: LayoutApp,

        //register component
        components: {
            Head,
            Link,
        },

        props: {
            permissions: Array,
            positions: Array,
        },

        data: () => ({
            table_data : [],
            additional : 0,
            array_additional : [],
        }),

        mounted() {
            this.count_additional();
        },

        watch:{
        },

        methods: {
            count_additional(){
                for(var i=0; i < this.additional; i++){
                    this.array_additional.push(this.additional[i]);
                }
            },

            add_new(){
                this.additional += 1;
                // this.count_additional();
                this.array_additional.push(this.additional);
            },

            remove_one(){
                this.additional -= 1;
                // this.count_additional();
                this.array_additional.pop();
                if(this.additional == 0){
                    this.form.additional_name = [];
                }
            },

            deletePermission(permissionId) {
                Inertia.delete(`/permission/${permissionId}`).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Permission Deleted',
                        text: 'The permission has been successfully deleted.',
                        showConfirmButton: false,
                        timer: 1500 // Automatically close after 1.5 seconds
                    });
                    window.location.href = '/permission/index';
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while deleting the permission. Please try again later.',
                        confirmButtonText: 'OK'
                    });
                    window.location.href = '/permissions/index';
                });
            }
            // getFormData(page = 1) {
            //     var UrlOrigin = window.location.origin;
            //     var pathname = window.location.pathname;
            //     var base_url = UrlOrigin+pathname;
            //     console.log(base_url);
            //     window.location.href = base_url+'?page='+page;
            // },
        },

        setup() {
            const form = reactive({
                index: '',
                edit: '',
                delete: '',
                create: '',
                base_name: '',
                additional_name: [],
            });

            const submit = () => {
            Inertia.post('/permission', {
                index: form.index,
                edit: form.edit,
                delete: form.delete,
                create: form.create,
                base_name: form.base_name,
                additional_name: form.additional_name,
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User saved successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });
            }

            return {
                form,
                submit,
            };
        }
}
</script>
