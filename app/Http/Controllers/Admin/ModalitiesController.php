<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ModalitiesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('modality_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Modality::with(['facility'])->select(sprintf('%s.*', (new Modality)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'modality_show';
                $editGate      = 'modality_edit';
                $deleteGate    = 'modality_delete';
                $crudRoutePart = 'modalities';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('icon', function ($row) {
                if ($photo = $row->icon) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('facility_name', function ($row) {
                return $row->facility ? $row->facility->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Modality::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'icon', 'facility']);

            return $table->make(true);
        }

        return view('admin.modalities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('modality_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.modalities.create', compact('facilities'));
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

        return redirect()->route('admin.modalities.index');
    }

    public function edit(Modality $modality)
    {
        abort_if(Gate::denies('modality_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modality->load('facility');

        return view('admin.modalities.edit', compact('facilities', 'modality'));
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

        return redirect()->route('admin.modalities.index');
    }

    public function show(Modality $modality)
    {
        abort_if(Gate::denies('modality_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modality->load('facility');

        return view('admin.modalities.show', compact('modality'));
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
