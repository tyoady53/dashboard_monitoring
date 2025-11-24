<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <h6 class="text-lg font-semibold mb-1 text-center"><strong>{{ chart_title }}</strong></h6>
        <div class="card shadow p-2 chart" style="height: 280PX;">
            <div style="height: 99%; overflow-y: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Lab No</th>
                            <th>Patient Name</th>
                            <th>Result Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(patient, i) in chart_data" :key="i">
                            <td>{{ patient.lab_no }}</td>
                            <td>{{ patient.patient_name }}</td>
                            <td>{{ globalConfig.formatCompat(patient.result_time) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style>
thead {
    position: sticky;
    top: 0;
    background: black;
    z-index: 5;
    text-align: center;
    color: white;
}
</style>

<script setup>
import { ref, computed } from 'vue';
import LoadingComponent from '../LoadingComponent.vue';
import { globalConfig } from '../../globalConfig.js';

const props = defineProps({
    label: String,
    value: Number,
    datas: Array,
});

const isLoading = ref(false);

const chart_title = computed(() => props.datas?.title || 'Untitled')
const chart_data = computed(() => props.datas?.data || [])
</script>
