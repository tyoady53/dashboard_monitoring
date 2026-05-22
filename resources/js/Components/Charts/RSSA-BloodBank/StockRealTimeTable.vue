<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <div class="card shadow p-2 chart" style="height: 280PX;">
            <h6 class="text-lg font-semibold mb-1"><strong>{{ chart_title }}</strong></h6>
            <div style="height: 99%; overflow-y: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">Komponen</th>
                            <th colspan="2" class="align-middle">A</th>
                            <th colspan="2" class="align-middle">B</th>
                            <th colspan="2" class="align-middle">O</th>
                            <th colspan="2" class="align-middle">AB</th>
                            <th rowspan="2" class="align-middle">Total</th>
                        </tr>
                        <tr>
                            <th class="align-middle">+</th>
                            <th class="align-middle">-</th>
                            <th class="align-middle">+</th>
                            <th class="align-middle">-</th>
                            <th class="align-middle">+</th>
                            <th class="align-middle">-</th>
                            <th class="align-middle">+</th>
                            <th class="align-middle">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(patient, i) in chart_data" :key="i">
                            <td class="text-start">{{ patient.component }}</td>
                            <td class="text-center">{{ patient.blood_apos }}</td>
                            <td class="text-center">{{ patient.blood_aneg }}</td>
                            <td class="text-center">{{ patient.blood_bpos }}</td>
                            <td class="text-center">{{ patient.blood_bneg }}</td>
                            <td class="text-center">{{ patient.blood_opos }}</td>
                            <td class="text-center">{{ patient.blood_oneg }}</td>
                            <td class="text-center">{{ patient.blood_abpos }}</td>
                            <td class="text-center">{{ patient.blood_abneg }}</td>
                            <td class="text-center fw-bold">{{
                                [
                                    patient.blood_apos,
                                    patient.blood_aneg,
                                    patient.blood_bpos,
                                    patient.blood_bneg,
                                    patient.blood_opos,
                                    patient.blood_oneg,
                                    patient.blood_abpos,
                                    patient.blood_abneg
                                ].reduce((a, b) => Number(a) + Number(b || 0), 0)
                            }}
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

const props = defineProps({
    label: String,
    value: Number,
    datas: Array,
});

const isLoading = ref(false);

const chart_title = computed(() => props.datas?.title || 'Untitled')
const chart_data = computed(() => props.datas?.data || [])
</script>
