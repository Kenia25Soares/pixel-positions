<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        // dd('asafdaf');
        //dd(request('q'));

        // $jobs = Job::where('title', 'LIKE', '%'.request('q').'%')->get();

        // // return $jobs;
        // return view('results', ['jobs'=> $jobs]);
        $jobs = Job::query()
            ->with(['employer', 'tags'])
            ->where('title', 'LIKE', '%'.request('q').'%')
            ->get();

        return view('results', ['jobs' => $jobs]);
 }
}
