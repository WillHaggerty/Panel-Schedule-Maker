@extends('layouts.app')

@section('title', ': Editing Panel Circuits')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="float-left h5 mt-2">Editing: {{ $panel->name }}, {{ $job->name }}</div>
          <div class="float-right"><a href="../" class="btn btn-primary">Done</a></div>
        </div>
        <div class="table-responsive">
          <table class="table-sm table-bordered" style="width:100%;">
            @for ($a = 1, $b = $panel->circuit_count_ab + 1, $c = 1, $i = 1; $i <= $panel->circuit_count; $i++)
            <tr>
              <td>
                <form class="{{ isset($panelCircuits[$c]) ? 'update' : 'create' }}" action="/jobs/{{ $job->id }}/panels/{{ $panel->id }}/circuits/{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->id : 'create' }}" method="post">
                  <div class="form-group row">
                    @if (isset($panelCircuits[$c]))
                    @method('patch')
                    @endif
                    @csrf
                    <input type="hidden" name="circuit_num" value="{{ $c }}">
                    <div class="col-md-3">
                      <select class="form-control custom-select mr-sm-2" name="poles" id="{{ $c }}" tabindex="{{ $a++ }}">
                        @for ($s = 1;$s <= 3; $s++)
                        <option value="{{ $s }}" {{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles == $s ? 'selected' : '' }}>{{ $s }} pole</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col-md-7">
                      <input name="name" type="text" class="form-control" value="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}" id="{{ $c++ }}c" tabindex="{{ $a++ }}">
                    </div>
                  </div>
                </form>
              </td>
              @if ($panel->ab == 1)
              <td class="text-right">A</td>
              @endif
              <td class="text-center" rowspan="{{ $panel->ab == 1 ? '2' : '' }}">{{ $i++ }}</td>
              <td class="text-center" rowspan="{{ $panel->ab == 1 ? '2' : '' }}">{{ $i }}</td>
              @if ($panel->ab == 1)
              <td>A</td>
              @endif
              <td>
                <form class="{{ isset($panelCircuits[$c]) ? 'update' : 'create' }}" action="/jobs/{{ $job->id }}/panels/{{ $panel->id }}/circuits/{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->id : 'create' }}" method="post">
                  <div class="form-group row">
                    @if (isset($panelCircuits[$c]))
                    @method('patch')
                    @endif
                    @csrf
                    <input type="hidden" name="circuit_num" value="{{ $c }}">
                    <div class="col-md-7">
                      <input name="name" type="text" class="form-control" value="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}" id="{{ $c }}c" tabindex="{{ $b++ }}">
                    </div>
                    <div class="col-md-3">
                      <select class="form-control custom-select mr-sm-2" name="poles" id="{{ $c }}" tabindex="{{ $b++ }}">
                        @for ($s = 1;$s <= 3; $s++)
                        <option value="{{ $s }}" {{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles == $s ? 'selected' : '' }}>{{ $s }} pole</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  @php
                  $c++
                  @endphp
                </form>
              </td>
            </tr>
            @if ($panel->ab == 1)
            <tr>
              <td><form class="{{ isset($panelCircuits[$c]) ? 'update' : 'create' }}" action="/jobs/{{ $job->id }}/panels/{{ $panel->id }}/circuits/{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->id : 'create' }}" method="post">
                <div class="form-group row">
                  @if (isset($panelCircuits[$c]))
                  @method('patch')
                  @endif
                  @csrf
                  <input type="hidden" name="circuit_num" value="{{ $c }}">
                  <input type="hidden" name="ab" value="1">
                  <div class="col-md-3">
                    <select class="form-control custom-select mr-sm-2" name="poles" id="{{ $c }}" tabindex="{{ $a++ }}">
                      @for ($s = 1;$s <= 2; $s++)
                      <option value="{{ $s }}" {{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles == $s ? 'selected' : '' }}>{{ $s }} pole</option>
                      @endfor
                    </select>
                  </div>
                  <div class="col-md-7">
                    <input name="name" type="text" class="form-control" value="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}" id="{{ $c++ }}c" tabindex="{{ $a++ }}">
                  </div>
                </div>
              </form></td>
              <td class="text-right">B</td>
              <td>B</td>
              <td><form class="{{ isset($panelCircuits[$c]) ? 'update' : 'create' }}" action="/jobs/{{ $job->id }}/panels/{{ $panel->id }}/circuits/{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->id : 'create' }}" method="post">
                <div class="form-group row">
                  @if (isset($panelCircuits[$c]))
                  @method('patch')
                  @endif
                  @csrf
                  <input type="hidden" name="circuit_num" value="{{ $c }}">
                  <input type="hidden" name="ab" value="1">
                  <div class="col-md-7">
                    <input name="name" type="text" class="form-control" value="{{ isset($panelCircuits[$c]) ? $panelCircuits[$c]->name : '' }}" id="{{ $c }}c" tabindex="{{ $b++ }}">
                  </div>
                  <div class="col-md-3">
                    <select class="form-control custom-select mr-sm-2" name="poles" id="{{ $c }}" tabindex="{{ $b++ }}">
                      @for ($s = 1;$s <= 2; $s++)
                      <option value="{{ $s }}" {{ isset($panelCircuits[$c]) && $panelCircuits[$c]->poles == $s ? 'selected' : '' }}>{{ $s }} pole</option>
                      @endfor
                    </select>
                  </div>
                </div>
                @php
                $c++
                @endphp
              </form></td>
            </tr>
            @endif
            @endfor
          </table>
        </div>
        <div class="card-footer">
          <div class="float-right"><a href="../" class="btn btn-primary">Done</a></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
<div class="modal"></div>
@endsection

@section('script')
<script type="text/javascript">
window.onload = function () {
  $('form').submit(function (event) {
    event.preventDefault();
  });
  $('.form-control').on("change", function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    var form = $(this).closest('form');
    var oldText = form.find('input[name="name"]').val();

    if (form.hasClass('update') && !oldText.length) {
      $.ajax({
        url: form.attr('action'),
        method: 'delete',
        data: form.serialize(),
        success: function(response) {
          form.toggleClass('update create');
          form.attr('action', "/jobs/{{ $job->id }}/panels/{{ $panel->id }}/circuits/create");
          console.log("Successfully deleted");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Something went wrong');
          }
        });
    } else if (form.hasClass('update')) {
      $.ajax({
        url: form.attr('action'),
        method: 'patch',
        data: form.serialize(),
        success: function(response) {
          console.log("Successfully updated");
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log('Something went wrong');
        }
      });
      } else if (form.hasClass('create') && oldText.length) {
        $.ajax({
          url: form.attr('action'),
          method: 'post',
          data: form.serialize(),
          success: function(response) {
              form.toggleClass('create update');
              form.attr('action', "/jobs/{{ $job->id }}/panels/{{ $panel->id }}/circuits/" + response['circuit_id']);
              console.log(response['circuit_id']);
            },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('Something went wrong');
          }
        })};
        return false;
      });
      $("a.btn-primary[href]").click(function(e){
        e.preventDefault();
        $(this).addClass('disabled');
        $body = $("body");
        $body.addClass("loading");
        if (this.href) {
          var target = this.href;
          setTimeout(function(){
            window.location = target; },
            1400);
          }
        });
        $body = $("body");
        $(document).on({
          ajaxStart: function() { $body.addClass("loading");},
          ajaxStop: function() { $body.removeClass("loading"); }
        });
      }
</script>
@endsection
