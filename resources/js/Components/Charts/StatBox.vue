<template>

    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <div class="row">
            <div class="col-4" v-for="data in chart_data">
                <div class="card_content">
                    <div class="stat-box">
                        <div class="stat-value">{{ formatNumber(data.total) }}</div>
                        <div class="stat-label">{{ data.label }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import LoadingComponent from '../LoadingComponent.vue';

const props = defineProps({
    label: String,
    datas: Array,
});

const isLoading = ref(false);

function formatNumber(num) {
    return Number(num).toLocaleString('id-ID', {
        currency: 'IDR',
        minimumFractionDigits: 0
    });
}

const chart_data = computed(() => props.datas || [])
</script>


<style scoped>
.stat-box {
    border-radius: 10px;
    padding: 10px;
    height: 100px;
    background: #f3f4f6;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.card_content {
    display: flex;               /* Aktifkan flexbox */
    justify-content: center;     /* Horizontal center */
    align-items: center;         /* Vertical center */
}

.stat-label {
    font-size: 12px;
    color: #6b7280;
}

.stat-value {
    font-size: 20px;
    font-weight: bold;
    color: #111827;
}
</style>
