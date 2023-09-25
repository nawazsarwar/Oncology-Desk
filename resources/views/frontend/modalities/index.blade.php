@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('modality_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.modalities.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.modality.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.modality.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Modality">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.modality.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.modality.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.modality.fields.icon') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.modality.fields.facility') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.modality.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.modality.fields.remarks') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modalities as $key => $modality)
                                    <tr data-entry-id="{{ $modality->id }}">
                                        <td>
                                            {{ $modality->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $modality->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $modality->code ?? '' }}
                                        </td>
                                        <td>
                                            @if($modality->icon)
                                                <a href="{{ $modality->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $modality->icon->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $modality->facility->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Modality::STATUS_SELECT[$modality->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $modality->remarks ?? '' }}
                                        </td>
                                        <td>
                                            @can('modality_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.modalities.show', $modality->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('modality_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.modalities.edit', $modality->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('modality_delete')
                                                <form action="{{ route('frontend.modalities.destroy', $modality->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('modality_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.modalities.massDestroy') }}",
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
  let table = $('.datatable-Modality:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection