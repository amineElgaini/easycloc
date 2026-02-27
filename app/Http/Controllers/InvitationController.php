<?php

namespace App\Http\Controllers;

use App\Mail\ColocationInvitationMail;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Psy\Util\Str;

class InvitationController extends Controller
{
    public function acceptView($token)
    {
        $invitation = \App\Models\Invitation::where('token', $token)->firstOrFail();

        if ($invitation->expires_at->isPast()) {
            return view('invitations.accept', ['error' => 'This invitation has expired.']);
        }

        if ($invitation->is_accepted) {
            return view('invitations.accept', ['error' => 'This invitation has already been accepted.']);
        }

        if (auth()->user()->email !== $invitation->email) {
            return view('invitations.accept', ['error' => 'This invitation was sent to a different email address. Please log in with the correct account.']);
        }

        return view('invitations.accept', compact('invitation'));
    }

    public function accept($token)
    {
        $invitation = \App\Models\Invitation::where('token', $token)->firstOrFail();

        if ($invitation->expires_at->isPast() || $invitation->is_accepted) {
            return back()->with('error', 'Invalid or expired invitation.');
        }

        $colocation = $invitation->colocation;

        // Add user to colocation
        if (!$colocation->members()->where('user_id', auth()->id())->exists()) {
            $colocation->members()->attach(auth()->id());
        }

        // Mark as accepted
        $invitation->update(['is_accepted' => true]);

        return redirect()->route('colocations.show', $colocation->id)
            ->with('success', "Welcome to {$colocation->name}!");
    }

    public function refuse($token)
    {
        $invitation = \App\Models\Invitation::where('token', $token)->firstOrFail();
        $invitation->delete();

        return redirect()->route('colocations.index')
            ->with('success', 'Invitation declined.');
    }
}
