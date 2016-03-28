<?php

namespace App\Back\Http\Requests\Documents;

use App\Back\Http\Requests\BackRequest;

/**
 * @property mixed images
 */
class ImageRequest extends BackRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'image' => 'required|mimes:jpg,png,gif,svg,jpeg',
                    'title' => 'required|unique:images,title',
                    'description' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title' => "required|unique:images,title,{$this->images}",
                    'image' => 'mimes:jpg,png,gif,svg,jpeg',
                    'description' => 'required',
                ];
            }
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
