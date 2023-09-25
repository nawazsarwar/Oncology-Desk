@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.transactionType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.transaction-types.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.transactionType.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transactionType.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="account">{{ trans('cruds.transactionType.fields.account') }}</label>
                            <input class="form-control" type="text" name="account" id="account" value="{{ old('account', '') }}" required>
                            @if($errors->has('account'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transactionType.fields.account_helper') }}</span>
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