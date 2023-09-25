<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReferringPhysicianRequest;
use App\Http\Requests\StoreReferringPhysicianRequest;
use App\Http\Requests\UpdateReferringPhysicianRequest;
use App\Models\ReferringPhysician;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReferringPhysiciansController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('referring_physician_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referringPhysicians = ReferringPhysician::all();

        return view('frontend.referringPhysicians.index', compact('referringPhysicians'));
    }

    public function create()
    {
        abort_if(Gate::denies('referring_physician_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.referringPhysicians.create');
    }

    public function store(StoreReferringPhysicianRequest $request)
    {
        $referringPhysician = ReferringPhysician::create($request->all());

        return redirect()->route('frontend.referring-physicians.index');
    }

    public function edit(ReferringPhysician $referringPhysician)
    {
        abort_if(Gate::denies('referring_physician_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.referringPhysicians.edit', compact('referringPhysician'));
    }

    public function update(UpdateReferringPhysicianRequest $request, ReferringPhysician $referringPhysician)
    {
        $referringPhysician->update($request->all());

        return redirect()->route('frontend.referring-physicians.index');
    }

    public function show(ReferringPhysician $referringPhysician)
    {
        abort_if(Gate::denies('referring_physician_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.referringPhysicians.show', compact('referringPhysician'));
    }

    public function destroy(ReferringPhysician $referringPhysician)
    {
        abort_if(Gate::denies('referring_physician_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referringPhysician->delete();

        return back();
    }

    public function massDestroy(MassDestroyReferringPhysicianRequest $request)
    {
        $referringPhysicians = ReferringPhysician::find(request('ids'));

        foreach ($referringPhysicians as $referringPhysician) {
            $referringPhysician->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
