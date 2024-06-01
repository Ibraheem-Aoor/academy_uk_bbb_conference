<?php

namespace App\Transformers\Admin;

use App\Models\AccountTree;
use App\Models\Meeting;
use League\Fractal\TransformerAbstract;

class MeetingTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\AccountTree $contact
     * @return array
     */
    public function transform(Meeting $meeting): array
    {
        return [
            'id' => $meeting->id,
            'name' => $meeting->name,
            'meeting_id' => $meeting->meeting_id,
            'created_at' => date($meeting->created_at),
            'actions' => $this->getActions($meeting),
        ];
    }


    public function getActions($meeting)
    {
        return '<div class="text-end p-3">
        <a data-bs-toggle="modal" data-bs-target="#add-meeting-users-modal" data-action="' . route('admin.meeting.add_user', ($meeting->id)) . '"
        data-method="POST" data-header-title="' . __('general.add_meeting_users', ['meeting' => $meeting->name]) . '"
        href="#" class="btn btn-sm btn-primary ms-2 editParticipantsBtn" data-meetingId="' . $meeting->id . '" onclick="fetchParticipants(this);">
        <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/users.svg') . '"><i class="fa fa-eye"></i></a> &nbsp;
        <a class="btn btn-sm btn-info" href="'.route('admin.meeting.export' , $meeting->id).'">
        <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/file.svg') . '"><i class="fa fa-eye"></i></a>
        <a  class="btn btn-sm btn-success link-to-copy" href="#"  data-url="'.route('site.join_public_meeting' , encrypt($meeting->id)).'">
        <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/copy.svg') . '"></a>
        </div>';
    }




}
