<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Order_TbEditRequest extends FormRequest
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
		
		$rec_id = request()->route('rec_id');

        return [
            
				"order_no" => "filled|numeric|max:50|min:1|unique:order_tb,order_no,$rec_id,order_id",
				"user_id" => "filled",
				"vendor_id" => "filled",
				"product_id" => "filled",
				"mat_no" => "nullable|string",
				"rate" => "filled|numeric",
				"qty" => "filled|numeric|max:50|min:1",
				"total_amount" => "filled|numeric",
				"payment_optn" => "nullable|string",
				"date" => "filled|date",
            
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
