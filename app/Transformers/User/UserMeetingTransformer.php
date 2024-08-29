<?php

namespace App\Transformers\User;

use App\Models\AccountTree;
use App\Models\Meeting;
use App\Models\User\UserMeeting;
use League\Fractal\TransformerAbstract;

class UserMeetingTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\AccountTree $contact
     * @return array
     */
    public function transform(UserMeeting $meeting): array
    {
        return [
            'id' => $meeting->id,
            'name' => $meeting->name,
            'room' => $meeting->room->name,
            'meeting_id' => $meeting->meeting_id,
            'user' => $meeting->user->name,
            'status' => $this->getStatusColumn($meeting),
            'created_at' => date($meeting->created_at),
            'actions' => $this->getActions($meeting),
        ];
    }


    public function getActions($meeting)
    {
        return '<div class="d-flex justify-content-between align-items-center">
        <a title="Add Participants" data-bs-toggle="modal" data-bs-target="#add-meeting-users-modal" data-action="' . route('user.meeting.add_user', ($meeting->id)) . '"
        data-method="POST" data-header-title="' . __('general.add_meeting_users', ['meeting' => $meeting->name]) . '"
        href="#" class="btn btn-sm btn-primary ms-2 editParticipantsBtn" data-fetchUrl="' . route('user.meeting.get_participants', encrypt($meeting->id)) . '"
        data-actionUrl="' . route('user.meeting.update_participants', encrypt($meeting->id)) . '"
         onclick="fetchParticipants(this);">
        <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/users.svg') . '"><i class="fa fa-eye"></i></a>&nbsp;
        <a title="Excel" class="btn btn-sm btn-info" href="' . route('user.meeting.export', $meeting->id) . '">
        <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/file.svg') . '"><i class="fa fa-eye"></i></a>&nbsp;
        <a  title="Public Link" class="btn btn-sm btn-success link-to-copy" href="#"  data-url="' . route('site.user.join_public_meeting', ($meeting->meeting_id)) . '">
        <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/copy.svg') . '"></a>&nbsp;
            <a  title="Join Meeting"  class="btn btn-sm btn-success " href="' . route('user.meeting.join_as_moderator', encrypt($meeting->id)) . '" target="__blank">
        <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/arrow-right.svg') . '"></a>
        <a data-bs-toggle="modal" data-bs-target="#delete-modal" data-delete-url="' . route('user.meeting.destroy', encrypt($meeting->id)) . '"
        data-message="' . __('general.confirm_delete') . '" data-name="' . $meeting->name . '" id="row-' . $meeting->id . '"
        class="btn btn-sm btn-danger ms-2"><img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/trash.svg') . '"><i class="fa fa-trash"></i></a>
        </div>';
    }


    public function getStatusColumn($meeting)
    {
        $is_checked = $meeting->status ? 'checked' : null;
        $html = '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status"  ' . $is_checked . ' data-route="' . route('user.meeting.toggle_status') . '" data-id="' . $meeting->id . '" onclick="toggleStatus($(this));">
    </div>';
        return $html;
    }


}
