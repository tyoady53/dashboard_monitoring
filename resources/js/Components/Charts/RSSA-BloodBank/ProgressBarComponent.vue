<template>
    <div class="d-flex align-items-center w-100">
        <div class="progress flex-grow-1" style="height: 16px; border-radius: 8px; background-color: #e9ecef;">
            <div
                class="progress-bar progress-bar-striped progress-bar-animated transition-all"
                :class="color"
                role="progressbar"
                :style="{ width: percentage + '%' }"
                :aria-valuenow="percentage"
                aria-valuemin="0"
                aria-valuemax="100"
            >
                <small class="fw-bold text-white">
                    {{ current }} / {{ total }}
                </small>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    current: {
        type: [Number, String],
        default: 0
    },
    total: {
        type: [Number, String],
        default: 0
    },
    color: {
        type: String,
        default: 'bg-info'
    }
});

// Calculate percentage safely
const percentage = computed(() => {
    const currentVal = Number(props.current) || 0;
    const totalVal = Number(props.total) || 0;

    if (totalVal <= 0) return 0;
    return Math.min(Math.round((currentVal / totalVal) * 100), 100);
});

// Dynamic Bootstrap background color switching
const progressColor = computed(() => {
    if (percentage.value === 100) return 'bg-success';
    if (percentage.value >= 50) return 'bg-info';
    return 'bg-warning text-dark';
});
</script>

<style scoped>
.transition-all {
    transition: width 0.4s ease;
}
</style>
