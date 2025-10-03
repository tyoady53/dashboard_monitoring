<template>
    <div class="page-loader">
        <div class="loading-spinner">
            <div class="spinner-border"></div>
        </div>
        <!-- Dynamic loading label -->
        <div class="loading-label"><h3>{{ loadingLabel }}</h3></div>
    </div>
</template>

<script>
    export default {
        name: 'LoadingComponent',
        props: {
            loadingLabel: {
            type: String,
            default: 'Loading Data', // Default label if none is provided
            },
        },
    };
</script>

<style scoped>
.page-loader {
    padding: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 250px;
    width: 100%;
    z-index: 9999;
}

.loading-spinner {
    position: relative;
    width: 120px;
    height: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loading-label {
    margin-top: 10px; /* Adjust based on spinner size */
}

/* Outer spinning border */
.spinner-border {
    position: absolute;
    border: 8px solid #f3f3f3; /* Light gray border */
    border-top: 8px solid #3498db; /* Blue top border */
    border-radius: 50%; /* Circular spinner */
    width: 100%; /* Match the container size */
    height: 100%;
    animation: spin 1.2s linear infinite; /* Rotates only the border */
}

/* Inner stationary content */
.spinner-static {
    position: absolute; /* Decouples it from the spinning animation */
    background-image: url('/images/Wynacom.png'); /* Logo path */
    background-size: contain; /* Scales logo appropriately */
    background-position: center;
    background-repeat: no-repeat;
    width: 60%; /* Adjust size relative to the spinner */
    height: 60%;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Extra small devices (phones, <576px) */
@media (max-width: 575.98px) {
    /* Styles for extra small devices */
    .page-loader {
        display: flex;
        justify-content: center;
        align-items: center;
        /* position: fixed; */
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: white;
        z-index: 999;
    }
}

/* Small devices (tablets, ≥576px) */
@media (min-width: 576px) and (max-width: 767.98px) {
    /* Styles for small devices */
    .page-loader {
        display: flex;
        justify-content: center;
        align-items: center;
        /* position: fixed; */
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: white;
        z-index: 999;
    }
}

/* Medium devices (tablets, ≥768px) */
@media (min-width: 768px) and (max-width: 991.98px) {
    /* Styles for medium devices */
    .page-loader {
        display: flex;
        justify-content: center;
        align-items: center;
        /* position: fixed; */
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: white;
        z-index: 999;
    }
}
</style>
