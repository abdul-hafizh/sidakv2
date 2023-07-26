<template>
    <div class="text-center loading-holder">
        <div v-if="message">{{ message }}</div>
        <pulse-loader color="#1f399a"></pulse-loader>
    </div>
</template>

<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

export default {
    components: {
        PulseLoader
    },
    props: {
        message: {
            type: String,
            default: ''
        }
    },
}
</script>
<style scoped>
.loading-holder {
    flex-direction: column;
}
</style>
