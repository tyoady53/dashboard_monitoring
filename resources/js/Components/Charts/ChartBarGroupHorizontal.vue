<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <h5 class="text-lg font-semibold mb-2  text-center">{{ chart_title }}</h5>
        <div class="card shadow-sm p-4 chart" :style="`height: ${height}PX;`">
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
import LoadingComponent from '../LoadingComponent.vue';

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

const chartOptions = computed(() => ({
    chart: {
        type: 'bar',
        stacked: false,
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            horizontal: true,
            barHeight: '70%', // optional, better for horizontal layout
        }
    },
    dataLabels: {
        enabled: true,
        offsetX: 20, // ✅ slight spacing from the bar end
        style: {
            fontSize: '12px',
            colors: ['#000']
        },
        dropShadow: {
            enabled: true,
            top: 0,
            left: 0,
            blur: 2,
            color: '#fff',     // outline color
            opacity: 3
        }
    },
    xaxis: {
        categories: chart_labels.value, // ✅ move categories to y-axis
    },
    legend: {
        position: 'top',
    },
    colors: ['#f39c12', '#3498db']
}));
</script>
