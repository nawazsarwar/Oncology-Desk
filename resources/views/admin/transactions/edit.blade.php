@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transactions.update", [$transaction->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="narration">{{ trans('cruds.transaction.fields.narration') }}</label>
                <input class="form-control {{ $errors->has('narration') ? 'is-invalid' : '' }}" type="text" name="narration" id="narration" value="{{ old('narration', $transaction->narration) }}" required>
                @if($errors->has('narration'))
                    <span class="text-danger">{{ $errors->first('narration') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.narration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.transaction.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $transaction->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.transaction.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $transaction->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $transaction->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transactionable_type">{{ trans('cruds.transaction.fields.transactionable_type') }}</label>
                <input class="form-control {{ $errors->has('transactionable_type') ? 'is-invalid' : '' }}" type="text" name="transactionable_type" id="transactionable_type" value="{{ old('transactionable_type', $transaction->transactionable_type) }}" required>
                @if($errors->has('transactionable_type'))
                    <span class="text-danger">{{ $errors->first('transactionable_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.transactionable_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.transaction.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $transaction->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.transaction.fields.remarks') }}</label>
                <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" name="remarks" id="remarks">{{ old('remarks', $transaction->remarks) }}</textarea>
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.remarks_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type_id">{{ trans('cruds.transaction.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id" required>
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $transaction->type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transactionable_id">{{ trans('cruds.transaction.fields.transactionable') }}</label>
                <select class="form-control select2 {{ $errors->has('transactionable') ? 'is-invalid' : '' }}" name="transactionable_id" id="transactionable_id" required>
                    @foreach($transactionables as $id => $entry)
                        <option value="{{ $id }}" {{ (old('transactionable_id') ? old('transactionable_id') : $transaction->transactionable->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transactionable'))
                    <span class="text-danger">{{ $errors->first('transactionable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.transactionable_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection