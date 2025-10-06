<?php

namespace App\Services;

use App\Repositories\Menu\MenuRepositoryInterface as EntityRepositoryInterface;
use App\Repositories\Banner\BannerRepositoryInterface;

class Service extends BaseService
{

    public function __construct(EntityRepositoryInterface $entityRepository, BannerRepositoryInterface $bannerRepository)
    {
        $this->repository = $entityRepository;
        $this->bannerRepository = $bannerRepository;
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
}
