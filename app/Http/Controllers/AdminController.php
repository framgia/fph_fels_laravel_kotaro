<?php

namespace App\Http\Controllers;

use App\Word;
use App\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function categoriesView($pageNumber)
    {
        $pageNumber < 0 ? $pageNumber = 1 : '';
        $categories = app(Category::class)->orderBy('updated_at', 'desc')->skip(10 * ($pageNumber - 1))->take(10)->get();
        return view('/admin/categories', compact('categories', 'pageNumber'));
    }

    public function categoryEdit($categoryId)
    {
        $category = app(Category::class)::find($categoryId);
        return view('/admin/categoryEdit', compact('category'));
    }

    public function categoryRestore($categoryId, Request $request)
    {
        $request->validate([
            'title' => 'required | max:50',
            'description' => 'required',
        ]);
        app(Category::class)::find($categoryId)->fill($request->all())->update();
        return $this->categoriesView(1);
    }

    public function categoryDestroy($categoryId)
    {
        $category = app(Category::class)::find($categoryId);
        return view('/admin/categoryDelete', compact('category'));
    }

    public function categoryDelete($categoryId)
    {
        app(Category::class)::find($categoryId)->delete();
        return $this->categoriesView(1);
    }

    public function addWord($categoryId)
    {
        return view('/admin/addWord', compact('categoryId'));
    }

    public function addWordStore($categoryId, Request $request)
    {
        if (Category::find($categoryId) == null) {
            return $this->categoriesView(1);
        }
        $request->validate([
            'word' => 'required | max:50', 'answer' => 'required | in:choice1,choice2,choice3,choice4',
            'choice1' => 'required | max:50', 'choice2' => 'required | max:50',
            'choice3' => 'required | max:50', 'choice4' => 'required | max:50',
        ]);
        $n = 1;
        $newWord = new Word;
        $newWord->word = $request->word;
        $newWord->category_id = $categoryId;
        for ($i = 1; $i < 5; $i++) {
            $choicei = 'choice' . $i;
            $wrong_answer_n = "wrong_answer_" . $n;
            if ($request->answer == $choicei) {
                $newWord->answer = $request->$choicei;
            } else {
                $newWord->$wrong_answer_n = $request->$choicei;
                $n++;
            }
        }
        $newWord->save();
        return back();
    }
}
