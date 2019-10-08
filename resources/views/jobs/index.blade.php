@extends('layouts.app')

@section('title', ': Jobs')

@section('recentJobs')
@if ($recentJobs->count())
<h6 class="dropdown-header">Recently Modified</h6>
@foreach ($recentJobs as $job)
<a class="dropdown-item" href="/jobs/{{ $job->id }}">{{ $job->name }}</a>
@endforeach
@endif
@endsection

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header h5">Jobs</div>

        @if ($jobs->count())
        <div class="card-body">
          <ul>
            @foreach ($jobs as $job)
            <li><a href="jobs/{{ $job->id }}">{{ $job->name }}</a></li>
            @endforeach
          </ul>
        </div>
        @else
        <div class="card-body">
          <p>No jobs have been added yet!</p>
        </div>
        @endif
        <div class="card-footer">
          <div class="float-right"><a class="btn btn-success" href="/jobs/create">Add job</a></div>
        </div>
      </div>
    </div>
  </div>
@endsection
