<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function create(Request $request) {
        Person::create([
            'nickname' => $request->nickname,
            'image_path' => 'temp'
        ]);
    }
    public function get(Request $request, string $id) {
        $person = Person::find(intval($id));
        // $person->image_path = asset('/storage/' . $person->image_path);
        return response()->json($person);
    }
    public function updateName(Request $request) {
        $person = Person::find($request->id);
        $person->nickname = $request->nickname;
        $person->save();
        return response()->json(['success']);
    }
}
