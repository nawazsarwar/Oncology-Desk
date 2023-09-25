<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOccupationRequest;
use App\Http\Requests\UpdateOccupationRequest;
use App\Http\Resources\Admin\OccupationResource;
use App\Models\Occupation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OccupationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('occupation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OccupationResource(Occupation::all());
    }

    public function store(StoreOccupationRequest $request)
    {
        $occupation = Occupation::create($request->all());

        return (new OccupationResource($occupation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Occupation $occupation)
    {
        abort_if(Gate::denies('occupation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OccupationResource($occupation);
    }

    public function update(UpdateOccupationRequest $request, Occupation $occupation)
    {
        $occupation->update($request->all());

        return (new OccupationResource($occupation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Occupation $occupation)
    {
        abort_if(Gate::denies('occupation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $occupation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
