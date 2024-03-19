<script setup>
import {ref, onMounted, onUnmounted} from 'vue';
import { useQuizStore } from '@/stores/quiz';
import router from "@/router";
import {formatTime} from "@/utils/formatTime";
import VButton from '@/components/VButton';

const quizStore = useQuizStore();
const currentQuestion = ref(null);
const isAnswered = ref(false);
const resultMessage = ref('');
const totalTime = ref(quizStore.timeLimit);

let timerRunning = false;
let isPaused = false; //not use pause for now
let timerInterval = null;

function submitAnswer(answer) {
    isAnswered.value = true;
    isPaused = true;
    quizStore.submitAnswer(currentQuestion.value.id, answer).then(message => {
        resultMessage.value = message;
    });
}

function nextQuestion() {
    isAnswered.value = false;
    resultMessage.value = '';
    currentQuestion.value = quizStore.getNextQuestion();
    isPaused = false;
    if (quizStore.countQuestions < quizStore.currentQuestionIndex) {
        finishQuiz();
    }
}

function finishQuiz() {
    quizStore.saveTimeUsed(totalTime.value);
    router.push('/result');
}

function startTimer() {
    if (timerRunning) return;
    timerRunning = true;
    timerInterval = setInterval(() => {
        if (totalTime.value > 0) {
            totalTime.value--;
        } else if (totalTime.value <= 0) {
            stopTimer();
            finishQuiz();
        }
    }, 1000);
}

function stopTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
        timerRunning = false;
    }
}

onMounted(async () => {
    await quizStore.fetchQuestions();
    currentQuestion.value = quizStore.getNextQuestion();
    startTimer();
});

onUnmounted(() => {
    stopTimer();
});

</script>

<template>
    <div class="flex flex-col items-center space-y-4 my-8">
        <h1 class="text-2xl font-bold">Quiz</h1>
        <p class="text-lg">Time left: {{ formatTime(totalTime) }}</p>
        <div v-if="currentQuestion" class="w-full max-w-xl text-center">
            <p class="text-lg font-medium">{{ currentQuestion.question }}</p>
            <div class="flex flex-wrap justify-center space-x-2">
                <v-button
                    v-for="(answer, index) in currentQuestion.answers"
                    :key="index"
                    class="mt-2"
                    @click="submitAnswer(index)"
                    :disabled="isAnswered">
                    {{ answer }}
                </v-button>
            </div>
            <div v-if="isAnswered" class="mt-4">
                <p>{{ resultMessage }}</p>
                <v-button @click="nextQuestion">Next -></v-button>
            </div>
        </div>
        <div v-else>
            <p>Loading...</p>
        </div>
    </div>
</template>
