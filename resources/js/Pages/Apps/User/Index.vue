<template>
    <Head>
        <title>Users - Wynacom Information System</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 rounded-3 shadow border-top-purple">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> USERS</span>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="input-group mb-3">
                                    <Link href="/user/create" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</Link>
                                    <input type="text" class="form-control" placeholder="search by user name . . .">

                                    <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width:3%">No</th>
                                        <th scope="col" class="text-center" style="width:22 %"> User Name </th>
                                        <th scope="col" class="text-center" style="width:20%"> Email </th>
                                        <th scope="col" class="text-center" style="width:15%">Customer</th>
                                        <th scope="col" class="text-center" style="width:15%">Branch</th>
                                        <th scope="col" class="text-center" style="width:15%">Role</th>
                                        <th scope="col" class="text-center" style="width:10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users.data" :key="index">
                                        <td class="text-end">{{ index + 1 }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.has_company.customer_name }}</td>
                                        <td>{{ user.has_branch.branch_name }}</td>
                                        <td>
                                            <span v-for="(role, index) in user.roles" :key="index" class="badge badge-primary shadow border-0 ms-2 mb-2">
                                                {{ role.name }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <Link :href="`/user/${user.id}`" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="margin-start: 10px;">
                                <pagination :data="users" @pagination-change-page="getFormData"></pagination>
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

    import pagination from 'laravel-vue-pagination/src/Bootstrap5Pagination'

    import axios from 'axios';

    export default {
        layout: LayoutApp,

        components: {
            Head,
            Link,
            pagination,
        },

        props: {
            users: Object,
        },

        data: () => ({
            table_data : [],
        }),

        watch:{
            paginate: function(value){
                this.users();
            },
            search: function(value){
                this.users();
            },
        },

        computed: {

        },

        methods: {
            getFormData(page = 1) {
                var UrlOrigin = window.location.origin;
                var pathname = window.location.pathname;
                var base_url = UrlOrigin+pathname;
                window.location.href = base_url+'?page='+page;
                // axios.get(UrlOrigin+'/?page='+page
                //     + '&q=' + this.search
                //     ).then(response => {
                //         console.log(this.search)
                //         console.log(response.data)
                //     this.table_data = response.data;
                // }).catch(error => {
                //     console.log(error.response.data)
                // }) ;
            },
        },
    }
</script>
