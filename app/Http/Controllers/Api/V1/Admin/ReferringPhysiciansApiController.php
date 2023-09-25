<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReferringPhysicianRequest;
use App\Http\Requests\UpdateReferringPhysicianRequest;
use App\Http\Resources\Admin\ReferringPhysicianResource;
use App\Models\ReferringPhysician;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReferringPhysiciansApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('referring_physician_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReferringPhysicianResource(ReferringPhysician::all());
    }

    public function store(StoreReferringPhysicianRequest $request)
    {
        $referringPhysician = ReferringPhysician::create($request->all());

        return (new ReferringPhysicianResource($referringPhysician))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ReferringPhysician $referringPhysician)
    {
        abort_if(Gate::denies('referring_physician_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReferringPhysicianResource($referringPhysician);
    }

    public function update(UpdateReferringPhysicianRequest $request, ReferringPhysician $referringPhysician)
    {
        $referringPhysician->update($request->all());

        return (new ReferringPhysicianResource($referringPhysician))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ReferringPhysician $referringPhysician)
    {
        abort_if(Gate::denies('referring_physician_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referringPhysician->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
