<?php

namespace App\Transformers\User;

use App\Models\AccountTree;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class  RoomManagerTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\AccountTree $contact
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => $this->getStatusColumn($user),
            'created_at' => date($user->created_at),
            'actions' => $this->getActions($user),
        ];
    }


    public function getActions($user)
    {
        return '<div class="text-end p-3">
            <a title="Edit" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="' . $user->room_manager_modal . '"
                data-action="' . route('user.room_managers.update', encrypt($user->id)) . '"
                data-method="POST" data-header-title="' . __('general.edit_manager', ['manager' => $user->name]) . '"
                data-name="' . $user->name . '" data-email="' . $user->email . '" data-rooms="'.json_encode($user->rooms()->pluck('room_id')->toArray()).'"
                href="#" >

                <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/edit.svg') . '"><i class="fa fa-edit"></i>
            </a>
            <a data-bs-toggle="modal" data-bs-target="#delete-modal" data-delete-url="' . route('admin.user.destroy', encrypt($user->id)) . '"
        data-message="' . __('general.confirm_delete') . '" data-name="' . $user->name . '" id="row-' . $user->id . '"
        class="btn btn-sm btn-danger ms-2"><img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/trash.svg') . '"><i class="fa fa-trash"></i></a>
        </div>';
    }


    public function getStatusColumn($user)
    {
        $is_checked = $user->status ? 'checked' : null;
        $html = '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status"  ' . $is_checked . ' data-route="' . route('user.room_managers.toggle_status') . '" data-id="' . $user->id . '" onclick="toggleStatus($(this));">
    </div>';
        return $html;
    }


}
