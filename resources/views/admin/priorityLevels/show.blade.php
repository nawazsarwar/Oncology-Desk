@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.priorityLevel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.priority-levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.priorityLevel.fields.id') }}
                        </th>
                        <td>
                            {{ $priorityLevel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priorityLevel.fields.title') }}
                        </th>
                        <td>
                            {{ $priorityLevel->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priorityLevel.fields.turnaround_time') }}
                        </th>
                        <td>
                            {{ $priorityLevel->turnaround_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priorityLevel.fields.color') }}
                        </th>
                        <td>
                            {{ $priorityLevel->color }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.priority-levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection