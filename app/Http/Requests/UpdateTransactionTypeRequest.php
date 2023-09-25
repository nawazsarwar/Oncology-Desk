<?php

namespace App\Http\Requests;

use App\Models\TransactionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_type_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:transaction_types,title,' . request()->route('transaction_type')->id,
            ],
            'account' => [
                'string',
                'required',
            ],
        ];
    }
}
