<?php

namespace App\Observers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    protected $answer = true;

    protected $unsetTime = 0;

    protected $setTime = 0;

    public function __construct()
    {
        $this->unsetTime = Carbon::createFromTimestamp(0);
        $this->setTime = Carbon::createFromTimestamp(1);
    }

    public function create(User $request)
    {
        $this->hashPass($request);
    }

    public function hashPass(User $request)
    {

        $request->password = Hash::make($request->password);
    }

    public function creating(User $request)
    {
        $this->setEmailVerification($request);
        $this->hashPass($request);
    }

    public function setEmailVerification(User $request)
    {
        if ($this->unsetTime != $request->email_verified_at) {
            $request->email_verified_at = Carbon::now();
        }
            $request->email_verified_at = Null;
    }

    public function updating(User $request)
    {
        $this->setName($request);
        $this->setEmail($request);
        $this->setImage($request);
        $this->setPassword($request);
        $this->setEmailVerificationAdmin($request);
    }

    public function setEmailVerificationAdmin(User $request)
    {
        if ($this->unsetTime == $request->email_verified_at) {
            $request->email_verified_at = Null;
        } elseif ($this->setTime == $request->email_verified_at && empty($request->email_verified_at)) {
            $request->email_verified_at = Carbon::now();
        } else {
            $request->email_verified_at = $request->getOriginal('email_verified_at');
        }
    }

    public function setPassword(User $request)
    {
        if(!$request->password) {
            $request->password = $request->getOriginal('password');
        } else {
            $this->hashPass($request);
        }
    }

    public function setImage(User $request)
    {
        if (!$request->image)
            $request->image = $request->getOriginal('image');
    }

    public function setName(User $request)
    {
        if (strlen($request->name)<=5 && strlen($request->name)!= 0) {
            $this->answer = false;
            return back()
                ->withErrors(['1' => 'Имя короче 5 символов']);
        }
         if (!$request->name)
             $request->name = $request->getOriginal('name');
    }

    public function setEmail(User $request)
    {
        if (!$request->email)
            $request->email = $request->getOriginal('email');
        else $request->email_verified_at = null;
    }
}
