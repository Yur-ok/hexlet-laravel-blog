<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = Article::paginate(4);
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validate(
            $request,
            [
                'title' => 'required|unique:articles',
                'body' => 'required|min:10',
            ]
        );

        $article = new Article();
        $article->fill($data);
        $article->save();

        return redirect()
            ->route('articles.index')
            ->with('status', 'Article was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     * @return View
     */
    public function show(Article $article): View
    {
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validate(
            $request,
            [
                'title' => 'required|unique:articles, name, ' . $article->id,
                'body' => 'required|min:100',
            ]
        );
        $article->fill($data);
        $article->save();

        return redirect()
            ->route('articles.update', compact('article'))
            ->with('status', 'Article is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article = Article::findOrFail($article);
        if ($article) {
            $article->delete();

            return redirect()
                ->route('articles.index')
                ->with('status', 'Article was deleted');
        }
    }
}
