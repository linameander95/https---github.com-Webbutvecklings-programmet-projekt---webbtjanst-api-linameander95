<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skincare;
class SkincareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Skincare::all();
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

        Return Skincare::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skincare = Skincare::find($id);
        if($skincare != null) {
            return $skincare;
        } else {
            return response()->json([
                'Skincare product not found'
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
        $skincare = Skincare::find($id);
        if($skincare != null) {
            $skincare->update($request->all());
            return $skincare;
        } else {
            return response()->json([
                'Skincare product not found'
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
        $skincare = Skincare::find($id);
        if($skincare != null) {
            $skincare->delete();
            return response()->json([
                'Skincare product deleted'
            ]);
        } else {
            return response()->json([
                'Skincare product not found'
            ], 404);
        }
    }
}
