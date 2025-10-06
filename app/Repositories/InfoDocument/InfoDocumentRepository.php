<?php

namespace App\Repositories\InfoDocument;

use App\Repositories\BaseRepository;
use App\Repositories\InfoDocument\InfoDocumentRepositoryInterface as EntityRepositoryInterface;
use App\Models\InfoDocument as Entity;
use App\Filters\InfoDocumentFilter as EntityFilter;

class InfoDocumentRepository extends BaseRepository implements EntityRepositoryInterface
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

    public function typeInfoDocuments($type)
    {
        $query = $this->query()->where(['type' => $type, 'active' => true])->get();
        return $query;
    }
}
