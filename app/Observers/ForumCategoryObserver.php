<?php

namespace App\Observers;

use App\Models\ForumCategory;

class ForumCategoryObserver
{
    /**
     * Handle the forum category "created" event.
     *
     * @param ForumCategory $forumCategory
     * @return void
     */
    public function created(ForumCategory $forumCategory)
    {
        //
    }

    /**
     * @param ForumCategory $forumCategory
     */
    public function creating(ForumCategory $forumCategory)
    {
        $this->setSlug($forumCategory);
    }

    /**
     * if slug is empy, we will input him
     *
     * @param ForumCategory $forumCategory
     */
    protected function setSlug(ForumCategory $forumCategory)
    {
        if (empty($forumCategory['slug'])) {
            $forumCategory['slug'] = str_slug($forumCategory['title']);
        }
    }

    /**
     * Handle the forum category "updated" event.
     *
     * @param ForumCategory $forumCategory
     * @return void
     */
    public function updated(ForumCategory $forumCategory)
    {
        //
    }

    /**
     * @param ForumCategory $forumCategory
     */
    public function updating(ForumCategory $forumCategory)
    {
        $this->setSlug($forumCategory);
    }

    /**
     * Handle the forum category "deleted" event.
     *
     * @param ForumCategory $forumCategory
     * @return void
     */
    public function deleted(ForumCategory $forumCategory)
    {
        //
    }

    /**
     * Handle the forum category "restored" event.
     *
     * @param ForumCategory $forumCategory
     * @return void
     */
    public function restored(ForumCategory $forumCategory)
    {
        //
    }

    /**
     * Handle the forum category "force deleted" event.
     *
     * @param ForumCategory $forumCategory
     * @return void
     */
    public function forceDeleted(ForumCategory $forumCategory)
    {
        //
    }
}
