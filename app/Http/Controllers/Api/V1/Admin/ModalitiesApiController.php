<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreModalityRequest;
use App\Http\Requests\UpdateModalityRequest;
use App\Http\Resources\Admin\ModalityResource;
use App\Models\Modality;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModalitiesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('modality_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModalityResource(Modality::with(['facility'])->get());
    }

    public function store(StoreModalityRequest $request)
    {
        $modality = Modality::create($request->all());

        if ($request->input('icon', false)) {
            $modality->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        return (new ModalityResource($modality))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Modality $modality)
    {
        abort_if(Gate::denies('modality_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModalityResource($modality->load(['facility']));
    }

    public function update(UpdateModalityRequest $request, Modality $modality)
    {
        $modality->update($request->all());

        if ($request->input('icon', false)) {
            if (! $modality->icon || $request->input('icon') !== $modality->icon->file_name) {
                if ($modality->icon) {
                    $modality->icon->delete();
                }
                $modality->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($modality->icon) {
            $modality->icon->delete();
        }

        return (new ModalityResource($modality))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Modality $modality)
    {
        abort_if(Gate::denies('modality_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modality->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
