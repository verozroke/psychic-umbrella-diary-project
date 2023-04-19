<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function upload(Request $request, string $user_id) {
        $file = $request->hasFile('thumbnail');
        if($file) {
            $newFile = $request->file('thumbnail');
            // return $newFile->getClientMimeType();
            // return $newFile->getClientOriginalExtension();
            $filepath = $newFile->store('img');
            $person = Person::find(intval($user_id));
            $oldPath = str_replace("http://localhost:8000/storage/", "", $person->image_path);
            $person->image_path = asset('/storage/' . $filepath);
            Storage::delete($oldPath);
            $person->save();
            return response()->json($person);
        }
    }
}
