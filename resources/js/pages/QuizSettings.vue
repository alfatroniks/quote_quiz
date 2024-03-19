<script setup>
import { ref } from 'vue';
import { useQuizStore } from '@/stores/quiz';
import router from "@/router";
import VButton from "@/components/VButton.vue";

const quizStore = useQuizStore();

function setMode(mode, modeId) {
    quizStore.setMode(mode, modeId);
    if ( !quizStore.userData.email || quizStore.userData.email.trim() === '' ) {
        router.push('/');
    } else {
        router.push('/quiz');
    }
}
</script>

<template>
    <div class="max-w-md mx-auto my-8 p-4 bg-white shadow rounded-lg text-center">
        <h1 class="text-2xl font-bold mb-6">Select Quiz Mode</h1>
<!--        //todo load from settings-->
        <v-button @click="setMode('binary', 1)" class="mr-2">Binary (Yes/No)</v-button>
        <v-button @click="setMode('multiple', 2)">Multiple Choice</v-button>
    </div>
</template>
