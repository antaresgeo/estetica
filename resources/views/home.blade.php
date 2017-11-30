@extends('layouts.new.base')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
        </div>
    </div>
    <div class="container">
        <div id="calendar"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
			left: 'promptResource today prev,next',
			center: 'title',
			right: 'timelineDay,timelineThreeDays,agendaWeek,month'
	}})
});
</script>
@endpush
