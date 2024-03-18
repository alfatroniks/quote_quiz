<script setup>
import {ref, onMounted, onUnmounted} from 'vue';
import { useQuizStore } from '@/stores/quiz';
import router from "@/router";

const quizStore = useQuizStore();
const currentQuestion = ref(null);
const isAnswered = ref(false);
const resultMessage = ref('');
const totalTime = ref(15); //todo get from settings

let timerRunning = false;
let isPaused = false;
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
    //todo write result
    router.push('/result');
}

function startTimer() {
    if (timerRunning || isPaused) return;
    timerRunning = true;
    timerInterval = setInterval(() => {
        if (totalTime.value > 0 && !isPaused) {
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

function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    return `${minutes}:${seconds.toString().padStart(2, '0')}`;
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
    <div>
        <h1>Quiz</h1>
        <p>Time left: {{ formatTime(totalTime) }}</p>
        <div v-if="currentQuestion">
            <p>{{ currentQuestion.question }}</p>
            <button v-for="(answer, index) in currentQuestion.answers"
                    :key="index"
                    @click="submitAnswer(index)"
                    :disabled="isAnswered">
                {{ answer }}
            </button>
            <div v-if="isAnswered">
                <p>{{ resultMessage }}</p>
                <button @click="nextQuestion">Next -></button>
            </div>
        </div>
        <div v-else>
            <p>Loading...</p>
        </div>
    </div>
</template>
