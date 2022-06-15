<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Admins_TbEditRequest extends FormRequest
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
            
				"firstname" => "filled|string",
				"lastname" => "filled|string",
				"email" => "filled|email|unique:admins_tb,email,$rec_id,admin_id",
				"password" => "filled|same:confirm_password",
				"username" => "filled|string",
				"status" => "nullable|numeric",
            
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
