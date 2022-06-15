<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Vendors_TbEditRequest extends FormRequest
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
            
				"title" => "filled|string",
				"name" => "filled|string",
				"email" => "filled|email|unique:vendors_tb,email,$rec_id,vendor_id",
				"department_id" => "filled",
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
