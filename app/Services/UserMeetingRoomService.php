<?php
namespace App\Services;

use App\Services\BaseModelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Plan;
use App\Models\User;
use App\Models\User\UserMeetingRoom;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserMeetingRoomService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new UserMeetingRoom());
        $this->allow_all_records = true;
    }



    public function updateName($id, Request $request)
    {
        try {
            $model = $this->find($id);
            $model->update([
                'name' => $request->input('name'),
            ]);
            return generateResponse(status: true, modal_to_hide: $this->model->modal , reload:true);
        } catch (Throwable $e) {
            Log::error("Fail with adding rooms: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }


    /**
     * Update Or Create The User Meeting Rooms.
     * @param mixed $user_id
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function updateOrCreate($user_id, Request $request)
    {
        try {
            DB::beginTransaction();
            $rooms = $this->getModelAttributes($request)['rooms'];
            $user = User::query()->findOrFail($user_id);
            foreach ($rooms as $room) {
                $room_to_save =  $this->findOrCreate($room);
                $room_to_save->fill($room)->save();
                $rooms_to_sync[] = $room_to_save->id;
            }
            $user->rooms()->sync(array_values($rooms_to_sync));
            DB::commit();
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            DB::rollBack();
            Log::error("Fail with adding rooms: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }

    private function findOrCreate($room)
    {
        return $this->model::query()->firstOrCreate(['id' => @$room['id'] ?? null], [
            'name' => $room['name'],
            'max_meetings' => $room['max_meetings'],
            'max_participants' => $room['max_participants'],
            'max_storage_allowed' => $room['max_storage_allowed'],
        ]);
    }


    // delete model by id
    public function delete($id)
    {
        try {
            $model = $this->find($id);
            $model->plan()->delete();
            $model->delete();
        } catch (Throwable $e) {
            Log::error("Fail with Deleted in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_delete'));
        }
        return generateResponse(true, 200, message: __('response.success_delete'), modal_to_hide: '#delete-modal', table_reload: true, table: '#myTable', row_to_delete: $id, is_deleted: true);

    }



    public function toggleStatus($id)
    {
        try {
            $model = $this->find($id);
            $model->update([
                'status' => !$model->status,
            ]);
            $response = generateResponse(status: true, message: __('response.success_updated'));
        } catch (Throwable $e) {
            Log::error("Fail with " . __FUNCTION__ . " in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            $response = generateResponse(status: false, message: __('response.error'));
        }
        return $response;
    }



    /**
     * Format The User Data And Plan Data.
     * @param mixed $request
     * @return array
     */
    protected function getModelAttributes($request): array
    {
        $data = $request->toArray();
        return $data;
    }

    /**
     * reutrn the table data for view
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query();
        return DataTables::of($query)
            ->setTransformer($this->model->transformer)
            ->make(true);
    }







}
