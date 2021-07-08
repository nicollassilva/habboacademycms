<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Dashboard\ArticleCategory;
use App\Http\Requests\StoreUpdateArticleCategory;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ArticleCategory::latest('id')->paginate(30);

        return view('dashboard.articles.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.articles.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateArticleCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateArticleCategory $request)
    {
        $data = $request->all();

        if($request->hasFile('icon') && $request->icon->isValid()) {
            $data['icon'] = $request->icon->store("articles/categories");
        }

        ArticleCategory::create($data);

        return redirect()
            ->route('articles.categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! $category = ArticleCategory::find($id)) {
            return redirect()
                ->route('articles.categories.index')
                ->withErrors('Categoria não encontrada');
        }

        return view('dashboard.articles.categories.show', [
            'category' => $category
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
        if(! $category = ArticleCategory::find($id)) {
            return redirect()
                ->route('articles.categories.index')
                ->withErrors('Categoria não encontrada');
        }

        return view('dashboard.articles.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateArticleCategory  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateArticleCategory $request, $id)
    {
        if(! $category = ArticleCategory::find($id)) {
            return redirect()
                ->route('articles.categories.index')
                ->withErrors('Categoria não encontrada');
        }

        $data = $request->all();

        if($request->hasFile('icon') && $request->icon->isValid()) {

            if(Storage::exists($category->icon)) {
                Storage::delete($category->icon);
            }

            $data['icon'] = $request->icon->store("articles/categories");
        }

        $category->update($data);

        return redirect()
            ->route('articles.categories.index')
            ->with('success', 'Categoria editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! $category = ArticleCategory::find($id)) {
            return redirect()
                ->route('articles.index')
                ->withErrors('Categoria não encontrada');
        }

        if($category->articles->count() > 0) {
            return redirect()
                ->route('articles.categories.show', $category->id)
                ->withErrors('Categoria não pôde ser excluída pois existem notícias que dependem dela.');
        }

        if(Storage::exists($category->icon)) {
            Storage::delete($category->icon);
        }

        $category->delete();

        return redirect()
            ->route('articles.categories.index')
            ->with('success', 'Categoria deletada com sucesso!');
    }
}
