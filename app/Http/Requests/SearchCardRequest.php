<?php namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SearchCardRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::guard('api')->check();
    }

    public function rules()
    {

        return [
            'card'  => 'required|string',
            'count' => 'required|integer|min:1'
        ];
    }
}
