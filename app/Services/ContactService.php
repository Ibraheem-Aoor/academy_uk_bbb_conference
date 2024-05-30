<?php
namespace App\Services;

use App\Models\Contact;
use App\Services\BaseModelService;
use App\Transformers\User\AccountTreeTransformer;
use App\Transformers\User\ContactTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ContactService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(Contact::class);
        $this->allow_all_records = true;
    }

    public function create(Request $request)
    {
        //
    }
    public function update($id, $request)
    {
        // Do Something
    }


    public function delete($id)
    {
        try {
            $model = $this->find($id);
            $model->delete();
        } catch (Throwable $e) {
            Log::error("Fail with Deleted in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateResponse(false, 500, message: __('response.faild_delete'));
        }
        return generateResponse(true, 200, message: __('response.success_delete'), modal_to_hide: '#delete-modal', table_reload: true, table: '#myTable', row_to_delete: $id, is_deleted: true);
    }


    /**
     *  I used DTO insetaed of couple the attributes transfering to the service.
     *  we can customize our DTO as needed later.
     *  I Guess u can deprecate this function.
     */
    protected function getModelAttributes($request)
    {
        //
    }

    /**
     * reutrn the table data for view
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query();
        return DataTables::of($query)
            ->setTransformer(ContactTransformer::class)
            ->make(true);
    }



}
