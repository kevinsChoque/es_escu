@extends('layout.layout')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="row m-3">
        {{-- d1 --}}
        @include('report.sections.resumen')
        @include('report.sections.bar1')
        @include('report.sections.barapi1')
        @include('report.sections.d1')
        @include('report.sections.test')

    </div>
    <script>
        $(document).ready(function() {
            $('.overlayPage').css("display", "none");
        });
    </script>
@endsection
