<template>
    <div v-if="visible" class="toast show" role="alert" aria-live="assertive" aria-atomic="true" :class="bgClass">
        <div class="toast-header">
            <strong class="me-auto">{{ title }}</strong>
            <button type="button" class="btn-close" @click="closeToast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ message }}
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, watch, onMounted } from 'vue';

const props = defineProps({
    message: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'success', // or 'error'
    },
});

const visible = ref(true);
const title = props.type === 'success' ? 'Success' : 'Error';
const bgClass = props.type === 'success' ? 'bg-success' : 'bg-danger';

const closeToast = () => {
    visible.value = false;
};

watch(() => props.message, (newMessage) => {
    if (newMessage) {
        visible.value = true; // Make toast visible when there's a new message
    }
});

onMounted(() => {
    visible.value = true; // Ensure the toast is visible on mount
});
</script>

<style scoped>
.toast {
    transition: opacity 0.5s ease-in-out;
}

.toast.show {
    opacity: 1;
}

.toast.hide {
    opacity: 0;
}
</style>
