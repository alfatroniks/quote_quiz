<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const questions = ref([]);

async function deleteQuestion(id) {
    try {
        await axios.delete(`/questions/${id}`)
        questions.value = questions.value.filter(question => question.id !== id);
    } catch (error) {
        console.log('login error');
    }
}

onMounted(async () => {
    try {
        const response = await axios.get('/questions');
        questions.value = response.data;
    } catch (error) {
        console.error('Error:', error);
    }
});
</script>

<template>
    <div class="max-w-4xl mx-auto my-8 p-4 bg-white shadow rounded-lg">
        <h2 class="text-2xl font-bold mb-4">List of questions</h2>
        <router-link to="question" class="inline-block mb-4 bg-custom-red text-white py-2 px-4 rounded hover:bg-red-700 transition ease-in-out duration-150">Create new</router-link>
        <ul class="list-disc pl-5 space-y-2">
            <li v-for="question in questions" :key="question.id" class="flex justify-between items-center">
                {{ question.question }} (Mode: {{ question.quiz_mode_id }})
                <span>
                    <router-link :to="`question/${question.id}`" class="text-custom-red hover:text-red-700 transition ease-in-out duration-150 mr-2">Edit</router-link> |
                    <a href="#" @click.prevent="deleteQuestion(question.id)" class="text-custom-red hover:text-red-700 transition ease-in-out duration-150 ml-2">Delete</a>
                </span>
            </li>
        </ul>
    </div>
</template>
