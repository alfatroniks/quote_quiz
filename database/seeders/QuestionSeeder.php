<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Yes/No Questions
        $questionsYesNo = [
            ['question' => 'Is "To be, or not to be" a quote by Shakespeare?', 'answers' => ['Yes', 'No'], 'correct' => 0],
            ['question' => 'Did Einstein say "I think, therefore I am"?', 'answers' => ['Yes', 'No'], 'correct' => 1],
            ['question' => 'Did Leonardo da Vinci paint the Mona Lisa?', 'answers' => ['Yes', 'No'], 'correct' => 0],
            ['question' => 'Is the capital of France Rome?', 'answers' => ['Yes', 'No'], 'correct' => 1],
            ['question' => 'Can humans breathe underwater without any equipment?', 'answers' => ['Yes', 'No'], 'correct' => 1],
            ['question' => 'Is the chemical symbol for water H2O?', 'answers' => ['Yes', 'No'], 'correct' => 0],
            ['question' => 'Is Bitcoin a physical coin?', 'answers' => ['Yes', 'No'], 'correct' => 1],
            ['question' => 'Does the sun revolve around the Earth?', 'answers' => ['Yes', 'No'], 'correct' => 1],
            ['question' => 'Can penguins fly?', 'answers' => ['Yes', 'No'], 'correct' => 1],
            ['question' => 'Is Mount Everest the highest mountain in the world?', 'answers' => ['Yes', 'No'], 'correct' => 0],
            ['question' => 'Is Python a type of snake as well as a programming language?', 'answers' => ['Yes', 'No'], 'correct' => 0],
            ['question' => 'Did the Titanic sink on its maiden voyage?', 'answers' => ['Yes', 'No'], 'correct' => 0],
        ];

        // Multiple Choice Questions
        $questionsMultiple = [
            ['question' => 'Who said "I think, therefore I am"?', 'answers' => ['Descartes', 'Einstein', 'Newton'], 'correct' => 0],
            ['question' => 'Finish the quote: "That\'s one small step for man..."', 'answers' => ['one giant leap for mankind.', 'a step on the moon.', 'an unforgettable journey.'], 'correct' => 0],
            ['question' => 'Who wrote "Hamlet"?', 'answers' => ['Charles Dickens', 'William Shakespeare', 'Leo Tolstoy'], 'correct' => 1],
            ['question' => 'What is the capital of Japan?', 'answers' => ['Seoul', 'Beijing', 'Tokyo'], 'correct' => 2],
            ['question' => 'Which element is He on the periodic table?', 'answers' => ['Helium', 'Hydrogen', 'Hafnium'], 'correct' => 0],
            ['question' => 'What year did the first man land on the moon?', 'answers' => ['1969', '1972', '1958'], 'correct' => 0],
            ['question' => 'Who painted the Last Supper?', 'answers' => ['Michelangelo', 'Raphael', 'Leonardo da Vinci'], 'correct' => 2],
            ['question' => 'What is the largest ocean on Earth?', 'answers' => ['Atlantic Ocean', 'Indian Ocean', 'Pacific Ocean'], 'correct' => 2],
            ['question' => 'Who is the author of "1984"?', 'answers' => ['George Orwell', 'Aldous Huxley', 'Ray Bradbury'], 'correct' => 0],
            ['question' => 'Where are the Pyramids of Giza?', 'answers' => ['Mexico', 'Egypt', 'Peru'], 'correct' => 1],
            ['question' => 'What is the hardest natural substance on Earth?', 'answers' => ['Gold', 'Diamond', 'Quartz'], 'correct' => 1],
            ['question' => 'Who discovered penicillin?', 'answers' => ['Marie Curie', 'Alexander Fleming', 'Louis Pasteur'], 'correct' => 1],
        ];

        foreach ($questionsYesNo as $q) {
            DB::table('questions')->insert([
                'question' => $q['question'],
                'answers' => json_encode($q['answers']),
                'correct_answer' => $q['correct'],
                'quiz_mode_id' => 1,
            ]);
        }

        foreach ($questionsMultiple as $q) {
            DB::table('questions')->insert([
                'question' => $q['question'],
                'answers' => json_encode($q['answers']),
                'correct_answer' => $q['correct'],
                'quiz_mode_id' => 2,
            ]);
        }
    }
}
