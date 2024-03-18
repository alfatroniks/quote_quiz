<script setup>
import { useQuizStore } from '@/stores/quiz';
import {computed} from "vue";
import router from "@/router";

const quizStore = useQuizStore();
const unanswered = computed(() => {
    return quizStore.countQuestions - quizStore.currentQuestionIndex + 1;
})

async function restart() {
    await quizStore.fetchQuestions();
    await router.push('/quiz');
}

</script>

<template>
    <div>
        <h1>You result</h1>
        <p>Score: <strong>{{ quizStore.totalScore }}</strong></p>
        <p v-if="unanswered > 0">Unanswered question: <strong>{{ unanswered }}</strong></p>
        <button @click="restart()">Restart</button>
    </div>
</template>

<style scoped>

</style>
