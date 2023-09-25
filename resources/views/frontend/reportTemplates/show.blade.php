@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.reportTemplate.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.report-templates.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $reportTemplate->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $reportTemplate->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.template') }}
                                    </th>
                                    <td>
                                        {!! $reportTemplate->template !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ReportTemplate::TYPE_SELECT[$reportTemplate->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ReportTemplate::STATUS_SELECT[$reportTemplate->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.remarks') }}
                                    </th>
                                    <td>
                                        {{ $reportTemplate->remarks }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $reportTemplate->user->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.report-templates.index') }}">
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