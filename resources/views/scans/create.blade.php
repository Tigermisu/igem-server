@extends('layouts.app')

@section('content')
<div class="centerer">
    <div class="container">
        <div class="row">
            <h2>Upload new scan(s)</h2>
            <div class="margin"></div>
            <form class="upload" id="uploadForm" data-url="{{ route('scan.store') }}" method="post">
                {{ csrf_field() }}
                <div class="col-md-6 col-lg-4">
                    <label for="file">File: </label>
                    <input type="file" id="file" name="file" accept=".txt" required>
                </div>
                <div class="col-md-6 col-lg-4">
                    <label for="name">Scan Name: </label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="col-xs-6">
                        <input type="checkbox" id="recurring"> <label for="recurring">Recurrent upload</label>
                    </div>
                    <div class="col-xs-6" id="freqWrapper" style="display: none;">                
                        <label for="frequency">Upload Frequency (m)</label>
                        <input type="number" step="1" id="frequency" min="0" value="10">
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" id="uploadScans">
                        Upload
                    </button>
                </div>
            </form>
            <div class="col-md-12">                
                <button class="btn btn-danger inline" id="cancelRecurring" style="opacity: 0;">
                    Stop Recurring Upload
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="console" id="console">
                    <p class="info"><span class="timestamp">[{{ date('G:i:s') }}]</span> Ready to upload! Select a file above to begin.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
