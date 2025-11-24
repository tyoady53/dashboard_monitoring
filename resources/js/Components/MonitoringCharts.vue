<template>
    <div class="card border-0 rounded-3 shadow-border-top-purple mt-2">
        <div class="card-body">
            <div class="text-center mb-1">
                <h5><strong>MONITORING OPERASIONAL {{ title.toUpperCase() }}</strong></h5>
                <span><strong>{{ weekRange }}</strong></span><br>
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
                <div class="row align-items-stretch mb-1">
                    <div class="col-md-4">
                        <ChartBarGroupHorizontal :datas="chart_data[0]" summary="Total pemeriksaan per layanan" height="380"/>
                    </div>
                    <div class="col-md-4">
                        <ChartBarGroupHorizontal :datas="chart_data[1]" summary="Total pemeriksaan per janji hasil" height="380"/>
                    </div>
                    <div class="col-md-4">
                        <ChartDonut :datas="chart_data[2]" height="380"/>
                    </div>
                    <div class="col-md-4">
                        <ChartBarGroupHorizontal :datas="chart_data[3]" :summary="null" height="280"/>
                    </div>
                    <div class="col-md-4">
                        <PatientTable :datas="chart_data[4]" height="280"/>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-lg font-semibold mb-2 text-center">&nbsp</h5>
                        <div class="card shadow p-3 chart shadow-sm p-4 d-flex align-items-center justify-content-center" style="height: 280PX;">
                            <h5 class="text-lg font-semibold mb-2 text-center">{{ (chart_data[5] ? chart_data[5].title : '') }}</h5>
                            <h5 class="text-lg font-semibold mb-2 text-center">PERIODE:{{ (chart_data[5] ? chart_data[5].period: '') }}</h5>
                            <StatBox :datas="( chart_data[5] ? chart_data[5].data : [])" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                                <StatBox v-if="chart_data[6] && chart_data[6][0]" :datas="chart_data[6][0]" />
                    </div>
                    <div class="col-4">
                                <StatBox v-if="chart_data[6] && chart_data[6][1]" :datas="chart_data[6][1]" />
                    </div>
                    <div class="col-4">
                                <StatBox v-if="chart_data[6] && chart_data[6][2]" :datas="chart_data[6][2]" />
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

import ChartBarGroupHorizontal from './Charts/ChartBarGroupHorizontal.vue';
import ChartBarGroup from './Charts/ChartBarGroup.vue';
import ChartDonut from './Charts/ChartDonut.vue';
import ChartLine from './Charts/ChartLine.vue';
import PatientTable from './Charts/PatientTable.vue';
import StatBox from './Charts/StatBox.vue';

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
//   const today = new Date('2025-12-29');
  const day = today.getDay(); // 0 = Sun, 1 = Mon, ...
  const mondayOffset = day === 0 ? -6 : 1 - day;

  const start = new Date(today);
  start.setDate(today.getDate() + mondayOffset);

  const end = new Date(start);
  end.setDate(start.getDate() + 6);

  return `PERIODE : ${formatDateDash(start)} - ${formatDateDash(end)}`;
};

const weekRange = ref(getWeekRange());
</script>
