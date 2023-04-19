<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getAllMessages() {
        return response()->json([Message::all()]);
    }
    public function updateMessageText(Request $request, string $id) {
        $message = Message::find(intval($id));
        $message->text = $request->text;
        $message->save();
        return response()->json(['success']);
    }
    public function delete(Request $request, string $id) {
        $message = Message::find(intval($id));
        $message->delete();
        return response()->json(['success']);
    }
}
