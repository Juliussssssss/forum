<?php

namespace App\Observers;

use App\models\ForumComment;

class ForumCommentObserver
{
    /**
     * Handle the forum comment "created" event.
     *
     * @param  \App\models\ForumComment  $forumComment
     * @return void
     */
    public function created(ForumComment $forumComment)
    {
    }

    public function creating(ForumComment $forumComment)
    {
        $this->setUser($forumComment);
    }

    public function setUser(ForumComment $forumComment)
    {
        $forumComment->user_id = auth()->id();
    }

    /**
     * Handle the forum comment "updated" event.
     *
     * @param  \App\models\ForumComment  $forumComment
     * @return void
     */
    public function updated(ForumComment $forumComment)
    {

    }

    public function updating(ForumComment $forumComment)
    {

    }

    /**
     * Handle the forum comment "deleted" event.
     *
     * @param  \App\models\ForumComment  $forumComment
     * @return void
     */
    public function deleted(ForumComment $forumComment)
    {
        //
    }

    /**
     * Handle the forum comment "restored" event.
     *
     * @param  \App\models\ForumComment  $forumComment
     * @return void
     */
    public function restored(ForumComment $forumComment)
    {
        //
    }

    /**
     * Handle the forum comment "force deleted" event.
     *
     * @param  \App\models\ForumComment  $forumComment
     * @return void
     */
    public function forceDeleted(ForumComment $forumComment)
    {
        //
    }
}
