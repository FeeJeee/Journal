<?php

namespace App\Services;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileService
{
    public function userAvatar(User $user, int $width, int $height)
    {
        if(Storage::disk('avatars')->exists($user->id))
        {
            if (Storage::disk('avatars')->exists($user->id.'/'.$user->id.'.'.$user->avatar))
            {
                if (!Storage::disk('avatars')->exists($user->id.'/'.$user->id.'w'.$width.'h'.$height.'.'.$user->avatar))
                {
                    $img = Image::make('storage/avatars/'.$user->id.'/'.$user->id.'.'.$user->avatar);
                    $img->resize($width, $height);
                    $img->save('storage/avatars/'.$user->id.'/'.$user->id.'w'.$width.'h'.$height.'.'.$user->avatar);
                }

                return Storage::url('avatars/'.$user->id.'/'.$user->id.'w'.$width.'h'.$height.'.'.$user->avatar);
            }
        }

        if (!(Storage::disk('avatars')->exists('defaults/'.'w'.$width.'h'.$height.'.jpg')))
        {
            $img = Image::make('storage/avatars/defaults/'.'default.jpg');
            $img->resize($width, $height);
            $img->save('storage/avatars/defaults/'.'w'.$width.'h'.$height.'.jpg');
        }

        return  Storage::url('avatars/defaults/'.'w'.$width.'h'.$height.'.jpg');
    }

    public function uploadAvatar(Request $request)
    {
        if(Storage::disk('avatars')->exists($request->user()->id))
        {
            $this->deleteAvatar($request->user());
        }
        Storage::disk('avatars')->makeDirectory($request->user()->id);

        $request->user()->avatar = $request->avatar->hashName();

        $request->avatar->storeAs($request->user()->id, $request->user()->id.'.'.$request->user()->avatar, 'avatars');
    }

    public function deleteAvatar(User $user)
    {
        Storage::disk('avatars')->deleteDirectory($user->id);
    }

    public function userToPdf(User $user)
    {
        return Pdf::loadView('users.user-pdf', compact('user'))->download('user' . $user->id . '.pdf');
    }
}
