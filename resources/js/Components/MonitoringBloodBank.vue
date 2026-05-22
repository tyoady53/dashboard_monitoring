<template>
    <div class="card border-0 rounded-3 shadow-border-top-purple mt-2">
        <div class="card-body" style="background: #EDF2F7;">
            <div class="text-center mb-2">
                <h5><strong>{{ name }}</strong></h5>
                <span>{{ title }}</span><br>
                Last Update : {{ globalConfig.formatCompat(last_update) }} <br />
                <!-- Time : {{ time }} -->
            </div>
            <!-- <br> -->
            <template v-if="isLoading">
                <div class="page-loader">
                    <div class="loading-spinner">
                        <div class="spinner-border"></div>
                    </div>
                    <h3>Loading Data</h3>
                </div>
            </template>
            <template v-else>
                <div class="row g-3 align-items-stretch mb-1">
                    <div class="col-md-3">
                        <StatBoxBB v-if="chart_data[0] && chart_data[0][0]" :datas="chart_data[0][0]" />
                    </div>
                    <div class="col-md-3">
                        <StatBoxBB v-if="chart_data[0] && chart_data[0][1]" :datas="chart_data[0][1]" />
                    </div>
                    <div class="col-md-3">
                        <StatBoxBB v-if="chart_data[0] && chart_data[0][2]" :datas="chart_data[0][2]" />
                    </div>
                    <div class="col-md-3">
                        <StatBoxBB v-if="chart_data[0] && chart_data[0][3]" :datas="chart_data[0][3]" />
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-7">
                            <ListMonitoringTable :datas="chart_data[1]" summary="Total pemeriksaan per layanan"
                                height="400" />
                        </div>
                        <div class="col-md-5">
                            <StockRealTimeTable :datas="chart_data[2]" summary="Total pemeriksaan per janji hasil"
                                height="400" />
                        </div>
                        <div class="col-md-4">
                            <ChartBarHorizontal :datas="chart_data[3]" height="300" />
                        </div>
                        <div class="col-md-4">
                            <!-- {{ chart_data[4] }} -->
                            <ChartLine :datas="chart_data[4]" height="300" />
                        </div>
                        <div class="col-md-4">
                            <ToastLists :datas="chart_data[5]" height="300" />
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, computed, reactive, onBeforeUnmount } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { globalConfig } from '../globalConfig.js';

import ChartDonut from './Charts/ChartDonut.vue';
import PatientTable from './Charts/PatientTable.vue';
import StatBoxBB from './Charts/RSSA-BloodBank/StatBoxBB.vue';
import ChartBarHorizontal from './Charts/RSSA-BloodBank/ChartBarHorizontal.vue';
import ChartLine from './Charts/RSSA-BloodBank/ChartLine.vue';
import ListMonitoringTable from './Charts/RSSA-BloodBank/ListMonitoringTable.vue';
import StockRealTimeTable from './Charts/RSSA-BloodBank/StockRealTimeTable.vue';
import ToastLists from './Charts/RSSA-BloodBank/ToastLists.vue';

const props = defineProps({
    series: Array,
    link: String,
    title: String,
    refreshInterval: Number,
});

const isLoading = ref(false);
let refreshRate = 1;
let timeCount = props.refreshInterval;
const chart_data = ref('');
const last_update = ref('');
let intervalId = null;
const time = ref('');

onMounted(() => {
    get_monitoring_data();
    intervalId = setInterval(() => {
        checkTime();
        time.value = Intl.DateTimeFormat(navigator.language, {
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
            hourCycle: "h23", // 24-hour format
        }).format();
    }, 1000);
});

onBeforeUnmount(() => {
    if (intervalId) {
        clearInterval(intervalId);
    }
});

const checkTime = () => {
    refreshRate = globalConfig.get('refreshRate');
    if (refreshRate > 0) {
        if (Math.floor(Date.now() / 1000) % 60 == 0) {
            timeCount += 1;
        }
        if (timeCount == refreshRate) {
            get_monitoring_data();
        }
    }
    console.log('Checking time for refresh... Refresh Rate:', refreshRate, 'Minute(s), Time Count:', timeCount);
};

const get_monitoring_data = () => {
    console.log(props.link)
    isLoading.value = true;
    timeCount = 0;
    axios.get(`/${props.link}`, {
        params: {
        }
    })
        .then(res => {
            const data = res.data;

            chart_data.value = data.data;
            last_update.value = data.last_update;

            isLoading.value = false;
        })
        .catch(() => {
            isLoading.value = false;
            Swal.fire({
                icon: 'error',
                title: 'Fetch Failed',
                text: 'Unable to get data.',
                timer: 2000
            });
        });
};

const formatDate = (date) => {
    return date.toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    }).toUpperCase();
};

function formatDateDash(date) {
    const d = date.getDate().toString().padStart(2, '0');
    const m = (date.getMonth() + 1).toString().padStart(2, '0');
    const y = date.getFullYear();

    return `${d}-${m}-${y}`;
}

const getWeekRange = () => {
    const today = new Date();
    //   const today = new Date('2025-12-31');
    const day = today.getDay(); // 0 = Sun, 1 = Mon, ...
    const mondayOffset = day === 0 ? -6 : 1 - day;

    const start = new Date(today);
    start.setDate(today.getDate() + mondayOffset);

    const end = new Date(start);
    end.setDate(start.getDate() + 6);

    return `PERIODE : ${formatDateDash(start)} s/d ${formatDateDash(end)}`;
};

const weekRange = ref(getWeekRange());
</script>
