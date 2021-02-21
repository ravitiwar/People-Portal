<?php

namespace App\Http\Controllers\Api;

use App\ConferenceRoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConferenceRoomRequest;
use Illuminate\Http\Request;

class ConferenceRoomController extends Controller
{
    protected $conferenceRoomModel;

    function __construct(ConferenceRoom $conferenceRoom)
    {
        $this->conferenceRoomModel = $conferenceRoom;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return response()->success($this->conferenceRoomModel->paginate(15));
    }


    /**
     * @param  ConferenceRoomRequest  $conferenceRoomRequest
     */
    public function store(ConferenceRoomRequest $conferenceRoomRequest)
    {
        return response()->success(
            $this->conferenceRoomModel->create(array_merge($conferenceRoomRequest->only([
                    'name',
                    'sitting'
                ]), [
                    'room_id' => $conferenceRoomRequest->get('roomId'),
                    'current_status' => $conferenceRoomRequest->get('currentStatus'),
                    'booking_email' => $conferenceRoomRequest->get('bookingEmail'),
                ])
            ),
            "Conference room updated"
        );
    }


    /**
     * Update a resource
     * @param  ConferenceRoomRequest  $conferenceRoomRequest
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConferenceRoomRequest $conferenceRoomRequest, $id)
    {
        try {
            return response()->success(
                $this->conferenceRoomModel->findOrFail($id)->update(
                    $this->conferenceRoomModel->getFillable()
                )
            );

        } catch (\Exception $e) {
            return response()->fail([], "Conference room not found");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return response()->success(
                $this->conferenceRoomModel->findOrFail($id)->destroy($id)
            );
        } catch (\Exception $e) {
            return response()->fail([$id], "Conference room not found");
        }
    }
}
