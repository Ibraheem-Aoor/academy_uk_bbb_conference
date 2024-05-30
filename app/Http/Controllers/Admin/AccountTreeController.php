<?php
namespace App\Http\Controllers\Admin;


use App\Enums\AccountTreeTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccountTreeRequest;
use App\Http\Requests\User\WebshopAccountRequest;
use App\Services\AccountTreeService;
use App\Services\UserWebShopAccountsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AccountTreeController extends Controller
{

    public function __construct(protected AccountTreeService $service)
    {

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $data['types'] = AccountTreeTypeEnum::get();
        $data['parent_accounts'] = $this->service->get(paginate: 0, params: ['id', 'name'], filters: ['parent' => true]);
        $data['table_data_url'] = route('user.account_tree.table');
        return view('admin.account_tree.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountTreeRequest $request)
    {
        $response = $this->service->create($request);
        return response()->json($response);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountTreeRequest $request, $id)
    {
        $response = $this->service->update(decrypt($id), $request);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->delete(decrypt($id));
    }

    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getTableData($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }

    public function toggleStatus(Request $request)
    {
        $response = $this->service->toggleIsActiveStatus($request);
        return response()->json($response);
    }
}
