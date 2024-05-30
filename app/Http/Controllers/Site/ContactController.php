<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Http\Requests\Site\IntresetedStudentRegisterRequest;
use App\Mail\TestMail;
use App\Models\Contact;
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

class ContactController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ContactRequest $request)
    {
        try {
            Contact::create($request->validated());
            $response = generateResponse(status: true, message: __('response.we_will'), reload: true);
        } catch (Throwable $e) {
            $response = generateResponse(status: false, message: __('response.error'));
        }
        return response()->json($response);
    }

}
