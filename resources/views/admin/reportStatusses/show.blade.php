@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reportStatuss.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.report-statusses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reportStatuss.fields.id') }}
                        </th>
                        <td>
                            {{ $reportStatuss->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reportStatuss.fields.title') }}
                        </th>
                        <td>
                            {{ $reportStatuss->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reportStatuss.fields.color') }}
                        </th>
                        <td>
                            {{ $reportStatuss->color }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.report-statusses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection