<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionFormRequest;
use App\Models\Exhibition;
use App\Models\Type;

class ExhibitionController extends Controller
{

    public function create()
    {
        return view('create', [
            'types' => Type::all(),
        ]);
    }

    public function store(ExhibitionFormRequest $request)
    {

        $validatedData = $request->validated();

        // Set views and user_id directly
        $validatedData['views'] = 0;
        $validatedData['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('thumbnail_image')) {
            // Consider error handling for file storage
            $thumbnailPath = $request->file('thumbnail_image')->store('exhibition_images', 'public');
            if ($thumbnailPath) {
                $validatedData['thumbnail_image'] = $thumbnailPath;
            }
        }

        $newExhibition = Exhibition::create($validatedData);

        return redirect()->route('exhibition.show', $newExhibition->id)
            ->with('message', 'Exhibition Created Successfully');
    }

    public function show(Exhibition $exhibition)
    {
        // add more view
        $exhibition->views += 1;

        // save in db
        $exhibition->save();

        return view('exhibition', ['exhibition' => $exhibition]);
    }

    public function destroy(Exhibition $exhibition)
    {
        //Make sure logged in user is owner
        if ($exhibition->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $exhibition->delete();
        return redirect('/myexhibitions/manage')->with('message', 'Exhibition Deleted successfully');
    }

    public function manage()
    {
        return view('my-exhibitions', ['exhibitions' => auth()->user()->exhibitions()->get()]);
    }

}
