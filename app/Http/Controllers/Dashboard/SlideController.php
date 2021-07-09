<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Dashboard\Slide;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSlide;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::latest()->paginate();

        return view('dashboard.slides.index', [
            'slides' => $slides
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateSlide  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSlide $request)
    {
        $data = $request->only(['title', 'description', 'slug', 'image', 'new_tab']);

        if($request->hasFile('image') && $request->image->isValid()) {
            $data['image_path'] = $request->image->store("slides");
        }

        Slide::create($data);

        return redirect()
            ->route('adm.slides.index')
            ->with('success', 'Slide criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! $slide = Slide::find($id)) {
            return redirect()
                ->route('adm.slides.index')
                ->withErrors('Slide não encontrado');
        }

        return view('dashboard.slides.show', [
            'slide' => $slide
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
        if(! $slide = Slide::find($id)) {
            return redirect()
                ->route('adm.slides.index')
                ->withErrors('Slide não encontrado');
        }

        return view('dashboard.slides.edit', [
            'slide' => $slide
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateSlide  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSlide $request, $id)
    {
        if(! $slide = Slide::find($id)) {
            return redirect()
                ->route('adm.slides.index')
                ->withErrors('Slide não encontrado');
        }

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid()) {

            if(Storage::exists($slide->image_path)) {
                Storage::delete($slide->image_path);
            }

            $data['image_path'] = $request->image->store("slides");
        }

        $slide->update($data);

        return redirect()
            ->route('adm.slides.index')
            ->with('success', 'Slide editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! $slide = Slide::find($id)) {
            return redirect()
                ->route('adm.slides.index')
                ->withErrors('Slide não encontrado');
        }

        if(Storage::exists($slide->image_path)) {
            Storage::delete($slide->image_path);
        }

        $slide->delete();

        return redirect()
            ->route('adm.slides.index')
            ->with('success', 'Slide deletado com sucesso!');
    }

    /**
     * Display a listing of the filtered resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $filteredSlides = Slide::search($request->filter);

        return view('dashboard.slides.index', [
            'slides' => $filteredSlides,
            'filters' => $filters
        ]);
    }
}
