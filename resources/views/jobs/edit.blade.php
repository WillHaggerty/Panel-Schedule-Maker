@extends('layouts.app')

@section('title', ': Edit Job')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add a Job</div>
        <form class="" action="{{ url('/jobs') }}/{{ $job->id }}" method="post">
          <div class="card-body">
            @method('patch')
            @csrf

            <div class="form-group">
              <label for="name">Job Name:</label>
              <input class="form-control" type="text" name="name" value="{{ $job->name }}">
            </div>
            <div class="form-group">
              <label for="comment">Comments:</label>
              <textarea class="form-control" name="comment">{{ $job->comment }}</textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-success" type="submit">Submit changes</button>
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
