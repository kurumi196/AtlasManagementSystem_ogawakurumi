<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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

    protected function prepareForValidation(){
            $old_year = $this->input('old_year');
            $old_month = $this->input('old_month');
            $old_day = $this->input('old_day');
            $date = $old_year . '-' . $old_month . '-' . $old_day;
            $birth_day = date('Y-m-d', strtotime($date));
            $this->merge(['birth_day'=>$birth_day]);
    }

    public function rules()
    {
        return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|max:30|regex:/\A[ァ-ヴー]+\z/u',
            'under_name_kana' => 'required|string|max:30|regex:/\A[ァ-ヴー]+\z/us',
            'mail_address' => 'required|email|max:100|unique:users,mail_address',
            'sex'=>'required|in:1,2,3',
            'old_year'=>'required',
            'old_month'=>'required',
            'old_day'=>'required',
            'birth_day'=>'required|date|after_or_equal:"2000-01-01"|before:today',
            'role'=>'required|in:1,2,3,4',
            'password' => 'required|min:8|max:30|confirmed',
            'password_confirmation'=>'required|min:8|max:30'
        ];
    }

    public function messages(){
        return [
            'old_year.required'=>'年は必須項目です。',
            'old_month.required'=>'月は必須項目です。',
            'old_day.required'=>'日は必須項目です。',
            'birth_day.required'=>'生年月日は必須項目です。',
            'birth_day.date'=>'不正な日付です。',
            'birth_day.after_or_equal' => '2000年1月1日以降で指定してください。',
            'birth_day.before' => '選択できない日付です。',
        ];
    }
}
