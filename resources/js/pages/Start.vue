<script setup>
import { ref, computed } from 'vue';
import router from "@/router";
import { useQuizStore } from '@/stores/quiz';
import VButton from "@/components/VButton.vue";

const quizStore = useQuizStore();
const guest = ref(quizStore.userData);

const isValidEmail = computed(() => {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(guest.value.email);
});

function startSession() {
    if (isValidEmail.value) {
        //todo save user data to store for session
        quizStore.saveUserData(guest.value);
        router.push('/quiz')
    } else {
        alert("Invalid email address");
    }
}
</script>
<template>
    <div class="guest-entry max-w-md mx-auto my-8 p-4 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Fill out the form before starting</h2>
        <form @submit.prevent="startSession" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" v-model="guest.name" class="form-input">
            </div>
            <div>
                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name:</label>
                <input type="text" id="lastName" v-model="guest.last_name" class="form-input">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" v-model="guest.email" class="form-input">
                <span v-if="!isValidEmail && guest.email.length > 0" class="text-red-500 text-xs">Invalid email address</span>
            </div>
            <v-button type="submit" :disabled="!isValidEmail" class="w-full justify-center">Start</v-button>
        </form>
    </div>
</template>

<style scoped>
</style>
