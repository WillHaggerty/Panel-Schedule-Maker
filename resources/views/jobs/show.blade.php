@extends('layouts.app')

@section('title', ': Jobs')

@section('panelCreateLink', url('/jobs').'/'.$job->id.'/panels/create')

@section('recentJobs')
@if ($recentJobs->count())
<h6 class="dropdown-header">Recently Modified</h6>
@foreach ($recentJobs as $joblist)
<a class="dropdown-item" href="{{ url('/jobs') }}/{{ $joblist->id }}">{{ $joblist->name }}</a>
@endforeach
@endif
@endsection

@section('recentPanels')
@if ($job->recentPanels->count())
<h6 class="dropdown-header">Recently Modified</h6>
@foreach ($job->recentPanels as $panelList)
<a class="dropdown-item" href="{{ url('/jobs') }}/{{ $job->id }}/panels/{{ $panelList->id }}">{{ $panelList->name }}</a>
@endforeach
@endif
@endsection

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="float-left h5 mt-2">Job: {{ $job->name }}</div>
          <div class="float-right"><a class=" btn btn-info" href="{{ url('/jobs') }}">Job List</a></div>
        </div>
        @if (!empty($job->comment))
        <div class="card-body">
          <p>{{ $job->comment }}</p>
        </div>
        @endif

        @if ($job->panels->count())
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach ($job->panels as $panel)
            <li class="list-group-item"><a href="{{ url('/jobs') }}/{{ $job->id }}/panels/{{ $panel->id }}">{{ $panel->name }}</a>{{ empty($panel->info) ? '' : ': '.$panel->info }}</li>
            @endforeach
          </ul>
        </div>
        @else
        <div class="card-body">
          <p>No panels have been added yet.</p>
        </div>
        @endif
        <div class="card-footer">
          <div class="float-left">
            <a class="btn btn-success" href="{{ url('/jobs') }}/{{ $job->id }}/panels/create" role="button">Add panel</a>
          </div>
          <div class="float-right">
            <form method="POST" action="{{ url('/jobs') }}/{{ $job->id }}">
              @method('DELETE')
              @csrf
              <a class="btn btn-primary" href="{{ url('/jobs') }}/{{ $job->id }}/edit" role="button">Edit job</a>
              <button class="btn btn-danger" onClick="return confirm('Are you sure you wan to delete this job? This will also delete ALL associated panels!')">Delete job</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
