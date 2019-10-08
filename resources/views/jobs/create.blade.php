@extends('layouts.app')

@section('title', ': Jobs')

@section('recentJobs')
@if ($recentJobs->count())
<h6 class="dropdown-header">Recently Modified</h6>
@foreach ($recentJobs as $joblist)
<a class="dropdown-item" href="/jobs/{{ $joblist->id }}">{{ $joblist->name }}</a>
@endforeach
@endif
@endsection

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add a Job</div>
        <form class="" action="/jobs" method="post">
          <div class="card-body">
            @csrf

            <div class="form-group">
              <label for="name">Job Name:</label>
              <input class="form-control" type="text" name="name">
            </div>
            <div class="form-group">
              <label for="comment">Comments:</label>
              <textarea class="form-control" name="comment"></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-success" type="submit">Add this job</button>
            </div>
          </div>
          <div class="card-footer">
            &nbsp;
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
