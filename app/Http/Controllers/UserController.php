<?php

namespace App\Http\Controllers;

use App\Mail\EmailChangeVerification;
use App\Models\User;
use App\Models\UserImage;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        return $this->userService = $userService;
    }

    public function changeEmailForm(User $user)
    {
        $verificationCode = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $user->email_verification_code = $verificationCode;
        $user->email_verification_expires_at = now()->addMinutes(30);
        $user->save();

        $mailable = new EmailChangeVerification(['verificationCode' => $user->email_verification_code]);
        Mail::to($user->email)->send($mailable);

        return redirect()->route('change.email.form');
    }

    public function showChangeEmailForm(User $user)
    {
        return view('auth.change-email');
    }

    public function changeEmail(Request $request)
    {
        $user_auth = Auth::user();
        $user = User::where('id', $user_auth['id'])->first();

        $request->validate([
            'new_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);

        $data = $request->all();

        if ($data['email_verification_code'] == $user->email_verification_code && now() < $user->email_verification_expires_at) {
            $user->email = $request->input('new_email');
            $user->save();

            return view('auth.passwords.confirm-change-email');
        }

        return redirect()->back()->with('error', 'Something went wrong!');
    }

    public function showProfile($userId)
    {
        $user = $this->userService->getUser($userId);
        return view('auth.profile', ['user' => $user]);
    }

    public function showAddImagesForm()
    {
        return view('pages.profile.user-images-form');
    }

    public function addImages(Request $request)
    {
        $request->validate([
            'user_images.*' => 'image|mimes:jpeg,png,svg,pdf|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('user_images')) {
            foreach ($request->file('user_images') as $file) {
                $imagePath = $file->store('user_images', 'public');

                $userImage = new UserImage([
                    'image' => $imagePath,
                ]);

                $user->userImages()->save($userImage);
            }
        }

        return redirect()->route('profile', $user->id);
    }
}
