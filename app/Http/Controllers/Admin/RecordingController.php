<?php
namespace App\Http\Controllers\Admin;


use App\Enums\AccountTreeTypeEnum;
use App\Enums\RoleEnum;
use App\Exports\MeetingExport;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMeetingParticipantsRequest;
use App\Http\Requests\Admin\StoreMeetingRequest;
use App\Models\Meeting;
use App\Services\AccountTreeService;
use App\Services\MeetingService;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class RecordingController extends AdminBaseController
{

    public function __construct(protected MeetingService $service)
    {
        $this->base_route_path = 'admin.recording';
        $this->base_view_path = 'admin.recordings';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Saved Recordings';
        $data['table_data_url'] = route($this->base_route_path . '.table');
        $data['route'] = $this->base_route_path;
        return view('admin.recordings.index', $data);
    }

    public function allRecordings(Request $request)
    {
        $data['page_title'] = 'All Recordings';
        $data['recordings'] = $this->service->getAllRecordings();
        return view('admin.recordings.all' , $data);
    }


    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getTableDataForRecordings($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }


}
