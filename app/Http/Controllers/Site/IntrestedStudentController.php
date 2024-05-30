<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\IntresetedStudentRegisterRequest;
use App\Mail\TestMail;
use App\Models\Course;
use App\Models\CrfCourse;
use App\Models\IntrestedStudent;
use App\Models\Program;
use App\Models\Webshop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Throwable;

class IntrestedStudentController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(IntresetedStudentRegisterRequest $request)
    {
        try {
            IntrestedStudent::create([
                'name' => $request->validated('name'),
                'email' => $request->validated('email'),
                'program_id' => $request->validated('program'),
            ]);
            $response = generateResponse(status: true, message: __('response.we_will'), reload: true);
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false, message: __('response.error'));
        }
        return response()->json($response);
    }

}
