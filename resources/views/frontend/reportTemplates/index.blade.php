@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('report_template_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.report-templates.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.reportTemplate.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.reportTemplate.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ReportTemplate">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.remarks') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.reportTemplate.fields.user') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportTemplates as $key => $reportTemplate)
                                    <tr data-entry-id="{{ $reportTemplate->id }}">
                                        <td>
                                            {{ $reportTemplate->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $reportTemplate->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\ReportTemplate::TYPE_SELECT[$reportTemplate->type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\ReportTemplate::STATUS_SELECT[$reportTemplate->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $reportTemplate->remarks ?? '' }}
                                        </td>
                                        <td>
                                            {{ $reportTemplate->user->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('report_template_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.report-templates.show', $reportTemplate->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('report_template_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.report-templates.edit', $reportTemplate->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('report_template_delete')
                                                <form action="{{ route('frontend.report-templates.destroy', $reportTemplate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('report_template_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.report-templates.massDestroy') }}",
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
  let table = $('.datatable-ReportTemplate:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection