<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //home page
    public function index() {
        
        $categories = Category::where('status',1)->orderBy('name','ASC')->take(8)->get();

        $newCategories = Category::where('status',1)->orderBy('name','ASC')->get();

        $latestJobs = Job::where('status',1)->with('jobType')->orderBy('created_at','DESC')->take(6)->get();

        return view('front.home',[
            'categories' => $categories,
            'latestJobs' => $latestJobs,
            'newCategories' => $newCategories,
        ]);
    }

    public function contact() {
        return view('front.contact');
    }

    public function blogs() {
        return view('front.blogs');
    }
}
