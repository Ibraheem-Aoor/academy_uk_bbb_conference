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
use App\Transformers\User\RoomManagerTransformer;
use Illuminate\Support\Facades\Crypt;
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
            $plan->history()->create(['renewed_at' => null]);
            $data['plan_id'] = $plan->id;
            $this->model::query()->create($data);
            DB::commit();
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            DB::rollBack();
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


    /**
     * Renew the plan for a user.
     *
     * @param int $id The ID of the user.
     * @throws Throwable If an error occurs during the renewal process.
     * @return JsonResponse The response indicating the success of the renewal.
     */
    public function renewPlan($id)
    {
        try {

            $user = $this->model::query()->findOrFail(decrypt($id));
            $user->plan->history()->latest()->first()->renew();
            $user->status = 1;
            $user->save();
            return generateResponse(status: true, modal_to_hide: $this->model->renew_plan_modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            DB::rollBack();
            Log::error("Fail with Renew Plan Proccess: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_updated'));
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
        return $this->getDataTableObject($query, $this->model->transformer);
    }


    public function getRoomMangersTable(Request $request)
    {
        $query = $this->model::query()->isRoomManager();
        return $this->getDataTableObject($query, $this->model->room_manager_transformer);
    }

    private function getDataTableObject($query, $transformer)
    {
        return DataTables::of($query)
            ->setTransformer($transformer)
            ->make(true);
    }



    /**
     * Retrieves a service instance based on the provided service name.
     *
     * @param string $service The name of the service to retrieve.
     * @return BaseModelService The instance of the requested service.
     */
    public function getService(string $service): BaseModelService
    {
        return $this->$service;
    }


    /**
     * Create a new manager user with associated rooms.
     *
     * @param Request $request The request object containing the user data.
     * @return JsonResponse The JSON response indicating the success of the operation.
     */
    public function createManager($request)
    {
        try {
            DB::beginTransaction();
            $manager = $this->model::create([
                'email' => $request->input('email'), // Email of the user.
                'password' => makeHash($request->input('password')), // Hashed password of the user.
                'name' => $request->input('name'), // Name of the user.
                // 'password_text' => Crypt::encryptString($request->input('password')), // Encrypted password of the user.
                'is_room_manager' => true,
                'plan_id' => getAuthUser('web')->plan_id,
                'created_by' => getAuthUser('web')->id,
            ]);

            // Sync the associated rooms with the newly created manager user.
            $manager->rooms()->sync($request->input('rooms'));
            DB::commit();
            // Return a success response.
            return generateResponse(status: true, modal_to_hide: $this->model->room_manager_modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }
    /**
     * Update Room Manager
     *
     * @param Request $request The request object containing the user data.
     * @return JsonResponse The JSON response indicating the success of the operation.
     */
    public function updateManager($id, $request)
    {
        try {
            DB::beginTransaction();
            $manager = User::query()->findOrFail($id);
            $manager->update([
                'email' => $request->input('email'), // Email of the user.
                'password' => makeHash($request->input('password')), // Hashed password of the user.
                'name' => $request->input('name'), // Name of the user.
                // 'password_text' => Crypt::encryptString($request->input('password')), // Encrypted password of the user.
                'is_room_manager' => true,
            ]);

            // Sync the associated rooms with the newly created manager user.
            $manager->rooms()->sync($request->input('rooms'));
            DB::commit();
            // Return a success response.
            return generateResponse(status: true, modal_to_hide: $this->model->room_manager_modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }


}
