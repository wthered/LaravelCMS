<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class createPostsRequest extends FormRequest
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
    public function rules() {
    	// unique:blog_posts
        return [
            'title' => 'required',
	        'description' => 'required',
	        'image' => 'required|image',
	        'post_content'   => 'required',
	        'category' => 'required'
        ];
    }
}
