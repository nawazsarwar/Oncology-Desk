@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('study_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.studies.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.study.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.study.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Study">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.study.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.modality') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.fee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.maximum_slots') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.time_per_slot') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.films') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.weightage') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.facility') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.study.fields.remarks') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studies as $key => $study)
                                    <tr data-entry-id="{{ $study->id }}">
                                        <td>
                                            {{ $study->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->modality->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->fee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->maximum_slots ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->time_per_slot ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->films ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->weightage ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->facility->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Study::STATUS_SELECT[$study->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $study->remarks ?? '' }}
                                        </td>
                                        <td>
                                            @can('study_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.studies.show', $study->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('study_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.studies.edit', $study->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('study_delete')
                                                <form action="{{ route('frontend.studies.destroy', $study->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('study_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.studies.massDestroy') }}",
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
  let table = $('.datatable-Study:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection