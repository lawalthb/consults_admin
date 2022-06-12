<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Payment_TbAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		
        return [
            
				"vendor_id" => "required",
				"amount_in" => "required|numeric",
				"amount_out" => "required|numeric",
				"amount_balance" => "required|numeric",
				"cmment" => "nullable|string",
				"date" => "nullable|date",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
