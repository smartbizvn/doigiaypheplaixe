<?php

namespace App\Repositories\Banner;

use App\Repositories\BaseRepository;
use App\Repositories\Banner\BannerRepositoryInterface as EntityRepositoryInterface;
use App\Models\Banner as Entity;
use App\Filters\BannerFilter as EntityFilter;

class BannerRepository extends BaseRepository implements EntityRepositoryInterface
{
    public function __construct(Entity $entity)
    {
        parent::__construct($entity);
    }

    public function list($request)
    {
        $query = $this->query();
        $params = $request->query();

        $summaryParams = collect($params)->except('status')->toArray();
        $summaryQuery = $this->filter(clone $query, $summaryParams, EntityFilter::class);

        $summary = [
            'total' => (clone $summaryQuery)->count(),
            'active' => (clone $summaryQuery)->where('active', true)->count(),
            'inactive' => (clone $summaryQuery)->where('active', false)->count()
        ];

        $filterQuery = $this->filter($query, $params, EntityFilter::class);
        $paginate = $this->paginate($filterQuery);

        return [$paginate, $summary];
    }

    public function lastBanners()
    {
        $query = $this->query()->where(['active' => true])->orderBy('created_at', 'desc')->get();
        return $query;
    }
}
