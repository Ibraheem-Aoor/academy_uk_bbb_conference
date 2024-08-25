<?php
namespace App\Services;

use App\Services\BaseModelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Plan;
use App\Models\User\UserMeetingRoom;
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

    public function updateOrCreate($user_id, Request $request)
    {
        try {
            DB::beginTransaction();
            $rooms = $this->getModelAttributes($request)['rooms'];
            $existing_rooms = $this->model::where('user_id', $user_id)->pluck('id')->toArray();
            $rooms_ids = array_column($rooms, 'id');
            $rooms_ids_to_delete = array_diff($existing_rooms, $rooms_ids);
            $this->model::whereIn('id', $rooms_ids_to_delete)->delete();
            foreach ($rooms as $room) {
                $this->findOrCreate($room, $user_id)->fill($room)->save();
            }
            DB::commit();
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Fail with adding rooms: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }

    private function findOrCreate($room, $user_id)
    {
        return $this->model::query()->firstOrCreate(['id' => @$room['id'] ?? null], [
            'user_id' => $user_id,
            'name' => $room['name'],
            'max_meetings' => $room['max_meetings'],
            'max_participants' => $room['max_participants'],
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
