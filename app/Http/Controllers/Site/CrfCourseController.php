<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Course;
use App\Models\CrfCourse;
use App\Models\Program;
use App\Models\Webshop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class CrfCourseController extends Controller
{
    public function __construct()
    {
        $this->page_title = "Certified Remote Freelancer (CRF)";
        $this->base_view_path = "site.crf.";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request): View
    {
        $data['page_title'] = $this->page_title;
        if ($parent_crf = $request->query('parent_crf')) {
            $crfs = CrfCourse::query()->find(decrypt($parent_crf))->children;
        } else {
            $crfs = CrfCourse::query()->select(['id', 'name'])->with(['levels:id,crf_course_id,name,name,description'])->get();
        }
        $data['crfs'] = $crfs;
        return view($this->base_view_path . 'index', $data);
    }


    public function show($id)
    {
        $data['crf'] = Cache::get('crfs')->find(decrypt($id));
        $data['page_title'] = $data['crf']->name;
        return view($this->base_view_path . 'show', $data);
    }
}
