@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.transactions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="narration">{{ trans('cruds.transaction.fields.narration') }}</label>
                            <input class="form-control" type="text" name="narration" id="narration" value="{{ old('narration', '') }}" required>
                            @if($errors->has('narration'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('narration') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.narration_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.transaction.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.transaction.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transactionable_type">{{ trans('cruds.transaction.fields.transactionable_type') }}</label>
                            <input class="form-control" type="text" name="transactionable_type" id="transactionable_type" value="{{ old('transactionable_type', '') }}" required>
                            @if($errors->has('transactionable_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transactionable_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.transactionable_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.transaction.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.transaction.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.remarks_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="type_id">{{ trans('cruds.transaction.fields.type') }}</label>
                            <select class="form-control select2" name="type_id" id="type_id" required>
                                @foreach($types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transactionable_id">{{ trans('cruds.transaction.fields.transactionable') }}</label>
                            <select class="form-control select2" name="transactionable_id" id="transactionable_id" required>
                                @foreach($transactionables as $id => $entry)
                                    <option value="{{ $id }}" {{ old('transactionable_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transactionable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transactionable') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection