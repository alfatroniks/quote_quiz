<script setup>
import {useAuthStore} from "@/stores/auth";
import router from "@/router";
import VButton from "@/components/VButton.vue";
const authStore = useAuthStore();

function logout() {
    authStore.logout();
    router.push('/');
}

</script>

<template>
    <div id="app" class="flex flex-col min-h-screen">
        <header class="bg-gray-800 text-white">
            <nav class="max-w-5xl mx-auto px-4 py-2 flex justify-between items-center">
                <template v-if="authStore.user">
                    <router-link class="text-custom-red hover:text-red-700 transition duration-150" to="/admin/scores">Scores</router-link> |
                    <router-link class="text-custom-red hover:text-red-700 transition duration-150" to="/admin/questions">Questions</router-link> |
                    <v-button @click="logout" class="bg-transparent hover:bg-gray-700">Logout</v-button>
                </template>
                <template v-else>
                    <router-link class="text-custom-red hover:text-red-700 transition duration-150" to="/">Start</router-link> |
                    <router-link class="text-custom-red hover:text-red-700 transition duration-150" to="/mode">Mode</router-link> |
                    <router-link class="text-custom-red hover:text-red-700 transition duration-150" to="/scores">Scores</router-link> |
                    <router-link class="text-custom-red hover:text-red-700 transition duration-150" to="/admin">Admin</router-link>
                </template>
            </nav>
        </header>
        <main class="flex-grow">
            <router-view></router-view>
        </main>
        <footer class="bg-gray-800 text-white text-center p-4">
            <p>©Quiz</p>
        </footer>
    </div>
</template>

<style>
</style>
