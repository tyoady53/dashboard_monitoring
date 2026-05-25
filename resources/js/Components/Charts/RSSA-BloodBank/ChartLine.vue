<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <div class="card shadow-sm p-2 chart" :style="`height: ${height}PX;`">
            <h6 class="text-lg font-semibold mb-1"><strong>{{ chart_title }}</strong></h6>
            <apexchart v-if="chart_data.length" height="250" :options="chartOptions" :series="chart_data" />
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

const chartOptions = computed(() => ({
    chart: {
        type: 'area', // 💡 Kunci utama untuk membuat chart area seperti di gambar
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false
        }
    },
    tooltip: {
        x: {
            formatter: function(value, opts) {

                const categories = chart_labels.value.map(label => label.slice(0, 3))

                const label = categories[opts.dataPointIndex]

                const days = {
                    MIN: 'Minggu',
                    SEN: 'Senin',
                    SEL: 'Selasa',
                    RAB: 'Rabu',
                    KAM: 'Kamis',
                    JUM: 'Jumat',
                    SAB: 'Sabtu'
                }

                return days[label] || label
            }
        },

        y: {
            title: {
                formatter: () => 'Jumlah Pasien : '
            }
        }
    },
    dataLabels: {
        enabled: false // 💡 Di-disable agar bersih tanpa angka melayang di atas garis, mirip gambar
    },
    stroke: {
        curve: 'smooth', // 💡 Membuat garis melengkung halus (Spline)
        width: 3
    },
    fill: {
        type: 'gradient', // 💡 Memberikan efek gradasi warna transparan di bawah garis
        // gradient: {
        //     shadeIntensity: 1,
        //     opacityFrom: 0.4,
        //     opacityTo: 0.1,
        //     stops: [0, 90, 100]
        // }
    },
    xaxis: {
        categories: chart_labels.value.map(label => label.slice(0, 3))
    },
    colors: ['#3b82f6'], // 💡 Menggunakan warna biru cerah menyesuaikan mockup terbaru
    markers: {
        size: 4, // Tanda titik lingkaran kecil pada sudut grafik
        colors: ['#3b82f6'],
        strokeColors: '#3b82f6',
        strokeWidth: 2,
    },
    legend: {
        show: false
    }
}));
</script>
