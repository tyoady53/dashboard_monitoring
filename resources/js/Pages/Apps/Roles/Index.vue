<template>
    <Head>
        <title>Roles - Wynacom Information System</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 rounded-3 shadow border-top-purple">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> ROLES</span>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="input-group mb-3">
                                    <Link href="/role/create" v-if="permissions.includes('roles.create')" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</Link>
                                    <input type="text" class="form-control" placeholder="search by role name . . .">

                                    <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"> Role Name </th>
                                        <th scope="col" style="width:50%">Permissions</th>
                                        <th scope="col" style="width:20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(role, index) in roles.data" :key="index">
                                        <td>{{ role.name }}</td>
                                            <td>
                                                <span v-for="(permission, index) in role.permissions" :key="index" class="badge badge-primary shadow border-0 ms-2 mb-2">
                                                    {{ permission.name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <Link :href="`/role/${role.id}`" v-if="permissions.includes('roles.edit')" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</Link>
                                                <!-- <button @click.prevent="destroy(role.id)" v-if="hasAnyPermission(['roles.delete'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> DELETE</button> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="margin-start: 10px;">
                                <pagination :data="roles" @pagination-change-page="getFormData"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import LayoutApp from '../../../Layouts/App.vue';

    import { Head, Link } from '@inertiajs/inertia-vue3';

    import pagination from 'laravel-vue-pagination/src/Bootstrap5Pagination';

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
            pagination,
        },

        props: {
            roles: Object,
        },

        data: () => ({
            table_data : [],
            permissions : [],
        }),

        watch:{
            paginate: function(value){
                this.roles();
            },
            search: function(value){
                this.roles();
            },
        },

        mounted() {
            this.get_permission();
        },


        computed: {

        },

        methods: {
            getFormData(page = 1) {
                var UrlOrigin = window.location.origin;
                var pathname = window.location.pathname;
                var base_url = UrlOrigin+pathname;
                console.log(base_url);
                window.location.href = base_url+'?page='+page;
            },

            get_permission() {
                var UrlOrigin = window.location.origin;
                axios
                    .get(UrlOrigin + `/user/get_permissions`)
                    .then((response) => {
                        console.log(response.data.data)
                        this.permissions = response.data.data;
                    })
                    .catch((error) => Swal.fire({
                            title: "Error!",
                            text: "Fetch data failed.",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000,
                        })
                    );
                // console.log('key down '+event);
                return false;
            },
        },

        setup() {

            const destroy = (id) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.isConfirmed) {

                        Inertia.delete(`/apps/roles/${id}`);

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Role deleted successfully.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                })
            }

            return {
                destroy
            }
        }
}
</script>
