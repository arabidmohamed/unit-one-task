<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;



class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $homes = Home::paginate(10);


        return $homes;
        
        // return Home::paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return Home::find($id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {
        //
        return Home::where('description', 'like', '%' . $keyword . '%')->get();
    }
}
