@extends('layouts.app')

@section('content')
    <div class="w-full">
        @if(Request::segment(3) == 'print')
            <document :report="{{ json_encode($caseReport) }}"></document>
        @else
            <pdf :report="{{ json_encode($caseReport) }}"></pdf>
        @endif
    </div>
@endsection