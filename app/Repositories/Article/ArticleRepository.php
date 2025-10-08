<?php

namespace App\Repositories\Article;

use App\Repositories\BaseRepository;
use App\Repositories\Article\ArticleRepositoryInterface as EntityRepositoryInterface;
use App\Models\Article as Entity;
use App\Filters\ArticleFilter as EntityFilter;

class ArticleRepository extends BaseRepository implements EntityRepositoryInterface
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

    public function detailArticle($slug)
    {
        $query = $this->query()->where(['slug' => $slug, 'active' => true])->first();
        return $query;
    }

    public function relativeArticles($articleId, $categoryArticleId)
    {
        return $this->query()
        ->where('active', true)
        ->where('category_id', $categoryArticleId)
        ->where('id', '<>', $articleId)
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
    }

    public function featureArticles()
    {
        $query = $this->query()->where(['feature' => true, 'active' => true])->orderBy('created_at', 'desc')->limit(9) ->get();
        return $query;
    }

    public function lastArticles()
    {
        $query = $this->query()->where(['active' => true])->orderBy('created_at', 'desc')->limit(6) ->get();
        return $query;
    }

    public function getArticleByCategoriesId($categoriesId, $limit = 0, $paginate = false)
    {
        $query = $this->query()
            ->where(['active' => true])
            ->whereIn('category_id', (array) $categoriesId)
            ->orderBy('created_at', 'desc');
        
        if ($paginate) {
            return $query->paginate($limit > 0 ? $limit : 15)->appends(request()->all()); 
        }
        if ($limit > 0) {
            $query->limit($limit);
        }
        return $query->get();
    }

    public function searchArticles($req, $limit = 15)
    {
        $query = $this->query()->where('active', true);
        if (!empty($req->key)) {
            $query->where(function ($q) use ($req) {
                $q->where('name', 'like', '%' . $req->key . '%')
                ->orWhere('desc', 'like', '%' . $req->key . '%')
                ->orWhere('content', 'like', '%' . $req->key . '%');
            });
        }
        $query->orderBy('created_at', 'desc');
        return $query->paginate($limit)->appends(request()->all());
    }
}
