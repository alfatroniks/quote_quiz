<template>
    <div class="login-container max-w-sm mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form @submit.prevent="login" class="space-y-4">
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" v-model="email" required class="form-input">
            </div>
            <div class="form-group">
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" v-model="password" required class="form-input">
            </div>
            <v-button type="submit" class="w-full">Login</v-button>
        </form>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth';
import router from "@/router";
import VButton from "@/components/VButton";

const email = ref('test@example.com');
const password = ref('password');
const authStore = useAuthStore();


async function login() {
    try {
        await authStore.login(email.value, password.value);
        await router.push('/admin');
    } catch (error) {
        console.log('login error');
    }
}
</script>

<style scoped>
.login-container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
}

.form-group input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
}
</style>
