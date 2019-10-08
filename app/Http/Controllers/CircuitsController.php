<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Panel;
use App\Circuit;
use App\Services\CircuitService;

class CircuitsController extends Controller
{
  protected $circuitService;
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct(CircuitService $circuitService)
  {
    $this->middleware('auth');
    $this->circuitService = $circuitService;
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Job $job, Panel $panel)
  {
    $validated = request()->validate([
      'name' => ['required', 'min:2'],
      'poles' => ['numeric', 'min:1', 'max:3'],
      'circuit_num' => ['required', 'numeric', 'max:'.$panel->circuit_count],
      'ab' => ['boolean'],
    ]);

    $validated['user_id'] = auth()->id();
    $validated['job_id'] = $job['id'];
    $validated['panel_id'] = $panel['id'];
    // dd($validated);
    $circuit = Circuit::create($validated);
    $response = array('status' => 1, 'circuit_id' => $circuit->id);
    // $response = array('status' => 1);
    return response()->json($response);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show()
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit(Job $job, Panel $panel)
  {
    $panel['circuit_count_ab'] = $panel['circuit_count'];
    if ($panel['ab'] == 1) {
      $panel['circuit_count'] = $panel['circuit_count'] / 2;
    }
    $panelCircuits = $panel->circuits->keyBy('circuit_num');

    // dd($panel);

    return view('circuits.edit',compact('job','panel', 'panelCircuits'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Job $job, Panel $panel, Circuit $circuit)
  {
    $validated = request()->validate([
      'name' => ['required', 'min:2'],
      'poles' => ['numeric', 'min:1', 'max:3'],
      'circuit_num' => ['numeric', 'max:'.$panel->circuit_count],
      'ab' => ['boolean'],
    ]);

    $validated['modified_by'] = auth()->id();
    // $validated['job_id'] = $job['id'];
    // $validated['panel_id'] = $panel['id'];
    $validated['id'] = $circuit['id'];
    // dd($validated);
    $circuit->update($validated);
    $response = array('status' => 1);
    return response()->json($response);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Job $job, Panel $panel, Circuit $circuit)
  {
    $circuit->delete();
    $response = array( 'status' => 1);
    return response()->json($response);
  }
}
