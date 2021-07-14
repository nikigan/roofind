<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use DebugBar\DebugBar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::query()->userProjects()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request): RedirectResponse
    {

        $validated = $request->validated();
        $data = [];

        if ($request->hasFile('files')) {
            $images = $request->file('files');

            foreach ($images as $image) {
                $name = $image->getClientOriginalName();
                $path = 'uploads/images/' . auth()->id() . '/';
                $image->storeAs($path, $name, 'public');
                $data[] = $path . $name;
            }
        }

        Project::query()->create(
            $validated +
            [
                'creator_id' => auth()->id(),
                'files' => json_encode($data)
            ]);

        return redirect()->route('projects.index')->with('success', __('Проект успешно создан!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
