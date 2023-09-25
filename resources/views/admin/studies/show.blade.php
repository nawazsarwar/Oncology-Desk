@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.study.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.studies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.id') }}
                        </th>
                        <td>
                            {{ $study->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.modality') }}
                        </th>
                        <td>
                            {{ $study->modality->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.type') }}
                        </th>
                        <td>
                            {{ $study->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.name') }}
                        </th>
                        <td>
                            {{ $study->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.fee') }}
                        </th>
                        <td>
                            {{ $study->fee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.maximum_slots') }}
                        </th>
                        <td>
                            {{ $study->maximum_slots }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.time_per_slot') }}
                        </th>
                        <td>
                            {{ $study->time_per_slot }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.films') }}
                        </th>
                        <td>
                            {{ $study->films }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.weightage') }}
                        </th>
                        <td>
                            {{ $study->weightage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.facility') }}
                        </th>
                        <td>
                            {{ $study->facility->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Study::STATUS_SELECT[$study->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.study.fields.remarks') }}
                        </th>
                        <td>
                            {{ $study->remarks }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.studies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection