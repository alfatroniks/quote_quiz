<script setup>
import {onMounted, ref, toRefs, watch} from 'vue';
import axios from 'axios';
import router from "@/router";
import VButton from "@/components/VButton";

const props = defineProps({
    questionId: Number
});

const { questionId } = toRefs(props);


const form = ref({
    question: '',
    quiz_mode_id: '1',
    correct_answer: '',
    answers: ['', '', ''],
});

const correctAnswerIndex = ref([]);

const onChangeQuestionMode = () => {
    form.value.correct_answer = '';
    correctAnswerIndex.value = [];
    form.value.answers = ['', '', ''];
};

function cancel() {
    router.push({name: 'QuestionsList'});
}

const submitForm = async () => {
    let payload = {
        question: form.value.question,
        quiz_mode_id: form.value.quiz_mode_id,
    };
    if (form.value.quiz_mode_id === '1') {
        payload = {
            ...payload,
            answers: ["Yes", "No"],
            correct_answer: parseInt(form.value.correct_answer),
        };
    } else {
        payload = {
            ...payload,
            answers: form.value.answers,
            correct_answer: correctAnswerIndex.value[0].toString(),
        };
    }

    if (payload.correct_answer === '') {
        console.log('Choose the correct answer!');
    } else {
        if (questionId.value) {
            await axios.put(`/questions/${questionId.value}`, payload);
        } else {
            await axios.post('/questions', payload);
        }

        await router.push({name: 'QuestionsList'});
    }
};

onMounted(async () => {
    if (questionId.value) {
        try {
            const response = await axios.get(`/questions/${questionId.value}`);
            const questionData = response.data.data;
            // console.log(questionData);
            form.value = {
                question: questionData.question,
                quiz_mode_id: questionData.quiz_mode_id.toString(),
                correct_answer: questionData.correct_answer,
                answers: questionData.answers || ['', '', ''],
            };
            if (form.value.quiz_mode_id !== '1') {
                correctAnswerIndex.value = [questionData.correct_answer];
            } else {
                correctAnswerIndex.value = [questionData.correct_answer ? 'No' : 'Yes'];
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
});

watch(correctAnswerIndex, (newValue) => {
    if (newValue.length > 1) {
        correctAnswerIndex.value = [newValue.pop()];
    }
});
</script>
<template>
    <div class="max-w-lg mx-auto my-8 p-4 bg-white shadow rounded-lg">
        <form @submit.prevent="submitForm" class="space-y-4">
            <div>
                <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                <input id="question" v-model="form.question" type="text" required class="form-input">
            </div>
            <div>
                <label for="quiz_mode_id" class="block text-sm font-medium text-gray-700">Mode:</label>
                <select id="quiz_mode_id" v-model="form.quiz_mode_id" @change="onChangeQuestionMode" required class="form-input">
                    <!-- Options are read from the database -->
                    <option value="1">Binary</option>
                    <option value="2">Multiple choice</option>
                </select>
            </div>
            <div v-if="form.quiz_mode_id === '1'" class="space-y-2">
                <span class="block text-sm font-medium text-gray-700">Right answer:</span>
                <div class="flex items-center">
                    <input type="radio" id="yes" value="0" v-model="form.correct_answer" class="mr-2">
                    <label for="yes" class="mr-4">Yes</label>
                    <input type="radio" id="no" value="1" v-model="form.correct_answer" class="mr-2">
                    <label for="no">No</label>
                </div>
            </div>

            <div v-if="form.quiz_mode_id === '2'" class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Answers:</label>
                <div v-for="(answer, index) in form.answers" :key="index" class="flex items-center space-x-2">
                    <input type="text" v-model="form.answers[index]" required class="form-input">
                    <input type="checkbox" :value="index" v-model="correctAnswerIndex" class="rounded">
                </div>
            </div>
            <div class="flex justify-between">
                <v-button @click.prevent="cancel" class="bg-gray-600 hover:bg-gray-700 text-white">Cancel</v-button>
                <v-button type="submit" class="bg-custom-red hover:bg-red-700 text-white">Save</v-button>
            </div>
        </form>
    </div>
</template>
