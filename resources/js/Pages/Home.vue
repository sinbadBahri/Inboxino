<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Toast from '../Support/Toast.vue';
import { Head } from "@inertiajs/vue3"; // Adjust the path as necessary

const message = ref('');
const toasts = ref([]); // Array to hold multiple toast messages

const MAX_TOASTS = 6; // Maximum number of toasts to display
const TOAST_DURATION = 300000; // Duration in milliseconds (5 minutes)

function sendMessage() {
    axios.post('/send-message', { message: message.value })
        .then(response => {
            if (response.status === 200) {
                // Add a success toast
                addToast({
                    id: Date.now(), // Unique ID for the toast
                    message: 'Message sent successfully!',
                    type: 'success',
                });
                message.value = ''; // Clear the input after sending
            }
        })
        .catch(error => {
            console.error('Error sending message:', error);
            // Add an error toast
            addToast({
                id: Date.now(), // Unique ID for the toast
                message: 'Failed to send message.',
                type: 'error',
            });
        });
}


// Function to add a toast to the list
function addToast(toast) {
    if (toasts.value.length < MAX_TOASTS) {
        toasts.value.push(toast);
        // Automatically close the toast after the specified duration
        setTimeout(() => {
            removeToast(toast.id);
        }, TOAST_DURATION);
    }
}

// Function to remove a toast by its ID
function removeToast(id) {
    toasts.value = toasts.value.filter(toast => toast.id !== id);
}
</script>

<template>
    <Head title="Messenger" />

    <div class="center-container">
        <div class="form-box">
            <!-- WhatsApp logo -->
            <img
                src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                alt="WhatsApp Logo"
                class="whatsapp-logo"
            />

            <!-- Form -->
            <form @submit.prevent="sendMessage" style="width: 100%;">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" :value="csrf">

                <!-- Message input -->
                <div class="form-outline mb-4">
                    <textarea
                        class="form-control"
                        id="message"
                        v-model="message"
                        rows="4"
                    ></textarea>
                    <label class="form-label" for="message">متن پیام</label>
                </div>

                <!-- Submit button -->
                <button
                    data-mdb-ripple-init
                    type="submit"
                    class="btn btn-success btn-block mb-4"
                >
                    ارسال پیام
                </button>
            </form>

            <!-- Toast Notifications -->
            <div class="toast-container">
                <Toast
                    v-for="toast in toasts"
                    :key="toast.id"
                    :message="toast.message"
                    :type="toast.type"
                    @close="removeToast(toast.id)"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
html,
body {
    height: 100%;
    margin: 0;
    background-color: #f0f2f5;
}

.center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.form-box {
    background-color: white;
    padding: 3rem;
    border-radius: 40px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin-top: 3rem;
    margin-left: 4rem;
    margin-right: 4rem;
}

.whatsapp-logo {
    width: 100px;
    height: 100px;
    margin-left: 3rem;
    margin-bottom: 1.5rem;
}

/* Styling for the toast container */
.toast-container {
    position: fixed;
    bottom: 0;
    end: 0;
    padding: 1rem;
    z-index: 11;
    display: flex;
    flex-direction: column; /* Stack toasts vertically */
    gap: 1rem; /* Space between toasts */
    margin-left: 40rem;
}
</style>
