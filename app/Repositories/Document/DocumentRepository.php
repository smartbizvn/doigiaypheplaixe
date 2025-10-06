<?php

namespace App\Repositories\Document;

use App\Repositories\BaseRepository;
use App\Repositories\Document\DocumentRepositoryInterface as EntityRepositoryInterface;
use App\Models\Document as Entity;
use App\Filters\DocumentFilter as EntityFilter;

class DocumentRepository extends BaseRepository implements EntityRepositoryInterface
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

    public function documents($req, $limit = 15)
    {
        $query = $this->query()->where('active', true);
        if (!empty($req->keyword)) {
            $query->where(function ($q) use ($req) {
                $q->where('name', 'like', '%' . $req->keyword . '%')
                ->orWhere('no', 'like', '%' . $req->keyword . '%')
                ->orWhere('epitome', 'like', '%' . $req->keyword . '%');
            });
        }

        if (!empty($req->class)) {
            $query->where('class_document', $req->class);
        }

        if (!empty($req->agency)) {
            $query->where('agency_document', $req->agency);
        }

        if (!empty($req->field)) {
            $query->where('field_document', $req->field);
        }

        if (!empty($req->type)) {
            $query->where('type_document', $req->type);
        }
        $query->orderBy('created_at', 'desc');
        return $query->paginate($limit)->appends(request()->all());
    }

    public function detailDocument($id)
    {
        $query = $this->query()->where(['id' => $id, 'active' => true])->first();
        return $query;
    }
}
