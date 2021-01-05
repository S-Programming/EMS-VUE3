<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cico;
use Carbon\Carbon;
use Session; 

class CicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "sadddique";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request)
    {

        $cico = new Cico;
        $cico->checkin = Carbon::now();
        $cico->user_id =  Auth::user()->id ?? 0;
       // dd($cico);
        $cico->save();
        

        return back()->with('success','Data save successfully');
    }
    public function checkout(Request $request)
    {

        $user_id =  Auth::user()->id ?? 0;
        $cico = Cico::where('user_id',$user_id)->first();
        $cico->checkout = Carbon::now();    
        $cico->description = $request->description;
        $cico->save();
        

        return back()->with('success','Data save successfully');
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
