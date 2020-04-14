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
        $this->setEmailVerificationAdmin($request);
    }

    /**
     * function for flag tracking and verification assignment
     *
     * @param User $request
     * @return void
     */
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

    /**
     * hash new password or appropriate old
     *
     * @param User $request
     * @return void
     */
    public function setPassword(User $request)
    {
        if(!$request->password) {
            $request->password = Hash::make($request->password);
        } else {
            $request->password = $request->getOriginal('password');
        }
    }

    /**
     * set original photo
     *
     * @param User $request
     * @return void
     */
    public function setImage(User $request)
    {
        if (!$request->image)
            $request->image = $request->getOriginal('image');
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
