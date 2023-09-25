@extends('layouts.admin')
@section('content')
@can('patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.patients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.patient.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.patient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Patient">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.registration_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.uhid_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.mobile_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.patient_age_in_years') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.patient_category') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.district') }}
                    </th>
                    <th>
                        {{ trans('cruds.patient.fields.referred_by') }}
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
@can('patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.patients.massDestroy') }}",
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
    ajax: "{{ route('admin.patients.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'registration_date', name: 'registration_date' },
{ data: 'uhid_number', name: 'uhid_number' },
{ data: 'mobile_number', name: 'mobile_number' },
{ data: 'first_name', name: 'first_name' },
{ data: 'gender', name: 'gender' },
{ data: 'patient_age_in_years', name: 'patient_age_in_years' },
{ data: 'patient_category_title', name: 'patient_category.title' },
{ data: 'district_district', name: 'district.district' },
{ data: 'referred_by_name', name: 'referred_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Patient').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection