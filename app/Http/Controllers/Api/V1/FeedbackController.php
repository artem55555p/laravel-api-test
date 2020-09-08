<?php

namespace App\Http\Controllers\Api\V1;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class FeedbackController extends Controller
{

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'message' => 'required'
        ]);

        $message = new Message([
            'name' => $request->get('name'),
            'message' => $request->get('message'),
        ]);
        $message->save();

        SendEmail::dispatch($message);

        return response()->json(['status' => 'Ваше сообщение успешно отправлено'], 200);
    }
}
