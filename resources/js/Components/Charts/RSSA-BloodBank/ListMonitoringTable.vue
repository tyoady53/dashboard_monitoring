<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <div class="card shadow p-2 chart" style="height: 280px; overflow: hidden;">
            <h6 class="text-lg font-semibold mb-1"><strong>{{ chart_title }}</strong></h6>
            <div class="scroll-container">
                <table class="table table-striped custom-marquee-table align-middle">
                    <thead class="sticky-thead">
                        <tr>
                            <th>No Lab</th>
                            <th>Nama Pasien</th>
                            <th class="text-center">No RM</th>
                            <th style="width: 20%;">Proses</th>
                            <th style="width: 20%;">Result</th>
                            <th style="width: 20%;">Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="scroll-content">
                        <tr v-for="(patient, i) in chart_data" :key="'orig-' + i">
                            <td>{{ patient.reg_no }}</td>
                            <td>{{ patient.patient_name }}</td>
                            <td class="text-center">{{ patient.rm_no }}</td>
                            <td>
                                <ProgressBarComponent
                                    :current="patient.test_proses"
                                    :total="patient.total_test"
                                    :color="isFullyComplete(patient) ? 'bg-primary' : 'bg-danger'"
                                />
                            </td>
                            <td>
                                <ProgressBarComponent
                                    :current="patient.test_result"
                                    :total="patient.total_test"
                                    :color="isFullyComplete(patient) ? 'bg-primary' : 'bg-warning text-dark'"
                                />
                            </td>
                            <td>
                                <ProgressBarComponent
                                    :current="patient.test_finish"
                                    :total="patient.total_test"
                                    :color="isFullyComplete(patient) ? 'bg-primary' : 'bg-success'"
                                />
                            </td>
                        </tr>

                        <tr v-for="(patient, i) in chart_data" :key="'clone-' + i">
                            <td>{{ patient.reg_no }}</td>
                            <td>{{ patient.patient_name }}</td>
                            <td class="text-center">{{ patient.rm_no }}</td>
                            <td>
                                <ProgressBarComponent
                                    :current="patient.test_proses"
                                    :total="patient.total_test"
                                    :color="isFullyComplete(patient) ? 'bg-primary' : 'bg-danger'"
                                />
                            </td>
                            <td>
                                <ProgressBarComponent
                                    :current="patient.test_result"
                                    :total="patient.total_test"
                                    :color="isFullyComplete(patient) ? 'bg-primary' : 'bg-warning text-dark'"
                                />
                            </td>
                            <td>
                                <ProgressBarComponent
                                    :current="patient.test_finish"
                                    :total="patient.total_test"
                                    :color="isFullyComplete(patient) ? 'bg-primary' : 'bg-success'"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import LoadingComponent from '../../LoadingComponent.vue';
import ProgressBarComponent from './ProgressBarComponent.vue';
import './AutoScroll.css';

const props = defineProps({
    label: String,
    value: Number,
    datas: Array,
});

const isLoading = ref(false);

const chart_title = computed(() => props.datas?.title || 'Untitled')
const chart_data = computed(() => props.datas?.data || [])

const isFullyComplete = (patient) => {
    var finishCount = 0;
    const total = Number(patient.total_test) || 0;
    finishCount += Number(patient.test_finish) == total ? 1 : 0;
    finishCount += Number(patient.test_result) == total ? 1 : 0;
    finishCount += Number(patient.test_proses) == total ? 1 : 0;

    return total > 0 && finishCount === 3;
};
</script>

<!-- <style scoped>
.scroll-container {
    height: calc(100% - 32px);
    overflow: hidden;
    position: relative;
    width: 100%;
}

/* Modifies display to safely allow transformations without breaking row grids */
.scroll-content {
    display: table-row-group;
    animation: vertical-marquee 25s linear infinite;
}

/* Clear pause logic targeting the layout content correctly */
.scroll-container:hover .scroll-content {
    animation-play-state: paused;
}

@keyframes vertical-marquee {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-50%);
    }
}

.custom-marquee-table {
    table-layout: fixed;
    width: 100%;
    /* Changing collapse to separate stops the browser from leaving behind border lines during shifts */
    border-collapse: separate;
    border-spacing: 0;
}

/* Keeps headers clean, sticky, and masks everything underneath seamlessly */
.sticky-thead {
    position: sticky;
    top: 0;
    z-index: 10;
}

.custom-marquee-table th {
    /* background-color: #f8f9fa !important; */
    border-bottom: 2px solid #dee2e6 !important;
    position: sticky;
    top: 0;
    z-index: 11;
}

/* Explicitly handles cell borders safely instead of relying on broken collapsed layouts */
.custom-marquee-table td {
    border-bottom: 1px solid #dee2e6;
    padding: 8px;
}
</style> -->
