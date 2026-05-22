<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <div class="stat-container">
            <div v-for="(data, index) in chart_data" :key="index" class="stat-item">
                <div class="stat-box" :style="{ borderLeft: `5px solid ${data.color || '#6b7280'}` }">
                    <div class="stat-label">{{ data.label }}</div>
                    <div class="stat-value">{{ formatNumber(data.total) }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import LoadingComponent from '../../LoadingComponent.vue';

const props = defineProps({
    label: String,
    datas: Array,
});

const isLoading = ref(false);

function formatNumber(num) {
    return Number(num).toLocaleString('id-ID', {
        minimumFractionDigits: 0
    });
}

const chart_data = computed(() => props.datas || []);
</script>

<style scoped>
/* Container untuk membuat layout berjejer ke samping */
.stat-container {
    display: flex;
    gap: 15px; /* Jarak antar kartu */
    width: 100%;
    flex-wrap: wrap; /* Agar responsif jika layar terlalu kecil */
}

/* Item pembungkus agar membagi space sama rata */
.stat-item {
    flex: 1;
    min-width: 200px; /* Batas minimum lebar per kartu */
}

.stat-box {
    border-radius: 12px;
    height: 100px; /* Ditinggikan sedikit agar teks panjang tidak menabrak angka */
    padding: 12px 15px;
    background: #ffffff; /* Menggunakan background putih seperti di gambar */
    text-align: left;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Menjaga label di atas dan angka di bawah */
    transition: transform 0.2s ease;
}

.stat-label {
    font-size: 13px;
    font-weight: 600;
    color: #4b5563; /* Warna abu-abu teks sedikit gelap */
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Membatasi teks label jika terlalu panjang */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.stat-value {
    font-size: 28px; /* Diperbesar agar sesuai dengan mockup */
    font-weight: 800;
    color: #111827;
    line-height: 1;
    margin-top: 0px;
}
</style>
