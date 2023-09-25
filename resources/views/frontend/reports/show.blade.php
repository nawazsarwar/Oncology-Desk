@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.report.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.reports.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $report->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.appointment') }}
                                    </th>
                                    <td>
                                        {{ $report->appointment->start_time ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.text') }}
                                    </th>
                                    <td>
                                        {!! $report->text !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.summary') }}
                                    </th>
                                    <td>
                                        {{ $report->summary }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $report->status->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $report->template->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.special') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Report::SPECIAL_RADIO[$report->special] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.evolving') }}
                                    </th>
                                    <td>
                                        {{ $report->evolving }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.allotted_to') }}
                                    </th>
                                    <td>
                                        {{ $report->allotted_to->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.finalized_by') }}
                                    </th>
                                    <td>
                                        {{ $report->finalized_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.approved_by') }}
                                    </th>
                                    <td>
                                        {{ $report->approved_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.tags') }}
                                    </th>
                                    <td>
                                        @foreach($report->tags as $key => $tags)
                                            <span class="label label-info">{{ $tags->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.reports.index') }}">
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