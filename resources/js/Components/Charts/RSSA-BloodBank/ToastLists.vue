<template>
    <LoadingComponent v-if="isLoading" class="col-12 text-center" />
    <div v-else>
        <div class="card border-0 shadow-sm p-3 bg-white" style="height: 300px; border-radius: 12px;">
            <h6 class="text-secondary font-semibold mb-3 d-flex align-items-center flex-wrap" style="font-size: 0.95rem; gap: 4px;">
                <span class="text-uppercase fw-bold">{{ chart_title.split('>')[0] }}</span>
                <span v-if="chart_title.includes('>') " class="text-muted fw-normal">> {{ chart_title.split('>')[1] }}</span>
            </h6>

            <div class="scroll-container">
                <div  class="scroll-content-toast">
                    <div style="height: calc(100% - 40px); overflow-y: auto; padding-right: 4px;">
                        <div
                            class="card mb-2 border-0 custom-blood-card"
                            v-for="(item, i) in chart_data"
                            :key="i"
                        >
                            <div class="card-body p-3">
                                <div class="fw-bold blood-title mb-1"><strong>{{ item.title }}</strong></div>
                                <div class="text-muted blood-status">{{ item.status }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import LoadingComponent from '../../LoadingComponent.vue';
import './AutoScroll.css';

const props = defineProps({
    label: String,
    value: Number,
    datas: Object,
});

const isLoading = ref(false);

const chart_title = computed(() => props.datas?.title || 'LIST BAG DARAH HAMPIR EXPIRED')
const chart_data = computed(() => props.datas?.data || [])
</script>

<style scoped>
.custom-blood-card {
    background-color: #FFFDF5; /* Soft warm background */

    /* 1. Add the heavy left border
      2. Set a general border radius, but keep top-left/bottom-left slightly
         sharper or tailored so the left border curves beautifully.
    */
    border-left: 6px solid #E86315 !important;
    border-radius: 16px 16px 16px 16px !important;

    /* Fallback/Correction to ensure the border respects the rounded corners */
    background-clip: padding-box;
}

.blood-title {
    color: #A34213; /* Darker brick orange text color */
    /* font-size: 1.05rem; */
}

.blood-status {
    color: #6C5549 !important; /* Muted text color */
    /* font-size: 0.9rem; */
}

/* Custom minimal scrollbar styling */
::-webkit-scrollbar {
    width: 5px;
}
::-webkit-scrollbar-track {
    background: transparent;
}
::-webkit-scrollbar-thumb {
    background: #E0E0E0;
    border-radius: 10px;
}
</style>
