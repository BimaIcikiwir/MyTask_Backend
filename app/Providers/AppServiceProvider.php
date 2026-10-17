<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Period;
use App\Models\Task;
use App\Policies\Admin\TaskPolicy as AdminTaskPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PeriodPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Period::class, PeriodPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Task::class, TaskPolicy::class);
    }
}
