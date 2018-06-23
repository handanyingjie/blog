<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title' => 'required|unique:posts,title',
            'author' => 'required',
            'tag_id' => 'required|exists:tags,id',
            'is_top' => 'required',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不可为空',
            'title.unique' => '标题已存在',
            'author.required' => '作者不可为空',
            'tag_id.required' => '标签不可为空',
            'tag_id.exists' => '无效的标签',
            'is_top.required' => '是否置顶不可为空',
            'body.required' => '文章内容不可为空'
        ];
    }
}
