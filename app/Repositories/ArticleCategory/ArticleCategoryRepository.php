<?php
namespace App\Repositories\ArticleCategory;
use App\Repositories\BaseRepository;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface as EntityRepositoryInterface;
use App\Models\ArticleCategory as Entity;
use App\Filters\ArticleCategoryFilter as EntityFilter;

class ArticleCategoryRepository extends BaseRepository implements EntityRepositoryInterface
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

    public function parentCategory()
    {
        return $this->model->whereNull('parent_id')->with('children_categories')->get();
    }

    public function articleCategory($slug)
    {
        $query = $this->query()->where(['slug' => $slug, 'active' => true])->first();
        return $query;
    }

    public function homeArticleCategories()
    {
        $query = $this->query()->where(['show_homepage' => true, 'active' => true, 'type_category' => 'page'])->orderBy('order','asc')->get();
        return $query;
    }

    public function lastCategories()
    {
        $query = $this->query()->where(['active' => true, 'type_category' => 'page'])->orderBy('created_at', 'desc')->limit(6) ->get();
        return $query;
    }

    function getCategoryWithChildrenIds($category)
    {  
        if (!$category) {
            return [];
        }
        $ids = [$category->id];
        foreach ($category->children ?? [] as $child) {
            $ids = array_merge($ids, getCategoryWithChildrenIds($child));
        }
        return $ids;
    }
}