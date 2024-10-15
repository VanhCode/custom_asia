<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateEditDestination extends FormRequest
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
            // "image" => "mimes:jpeg,jpg,png,webp,svg|nullable|file|max:3000",
            "active" => "required",
            // "checkrobot" => "accepted"
        ];
        $langConfig = config('languages.supported');
        $langDefault = config('languages.default');

        foreach ($langConfig as $key => $value) {
            $arrConlai = $langConfig;
            unset($arrConlai[$key]);
            $keyConlai = array_keys($arrConlai);
            $keyConlai = collect($keyConlai);

            $stringKey = $keyConlai->map(function ($item, $key) {
                return "name_" . $item;
            });
            $stringKey = $stringKey->implode(', ');
            $rule['name_' . $key] = "required|min:1|max:250";
            $rule['value_' . $key] = "nullable|min:1|max:250";
        }
        return $rule;
    }
    public function messages()
    {
        return     [
            "name.required" => "Name  is required",
            "name.min" => "Name  > 3",
            "name.max" => "Name  < 100",
            "name.unique" => "Name đã tồn tại",
            "slug.unique" => "Slug đã tồn tại",
            "image.mimes" => "image in jpeg,jpg,webp,png,svg",
            "active.required" => "active  is required",
            "checkrobot.accepted" => "checkrobot  is accepted",
        ];
    }
}
