<?php

namespace App\Providers;

use App\Models\ForumCategory;
use App\Models\ForumPost;
use App\Models\ForumComment;
use App\Models\User;
use App\Observers\ForumCategoryObserver;
use App\Observers\ForumPostObserver;
use App\Observers\ForumCommentObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        ForumPost::observe(ForumPostObserver::class);
        ForumCategory::observe(ForumCategoryObserver::class);
        ForumComment::observe(ForumCommentObserver::class);
        User::observe(UserObserver::class);
    }
}
