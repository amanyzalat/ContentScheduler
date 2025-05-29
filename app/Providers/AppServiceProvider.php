<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\Base\BaseInterface;
use App\Http\Repositories\Base\BaseRepository;
use App\Http\Repositories\Post\PostInterface;
use App\Http\Repositories\Post\PostRepository;
use App\Http\Repositories\Platform\PlatformInterface;
use App\Http\Repositories\Platform\PlatformRepository;
use App\Http\Repositories\Dashboard\Admin\AdminInterface;
use App\Http\Repositories\Dashboard\Admin\AdminRepository;
use App\Http\Repositories\Dashboard\AdminAuth\AdminAuthInterface;
use App\Http\Repositories\Dashboard\AdminAuth\AdminAuthRepository;




use App\Models\Post;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseInterface::class, BaseRepository::class);
        $this->app->bind(AdminAuthInterface::class, AdminAuthRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(PostInterface::class,PostRepository::class);
         $this->app->bind(PlatformInterface::class,PlatformRepository::class);
        

    }

    /**
     * Bootstrap any application services.
     */
   

    
}