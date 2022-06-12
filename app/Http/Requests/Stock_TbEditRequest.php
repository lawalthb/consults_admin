<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Stock_TbEditRequest extends FormRequest
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
            
				"date" => "nullable|date",
				"user_id" => "nullable|numeric",
				"mat_no" => "nullable|string",
				"item_id" => "filled",
				"vendor_id" => "filled",
				"user_type" => "filled|numeric",
				"item_in" => "filled|numeric",
				"item_out" => "filled|numeric",
				"item_balance" => "filled|numeric",
				"payment_id" => "filled|numeric",
				"status" => "filled|numeric",
            
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
