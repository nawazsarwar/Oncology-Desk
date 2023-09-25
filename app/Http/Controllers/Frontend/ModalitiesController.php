<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyModalityRequest;
use App\Http\Requests\StoreModalityRequest;
use App\Http\Requests\UpdateModalityRequest;
use App\Models\Facility;
use App\Models\Modality;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ModalitiesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('modality_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::with(['facility', 'media'])->get();

        return view('frontend.modalities.index', compact('modalities'));
    }

    public function create()
    {
        abort_if(Gate::denies('modality_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.modalities.create', compact('facilities'));
    }

    public function store(StoreModalityRequest $request)
    {
        $modality = Modality::create($request->all());

        if ($request->input('icon', false)) {
            $modality->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $modality->id]);
        }

        return redirect()->route('frontend.modalities.index');
    }

    public function edit(Modality $modality)
    {
        abort_if(Gate::denies('modality_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modality->load('facility');

        return view('frontend.modalities.edit', compact('facilities', 'modality'));
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

        return redirect()->route('frontend.modalities.index');
    }

    public function show(Modality $modality)
    {
        abort_if(Gate::denies('modality_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modality->load('facility');

        return view('frontend.modalities.show', compact('modality'));
    }

    public function destroy(Modality $modality)
    {
        abort_if(Gate::denies('modality_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modality->delete();

        return back();
    }

    public function massDestroy(MassDestroyModalityRequest $request)
    {
        $modalities = Modality::find(request('ids'));

        foreach ($modalities as $modality) {
            $modality->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('modality_create') && Gate::denies('modality_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Modality();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
