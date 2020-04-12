<?php

namespace App\Observers;

use App\Models\ForumPost;
use Carbon\Carbon;

class ForumPostObserver
{
    /**
     * Handle the forum post "created" event.
     *
     * @param ForumPost $forumPost
     * @return void
     */
    public function created(ForumPost $forumPost)
    {

    }

    /**
     * @param ForumPost $forumPost
     */
    public function creating(ForumPost $forumPost)
    {
        $this->setPublishedAt($forumPost);
        $this->setSlug($forumPost);
        $this->setHtml($forumPost);
        $this->setUser($forumPost);
        if ($forumPost->category_id == 1) {
            return false;
        };
    }

    /*
     * set content HTML regaeding content row
     *
     * @param ForumPost $forumPost
     */
    protected function setHtml(ForumPost $forumPost)
    {
        if ($forumPost->isDirty('content_row')) {
            $forumPost->content_html = $forumPost->content_row;
        }
    }

    protected function setUser(ForumPost $forumPost)
    {
        $forumPost->user_id = auth()->id() ?? ForumPost::UNKNOWN_USER;
    }

    /**
     * Handle the forum post "updated" event.
     *
     * @param ForumPost $forumPost
     * @return void
     */
    public function updated(ForumPost $forumPost)
    {
    }

    public function updating(ForumPost $forumPost)
    {
        $this->checkChangeCategory($forumPost);
        $this->setPublishedAt($forumPost);
        $this->setSlug($forumPost);
    }

    protected function checkChangeCategory(ForumPost $forumPost)
    {
        if (!auth()->user()->is_admin) {
            $forumPost->category_id = $forumPost->getOriginal('category_id');
        }
    }

    /**
     * if post is publihsed - set data when we do it
     *
     * @param ForumPost $forumPost
     */
    protected function setPublishedAt(ForumPost $forumPost)
    {
        if (empty($this->published_at) &&  $forumPost['is_published']) {
            $forumPost['published_at'] = Carbon::now();
        } else {
            $forumPost['published_at'] = NULL;
        }
    }

    /**
     * if slug empty set convertation of title
     *
     * @param ForumPost $forumPost
     */
    protected function setSlug(ForumPost $forumPost)
    {
        if (empty($forumPost['slug'])) {
            $forumPost['slug'] = str_slug($forumPost['title']);
        }
    }
    /**
     * Handle the forum post "deleted" event.
     *
     * @param ForumPost $forumPost
     * @return void
     */
    public function deleted(ForumPost $forumPost)
    {
        //
    }

    /**
     * Handle the forum post "restored" event.
     *
     * @param ForumPost $forumPost
     * @return void
     */
    public function restored(ForumPost $forumPost)
    {
        //
    }

    /**
     * Handle the forum post "force deleted" event.
     *
     * @param ForumPost $forumPost
     * @return void
     */
    public function forceDeleted(ForumPost $forumPost)
    {
        //
    }
}
