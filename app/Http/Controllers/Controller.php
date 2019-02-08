<?php

namespace App\Http\Controllers;

use App\LearnedWord;
use App\LearnedLesson;
use App\Category;
use App\User;
use App\Word;
use App\Relationship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user_dashboard_view()
    {
        $id = Auth::id();
        $user_model = new User();
        $user_name = $user_model->user_name($id);
        $user_avatar = $user_model->user_avatar($id);

        $learnedlesson_model = new LearnedLesson();
        $learned_lesson_number = $learnedlesson_model->learned_lesson_number($id);

        $learnedword_model = new LearnedWord();
        $learned_words_number = $learnedword_model->learned_words_number($id);

        $relationship_model = new Relationship();
        $relationship_activities = $relationship_model->activities();

        $lesson_model = new LearnedLesson();
        $lesson_activities = $lesson_model->activities();

        $user_activities = collect();
        $user_activities = $user_activities->concat($relationship_activities)->concat($lesson_activities)->sortByDesc('updated_at');

        return view('/user/dashboard', compact('user_name', 'learned_lesson_number', 'learned_words_number', 'user_avatar', 'user_activities'));
    }

    public function user_learned_words_list_view($id)
    {
        $user_model = new User();
        $user_name = $user_model->user_name($id);
        $user_avatar = $user_model->user_avatar($id);

        $lesson_model = new LearnedLesson();
        $learned_lesson_number = $lesson_model->learned_lesson_number($id);

        $learnedword_model = new LearnedWord();
        $learned_words_number = $learnedword_model->learned_words_number($id);
        $learned_words_id = $learnedword_model->learned_words_id($id);

        $word_model = new Word();
        $learned_words = $word_model->learned_words($learned_words_id);

        return view('/user/learnedwordslist', compact('user_name', 'user_avatar', 'learned_words_number', 'learned_words', 'learned_lesson_number', 'id'));
    }

    public function profile_view($id)
    {
        $user_data = User::where('id', $id)->first()->only(['name', 'avatar_url', 'id']);
        $relationship_model = new Relationship();
        $learnedlesson_model = new LearnedLesson();
        $followed_number = $relationship_model->number_of_followed($id);
        $follower_number = $relationship_model->number_of_follower($id);
        $followed_activities = $relationship_model->user_activities($id);
        $lesson_activities = $learnedlesson_model->user_activities($id);

        $followed_exists = $relationship_model->followed_exists($id);
        if ($id == Auth::id()) {
            $followed_exists = 2;
        }

        $learnedword_model = new LearnedWord();
        $learned_words_number = $learnedword_model->learned_words_number($id);

        $user_activities = collect();
        $user_activities = $user_activities->concat($followed_activities)->concat($lesson_activities)->sortByDesc('updated_at');

        return view('/user/profile', compact('user_data', 'followed_number', 'follower_number', 'user_activities', 'followed_exists', 'learned_words_number'));
    }

    public function following_store($following_id)
    {
        $relationship_model = new Relationship();
        $relationship_model->store($following_id);

        return redirect('/user/profile/'.$following_id);
    }

    public function followed_destroy($followed_id)
    {
        $relationship_model = new Relationship();
        $relationship_model->followed_destroy($followed_id);

        return redirect('/user/profile/'.$followed_id);
    }

    public function categories_view()
    {
        $category_model = new Category();
        $categories = $category_model->index();

        return view('user/categorieslist', compact('categories'));
    }

    public function lesson_view($category_id)
    {
        $learnedlesson_model = new LearnedLesson();
        $progress_number = $learnedlesson_model->get_progress_number($category_id);

        $word_model = new Word();
        $number_of_lesson_words = $word_model->get_number_of_lesson_words($category_id);

        $category_model = new Category();
        $category_data = $category_model->category_data($category_id);

        if ($progress_number >= $number_of_lesson_words) {
            return redirect('user/result/'.$category_id);
        }

        $lesson_word = $word_model->get_lesson_words($category_id, $progress_number);
        $choices = [
            $lesson_word->answer,
            $lesson_word->wrong_answer_1,
            $lesson_word->wrong_answer_2,
            $lesson_word->wrong_answer_3,
        ];

        shuffle($choices);

        $number_of_lesson_words = $word_model->get_number_of_lesson_words($category_id);

        return view('/user/lesson', compact('progress_number', 'category_data', 'lesson_word', 'number_of_lesson_words', 'choices'));
    }

    public function lesson_check($category_id)
    {
        $choiced = request('choiced');
        $word_id = request('word_id');

        $word_model = new Word();
        $lesson_word = $word_model->get_word_by_id($word_id);
        if ($lesson_word->answer == $choiced) {
            $learnedword_model = new LearnedWord();
            $learnedword_model->store($word_id);
        }

        $learnedlesson_model = new LearnedLesson();
        $learnedlesson_model->increment_progress_number($category_id);

        return redirect('/user/lesson/'.$category_id);
    }

    public function result_view($category_id)
    {
        $word_model = new Word();
        $learnedlesson_model = new LearnedLesson();

        $max_number_of_lesson_words = $word_model->get_number_of_lesson_words($category_id);
        $progress_number = $learnedlesson_model->get_progress_number($category_id);

        if ($progress_number >= $max_number_of_lesson_words) {
            $category_model = new Category();
            $learnedword_model = new LearnedWord();
            $learned_words = $learnedword_model->learned_words_id(Auth::id());
            $learned_words_number = $learnedword_model->learned_words_number($category_id);
            $category_words = $word_model->all_lesson_words($category_id);

            foreach ($category_words as $category_word) {
                foreach ($learned_words as $learned_word) {
                    if ($category_word->id == $learned_word->word_id) {
                        $category_word->mark = true;
                    }
                }
            }
            $category_data = $category_model->category_data($category_id);

            return view('/user/result', compact('max_number_of_lesson_words', 'category_data', 'category_words', 'learned_words_number'));
        }

        return redirect('/user/categorieslist');
    }
}

