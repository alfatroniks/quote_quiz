import { defineStore } from 'pinia';
import axios from 'axios';

export const useQuizStore = defineStore('quiz', {
    state: () => ({
        userData: JSON.parse(localStorage.getItem('userData')) ||
            {
            name: '',
            last_name: '',
            email: ''
            },
        mode: 'binary', // 'binary' or 'multiple' maybe need it?
        quiz_mode_id: 1,
        questions: [],
        currentQuestionIndex: 0,
        countQuestions: 0,
        totalScore: 0,
        timeLimit: 300, //todo setting time limit
        timeUsed: 0,
        //todo get data from settings
    }),
    actions: {
        saveUserData(data) {
            this.userData = data;
            localStorage.setItem('userData', JSON.stringify(data));
        },
        setMode(mode, modeId) {
            this.mode = mode;
            this.quiz_mode_id = modeId;
            this.currentQuestionIndex = 0;
            // Reset questions or fetch based on mode
        },
        async fetchQuestions() {
            const response = await axios.get('/questions/session', { params: { mode: this.mode } });
            this.questions = response.data;
            this.currentQuestionIndex = 0;
            this.totalScore = 0;
            this.countQuestions = this.questions.length;
        },
        getNextQuestion() {
            const question = this.questions[this.currentQuestionIndex];
            this.currentQuestionIndex += 1;
            return question;
        },
        async submitAnswer(questionId, answer) {
            try {
                const response = await axios.put('/answer/' + questionId, { answer: answer });
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
        },
        getUnAnswered() {
            return this.countQuestions - this.currentQuestionIndex + 1;
        },
        saveTimeUsed(timeUsed) {
            this.timeUsed = this.timeLimit-timeUsed;
        },
        async saveScore (unanswered, time_used) {
            let scoreData = {
                ...this.userData,
                total_score: this.totalScore,
                unanswered: this.getUnAnswered(),
                quiz_mode_id: this.quiz_mode_id,
                time_used: this.timeUsed,
            };
            try {
                const response = await axios.post('/scores', scoreData);
                console.log(response.data.message);
            } catch (error) {
                console.error(error.response.data);
            }
        }
    },
});
