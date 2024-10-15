<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateAddDestination extends FormRequest
{
    /**
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
     * @return array
     */
    public function rules()
    {
        $rule = [
            "order" => "nullable|numeric",
            "active" => "required",
            // "image" => "mimes:jpeg,jpg,png,webp,svg|nullable|file|max:3000",
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
            "image.mimes" => "image  in jpeg,jpg,png,svg",
            "slug.unique" => "Slug đã tồn tại",
            "active.required" => "active  is required",
            "checkrobot.accepted" => "checkrobot  is accepted",
        ];
    }
}
