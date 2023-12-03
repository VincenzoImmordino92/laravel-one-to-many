<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Functions\Helper;
class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::orderBy('id','desc')->get();
        return view('admin.technologies.index', compact('technologies'));
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
    public function store(Request $request)
    {
        $exixts = Technology::where('name', $request->name)->first();
        if($exixts){
            return redirect()->route('admin.technologies.index')->with('error','Tecnologia gia presente');
        }else{
            $new_technology = new Technology();
            $new_technology->name = $request->name;
            $new_technology->slug = Helper::generateSlug($request->name,Technology::class);
            $new_technology->save();
            return redirect()->route('admin.technologies.index')->with('success','Tecnologia salvata con successo');
        }
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
    public function update(Request $request, Technology $technology)
    {
        $val_data = $request->validate([
            'name' => 'required|min:2|max:100'
        ],
        [
            'name.required' => 'Devi inserire il nome della Tecnologia',
            'name.min' => 'Il nome della Tecnologia deve essere minimo 2 caratteri',
            'name.max' => 'Il nome della Tecnologia deve essere massimo 100 caratteri'
        ]);

        $exixts = Technology::where('name', $request->name)->first();
        if($exixts){
            return redirect()->route('admin.technologies.index')->with('error','Tecnologia già presente');
        }


            $val_data['slug'] = Helper::generateSlug($request->name, Technology::class);
            $technology->update($val_data);

            return redirect()->route('admin.technologies.index')->with('success','Tecnologia aggiornata correttamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success','Tecnologia eliminata con successo');
    }
}
