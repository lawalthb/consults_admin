<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Users_TbEditRequest extends FormRequest
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
            
				"matric_no" => "nullable|string",
				"firstname" => "filled|string",
				"lastname" => "filled|string",
				"email" => "filled|email",
				"phone" => "nullable|string",
				"department" => "filled",
				"level" => "nullable",
				"password" => "filled|same:confirm_password",
				"status" => "filled|numeric",
				"gender" => "nullable",
				"photo" => "nullable",
            
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
