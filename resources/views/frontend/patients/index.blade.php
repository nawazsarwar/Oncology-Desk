@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('patient_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.patients.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Patient">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($patients as $key => $patient)
                                    <tr data-entry-id="{{ $patient->id }}">
                                        <td>
                                            {{ $patient->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->registration_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->uhid_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->mobile_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Patient::GENDER_SELECT[$patient->gender] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->patient_age_in_years ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->patient_category->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->district->district ?? '' }}
                                        </td>
                                        <td>
                                            {{ $patient->referred_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('patient_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.patients.show', $patient->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('patient_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.patients.edit', $patient->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('patient_delete')
                                                <form action="{{ route('frontend.patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.patients.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Patient:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection