<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_create');
    }

    public function rules()
    {
        return [
            'narration' => [
                'string',
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'amount' => [
                'required',
            ],
            'transactionable_type' => [
                'string',
                'required',
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'type_id' => [
                'required',
                'integer',
            ],
            'transactionable_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
