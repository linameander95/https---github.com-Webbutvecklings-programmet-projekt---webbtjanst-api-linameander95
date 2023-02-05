<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makeup;
class MakeupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Makeup::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        Return Makeup::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Makeup = Makeup::find($id);
        if($Makeup != null) {
            return $Makeup;
        } else {
            return response()->json([
                'Makeup product not found'
            ], 404);
        }
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
        $Makeup = Makeup::find($id);
        if($Makeup != null) {
            $Makeup->update($request->all());
            return $Makeup;
        } else {
            return response()->json([
                'Makeup product not found'
            ], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Makeup = Makeup::find($id);
        if($Makeup != null) {
            $Makeup->delete();
            return response()->json([
                'Makeup product deleted'
            ]);
        } else {
            return response()->json([
                'Makeup product not found'
            ], 404);
        }
    }
}
