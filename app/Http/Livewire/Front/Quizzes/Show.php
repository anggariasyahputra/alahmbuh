<?php

namespace App\Http\Livewire\Front\Quizzes;

use App\Models\Question;
use App\Models\Option;
use App\Models\Quiz;
use App\Models\Test;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Show extends Component
{
    public Quiz $quiz;
    public Collection $questions;
    public Question $currentQuestion;
    public int $currentQuestionIndex = 0;
    public array $answersOfQuestions = [];
    public int $startTimeInSeconds = 0;
    public bool $alreadyAttempted = false;

    public function mount()
    {
        $userId = auth()->id();

        // Check if the user has already attempted this quiz using direct DB query
        $this->alreadyAttempted = DB::table('quiz_user')
            ->where('user_id', $userId)
            ->where('quiz_id', $this->quiz->id)
            ->exists();

        if ($this->alreadyAttempted) {
            return;
        }

        $this->startTimeInSeconds = now()->timestamp;

        $this->questions = Question::query()
            ->inRandomOrder()
            ->whereRelation('quizzes', 'id', $this->quiz->id)
            ->with('options')
            ->get();

        if ($this->questions->count() > 0) {
            $this->currentQuestion = $this->questions[$this->currentQuestionIndex];

            for ($questionIndex = 0; $questionIndex < $this->questionsCount; $questionIndex++) {
                $this->answersOfQuestions[$questionIndex] = [];
            }
        }
    }

    public function getQuestionsCountProperty(): int
    {
        return $this->questions->count();
    }

    public function nextQuestion()
    {
        $this->currentQuestionIndex++;

        if ($this->currentQuestionIndex == $this->questionsCount) {
            return $this->submit();
        }

        $this->currentQuestion = $this->questions[$this->currentQuestionIndex];
    }

    public function submit()
    {
        $userId = auth()->id();

        // Double check if the user has already attempted this quiz
        if (DB::table('quiz_user')
            ->where('user_id', $userId)
            ->where('quiz_id', $this->quiz->id)
            ->exists()
        ) {
            session()->flash('error', 'Anda sudah mengerjakan quiz ini sebelumnya.');
            return redirect()->route('quizzes.index');
        }

        $result = 0;

        $test = Test::create([
            'user_id' => $userId,
            'quiz_id' => $this->quiz->id,
            'result' => 0,
            'ip_address' => request()->ip(),
            'time_spent' => now()->timestamp - $this->startTimeInSeconds
        ]);

        foreach ($this->answersOfQuestions as $key => $optionId) {
            if (!empty($optionId)) {
                $option = Option::find($optionId);
                if ($option && $option->correct) {
                    $result++;
                    Answer::create([
                        'user_id' => $userId,
                        'test_id' => $test->id,
                        'question_id' => $this->questions[$key]->id,
                        'option_id' => $optionId,
                        'correct' => 1
                    ]);
                } else {
                    Answer::create([
                        'user_id' => $userId,
                        'test_id' => $test->id,
                        'question_id' => $this->questions[$key]->id,
                        'option_id' => $optionId,
                        'correct' => 0
                    ]);
                }
            } else {
                Answer::create([
                    'user_id' => $userId,
                    'test_id' => $test->id,
                    'question_id' => $this->questions[$key]->id,
                    'option_id' => null,
                    'correct' => 0
                ]);
            }
        }

        $test->update([
            'result' => $result
        ]);

        // Record that the user has completed this quiz using direct DB query
        DB::table('quiz_user')->insert([
            'user_id' => $userId,
            'quiz_id' => $this->quiz->id,
            'is_completed' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return to_route('results.show', ['test' => $test]);
    }

    public function render(): View
    {
        if ($this->alreadyAttempted) {
            return view('livewire.front.quizzes.already-attempted', ['quiz' => $this->quiz]);
        }

        return view('livewire.front.quizzes.show');
    }
}
