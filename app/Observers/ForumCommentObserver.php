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
        //
    }

    /**
     * Handle the forum comment "creating" event.
     *
     * @param  \App\models\ForumComment  $forumComment
     * @return void
     */
    public function creating(ForumComment $forumComment)
    {
        $this->setUser($forumComment);
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

    /**
     * Handle the forum comment "updating" event.
     *
     * @param  \App\models\ForumComment  $forumComment
     * @return void
     */
    public function updating(ForumComment $forumComment)
    {
        $this->setAttrForAnwer($forumComment);
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

    /**
     * set the name of the owner of the comment
     *
     * @param ForumComment $forumComment
     * @return void
     */
    public function setUser(ForumComment $forumComment)
    {
        $forumComment->user_id = auth()->id();
    }

    /**
     * checking for a response from a mutable comment
     *
     * @param ForumComment $forumComment
     * @return void
     */
    private function setAttrForAnwer(ForumComment $forumComment)
    {
        if (!empty($forumComment->getOriginal('post_id_answer'))) {
            $forumComment->post_id_answer = $forumComment->getOriginal('post_id_answer');
        }
    }
}
