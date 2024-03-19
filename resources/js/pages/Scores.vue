<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import {formatTime} from "@/utils/formatTime";
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
const results = ref([]);
const isAdmin = ref(authStore.user?.is_admin);

onMounted(async () => {
    try {
        const response = await axios.get('/scores');
        results.value = response.data;
    } catch (error) {
        console.error('Error:', error);
    }
});
</script>

<template>
    <div class="max-w-6xl mx-auto my-8">
        <h1 class="text-2xl font-bold text-center mb-6">Scores</h1>
        <div class="overflow-x-auto">
            <table class="w-full table-auto text-left whitespace-no-wrap">
                <thead class="text-xs font-semibold uppercase text-gray-600 bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th v-if="isAdmin" class="px-4 py-2">Last Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th v-if="isAdmin" class="px-4 py-2">Unanswered</th>
                    <th class="px-4 py-2">Total Score</th>
                    <th v-if="isAdmin" class="px-4 py-2">Submit Date</th>
                    <th v-else class="px-4 py-2">Time</th>
                </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-200">
                <tr v-for="result in results" :key="result.email" class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ result.name }}</td>
                    <td v-if="isAdmin" class="px-4 py-2">{{ result.last_name }}</td>
                    <td class="px-4 py-2">{{ result.email }}</td>
                    <td v-if="isAdmin" class="px-4 py-2">{{ result.unanswered }}</td>
                    <td class="px-4 py-2">{{ result.totalScore }}</td>
                    <td v-if="isAdmin" class="px-4 py-2">{{ new Date(result.created_at).toLocaleString() }}</td>
                    <td v-else class="px-4 py-2">{{ formatTime(result.timeUsed) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

