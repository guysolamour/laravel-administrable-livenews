<?php

namespace Guysolamour\Administrable\Extensions\Livenews\Http\Controllers\Back;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class LivenewsController extends BaseController
{
    use FormBuilderTrait;

    public function index()
    {
        $livenews = config('administrable-livenews.models.livenews')::latest()->get();

        return view('administrable-livenews::' . Str::lower(config('administrable.back_namespace')) . '.livenews.index', compact('livenews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(new (config('administrable-livenews.models.livenews')), config('administrable-livenews.forms.back.livenews'));

        return view('administrable-livenews::' . Str::lower(config('administrable.back_namespace')) . '.livenews.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(new (config('administrable-livenews.models.livenews')), config('administrable-livenews.forms.back.livenews'));

        $form->redirectIfNotValid();

        config('administrable-livenews.models.livenews')::create($request->all());

        flashy(Lang::get('administrable-livenews::translations.controller.create'));

        return redirect_backroute('extensions.livenews.livenews.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $livenews = config('administrable-livenews.models.livenews')::where('id', $id)->firstOrFail();

        $form = $this->getForm($livenews, config('administrable-livenews.forms.back.livenews'));

        return view('administrable-livenews::' . Str::lower(config('administrable.back_namespace')) . '.livenews.edit', compact('livenews', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $livenews = config('administrable-livenews.models.livenews')::where('id', $id)->firstOrFail();

        $form = $this->getForm($livenews, config('administrable-livenews.forms.back.livenews'));
        $form->redirectIfNotValid();

        $livenews->update($request->all());

        flashy(Lang::get('administrable-livenews::translations.controller.update'));

        return redirect_backroute('extensions.livenews.livenews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $livenews = config('administrable-livenews.models.livenews')::where('id', $id)->firstOrFail();

        $livenews->delete();

        flashy(Lang::get('administrable-livenews::translations.controller.delete'));

        return redirect_backroute('extensions.livenews.livenews.index');
    }
}
