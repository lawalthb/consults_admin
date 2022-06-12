<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Products_TbAddRequest extends FormRequest
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
            
				"product_name" => "required|string",
				"vendor_id" => "required",
				"sell_rate" => "required|numeric",
				"purchase_rate" => "required|numeric",
				"level" => "required",
				"department_id" => "required",
				"vendor_email" => "nullable|string",
				"description" => "required|string",
            
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
