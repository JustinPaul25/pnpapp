<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Print Report</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 1000px;
          margin-left: auto;
          margin-right: auto;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 2px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div class="text-center mb-5 mx-auto" style="width: 500px">
        <p class="text-2xl font-bold">POLICE REPORT</p>
    </div>
    <div class="flex mb-5 w-full">
      <div class="w-1/2">
        <b>Case no. {{$report->id}}</b><br>
        <b>Reporting Officer: {{auth()->user()->first_name.' '.auth()->user()->first_name}}</b><br>
        <b>Incedent: {{$report->crime->type}}</b>
        @if($report->crime->id == 1)
          <br><b>Focus Crime Type: {{$report->focus_crime_type}}</b>
        @endif
      </div>
      <div class="w-1/2">
        <b>Date: {{$report->crime_date}}</b><br>
        <b>Prepared: {{auth()->user()->first_name.' '.auth()->user()->first_name}}</b>
      </div>
    </div>
    <div class="flex content-center mb-5 w-full">
      <img style="margin-left: auto; margin-right:auto" width="150px" src="{{$url}}" alt="">
    </div>
    <div class="mb-5 w-full">
      <b class="text-2xl">Detail of Event</b>
      <br>
      <div style="text-indent: 50px">
        <p>{{$report->event_detail}}</p>
      </div>
    </div>
    <div class="mb-5 w-full">
      <b class="text-2xl">Action Taken</b>
      <br>
      <div style="text-indent: 50px">
        <p>{{$report->action_taken}}</p>
      </div>
    </div>
    <div class="mb-5 w-full">
      <b class="text-2xl">Summary</b>
      <br>
      <div style="text-indent: 50px">
        <p>{{$report->summary}}</p>
      </div>
    </div>
    <div>

    </div>
</body>
</html>