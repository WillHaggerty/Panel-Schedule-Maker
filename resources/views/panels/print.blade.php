<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSRF Token -->

  <title>Printing {{ $panel->name }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
  nav {
    margin-bottom: 40px;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="float-left h5 mt-2">{{ $panel->name }}, {{ $job->name }}</div>
            <div class="float-right">
              <a class="btn" style="font-size: 14pt;" href="#">&#128424;</a>
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
          <div class="card-body">
            <div class="table-responsive">
              <table class="table-sm table-bordered" style="width:100%;">
                @for ($i = 1; $i <= $panel->circuit_count; $i++)
                <tr>
                  @if (!isset($skipCircuits[$i]))
                  <td class="text-right" style="width: 44%;" rowspan="{{ isset($panelCircuits[$i]) && $panelCircuits[$i]->poles > 1 ? $panelCircuits[$i]->poles : '' }}">{{ isset($panelCircuits[$i]) ? $panelCircuits[$i]->name : '' }}</td>
                  @endif
                  <td class="text-center">{{ $i++ }}</td>
                  <td class="text-center">{{ $i }}</td>
                  @if (!isset($skipCircuits[$i]))
                  <td class="text-left" style="width: 44%;" rowspan="{{ isset($panelCircuits[$i]) && $panelCircuits[$i]->poles > 1 ? $panelCircuits[$i]->poles : '' }}">{{ isset($panelCircuits[$i]) ? $panelCircuits[$i]->name : '' }}</td>
                  @endif
                </tr>
                @endfor
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
