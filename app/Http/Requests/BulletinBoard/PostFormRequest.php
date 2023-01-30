<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:5000',
        ];
    }

    public function messages(){
        return [
            // 'post_category_id.required'=>'サブカテゴリーは必須項目です。',
            // 'post_category_id.exists'=>'サブカテゴリーが不正です。',
            'post_title.required' => 'タイトルは必須項目です。',
            'post_title.string' =>'形式が正しくありません。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',
            'post_body.required' => '投稿内容は必須項目です。',
            'post_body.string' =>'形式が正しくありません。',
            'post_body.max' => '最大文字数は500文字です。',
        ];
    }
}
