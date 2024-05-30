<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Webshop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->page_title = "Home";
        $this->base_view_path = "site.";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $data['page_title'] = $this->page_title;
        return view($this->base_view_path . 'home', $data);
    }



    public function about(): View
    {
        $data['page_title'] = "About";
        return view($this->base_view_path . 'about', $data);
    }
    public function partners(): View
    {
        $data['page_title'] = "Partners";
        return view($this->base_view_path . 'partners', $data);
    }

    public function eTraining(): View
    {
        $data['page_title'] = "E-Training";
        return view($this->base_view_path . 'e_training', $data);
    }

    public function contact() :View
    {
        $data['page_title'] = "Contact Us";
        return view($this->base_view_path . 'contact', $data);
    }

}
