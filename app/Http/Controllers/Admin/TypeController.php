<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Functions\Helper;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    public function typeProject(){
        $types = Type::all();
        return view('admin.types.list',compact('types'));
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
        $exixts = Type::where('name', $request->name)->first();
        if($exixts){
            return redirect()->route('admin.technologies.index')->with('error','Tipo di progetto gia presente');
        }else{
            $new_type = new Type();
            $new_type->name = $request->name;
            $new_type->slug = Helper::generateSlug($request->name,Type::class);
            $new_type->save();
            return redirect()->route('admin.types.index')->with('success','Tipo di progetto salvata con successo');
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
    public function update(Request $request, Type $type)
    {
        $val_data = $request->validate([
            'name' => 'required|min:2|max:100'
        ],
        [
            'name.required' => 'Devi inserire il nome del tipo di progetto',
            'name.min' => 'Il nome del tipo di progetto deve essere minimo 2 caratteri',
            'name.max' => 'Il nome del tipo di progetto deve essere massimo 100 caratteri'
        ]);

        $exixts = Type::where('name', $request->name)->first();
        if($exixts){
            return redirect()->route('admin.types.index')->with('error','Tecnologia già presente');
        }


            $val_data['slug'] = Helper::generateSlug($request->name, Type::class);
            $type->update($val_data);

            return redirect()->route('admin.types.index')->with('success','Tecnologia aggiornata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success','Tecnologia eliminata con successo');
    }
}
