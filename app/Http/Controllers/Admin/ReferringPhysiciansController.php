<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReferringPhysicianRequest;
use App\Http\Requests\StoreReferringPhysicianRequest;
use App\Http\Requests\UpdateReferringPhysicianRequest;
use App\Models\ReferringPhysician;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReferringPhysiciansController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('referring_physician_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ReferringPhysician::query()->select(sprintf('%s.*', (new ReferringPhysician)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'referring_physician_show';
                $editGate      = 'referring_physician_edit';
                $deleteGate    = 'referring_physician_delete';
                $crudRoutePart = 'referring-physicians';

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
            $table->editColumn('gender', function ($row) {
                return $row->gender ? ReferringPhysician::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('mobile_no', function ($row) {
                return $row->mobile_no ? $row->mobile_no : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('department', function ($row) {
                return $row->department ? $row->department : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.referringPhysicians.index');
    }

    public function create()
    {
        abort_if(Gate::denies('referring_physician_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referringPhysicians.create');
    }

    public function store(StoreReferringPhysicianRequest $request)
    {
        $referringPhysician = ReferringPhysician::create($request->all());

        return redirect()->route('admin.referring-physicians.index');
    }

    public function edit(ReferringPhysician $referringPhysician)
    {
        abort_if(Gate::denies('referring_physician_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referringPhysicians.edit', compact('referringPhysician'));
    }

    public function update(UpdateReferringPhysicianRequest $request, ReferringPhysician $referringPhysician)
    {
        $referringPhysician->update($request->all());

        return redirect()->route('admin.referring-physicians.index');
    }

    public function show(ReferringPhysician $referringPhysician)
    {
        abort_if(Gate::denies('referring_physician_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referringPhysicians.show', compact('referringPhysician'));
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
