<?php

namespace App\Observers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Handle the user "created" event.
     *
     * @param User $request
     * @return void
     */
    public function created(User $request)
    {
        $this->hashPass($request);
    }

    /**
     * Handle the user "creating" event.
     *
     * @param User $request
     * @return void
     */
    public function creating(User $request)
    {
        $this->setEmailVerification($request);
        $this->hashPass($request);
    }

    /**
     * Handle the user "updating" event.
     *
     * @param User $request
     * @return void
     */
    public function updating(User $request)
    {
        $this->setImage($request);
        $this->setPassword($request);
        $this->setEmail($request);
    }

    /**
     * function for flag tracking and verification assignment
     *
     * @param User $request
     * @return void
     */
    public function setEmail(User $request)
    {
        if ($this->unsetTime == $request->email_verified_at) {
            $request->email_verified_at = Null;
        } elseif ($this->setTime == $request->email_verified_at) {
            $request->email_verified_at = Carbon::now();
        }
    }

    /**
     * hash new password or appropriate old
     *
     * @param User $request
     * @return void
     */
    public function setPassword(User $request)
    {
        if(!$request->password) {
            $this->hashPass($request);
        } else {
            $request->password = $request->getOriginal('password');
        }
    }

    /**
     * hash user pass
     *
     * @param User $request
     * @return void
     */
    public function hashPass(User $request) {
        $request->password = Hash::make($request->password);
    }


    /**
     * set original photo
     *
     * @param User $request
     * @return void
     */
    public function setImage(User $request)
    {
        if ($request->image != $request->getOriginal('image') && $request->getOriginal('image') != 'uploads/userPhoto/WdkIpFiOsffpObNNkH2M7UZ6cnGFk6g71nkq9Yos.png')
        {
            Storage::disk('public')->delete($request->getOriginal('image'));
        }
    }

    /**
     * change verification attribute for new email
     *
     * @param User $request
     * @return void
     */
    public function setEmailVerification(User $request)
    {
        if ($this->unsetTime != $request->email_verified_at) {
            $request->email_verified_at = Carbon::now();
        }
        $request->email_verified_at = Null;
    }

}
