<template>
    <Head>
        <title>Dashboard - Wynacom Information System</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="text-center">
                    <h4>Dashboard Monitoring {{ table_data.cust_name }}</h4>
                </div>
                <div class="card border-0 rounded-3 shadow-border-top-purple mt-4">
                    <div class="card-body">
                        <div class="text-center">
                            Last Update : {{ formatCompat(last_update) }} <br>
                            Time : {{ time }}
                        </div>
                        <template v-if="table_data">
                            <div class="row">
                                <div class="col-2">
                                    <table class="table table-bordered display">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="2">SPECIMEN COLLECTION</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>CITO/EA</th>
                                                <th>NON CITO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data,index) in table_data.sc" class="text-center">
                                                <template v-for="(show,data_key) in data">
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>

                                                            </td>
                                                        </template>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-2">
                                    <table class="table table-bordered display">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="2">PROCESS SAMPLE</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>CITO/EA</th>
                                                <th>NON CITO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data,index) in table_data.ps" class="text-center">
                                                <template v-for="(show,data_key) in data">
                                                    <template v-if="data_key == 'cito'">
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-2">
                                    <table class="table table-bordered display">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="2">RESULT</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>CITO/EA</th>
                                                <th>NON CITO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data,index) in table_data.rs" class="text-center">
                                                <template v-for="(show,data_key) in data">
                                                    <template v-if="data_key == 'cito'">
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-2">
                                    <table class="table table-bordered display">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="2">VERIFICATION</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>CITO/EA</th>
                                                <th>NON CITO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data,index) in table_data.vr" class="text-center">
                                                <template v-for="(show,data_key) in data">
                                                    <template v-if="data_key == 'cito'">
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-2">
                                    <table class="table table-bordered display">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="2">AUTHORIZATION</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>CITO/EA</th>
                                                <th>NON CITO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data,index) in table_data.au" class="text-center">
                                                <template v-for="(show,data_key) in data">
                                                    <template v-if="data_key == 'cito'">
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        <template v-if="show">
                                                            <template v-if="show.type == '1'">
                                                                <td style="background: #FF0000;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '2'">
                                                                <td style="background:  #FFFF00;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '3'">
                                                                <td style="background:  #00B050;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                            <template v-if="show.type == '4'">
                                                                <td style="background: #00B0F0;">
                                                                    <strong>
                                                                        {{ (show ? show.regno : '') }}
                                                                    </strong>
                                                                </td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td>
                                                            </td>
                                                        </template>
                                                    </template>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-2">
                                    <table class="table table-bordered display">
                                        <thead>
                                            <tr class="text-center">
                                                <th>KRITIS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data,index) in table_data.kr" class="text-center">
                                                <template v-if="data.type == '1'">
                                                    <td style="background: #F4B084;">
                                                        <strong>
                                                            {{ data.regno }}
                                                        </strong>
                                                    </td>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal Refresh Rate -->
        <div class="modal" id="intervalModal" ref="intervalModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Set Refresh Interval</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- <form @submit.prevent="submitInterval"> -->
                            <div class="mb-3">
                                <label class="fw-bold">Refresh Interval</label>
                                <input class="form-control" v-model="refreshRate" type="number" min="1">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary shadow-sm rounded-sm" type="button" @click="changeInterval" data-bs-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        <!-- </form> -->
                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>
        <!-- End of Modal Refresh Rate -->

    </main>
</template>

<script>
//import layout
import LayoutApp from '../../../Layouts/App.vue';

import { onMounted, reactive, ref } from "vue";

import { Inertia } from "@inertiajs/inertia";

//import Heade and useForm from Inertia
import { Head, } from '@inertiajs/inertia-vue3';

import axios from 'axios';

export default {

    //layout
    layout: LayoutApp,

    //register component
    components: {
        Head,
    },

    props: {
        lastRegno : Number,
        newRegno : Number,
    },

    data: () => ({
        table_data: [],
        last_update: '',
        time: '',
        interval: '',
        reload: '',
        refreshRate: 1,
        dataLength: 15,
        timeCount: 0,
    }),

    mounted() {
        this.get_monitoring_data();
    },

    computed: {
    },

    created() {
        this.interval = setInterval(() => {
            this.checkTime()
        this.time = Intl.DateTimeFormat(navigator.language, {
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric'
        }).format()
        }, 1000)
    },

    methods: {
        isMobile() {
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true
            } else {
                return false
            }
        },

        formatDate(dates) {
            var date = new Date(dates);
            var ms = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",];
            var result = (date.getDate() > 9 ? "" : "0") +date.getDate() + "-" + ms[date.getMonth()] + "-" + date.getFullYear();
            return result;
        },

        formatCompat(dates) {
            var date = new Date(dates);
            var ms = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",];
            var result = (date.getDate() > 9 ? "" : "0") +date.getDate() + "-" + ms[date.getMonth()] + "-" + date.getFullYear() + "/" + (date.getHours() > 9 ? "" : "0") + date.getHours() + ":" + (date.getMinutes() > 9 ? "" : "0") + date.getMinutes();
            return result;
        },

        checkTime() {
            if((Math.floor(Date.now() / 1000) % 60) == 0) {
                // this.get_monitoring_data();
                this.timeCount += 1;
                console.log('Time Count : '+this.timeCount);
                console.log('Refresh Interval : '+this.refreshRate);
            }

            if(this.timeCount == this.refreshRate) {
                this.get_monitoring_data();
            }
            // console.log(Math.floor(Date.now() / 1000) % 60);
        },

        get_monitoring_data() {
            console.log('Loaded : '+Date.now());
            this.last_update = Date.now();
            this.timeCount = 0;
            var UrlOrigin = window.location.origin;
            axios
                .get(UrlOrigin + `/api/dashboard/get_data`)
                .then((response) => {
                    this.table_data = response.data.data;
                })
                .catch((error) => Swal.fire({
                    title: "Error!",
                    text: "Fetch data failed.",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2000,
                })
            );
        },

        changeInterval() {
            console.log('Change Refresh Interval to : '+this.refreshRate);
        }
    },

    beforeDestroy() {
        // Clear the interval when the component is destroyed to avoid memory leaks
        clearInterval(this.interval);
    },

    setup(props) {
        const form = reactive({
            regno : props.newRegno,
            type : '',
            sc : "",
		    ps : "",
	    	rs : "",
	    	vr : "",
	    	au : "",
	    	kr : ""
        });

        const submit = () => {
            Inertia.post(
                "/apps/master/monitoring/store",
                {
                    regno: form.regno,
                    type: form.type,
                    sc: form.sc,
                    ps: form.ps,
                    rs: form.rs,
                    vr: form.vr,
                    au: form.au,
                    kr: form.kr,
                },
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Success!",
                            text: "Ticket saved successfully.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        loading.value = false;
                    },
                    onError: (error) => {
                        loading.value = false;
                        props.errors = error;
                    },
                }
            );
        }

        return {
            form,
            submit,
        }
    }
}
</script>

<style>
.myTicket:hover{
   background-color:blue;
   color: white;
}
.count{
    position:relative;
    top:-30px;
    color: white;
    font-size:20px;
}
.count2{
    position:relative;
    top:-20px;
    padding: 10px 50px 10px 50px;
    border-radius: 10%;
    color: white;
    background-color:black;
    font-size:40px;
}
.myTicket:hover .count{
   background-color:white;
   color: black;
}
.myTicket:hover .count2{
   background-color:blue;
   color: white;
}
</style>
