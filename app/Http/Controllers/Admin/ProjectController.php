<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Functions\Helper;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id','desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Inserimento nuovo Progetto';
        $method = 'POST';
        $route = route('admin.projects.store');
        $project= null;
        $types = Type::all();
        return view('admin.projects.create-edit', compact('title','method','route','project','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data_project = $request->all();

        $form_data_project['slug'] = Helper::generateSlug($form_data_project['title'],Project::class);
     /*    $form_data_project['start_date'] = date('Y-m-d');
        $form_data_project['end_date'] = date('Y-m-d'); */

        //se esiste la chiave image salvo l'immagine nel file system e nel database
        if(array_key_exists('image',$form_data_project)){
            //prima di salvare il file prendo il nome del file per salvarlo nel db
            $form_data_project['image_original_name'] = $request->file('image')->getClientOriginalName();
            //salvo il file nello storage rinominandolo
            $form_data_project['image']  = Storage::put('uploads',$form_data_project['image']);
        }

        $new_project= Project::create($form_data_project);
        return redirect()->route('admin.projects.show', $new_project);

        /*
        $form_new_project = new Project();



        $form_new_project->fill($form_data_project);

        $form_new_project->save();

        return redirect()->route('admin.projects.show', $form_new_project); */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $title = 'Modifica Progetto';
        $method = 'PUT';
        $route = route('admin.projects.update', $project);
        $types = Type::all();
        return view('admin.projects.create-edit', compact('title','method','route','project','types'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_modifica_data = $request->all();

        if($form_modifica_data['title'] != $project->title){
            $form_modifica_data['slug'] = Helper::generateSlug($form_modifica_data['title'], Project::class);
        }else{
            $form_modifica_data['slug'] = $project->slug;
        }

        if(array_key_exists('image',$form_modifica_data)){
        // se esiste la chiave image svuol dire che devo sostituire l'immagine presente (se c'è) eliminando quella vecchia
            if($project->image){
                //se era presente la elimino dallo storage
                Storage::disk('public')->delete($project->image);
            }
            //prima di salvare il file prendo il nome del file per salvarlo nel db
            $form_modifica_data['image_original_name'] = $request->file('image')->getClientOriginalName();
            //salvo il file nello storage rinominandolo
            $form_modifica_data['image']  = Storage::put('uploads',$form_modifica_data['image']);
        }

     /*    $form_modifica_data['start_date'] = date('Y-m-d');
        $form_modifica_data['end_date'] = date('Y-m-d'); */

        $project->update($form_modifica_data);
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //se il post contiene un immagine vuol dire che la devo eliminare
        if($project->image){
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted','Progetto Eliminato Correttamente');
    }
}
