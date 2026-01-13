<template>
    <Head>
        <title v-if="permissions.original.includes('dash_monitoring.regno')">Patient Monitoring - {{ auth.user.has_branch.branch_name }}</title>
        <title v-else>MONITORING OPERASIONAL {{ auth.user.has_branch.branch_name }}</title>
    </Head>
    <main class="c-main">
        <!-- <MonitoringCharts :refreshInterval="(refreshRate > 0 ? refreshRate : 1)" :link="`api/dashboard/get_data/${this.auth.user.email}`" /> -->
        <div class="container-fluid">
            <!-- <div class="container-fluid"> -->
            <div class="fade-in" style="margin-top: -25px;">
                <div class="text-center">
                    <h4 v-if="permissions.original.includes('dash_monitoring.regno')">Patient Monitoring {{ auth.user.has_branch.branch_name }}</h4>
                    <!-- <h4 v-else>MONITORING OPERASIONAL LAB</h4> -->
                </div>
                <template v-if="permissions.original.includes('dash_monitoring.regno')">
                    <MonitoringRegno :refreshInterval="(refreshRate > 0 ? refreshRate : 1)"
                        :link="`api/dashboard/get_data/${this.auth.user.email}`" />
                </template>
                <template v-else-if="permissions.original.includes('dash_monitoring.charts')">
                    <MonitoringCharts :refreshInterval="(refreshRate > 0 ? refreshRate : 5)"
                        :link="`api/dashboard/get_data/${this.auth.user.email}`" :title="auth.user.has_branch.branch_name" />
                </template>
                <template v-else-if="permissions.original.includes('dash_monitoring.process_sample')">
                    <MonitoringProcessSample :refreshInterval="(refreshRate > 0 ? refreshRate : 5)"
                        :link="`api/dashboard/get_data/${this.auth.user.email}`" :title="auth.user.has_branch.branch_name" />
                </template>
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
                        <div class="mb-3">
                            <label class="fw-bold">Refresh Interval ( In Minutes)</label>
                            <input class="form-control" v-model="refreshRate" type="number" min="1" />
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary shadow-sm rounded-sm" type="button" @click="changeInterval"
                                data-bs-dismiss="modal">
                                Save
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
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
import LayoutApp from "../../../Layouts/App.vue";

import { onMounted, reactive, ref } from "vue";

import { Inertia } from "@inertiajs/inertia";

//import Heade and useForm from Inertia
import { Head } from "@inertiajs/inertia-vue3";

import axios from "axios";

import Swal from "sweetalert2";

import { globalConfig } from '../../../globalConfig.js';

import MonitoringRegno from '../../../Components/MonitoringRegno.vue';
import MonitoringCharts from '../../../Components/MonitoringCharts.vue';
import MonitoringProcessSample from "../../../Components/MonitoringProcessSample.vue";

export default {
    //layout
    layout: LayoutApp,

    //register component
    components: {
        Head,
        MonitoringRegno,
        MonitoringCharts,
        MonitoringProcessSample,
        globalConfig,
    },

    props: {
        auth: Object,
        permissions: Array,
    },

    data: () => ({
        table_data: [],
        last_update: "",
        time: "",
        interval: "",
        reload: "",
        refreshRate: 0,
        dataLength: 15,
        timeCount: 0,
        isLoading: false,
    }),

    methods: {
        isMobile() {
            if (
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent
                )
            ) {
                return true;
            } else {
                return false;
            }
        },

        changeInterval() {
            Swal.fire({
                title: "Success!",
                text:
                    "Refresh Interval changed to " +
                    this.refreshRate +
                    " minutes",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
            });
            if (this.refreshRate > 0) {
                globalConfig.set("refreshRate", this.refreshRate);
            }
        },

        convert(time_res) {
            // console.log(time_res)
            const days = Math.floor(Math.abs(time_res) / 86400);
            const hours = Math.floor((Math.abs(time_res) % 86400) / 3600);
            const minutes = Math.floor((Math.abs(time_res) % 3600) / 60);
            const seconds = Math.abs(time_res) % 60;
            if (time_res > 0) {
                var result = (days ? (days < 10 ? '0' + days : days) + ':' : '') + (hours ? (hours < 10 ? '0' + hours : hours) + ':' : '00:') + (minutes ? (minutes < 10 ? '0' + minutes : minutes) + ':' : '00:') + (seconds < 10 ? '0' + seconds : seconds);
            } else if (time_res < 0) {
                var result = "-" + (days ? (days < 10 ? '0' + days : days) + ':' : '') + (hours ? (hours < 10 ? '0' + hours : hours) + ':' : '00:') + (minutes ? (minutes < 10 ? '0' + minutes : minutes) + ':' : '00:') + (seconds < 10 ? '0' + seconds : seconds);
            } else {
                var result = "-";
            }

            return result;
        },
    },
};
</script>

<style>
h4 {
    margin-bottom: 0;
}

h3 {
    margin-bottom: 0;
}

.regno_font {
    font-size: 32px;
    margin-bottom: 0;
}

.myTicket:hover {
    background-color: blue;
    color: white;
}

.count {
    position: relative;
    top: -30px;
    color: white;
    font-size: 20px;
}

.count2 {
    position: relative;
    top: -20px;
    padding: 10px 50px 10px 50px;
    border-radius: 10%;
    color: white;
    background-color: black;
    font-size: 40px;
}

.myTicket:hover .count {
    background-color: white;
    color: black;
}

.myTicket:hover .count2 {
    background-color: blue;
    color: white;
}
</style>
