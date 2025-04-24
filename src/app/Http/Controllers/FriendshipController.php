<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function addFriend(User $user)
    {
        if (auth()->id() === $user->id)
        {
            return back()->with('error', 'You cannot add yourself as a friend.');
        }
        $existingFriendship = Friendship::where([
            ['sender_id', auth()->id()],
            ['recipient_id', $user->id],
        ])->orWhere([
            ['sender_id', $user->id],
            ['recipient_id', auth()->id()],
        ])->first();

        if ($existingFriendship)
        {
            return back()->with('error', 'Friendship request already exists.');
        }

        Friendship::create([
            'sender_id'=>auth()->id(),
            'recipient_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Friend request sent!');
    }

    public function acceptFriend(User $user)
    {
        $friendship = Friendship::where([
            ['sender_id', $user->id],
            ['recipient_id', auth()->id()],
            ['status', 'pending']
        ])->firstOrFail();

        $friendship->update(['status', 'accepted']);

        return back()->with('success', 'Friend request accepted!');
    }
    public function declineFriend(User $user)
    {
        $friendship = Friendship::where([
            ['sender_id', $user->id],
            ['recipient_id', auth()->id()],
            ['status', 'pending'],
        ])->firstOrFail();

        $friendship->update(['status' => 'declined']);

        return back()->with('success', 'Friend request declined.');
    }
    public function removeFriend(User $user)
    {
        $friendship = Friendship::where([
            ['sender_id', auth()->id()],
            ['recipient_id', $user->id],
            ['status', 'accepted'],
        ])->orWhere([
            ['sender_id', $user->id],
            ['recipient_id', auth()->id()],
            ['status', 'accepted'],
        ])->firstOrFail();

        $friendship->delete();

        return back()->with('success', 'Friend removed.');
    }
}
