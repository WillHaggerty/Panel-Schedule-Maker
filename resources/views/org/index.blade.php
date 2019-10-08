@extends('layouts.app')

@section('title', ': Organization')

@section('recentJobs')
@if ($recentJobs->count())
<h6 class="dropdown-header">Recently Modified</h6>
@foreach ($recentJobs as $job)
<a class="dropdown-item" href="/jobs/{{ $job->id }}">{{ $job->name }}</a>
@endforeach
@endif
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
      <div class="card-header">
        <h4 class="h4">Hello!</h4>
      </div>
      <div class="card-body">
        <p>You have successfully logged in.</p>
      </div>
      @if ($recentJobs->count())
      <div class="card-body">
        <p>Recently Modified</p>
        <ul>
          @foreach ($recentJobs as $job)
          <li><a href="/jobs/{{ $job->id }}">{{ $job->name }}</a></li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card-footer">
        <div class="float-right"><a class="btn btn-success" href="/jobs/create">Add job</a></div>
      </div>
    </div>
  </div>
</div>
@endsection
