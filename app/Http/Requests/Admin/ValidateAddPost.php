<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateAddPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->guard('admin')->check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rule = [
            "order" => "nullable|numeric",
            // "avatar_path"=>"mimes:jpeg,jpg,png,webp,svg|nullable|file|max:3000",
            "view" => "nullable|integer",
            "hot" => "nullable|integer",
            "category_id" => 'exists:App\Models\CategoryPost,id',
            "active" => "required",
            "category" => "required",
        ];
        $langConfig = config('languages.supported');
        $langDefault = config('languages.default');

        foreach ($langConfig as $key => $value) {
            $arrConlai = $langConfig;
            unset($arrConlai[$key]);
            $keyConlai = array_keys($arrConlai);
            $keyConlai = collect($keyConlai);

            $stringKey = $keyConlai->map(function ($item, $key) {
                return "slug_" . $item;
            });
            $stringKey = $stringKey->implode(', ');
            // dd($stringKey);
            // $leng=count($keyConlai);

            // array_map(function($k,$i){
            //     dd($i);
            // },$keyConlai);
            // dd($leng);
            // $defirent=implode("name_",$keyConlai);
            // dd($defirent);

            $rule['name_' . $key] = "required|min:3|max:250";
            $rule['slug_' . $key] = [
                "required",
                'different:' . $stringKey,
                Rule::unique("App\Models\PostTranslation", 'slug'),
            ];
            $rule['title_seo_' . $key] = "nullable|min:1|max:191";
            $rule['description_seo_' . $key] = "nullable|min:1|max:191";
            $rule['keyword_seo_' . $key] = "nullable|min:1|max:191";
        }
        return $rule;
    }
    public function messages()
    {
        return [
            "name.required" => "Name post is required",
            "name.min" => "Name post > 3",
            "name.max" => "Name post < 250",
            "slug.required" => "slug post is required",
            "slug.unique" => "slug post is exits",
            "hot.integer" => "hot is integer",
            "view.integer" => "view is integer",
            "avatar.mimes" => "avatar  in jpeg,jpg,webp,png,svg",
            "active.required" => "active  is required",
            "category_id" => "Chưa chọn danh mục",
            "category" => "Chưa chọn danh mục",

        ];
    }
}
