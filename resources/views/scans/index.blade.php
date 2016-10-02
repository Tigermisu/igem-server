@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="margin">View Scans</h2>
    {{ $scans->links() }}
    <div class="clearfix"></div>
    <div class="scan-wrapper">
        @forelse($scans as $scan)
            <div class="scan" data-toggle="collapse" data-target="#result{{ $scan->id }}">
                <p class="pull-left">{{ $scan->name }}</p>
                <p class="pull-right">{{ $scan->created_at }}</p>
                <div class="clearfix"></div>
            </div>
            <div class="scan-result collapse" id="result{{ $scan->id }}">
                @foreach($scan->records as $record)
                    <span class="tenth">{{ $record->value }}</span>
                @endforeach
                <div class="clearfix"></div>
            </div>
        @empty
            <h2>There are no uploaded scans yet!</h2>
        @endforelse
    </div>
</div>
@endsection
