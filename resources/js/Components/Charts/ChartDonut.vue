<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <h5 class="text-lg font-semibold mb-2 text-center">{{ chart_title }}</h5>
        <div class="card  shadow-sm p-4 d-flex align-items-center justify-content-center" style="height: 400PX;">
            <apexchart v-if="chart_data.length" type="donut" height="350" :options="chartOptions" :series="chart_data" />
            <div v-if="total" class="text-sm text-gray-500">
                Total: <strong>{{ total }}</strong>
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
    datas: Array,
});

const isLoading = ref(false);

const chart_title = computed(() => props.datas?.title || 'Untitled')
const chart_labels = computed(() => props.datas?.labels || [])
const chart_data = computed(() => props.datas?.data || [])

function hsvToRgb(h, s, v) {
    let f = (n, k = (n + h / 60) % 6) =>
        v - v * s * Math.max(Math.min(k, 4 - k, 1), 0);
    const r = Math.round(f(5) * 255);
    const g = Math.round(f(3) * 255);
    const b = Math.round(f(1) * 255);
    return `rgb(${r}, ${g}, ${b})`;
}

function generateContrastingRgbColors(n) {
    const colors = [];
    for (let i = 0; i < n; i++) {
        const hue = i * 53;  // evenly spaced hues
        colors.push(hsvToRgb(hue, 0.65, 0.9)); // vivid RGB color
    }
    return colors;
}

const colors = computed(() => generateContrastingRgbColors(chart_data.length));

const chartOptions = computed(() => ({
    chart: {
        type: 'donut'
    },
    labels: chart_labels.value,
    dataLabels: {
        enabled: true,
        formatter: function (val, opts) {
            const series = opts?.w?.config?.series;
            const index = opts?.seriesIndex;

            if (Array.isArray(series) && typeof index === 'number') {
                return series[index];
            }

            return ''; // fallback if anything is wrong
        },
        style: {
            fontSize: '14px'
        }
    },
    legend: {
        position: 'bottom'
    },
    plotOptions: {
        pie: {
            donut: {
                size: '60%'
            }
        }
    },
    colors: colors.value // optional: adjust for 2-3 values
}));
</script>

<style>
.apexcharts-canvas {
  margin: auto;
  max-width: 100% !important;
  max-height: 100% !important;
}</style>
