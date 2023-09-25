@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.modality.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.modalities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $modality->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $modality->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.code') }}
                                    </th>
                                    <td>
                                        {{ $modality->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.icon') }}
                                    </th>
                                    <td>
                                        @if($modality->icon)
                                            <a href="{{ $modality->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $modality->icon->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.facility') }}
                                    </th>
                                    <td>
                                        {{ $modality->facility->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Modality::STATUS_SELECT[$modality->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.remarks') }}
                                    </th>
                                    <td>
                                        {{ $modality->remarks }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.modalities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection