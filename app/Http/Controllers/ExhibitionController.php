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
            'type_id' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();
        if ($request->hasFile('thumbnail_image')) {
            $formFields['thumbnail_image'] = $request->file('thumbnail_image')->store('thumbnail_image', 'public');
        }

        $newExhibition = Exhibition::create($formFields);

        return redirect('/exhibition/' . $newExhibition->id)->with('message', 'Exhibition Created Successfully');
    }
}
