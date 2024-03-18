<script setup>
import { ref, computed } from 'vue';
import router from "@/router";

const guest = ref({
    name: '',
    lastName: '',
    email: ''
});

const isValidEmail = computed(() => {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(guest.value.email);
});

function startSession() {
    if (isValidEmail.value) {
        //todo save user data to store for session
        router.push('/quiz')
    } else {
        alert("Invalid email address");
    }
}
</script>
<template>
    <div class="guest-entry">
        <h2>Fill out the form before starting</h2>
        <form @submit.prevent="startSession">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="guest.name">
            </div>
            <div>
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" v-model="guest.lastName">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="guest.email">
                <span v-if="!isValidEmail && guest.email.length > 0" style="color: red;">Invalid email address</span>
            </div>
            <button type="submit" :disabled="!isValidEmail">Start</button>
        </form>
    </div>
</template>

<style scoped>
</style>
