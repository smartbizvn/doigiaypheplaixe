<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
# Base
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
# Role & Permission
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
# Article
use App\Repositories\ArticleCategory\ArticleCategoryRepository;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
# Banner
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerRepositoryInterface;
# Menu
use App\Repositories\Menu\MenuRepository;
use App\Repositories\Menu\MenuRepositoryInterface;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        # Base
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
        # Role & Permission
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        # Article
        $this->app->bind(ArticleCategoryRepositoryInterface::class, ArticleCategoryRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        # Banner  
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        # Menu
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
