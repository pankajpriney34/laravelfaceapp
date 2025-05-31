<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('id', '!=', auth()->id())
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")->orWhere('email', 'like', "%{$query}%");
                   })->get();

        return view('users.index', compact('users', 'query'));
    }

    public function sendFriendRequest($id)
    {
        $receiver = User::findOrFail($id);

        // check duplicate request sent
        $alreadySent = FriendRequest::where('sender_id', Auth::id())->where('receiver_id', $receiver->id)->exists();

        if ($alreadySent) {
            return back()->with('info', 'Friend request already sent.');
        }

        FriendRequest::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->id,
        ]);

        // Send email to receiver but on local we not getting actual we just loggin n laravel.log file

        Mail::raw(Auth::user()->name . " has sent you a friend request!", function ($message) use ($receiver) {
            $message->to($receiver->email)->subject('New Friend Request');
        });

        return back()->with('success', 'Friend request sent!');
    }

    public function pendingRequests()
    {
        $pendingRequests = FriendRequest::where('receiver_id', Auth::id())->with('sender')->get();
        return view('friend_requests.pending', compact('pendingRequests'));
    }

    public function acceptRequest($id)
    {
        $request = FriendRequest::where('id', $id)->where('receiver_id', Auth::id())->firstOrFail();
        // Attach both users as friends
        Auth::user()->friends()->attach($request->sender_id);
        $request->sender->friends()->attach(Auth::id());
        $request->delete();
        return redirect()->back()->with('message', 'Friend request accepted.');
    }

    public function viewProfile($id)
    {
        $profileUser = User::findOrFail($id);
        // Ensure they're friends
        if (!Auth::user()->friends->contains($profileUser->id)) {
            abort(403, 'You are not friends with this user.');
        }
        $mutualFriends = Auth::user()->mutualFriendsWith($profileUser);
        return view('profile.show', compact('profileUser', 'mutualFriends'));
    }


}
