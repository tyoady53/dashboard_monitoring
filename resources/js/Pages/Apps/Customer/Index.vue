<template>
    <Head>
        <title>Customers - Wynacom Information System</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-end"><a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#customerModal"><i class="fa fa-plus me-1"></i> New Customer</a></div>
                <br>
                <br>
                <div class="col-md-12" v-for="(customer, index) in customers">
                    <div class="card border-0 rounded-3 shadow border-top-purple">
                        <!-- <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> Customer</span>
                        </div> -->
                        <div class="card-body" >
                            <div class="row">
                                <div class="col-10">
                                    <h4>Customer ID : {{ customer.customer_id }}</h4>
                                    <h4>Customer Name : {{ customer.customer_name }}</h4>
                                </div>
                                <div class="col-2 text-end"><a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#branchModal" @click="addBranch(index)"><i class="fa fa-plus me-1"></i> New Branch</a></div>
                            </div>
                            <table class="table table-striped table-bordered display">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width:5%"> No </th>
                                        <th scope="col" class="text-center" style="width:35%"> Outlet ID </th>
                                        <th scope="col" class="text-center" style="width:35%"> Branch Name </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(branch, idx) in customer.has_branch" :key="index">
                                        <td class="text-end" >{{ index+1 }}</td>
                                        <td>{{ branch.outlet_id }}</td>
                                        <td>{{ branch.branch_name }}</td>
                                        <!-- <td class="text-center">{{ user.clock_in ? user.clock_in[user.clock_in.length-1]['absence_time'] : '' }}</td> -->
                                        <!-- <td class="text-center"><div v-for="absence in user.clock_in">{{ absence.absence_time }}</div></td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal Add Customer -->
        <div class="modal" id="customerModal" ref="customerModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Customer</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold">Customer ID</label>
                            <input class="form-control" v-model="customer_id" type="text" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Customer Name</label>
                            <input class="form-control" v-model="customer_name" type="text">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-primary shadow-sm rounded-sm" type="button" @click="saveCustomer">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal Add Customer -->

        <!-- The Modal Add Branch -->
        <div class="modal" id="branchModal" ref="branchModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Branch: {{ customer_selcted.customer_name }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold">Outlet ID</label>
                            <input class="form-control" v-model="outlet_id" type="text" maxlength="5" style="text-transform:uppercase">
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Branch Name</label>
                            <input class="form-control" v-model="branch_name" type="text" style="text-transform:uppercase">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-primary shadow-sm rounded-sm" type="button" @click="saveBranch">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal Add Branch -->

    </main>
</template>

<script>

    import LayoutApp from '../../../Layouts/App.vue';

    import { Head, Link } from '@inertiajs/inertia-vue3';

    import axios from "axios";

    import { Inertia } from '@inertiajs/inertia';

    import Swal from 'sweetalert2';

    export default {
        layout: LayoutApp,

        components: {
            Head,
            Link,
        },

        props: {
            customers: Object,
        },

        data: () => ({
            table_data : [],
            customer_selcted : '',
            customer_id : '',
            customer_name : '',
            outlet_id : '',
            branch_name : '',
        }),

        watch:{
            paginate: function(value){
                this.users();
            },
            search: function(value){
                this.users();
            },
        },

        methods: {
            getFormData(page = 1) {
                var UrlOrigin = window.location.origin;
                var pathname = window.location.pathname;
                var base_url = UrlOrigin+pathname;
                console.log(base_url);
                window.location.href = base_url+'?page='+page;
            },

            getAbsenceTime(user_id) {
                var return_data = '';
                for(var user of this.users){
                    if(user.id == user_id){
                        for(var absence of user.clock_in){
                            return absence.absence_time;
                        }
                    }
                }
                return return_data;
            },

            addBranch(index) {
                this.customer_selcted = this.customers[index]
                console.log(this.customer_selcted);
            },

            saveCustomer() {
                Inertia.post('/customer', {
                    customer_id: this.customer_id,
                    customer_name: this.customer_name,
                }, {
                    onSuccess: () => {
                        Swal.fire({
                            title: 'Success!',
                            text: 'New Customer saved successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });
                const modal = bootstrap.Modal.getInstance(document.getElementById('customerModal'));
                modal.hide();
                console.log(this.customer_id);
            },

            saveBranch () {
                Inertia.post('/customer/branch', {
                    customer_id: this.customer_selcted.id,
                    outlet_id: this.outlet_id,
                    branch_name: this.branch_name,
                }, {
                    onSuccess: () => {
                        Swal.fire({
                            title: 'Success!',
                            text: 'New Branch saved successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });
                const modal = bootstrap.Modal.getInstance(document.getElementById('branchModal'));
                modal.hide();
            }
        },

        setup(props) {
            return {
                // dataTableOptions,
            }
        }
    }
</script>
