<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class PostsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title'         => 'required|string|max:255',
            'slug'          => 'string|max:255',
            'category_id'   => 'required|integer',
            'body'          => 'required|string',
        ];
        if ($this->method() == 'POST') {
            $rules['image'] =  'required|image|max:5000|mimes:png,jpg,jpeg';
        } else {
            $rules['image'] =  'nullable|image|max:5000|mimes:png,jpg,jpeg';
        }

        return $rules;
    }
    protected function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['title']) && ($this->method() == 'POST')) {
            $data['slug'] = $this->generate_slug($data['title']);
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json(['msg' => $validator->messages(), 'data' => null], 301));
        }
        parent::failedValidation($validator);
    }
    private function generate_slug($title)
    {
        $slug = Str::slug($title);
        if(Post::where('slug', $slug)->exists()){
            $slug = $slug .'-'.rand(1,1000000);
            return $this->generate_slug($slug);
        }
        return $slug;
    }
}
