<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Sales_TbEditRequest extends FormRequest
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
            
				"order_no" => "nullable",
				"product_id" => "filled",
				"vendor_id" => "filled",
				"user_id" => "filled",
				"rate" => "filled|numeric",
				"qty" => "filled|numeric",
				"total_amount" => "filled|numeric",
				"payment_optn" => "nullable|string",
				"date" => "filled|date",
				"sales_status" => "filled|numeric",
				"remark" => "nullable",
				"checkout_by" => "nullable",
            
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
