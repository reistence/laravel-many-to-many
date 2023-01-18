<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (count($request->all()) === 0) {
            $projects = Project::all();
        } elseif ($request->has("project_search_title")) {
            // dd($request->all());
            $projects = Project::where("title", "like", "%$request->project_search_title%")->get();
        }
        
        $types = Type::all();
        return view("admin.projects.index", compact("projects", "types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.create", compact("types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // dd($request->validated());
        $data = $request->validated();
        $data["slug"] = Project::generateSlug($data["title"]);
        // $project = new Project();
        // $project->fill($data);
        // $project->save();
        if ($request->hasFile("cover_image")) {
            $path = Storage::put("project_images", $request->cover_image);
            $data["cover_image"] = $path;
        }
        $data["user_id"] = Auth::id();
        $project = Project::create($data);
        // dd($project);

        if($request->has("technologies")){
            $project->technologies()->attach($request->technologies);
        }


        return redirect()->route("admin.projects.index")->with("message", "Your Project has been successfully added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // dd($project->technologies);
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.edit", compact("project", "types", "technologies"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $data["slug"] = Project::generateSlug($data["title"]);

        if ($request->hasFile("cover_image")){
            if($project->cover_image) Storage::delete("project_images", $request->cover_image);
            $path = Storage::put("project_images", $request->cover_image);
            $data["cover_image"] = $path;
        }

        $project->update($data);

        if($request->has("technologies")){
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route("admin.projects.index")->with("message","$project->title has been successfully edited." );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("admin.projects.index")->with("message", "$project->title has been deleted");
    }
}
