<script setup>
import { ref } from 'vue';
import { useQuizStore } from '@/stores/quiz';
import router from "@/router";

const quizStore = useQuizStore();

function setMode(mode) {
    quizStore.setMode(mode);
    router.push('/quiz');
}
</script>

<template>
    <div>
        <h1>Select Quiz Mode</h1>
<!--        //todo maybe component -->
        <button @click="setMode('binary')">Binary (Yes/No)</button>
        <button @click="setMode('multiple')">Multiple Choice</button>
    </div>
</template>
