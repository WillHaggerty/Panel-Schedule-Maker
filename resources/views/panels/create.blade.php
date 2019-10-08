@extends('layouts.app')

@section('title', ': Jobs')

@section('panelCreateLink', '/jobs/'.$job->id.'/panels/create')

@section('recentJobs')
@if ($job)
<h6 class="dropdown-header">This Job</h6>
<a class="dropdown-item" href="/jobs/{{ $job->id }}">{{ $job->name }}</a>
@endif
@if ($recentJobs->count())
<h6 class="dropdown-header">Recently Modified</h6>
@foreach ($recentJobs as $joblist)
<a class="dropdown-item" href="/jobs/{{ $joblist->id }}">{{ $joblist->name }}</a>
@endforeach
@endif
@endsection

@section('recentPanels')
@if ($job->recentPanels->count())
<h6 class="dropdown-header">Recently Modified</h6>
@foreach ($job->recentPanels as $panelList)
<a class="dropdown-item" href="/jobs/{{ $job->id }}/panels/{{ $panelList->id }}">{{ $panelList->name }}</a>
@endforeach
@endif
@endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">{{ $job->name }}: Add a Panel</div>
      <form class="" action="/jobs/{{ $job->id }}/panels" method="post">
        <div class="card-body">
          @csrf

          <div class="form-group">
            <label for="name">Panel Name:</label>
            <input class="form-control" type="text" name="name">
          </div>
          <div class="form-group">
            <label for="name">Panel Info:</label>
            <input class="form-control" type="text" name="info" placeholder="Fed from panel ####">
          </div>
          <div class="form-row">
            <div class="col-auto form-group">
              <label for="name">Number of circuits:</label>
              <input class="form-control" type="number" name="circuit_count">
            </div>
            <div class="col-1">
              &nbsp;
            </div>
            <div class="col-auto form-group">
              <p>Does this panel have mini breakers?</p>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="ab-no" name="ab" class="custom-control-input" value="0" checked>
                <label class="custom-control-label" for="ab-no">No</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="ab-yes" name="ab" class="custom-control-input" value="1">
                <label class="custom-control-label" for="ab-yes">Yes</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="comment">Comments:</label>
            <textarea class="form-control" name="comment"></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit">Add this panel</button>
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
