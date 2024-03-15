<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{
    //show jobs page
    public function index(Request $request) {

        $categories = Category::where('status',1)->get();
        $jobTypes = JobType::where('status',1)->get();

        $jobs = Job::where('status',1);

        //search using keyword
        if(!empty($request->keyword)){
            $jobs = $jobs->where(function($query) use ($request ){
                $query->orWhere('title','like','%'.$request->keyword.'%');
                $query->orWhere('keywords','like','%'.$request->keyword.'%');
            });
        }

        //search using location
        if(!empty($request->location)){
            $jobs = $jobs->where('location',$request->location);
        }

        //search using category
        if(!empty($request->category)){
            $jobs = $jobs->where('category_id',$request->category);
        }

        //search using Job Type
        $jobTypeArray = [];
        if(!empty($request->jobType)){
            $jobTypeArray = explode(',',$request->jobType);

            $jobs = $jobs->whereIn('job_type_id',$jobTypeArray);
        }

        //search using Experience
        if(!empty($request->experience)){
            $jobs = $jobs->where('experience',$request->experience);
        }

        $jobs = $jobs->with(['jobType','category']);

        if($request->sort == '0') {
            $jobs = $jobs->orderBy('created_at','ASC');
        } else {
            $jobs = $jobs->orderBy('created_at','DESC');
        }
        
        $jobs = $jobs->paginate(9);



        return view('front.jobs',[
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs,
            'jobTypeArray' => $jobTypeArray,
        ]);
    }

    //showing job details page 
    public function detail($id) {

        $job = Job::where([
                            'id' => $id, 
                            'status' => 1,
                        ])->with(['jobType','category'])->first();

        if ($job == null) {
            abort(404);
        }

        $count = 0;
        if (Auth::user()) {
            $count = SavedJob::where([
                'user_id' => Auth::user()->id,
                'job_id' => $id,
            ])->count();
        }

        //fetch applicants
        $applications = JobApplication::where('job_id',$id)->with('user')->get();

        return view('front.details',[
            'job' => $job,
            'count' => $count,
            'applications' => $applications,
        ]);
    }

    public function applyJob(Request $request) {
        $id = $request->id;

        $job = Job::where('id',$id)->first();

        if ($job == null) {
            session()->flash('error','Job dose not exists!');
            return response()->json([
                'status' => false,
                'message' => 'Job dose not exists!'
            ]);
        }

        //cannot apply own job
        $employer_id = $job->user_id;

        if ($employer_id == Auth::user()->id) {
            session()->flash('error','Cannot apply own job!');
            return response()->json([
                'status' => false,
                'message' => 'Cannot apply own job!'
            ]);
        }

        //You cannot apply on a job twice
        $jobApplicationCount = JobApplication::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->count();

        if ($jobApplicationCount > 0) {
            session()->flash('error','You already applied on this job!');
            return response()->json([
                'status' => false,
                'message' => 'You already applied on this job!',
            ]);
        }

        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();

        //Send Notification Email to Employer
        $employer = User::where('id',$employer_id)->first();
        $mailData = [
            'employer' => $employer,
            'user' => Auth::user(),
            'job' => $job,
        ];
        Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        session()->flash('success','You have successfully applied.');
        return response()->json([
            'status' => true,
            'message' => 'You have successfully applied.'
        ]);
    }

    public function savedJob(Request $request) {

        $id = $request->id;

        $job = Job::find($id);

        if ($job == null) {
            session()->flash('error','Job not found.');
            return response()->json([
                'status' => false,
            ]);
        }

        //checked if user already saved the job
        $count = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->count();

        if ($count > 0) {
            session()->flash('error','You already saved this job.');
            return response()->json([
                'status' => false,
            ]);
        }

        $savedJob = new SavedJob;
        $savedJob->job_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();

        session()->flash('success','You have successfully saved the job.');
            return response()->json([
                'status' => true,
            ]);
    }
}
