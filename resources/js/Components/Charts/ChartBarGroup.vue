<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <h5 class="text-lg font-semibold mb-1 text-center">{{ title }}</h5>
        <div class="card shadow-sm p-2 chart">
          <apexchart
            type="bar"
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
  link: String
});

const isLoading = ref(false);
const timeCount = ref(0);
const title = ref({});
const labels = ref([]);
const datas = ref([]);

onMounted(() => {
    get_monitoring_data();
});

const get_monitoring_data = () => {
  isLoading.value = true;
  timeCount.value = 0;
//   axios.get(`/api/dashboard/${props.link}/`,{
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
    type: 'bar',
    stacked: false,
    toolbar: {
      show: false
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '50%',
    }
  },
  dataLabels: {
    enabled: true,
    offset: 20, // ✅ slight spacing from the bar end
    style: {
      fontSize: '11px',
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
    categories: labels.value,
  },
  legend: {
    position: 'top',
  },
  colors: ['#f39c12', '#3498db']
}));
</script>
