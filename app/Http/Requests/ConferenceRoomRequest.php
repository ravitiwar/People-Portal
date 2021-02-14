<?php

namespace App\Http\Requests;

use App\Utils\AppUtils;
use Illuminate\Foundation\Http\FormRequest;

class ConferenceRoomRequest extends ApiRequest
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
            'room_id'=>'required|string',
            'name'=>'required|string',
            'booking_email'=>'required|email',
            'sitting'=>'required|int',
            'current_status'=>'required|in:'.join(',',AppUtils::getRoomStatuses())
        ];
    }


}
