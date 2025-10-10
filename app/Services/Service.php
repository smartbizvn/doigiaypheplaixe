<?php

namespace App\Services;

use App\Repositories\Menu\MenuRepositoryInterface as EntityRepositoryInterface;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use App\Repositories\Article\ArticleRepositoryInterface;

class Service extends BaseService
{

    public function __construct(EntityRepositoryInterface $entityRepository, BannerRepositoryInterface $bannerRepository, ArticleCategoryRepositoryInterface $articleCategoryRepository, ArticleRepositoryInterface $articleRepository)
    {
        $this->repository = $entityRepository;
        $this->bannerRepository = $bannerRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    public function getMenuItems()
    {
        return $this->repository
            ->with(['children_menus' => function($q) {
                $q->where('active', true)
                  ->orderBy('order', 'asc');
            }])
            ->where('active', true)
            ->whereNull('parent_id')
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getBanners()
    {
        return $this->bannerRepository->lastBanners();
    }

    public function getPages()
    {
        return $this->articleCategoryRepository->lastCategories();
    }

    public function getArticles()
    {
        return $this->articleRepository->lastArticles();
    }
}
