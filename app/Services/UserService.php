<?php
namespace App\Services;

use App\Models\AllRecording;
use App\Services\BaseModelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Meeting;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseModelService
{

    public function __construct(
        protected UserMeetingRoomService $user_meeting_room_service
    ) {
        parent::__construct(new User());
        $this->allow_all_records = true;
    }


    // create model
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->getModelAttributes($request);
            $plan = Plan::query()->create($data['plan']);
            $data['plan_id'] = $plan->id;
            $this->model::query()->create($data);
            DB::commit();
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            Log::error("Fail with adding participants: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }
    // create model
    public function update($id, $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->getModelAttributes($request);
            $user = $this->find(($id));
            $user->update($data);
            $user->plan()->update($data['plan']);
            DB::commit();
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            DB::rollBack();
            Log::error("Fail with adding participants: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
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
        $data['password'] = Hash::make($data['password']);
        $data['plan'] = [
            'type' => $data['type'],
            'max_storage_allowed' => $data['max_storage_allowed'],
            'is_backup_enabled' => @$data['is_backup_enabled'] == 'on',
            'parallel_rooms' => $data['parallel_rooms'],
        ];
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



    /**
     * Retrieves a service instance based on the provided service name.
     *
     * @param string $service The name of the service to retrieve.
     * @return BaseModelService The instance of the requested service.
     */
    public function getService(string $service) : BaseModelService
    {
        return $this->$service;
    }




}
