<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <h5 class="text-lg font-semibold mb-1 text-center">{{ title }}</h5>
        <div class="card shadow-sm p-2 chart">
          <apexchart
            type="line"
            height="250"
            :options="chartOptions"
            :series="datas"
          />
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, computed, reactive, onBeforeUnmount } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import LoadingComponent from '../LoadingComponent.vue';

const props = defineProps({
  series: Array,
  categories: Array,
  cust: Number,
  branch: Number,
  link: String,
});

const isLoading = ref(false);
const timeCount = ref(0);
const title = ref({});
const labels = ref([]);
const datas = ref([]);
const total = ref(0);

onMounted(() => {
    get_monitoring_data();
});

const get_monitoring_data = () => {
  isLoading.value = true;
  timeCount.value = 0;
  axios.get(`/get_data`,{
    params: {
        link: props.link,
        cust_id: props.cust,
        cust_branch: props.branch
    }
    })
    .then(res => {
        const data = res.data;
        title.value = data.title;
        labels.value = data.labels;
        datas.value = data.data;
        total.value = data.total;
        // console.log('Labels:', typeof data.labels, data.labels);

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

const chartOptions = computed(() => ({
  chart: {
    type: 'line',
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false
    }
  },
  dataLabels: {
    enabled: true
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    categories: labels.value
  },
  colors: ['#10b981'], // tailwind green
  markers: {
    size: 4
  },
  legend: {
    position: 'top'
  }
}));
</script>
