<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Scan;
use App\Record;
use Validator;

class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('scans.index', ['scans' => Scan::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|array',
            'name' => 'required|max:255'
        ], [
            'file.array' => "The file is not valid",
            'name.required' => "A name is required",
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400)
                    ->withHeaders([
                        'Content-Type' => "application/json",
            ]);
        }

        $scan = new Scan;

        $scan->name = $request->name;

        $scan->save();

        foreach($request->file as $value) {
                $record = new Record;
                $record->value = $value;
                $record->scan_id = $scan->id;
                $record->save();               
        }

        return response('true', 200)
                    ->withHeaders([
                        'Content-Type' => "application/json",
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
