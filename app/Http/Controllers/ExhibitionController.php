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

        $formFields = $request->validated();
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
