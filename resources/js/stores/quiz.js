import { defineStore } from 'pinia';
import axios from 'axios';

export const useQuizStore = defineStore('quiz', {
    state: () => ({
        mode: 'binary', // 'binary' or 'multiple'
        questions: [],
        currentQuestionIndex: 0,
        countQuestions: 0,
        totalScore: 0,
    }),
    actions: {
        setMode(mode) {
            this.mode = mode;
            this.currentQuestionIndex = 0;
            // Reset questions or fetch based on mode
        },
        async fetchQuestions() {
            // Fetch questions based on the selected mode
            const response = await axios.get('/questions/session', { params: { mode: this.mode } });
            this.questions = response.data;
            this.currentQuestionIndex = 0;
            this.totalScore = 0;
            this.countQuestions = this.questions.length;
        },
        getNextQuestion() {
            const question = this.questions[this.currentQuestionIndex];
            this.currentQuestionIndex++;
            return question;
        },
        async submitAnswer(questionId, answer) {
            try {
                const response = await axios.put('/answer/' + questionId, { answer: answer, mode: this.mode });
                let message = 'Sorry, you are wrong! The right answer is ';
                if (response.data.correct) {
                    this.totalScore++;
                    message = 'Correct! The right answer is ';
                }
                message += '"' + response.data.answer + '"';
                return message;
            } catch (error) {
                console.error(error);
                return "An error occurred";
            }
        }
    },
});
