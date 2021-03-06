<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerProfileUpdateRequest extends Request
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
            'fname' => 'required|min:3|max:20',
            'lname' => 'required|min:3|max:20',
            'profile_picture' => 'mimes:jpeg,png,jpg',
            'birthdate' => 'date_format:d-m-Y',
            'area_id' => 'required|integer'
        ];
    }
}
