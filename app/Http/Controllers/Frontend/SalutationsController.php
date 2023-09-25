<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySalutationRequest;
use App\Http\Requests\StoreSalutationRequest;
use App\Http\Requests\UpdateSalutationRequest;
use App\Models\Salutation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalutationsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('salutation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salutations = Salutation::all();

        return view('frontend.salutations.index', compact('salutations'));
    }

    public function create()
    {
        abort_if(Gate::denies('salutation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.salutations.create');
    }

    public function store(StoreSalutationRequest $request)
    {
        $salutation = Salutation::create($request->all());

        return redirect()->route('frontend.salutations.index');
    }

    public function edit(Salutation $salutation)
    {
        abort_if(Gate::denies('salutation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.salutations.edit', compact('salutation'));
    }

    public function update(UpdateSalutationRequest $request, Salutation $salutation)
    {
        $salutation->update($request->all());

        return redirect()->route('frontend.salutations.index');
    }

    public function show(Salutation $salutation)
    {
        abort_if(Gate::denies('salutation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.salutations.show', compact('salutation'));
    }

    public function destroy(Salutation $salutation)
    {
        abort_if(Gate::denies('salutation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salutation->delete();

        return back();
    }

    public function massDestroy(MassDestroySalutationRequest $request)
    {
        $salutations = Salutation::find(request('ids'));

        foreach ($salutations as $salutation) {
            $salutation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
