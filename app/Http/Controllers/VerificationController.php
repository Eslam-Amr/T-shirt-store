<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// In app/Http/Controllers/VerificationController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            // Invalid verification link
            abort(404);
        }
// $user->update(['email_verified_at' => date('Y-m-d H:i:s')]);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect('/home'); // Redirect to a suitable page after verification
    }
}
