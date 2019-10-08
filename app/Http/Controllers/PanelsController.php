<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Job;
use App\Panel;
use App\Services\CircuitService;

class PanelsController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  protected $circuitService;
  public function __construct(CircuitService $circuitService)
  {
    $this->middleware('auth');
    $this->circuitService = $circuitService;
    $this->middleware('can:update,panel')->except(['index','create','store']);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Job $job)
  {
    // return view('panels.index');
    if ($job->id > 0) {
      return redirect('/jobs/'.$job->id);
    } else {
      return redirect('/jobs');
    }
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(Job $job)
  {
    $this->authorize('update',$job);
    $recentJobs = auth()->user()->recentJobs;
    return view('panels.create', compact('job', 'recentJobs'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Job $job)
  {
    $this->authorize('update',$job);
    $validated = request()->validate([
      'name' => ['required', 'min:3'],
      'info' => ['nullable'],
      'circuit_count' => ['required', 'numeric', 'min:2'],
      'comment' => ['nullable'],
      'ab' => ['boolean'],
    ]);

    if ($validated['ab'] == 1) {
      $validated['circuit_count'] = $validated['circuit_count'] * 2;
    }

    $validated['user_id'] = auth()->id();
    $validated['job_id'] = $job['id'];

    // dd($validated);

    Panel::create($validated);

    return redirect('/jobs/'.$job->id);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Job $job, Panel $panel)
  {
    // $this->authorize('update', $panel);
    $panel['circuit_count_ab'] = $panel['circuit_count'];
    if ($panel['ab'] == 1) {
      $panel['circuit_count'] = $panel['circuit_count'] / 2;
    }
    $panelCircuits = $panel->circuits->keyBy('circuit_num');
    $skipCircuits = $this->circuitService->skipCircuits($panelCircuits, $panel);
    $recentJobs = auth()->user()->recentJobs;
    // dd($skipCircuits);
    return view('panels.show', compact('job', 'panel', 'recentJobs', 'panelCircuits', 'skipCircuits'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit(Job $job, Panel $panel)
  {
    $recentJobs = auth()->user()->recentJobs;
    $panelCircuits = $panel->circuits->keyBy('circuit_num');

    if ($panel['ab'] == 1) {
      $panel['circuit_count'] = $panel['circuit_count'] / 2;
    }

    return view('panels.edit', compact('job', 'panel', 'recentJobs', 'panelCircuits'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Job $job, Panel $panel)
  {
    $validated = request()->validate([
      'name' => ['required', 'min:3'],
      'info' => ['nullable'],
      'circuit_count' => ['required', 'numeric', 'min:2'],
      'comment' => ['nullable'],
      'ab' => ['boolean'],
    ]);

    if ($validated['ab'] == 1) {
      $validated['circuit_count'] = $validated['circuit_count'] * 2;
    }

    $validated['modified_by'] = auth()->id();

    // dd($validated);

    $panel->update($validated);

    return redirect('/jobs/'.$job->id.'/panels/'.$panel->id);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Job $job, Panel $panel)
  {
    $panel->delete();
    return redirect('/jobs/'.$job->id);
  }
}
