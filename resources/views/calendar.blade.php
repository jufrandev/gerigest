@extends('layouts.app')
@php
    $title = 'Calendario';
@endphp
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card m-10">
                <div class="card-header">
                    <h4>Calendario</h4>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

