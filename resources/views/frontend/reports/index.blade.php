@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('report_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.reports.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.report.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.report.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Report">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.report.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.appointment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.summary') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.template') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.special') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.evolving') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.allotted_to') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.finalized_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.approved_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.report.fields.tags') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $key => $report)
                                    <tr data-entry-id="{{ $report->id }}">
                                        <td>
                                            {{ $report->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->appointment->start_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->summary ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->status->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->template->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Report::SPECIAL_RADIO[$report->special] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->evolving ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->allotted_to->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->finalized_by->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $report->approved_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($report->tags as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('report_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.reports.show', $report->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('report_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.reports.edit', $report->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('report_delete')
                                                <form action="{{ route('frontend.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.reports.massDestroy') }}",
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
  let table = $('.datatable-Report:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection