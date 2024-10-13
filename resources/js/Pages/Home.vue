<script setup>
import { ref } from 'vue';
import axios from 'axios';
import {Head} from "@inertiajs/vue3";

const message = ref('');

function sendMessage() {
    axios.post('/send-message', { message: message.value })
        .then(response => {
            console.log('Message sent successfully:', response.data);
            message.value = '';
        })
        .catch(error => {
            console.error('Error sending message:', error.response.data);
        });
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
    margin-left: 3.5rem;
    margin-right: 3.5rem;
    margin-bottom: 1.5rem;
}
</style>
