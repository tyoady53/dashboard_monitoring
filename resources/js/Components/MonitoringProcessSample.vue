<template>
    <div class="card border-0 rounded-3 shadow-border-top-purple mt-4">
        <div class="card-body">
            <div class="text-center">
                Last Update : {{ globalConfig.formatCompat(last_update) }} <br />
                Time : {{ time }}
            </div>
            <template v-if="isLoading">
                <div class="page-loader">
                    <div class="loading-spinner">
                        <div class="spinner-border"></div>
                    </div>
                    <h3>Loading Data</h3>
                </div>
            </template>
            <template v-else>
                <div>
                    <table class="table table-bordered solid display">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>
                                    Nama Pasien<br>
                                    <span class="sub">Regno</span>
                                </th>
                                <th>Ruangan</th>
                                <th>Sample Datang</th>
                                <th>Proses Sample</th>
                                <th>Selesai</th>
                                <th>Durasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data, index
                            ) in table_data.table" class="text-center">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <strong>
                                        {{ data.patient_name }}
                                    </strong><br>
                                    <span>{{ data.reg_no }}</span>
                                </td>
                                <td>
                                    {{ data.ward }}
                                </td>
                                <td>
                                    {{ data.start_process }}
                                </td>
                                <td>
                                    {{ data.process_sample }}
                                </td>
                                <td>
                                    {{ data.finish_process }}
                                </td>
                                <td>
                                    {{ data.process_duration }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>
    </div>
    <div class="card border-0 rounded-3 shadow-border-top-purple mt-4 sticky-bottom-card">
        <!-- {{ table_data?.info?.total }} -->
        <div class="card-body py-2">
            <div class="row g-2 align-items-stretch">
                <div class="col-4  d-flex justify-content-center align-items-center">
                    <div class="w-50 inner-card text-center">
                        PASIEN BELUM SELESAI<br>{{ table_data?.info?.total }}
                    </div>
                </div>
                <div class="col-4  d-flex justify-content-center align-items-center">
                    <div class="w-50 inner-card text-center">
                        PASIEN SELESAI<br>{{ table_data?.info?.total_not_finish }}
                    </div>
                </div>
                <div class="col-4  d-flex justify-content-center align-items-center">
                    <div class="w-50 inner-card text-center">
                        TOTAL PASIEN<br>{{ table_data?.info?.total_patient }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { onMounted, ref, computed, reactive, onBeforeUnmount } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { globalConfig } from '../globalConfig.js';

const props = defineProps({
    series: Array,
    link: String,
    refreshInterval: Number,
});

const table_data = ref({});
const last_update = ref('');
const time = ref('');
const isLoading = ref(false);
let intervalId = null;
let refreshRate = 1;
let timeCount = props.refreshInterval;

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
    isLoading.value = true;
    timeCount = 0;
    axios.get(`/${props.link}`, {
        params: {
        }
    })
        .then(res => {
            const data = res.data;
            table_data.value = data.data;
            last_update.value = data.data.last_update;
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
</script>

<style>
.sticky-bottom-card {
    position: sticky;
    bottom: 0;
    z-index: 1;
    background: #fff;
}

.inner-card {
    border-radius: 12px;
    padding: 12px;
    background: #f8f9fa;
    box-shadow: 0 2px 6px rgba(0,0,0,.08);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 60px;
    font-weight: 600;
}
</style>

<!-- <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 2px solid #000;
        padding: 6px 8px;
        text-align: center;
        vertical-align: middle; /* INI */
    }

    thead th {
        background: #000;
        color: #fff;
    }
</style> -->
