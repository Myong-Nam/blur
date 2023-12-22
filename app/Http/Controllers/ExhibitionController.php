<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use App\Models\Type;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{

    public function create()
    {
        return view('create', [
            'types' => Type::all(),
        ]);
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|after_or_equal:start_date',
            'tags' => 'required',
            'type_id' => 'required|integer',
            'museum' => 'required',

        ], [
            'title.required' => 'The title field is required',
            'description.required' => 'The description field is required',
            'location.required' => 'The location field is required',
            'start_date.required' => 'The start date field is required',
            'end_date.after_or_equal:start_date' => 'The end date must not be earlier than the start date.',
            'tags.required' => 'The tags field is required',
            'type_id.integer' => 'The category field is required.',
            'museum' => 'The museum field is required.',
        ]);
        $formFields['views'] = 0;
        $formFields['user_id'] = auth()->id();
        if ($request->hasFile('thumbnail_image')) {
            $formFields['thumbnail_image'] = $request->file('thumbnail_image')->store('exhibition_images', 'public');
        }

        $newExhibition = Exhibition::create($formFields);

        return redirect('/exhibition/' . $newExhibition->id)->with('message', 'Exhibition Created Successfully');
    }
    public function show(Exhibition $exhibition)
    {
        if ($exhibition) {
            return view('exhibition', ['exhibition' => $exhibition]);
        } else {
            abort('404');
        }
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
