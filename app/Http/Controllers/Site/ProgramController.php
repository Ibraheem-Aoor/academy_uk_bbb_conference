<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Course;
use App\Models\Program;
use App\Models\Webshop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->page_title = "Programs";
        $this->base_view_path = "site.program.";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $data['page_title'] = $this->page_title;
        $programs = Program::query()->select(['id', 'name' , 'image'])->with(['courses:id,program_id,name,image,pdf_file,university'])->get();
        $data['programs'] = cacheAndGet('programs', now()->addDay(), $programs);
        return view($this->base_view_path . 'index', $data);
    }


    public function courses(Program $program)
    {
        $data['courses'] = cacheAndGet('program_'.$program->id, now()->addDay(), $program->courses);
        $data['program'] = $program;
        $data['page_title'] = $program->name .' - Courses';
        return view($this->base_view_path.'course' , $data);
    }
}
