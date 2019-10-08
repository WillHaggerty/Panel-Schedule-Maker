@extends('layouts.app')

@section('title', ': Jobs')

@section('panelCreateLink', '/jobs/'.$job->id.'/panels/create')

@section('head-css')
<link href="{{ asset('css/print.css') }}" media="print" rel="stylesheet">
<style media="screen">
  .circuit-td {
    width: 44%;
  }
  .circuit-name {
    width: 38%;
  }
</style>
@endsection

@section('recentJobs')
@if (isset($job))
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
      <div class="card-header">
        <div class="float-left h5 mt-2">{{ $panel->name }}, {{ $job->name }}</div>
        <div class="float-right">
          <a class="btn print-window" style="font-size: 14pt;" href="#">&#128424;</a>
          <a class="btn btn-info" href="/jobs/{{ $job->id }}/panels">Panel List</a>
        </div>
      </div>
      <div class="card-body">
        {!! !empty($panel->info) ? '<div class="float-left">Panel Info: '.$panel->info.'</div>' : '' !!}
        <div class="float-right">
          Number of circuits: {{ $panel->circuit_count }}
        </div>
      </div>
      @if (!empty($panel->comment))
      <div class="card-body">
        <div class="float-left">
          Comments:<br/>
          {!! nl2br(e($panel->comment))!!}
        </div>
      </div>
      @endif
      <div class="card-footer">
        <div class="float-left">
          <a class="btn btn-success" href="/jobs/{{ $job->id }}/panels/{{ $panel->id }}/circuits/edit" role="button">Edit circuits</a>
        </div>
        <div class="float-right">
          <form method="POST" action="/jobs/{{ $job->id }}/panels/{{ $panel->id }}">
            @method('DELETE')
            @csrf
            <a class="btn btn-primary" href="/jobs/{{ $job->id }}/panels/{{ $panel->id }}/edit" role="button">Edit panel</a>
            <button class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this panel? This will also delete ALL associated circuits!')">Delete panel</button>
          </form>
        </div>
      </div>
      <div class="card-body table-responsive panel">
        <table class="table-sm table-bordered" style="width:100%;">
          <tr>
            <th class="text-left lead circuit-td" colspan="{{ $panel->ab == 1 ? '2' : '' }}">{{ $panel->name }}</th>
            <th colspan="2" class="gap"></th>
            <th class="text-right lead circuit-td" colspan="{{ $panel->ab == 1 ? '2' : '' }}">{{ $panel->info }}</th>
            @for ($c = 1, $i = 1; $i <= $panel->circuit_count; $i++)
            <tr>
              @if (!isset($skipCircuits[$c]) && $panel['ab'] == 0)
              <td class="text-right circuit-name" rowspan="{{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles > 1 ? $panelCircuits[$c]->poles : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @elseif (!isset($skipCircuits[$c]) && !empty($panelCircuits[$c+2]['ab']))
              <td class="text-right circuit-name" rowspan="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->poles : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @elseif (!isset($skipCircuits[$c]))
              <td class="text-right circuit-name" rowspan="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->poles * 2 : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @endif
              @if ($panel->ab == 1)
              <td class="text-right circuit-letter">A</td>
              @endif
              @php
              $c++
              @endphp
              <td class="text-center font-weight-bold circuit-numbers" rowspan="{{ $panel->ab == 1 ? '2' : '' }}">{{ $i++ }}</td>
              <td class="text-center font-weight-bold circuit-numbers" rowspan="{{ $panel->ab == 1 ? '2' : '' }}">{{ $i }}</td>
              @if ($panel->ab == 1)
              <td class="circuit-letter">A</td>
              @endif
              @if (!isset($skipCircuits[$c]) && $panel['ab'] == 0)
              <td class="text-left circuit-name" rowspan="{{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles > 1 ? $panelCircuits[$c]->poles : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @elseif (!isset($skipCircuits[$c]) && !empty($panelCircuits[$c+2]['ab']))
              <td class="text-left circuit-name" rowspan="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->poles : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @elseif (!isset($skipCircuits[$c]))
              <td class="text-left circuit-name" rowspan="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->poles * 2 : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @endif
              @php
              $c++
              @endphp
            </tr>
            @if ($panel->ab == 1)
            <tr>
              @if (!isset($skipCircuits[$c]) && !empty($panelCircuits[$c]))
              <td class="text-right circuit-name" rowspan="{{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles > 1 ? $panelCircuits[$c]->poles : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @elseif (!isset($skipCircuits[$c]) && empty($panelCircuits[$c]) && empty($panelCircuits[$c-2]))
              <td></td>
              @endif
              @php
              $c++
              @endphp
              <td class="text-right circuit-letter">B</td>
              <td class="circuit-letter">B</td>
              @if (!isset($skipCircuits[$c]) && !empty($panelCircuits[$c]))
              <td class="text-left circuit-name" rowspan="{{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles > 1 ? $panelCircuits[$c]->poles : '' }}">{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}</td>
              @elseif (!isset($skipCircuits[$c]) && empty($panelCircuits[$c]) && empty($panelCircuits[$c-2]))
              <td></td>
              @endif
              @php
              $c++
              @endphp
            </tr>
            @endif
            @endfor
          </table>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('script')
  <script type="text/javascript">
  window.onload = function () {
    $('.print-window').click(function() {
      window.print();
    });
  }
  </script>
  @endsection
