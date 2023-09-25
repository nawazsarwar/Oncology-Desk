@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.referringPhysician.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.referring-physicians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.referringPhysician.fields.id') }}
                        </th>
                        <td>
                            {{ $referringPhysician->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referringPhysician.fields.name') }}
                        </th>
                        <td>
                            {{ $referringPhysician->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referringPhysician.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\ReferringPhysician::GENDER_SELECT[$referringPhysician->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referringPhysician.fields.mobile_no') }}
                        </th>
                        <td>
                            {{ $referringPhysician->mobile_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referringPhysician.fields.email') }}
                        </th>
                        <td>
                            {{ $referringPhysician->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referringPhysician.fields.department') }}
                        </th>
                        <td>
                            {{ $referringPhysician->department }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referringPhysician.fields.address') }}
                        </th>
                        <td>
                            {{ $referringPhysician->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.referring-physicians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection