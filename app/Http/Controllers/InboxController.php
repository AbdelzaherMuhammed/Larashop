<?php

namespace App\Http\Controllers;


use App\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {

        $records = Inbox::all();
        return view('myaccount.inbox', compact('records'));
    }

    public function updateInbox(Request $request)
    {
        $mId = $request->msgId;
        $update = Inbox::where('id',$mId);
        $update->update(['status' => '1']);

        if ($update)
        {
            echo 'status updated successfully';
        }
    }
}
