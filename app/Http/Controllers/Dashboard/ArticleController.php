<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Dashboard\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateArticle;
use App\Models\Dashboard\ArticleCategory;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with(['user', 'category'])->latest()->paginate(30);

        return view('dashboard.articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ArticleCategory::all();

        return view('dashboard.articles.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateArticle  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateArticle $request)
    {
        $data = $request->only(['title', 'description', 'content', 'category']);

        $data['category_id'] = $data['category'];

        if($request->hasFile('image') && $request->image->isValid()) {
            $data['image_path'] = $request->image->store("articles");
        }

        \Auth::user()->articles()->create($data);

        return redirect()
            ->route('adm.articles.index')
            ->with('success', 'Notícia criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! $article = Article::with(['user', 'category'])->find($id)) {
            return redirect()
                ->route('adm.articles.index')
                ->withErrors('Notícia não encontrada');
        }

        return view('dashboard.articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = ArticleCategory::all();

        if(! $article = Article::with('user')->find($id)) {
            return redirect()
                ->route('adm.articles.index')
                ->withErrors('Notícia não encontrada');
        }

        return view('dashboard.articles.edit', [
            'categories' => $categories,
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateArticle  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateArticle $request, $id)
    {
        if(! $article = Article::find($id)) {
            return redirect()
                ->route('adm.articles.index')
                ->withErrors('Notícia não encontrada');
        }

        $data = $request->all();
        $data['category_id'] = $data['category'];

        if($request->hasFile('image') && $request->image->isValid()) {

            if(Storage::exists($article->image_path)) {
                Storage::delete($article->image_path);
            }

            $data['image_path'] = $request->image->store('articles');
        }

        if(!$article->reviewed && !!$request->reviewed) {
            $data['reviewer'] = \Auth::user()->username;
        }

        $article->update($data);

        return redirect()
            ->route('adm.articles.index')
            ->with('success', 'Notícia editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! $article = Article::find($id)) {
            return redirect()
                ->route('adm.articles.index')
                ->withErrors('Notícia não encontrada');
        }

        if(Storage::exists($article->image_path)) {
            Storage::delete($article->image_path);
        }

        $article->delete();

        return redirect()
            ->route('adm.articles.index')
            ->with('success', 'Notícia deletada com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $filteredArticles = Article::search($request->filter);

        return view('dashboard.articles.index', [
            'articles' => $filteredArticles,
            'filters' => $filters
        ]);
    }
}
