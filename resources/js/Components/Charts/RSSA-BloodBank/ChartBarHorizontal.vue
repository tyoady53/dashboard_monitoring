<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <div class="card shadow-sm p-2 chart" :style="`height: ${height}PX;`">
            <h6 class="text-lg font-semibold mb-1"><strong>{{ chart_title }}</strong></h6>
            <apexchart v-if="chart_data.length" type="bar" height="250" :options="chartOptions" :series="chart_data" />
            <div class="row m-2 justify-content-center text-center" v-if="props.summary">
                <div class="col-12"><h6><strong>{{ props.summary.toUpperCase() }}</strong></h6></div>
                <div class="col-4" v-for="(label,idx) in chart_labels"><strong>{{ label }}</strong>: {{ chart_data[0].data[idx] + chart_data[1].data[idx] }}</div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import LoadingComponent from '../../LoadingComponent.vue';

const props = defineProps({
    series: Array,
    categories: Array,
    cust: Number,
    height: Number,
    datas: Array,
    summary: String,
});

const isLoading = ref(false);

const chart_title = computed(() => props.datas?.title || 'Untitled')
const chart_labels = computed(() => props.datas?.labels || [])
const chart_data = computed(() => props.datas?.data || [])

// DYNAMIC COLOR BY SERIES NAME
const chartColors = computed(() => {
    return chart_labels.value.map(label => {
        const name = (label || '').toUpperCase()

        switch (name) {
            case 'CITO':
                return '#ff0000' // RED

            case 'CITO-IGD':
                return '#28a745' // GREEN

            case 'PRIORITAS':
                return '#007bff' // BLUE

            case 'REGULAR':
                return '#6c757d' // GRAY

            default:
                return '#FFF'
        }
    })
})

const chartOptions = computed(() => ({
    chart: {
        type: 'bar',
        toolbar: {
            show: false
        }
    },

    plotOptions: {
        bar: {
            distributed: true, // IMPORTANT
            columnWidth: '50%',
            borderRadius: 4
        }
    },

    dataLabels: {
        enabled: true
    },

    xaxis: {
        categories: chart_labels.value,
    },

    legend: {
        show: false
    },

    colors: chartColors.value
}));
</script>
