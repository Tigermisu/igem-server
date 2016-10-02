@extends('layouts.app')

@section('content')
<div class="centerer">
    <div class="container">
        <div class="row">
            <h2>Good {{ localtime(time(), true)["tm_hour"] >= 12? localtime(time(), true)["tm_hour"] >= 17? "evening":"afternoon":"morning"}}, {{ Auth::user()->name }}! Please choose an option to begin.</h2>
            <div class="col-md-6">
                <a href="{{ route('scan.index') }}" class="nostyleplox">
                    <div class="menu-icon">
                        <img src="{{ asset('img/myxocolor-medium.png') }}" alt="Drawing of a petri dish">
                        <h3>View Scan Diagrams</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('scan.create') }}" class="nostyleplox">
                    <div class="menu-icon">
                        <img src="{{ asset('img/arduino.png') }}" alt="Drawing of an Arduino Uno">
                        <h3>Upload New Scan(s)</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
