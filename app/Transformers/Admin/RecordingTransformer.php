<?php

namespace App\Transformers\Admin;

use App\Models\AccountTree;
use App\Models\Meeting;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class RecordingTransformer extends TransformerAbstract
{


    /**
     * @param \App\Models\AccountTree $contact
     * @return array
     */
    public function transform($meeting): array
    {
        return [
            'name' => $meeting->name,
            'duration' => formatDuration($meeting->duration),
            'created_at' => Carbon::createFromTimestamp($meeting->endTime / 1000)->toDateTimeString(),
            'actions' => $this->getActions($meeting),
        ];
    }


    public function getActions($meeting)
    {
        $playbackUrl = $meeting->playbackUrl ?? $meeting->playback_url;
        if ($meeting instanceof \stdClass) {

            return '<div class="text-end p-3">
            <a title="Play Meeting"
            href="' . $playbackUrl . '" class="btn btn-sm btn-primary ms-2 " target="__blank">
            <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/eye.svg') . '"><i class="fa fa-eye"></i></a> &nbsp;
            </div>';
        } else {
            return '<div class="text-end p-3">
            <a title="Play Meeting"
            href="' . $playbackUrl . '" class="btn btn-sm btn-primary ms-2 " target="__blank">
            <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/eye.svg') . '"><i class="fa fa-eye"></i></a> &nbsp;
            <a title="Play Backup Meeting"
            href="' . $meeting->getBackuuPlayUrl() . '" class="btn btn-sm btn-soft-success ms-2 " target="__blank">
            <img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/database.svg') . '"><i class="fa fa-eye"></i></a> &nbsp;
            </div>';
        }
    }




}
