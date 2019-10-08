<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Org;
use App\Job;
use App\User;
use Auth;

class JobsController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('can:update,job')->except(['index','create','store']);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // $user = Auth::user();
    // $jobs = Org::findOrFail($user['org_id'])->jobs;
    // $recentJobs = Org::findOrFail($user['org_id'])->recentJobs;
    $jobs = auth()->user()->jobs;
    $recentJobs = auth()->user()->recentJobs;

    return view('jobs.index', compact('jobs', 'recentJobs'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $recentJobs = auth()->user()->recentJobs;
    return view('jobs.create', compact('recentJobs'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Job $job)
  {
    $validated = request()->validate([
      'name' => ['required', 'min:3'],
      'comment' => [],
      // 'org_id' => ['nullable'],
      // 'user_id' => ['nullable']
    ]);
    // $user = Auth::user();
    $validated['user_id'] = auth()->id();
    // $validated['org_id'] = $user['org_id'];

    // dd($validated);

    $job = Job::create($validated);

    return redirect('/jobs/'.$job->id);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Job $job)
  {
    // $this->authorize('update', $job);
    // $user = Auth::user();
    // $recentJobs = User::findOrFail(auth()->id())->recentJobs;
    // $recentPanels = Job::findOrFail($job['id'])->recentPanels;
    $recentJobs = auth()->user()->recentJobs;
    $recentPanels = auth()->user()->recentPanels;

    // dd($recentPanels);

    return view('jobs.show', compact('job'), compact('recentJobs'), compact('recentPanels'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit(Job $job)
  {
  	// $job = User::findOrFail(auth()->id())->jobs;
    $recentJobs = auth()->user()->recentJobs;
    return view('jobs.edit', compact('job'), compact('recentJobs'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Job $job)
  {
    $validated = request()->validate([
      'name' => ['required', 'min:3'],
      'comment' => [],
    ]);
    $validated['modified_by'] = auth()->id();
    // dd($validated);
    // $job->update(request(['name', 'comment']));
    $job->update($validated);
    return redirect('jobs/'.$job['id']);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Job $job)
  {
    $job->delete();
    return redirect('/jobs');
  }
}
