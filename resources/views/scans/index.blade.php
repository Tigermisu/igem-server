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
                <div class="scan-plot" id="plot{{ $scan->id }}">
                </div>
                <a href="#raw{{ $scan->id }}" data-toggle="collapse">Show raw scan data</a>
                <div class="collapse" id="raw{{ $scan->id }}">
                    @foreach($scan->records as $record)
                        <span class="tenth">{{ $record->value }}</span>
                    @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
        @empty
            <h2>There are no uploaded scans yet!</h2>
        @endforelse
    </div>
</div>

<script>
var scanLength = 10,
    sensors = 10;
@foreach($scans as $scan)
var records = [],
    z_data = [];

var layout{{$scan->id}} = {
  title: '{{ $scan->name }}',
  autosize: true,
  margin: {
    l: 35,
    r: 20,
    b: 35,
    t: 40,
  }
};

@foreach($scan->records as $record)
    records.push({{ $record->value }});
@endforeach

var row = [];
for(i = 0; i < records.length; i++) {
    row.push(records[i]);
    if((i+1) % scanLength == 0) {        
        z_data.push(row);
        row = [];
    }
}

var data{{$scan->id}} = [{
           z: z_data,
           type: 'surface'
        }];
  
Plotly.newPlot('plot{{ $scan->id }}', data{{$scan->id}}, layout{{$scan->id}});
@endforeach
</script>
@endsection
