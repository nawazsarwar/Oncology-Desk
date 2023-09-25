@extends('layouts.admin')
@section('content')
@can('report_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.reports.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Report">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.reports.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.reports.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'appointment_start_time', name: 'appointment.start_time' },
{ data: 'summary', name: 'summary' },
{ data: 'status_title', name: 'status.title' },
{ data: 'template_title', name: 'template.title' },
{ data: 'special', name: 'special' },
{ data: 'evolving', name: 'evolving' },
{ data: 'allotted_to_name', name: 'allotted_to.name' },
{ data: 'finalized_by_name', name: 'finalized_by.name' },
{ data: 'approved_by_name', name: 'approved_by.name' },
{ data: 'tags', name: 'tags.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Report').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection