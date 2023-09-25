@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('priority_level_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.priority-levels.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.priorityLevel.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'PriorityLevel', 'route' => 'admin.priority-levels.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.priorityLevel.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PriorityLevel">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.priorityLevel.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.priorityLevel.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.priorityLevel.fields.turnaround_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.priorityLevel.fields.color') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($priorityLevels as $key => $priorityLevel)
                                    <tr data-entry-id="{{ $priorityLevel->id }}">
                                        <td>
                                            {{ $priorityLevel->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $priorityLevel->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $priorityLevel->turnaround_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $priorityLevel->color ?? '' }}
                                        </td>
                                        <td>
                                            @can('priority_level_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.priority-levels.show', $priorityLevel->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('priority_level_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.priority-levels.edit', $priorityLevel->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('priority_level_delete')
                                                <form action="{{ route('frontend.priority-levels.destroy', $priorityLevel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('priority_level_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.priority-levels.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-PriorityLevel:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection