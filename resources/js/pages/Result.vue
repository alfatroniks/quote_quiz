<script setup>
import { useQuizStore } from '@/stores/quiz';
import {computed, onMounted, ref} from "vue";
import router from "@/router";
import {formatTime} from "@/utils/formatTime";
import VButton from "@/components/VButton.vue";

const quizStore = useQuizStore();
const unanswered = ref(quizStore.getUnAnswered())

async function restart() {
    await quizStore.fetchQuestions();
    await router.push('/quiz');
}

onMounted(async () => {
    await quizStore.saveScore(unanswered.value,10);
});

</script>

<template>
    <div class="max-w-md mx-auto my-8 p-4 bg-white shadow rounded-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Your result</h1>
        <p class="text-lg mb-2">Score: <strong class="text-custom-red">{{ quizStore.totalScore }}</strong></p>
        <p v-if="unanswered > 0" class="text-lg mb-2">Unanswered question: <strong class="text-custom-red">{{ unanswered }}</strong></p>
        <p v-else class="text-lg mb-2">Your time: <strong class="text-custom-red">{{ formatTime(quizStore.timeUsed) }}</strong></p>
        <v-button @click="restart()" class="mt-4">Restart</v-button>
    </div>
</template>

<style scoped>

</style>
