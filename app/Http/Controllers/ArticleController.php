<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest as EntityRequest;
use App\Repositories\Article\ArticleRepositoryInterface as EntityRepositoryInterface;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use App\Models\Article as Entity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Exception;

class ArticleController extends BaseController
{
    public function __construct(EntityRepositoryInterface $entityRepository, ArticleCategoryRepositoryInterface $articleCategoryRepository)
    {
        $this->module = 'articles';
        $this->repository = $entityRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies($this->module . '_access'), 403);
        try {
            list($results, $summary) = $this->repository->list($request);
            $data =  [
                'results' => $results,
                'summary' => $summary,
                'module'  => $this->module,
            ];
            return view('backend.' . $this->module . '.index', $data);
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function create()
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        return view('backend.' . $this->module . '.create', $this->formData(new Entity()));
    }

    public function store(EntityRequest $request)
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        try {
            $this->repository->create($this->getDataRequest($request));
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function edit(Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        return view('backend.' . $this->module . '.edit', $this->formData($entity));
    }

    public function update(EntityRequest $request, Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        try {
            $this->repository->update($this->getDataRequest($request, $entity), $entity->id);
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function changeStatus(Request $request)
    {
        return parent::changeStatus($request);
    }

    public function delete(Request $request)
    {
        return parent::bulkDelete($request);
    }

    protected function getDataRequest($request, $entity = null)
    {
        $featureImage = self::uploadFile($request->file('feature_image'), 'feature_images');
        $image =  $featureImage['link_file'] ?? null;

        $data = [
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'url'           => Str::slug($request->name),
            'desc'          => $request->desc,
            'content'       => $request->content,
            'category_id'   => $request->category_id ?? 0,
            'active'        => $request->active ?? false,
            'feature'       => $request->feature ?? false,
            'order'         => $request->order ?? 0,
            'meta_title'    => $request->meta_title,
            'meta_keyword'  => $request->meta_keyword,
            'meta_desc'     => $request->meta_desc,
        ];

        if ($image !== null) {
            $data['image'] = $image;
            if ($entity && $entity->image) {
                deleteFile($entity->image);
            }
        } elseif ($entity) {
            $data['image'] = $entity->image;
        }

        return $data;
    }

    private function formData(Entity $entity)
    {
        $articleCategories = $this->articleCategoryRepository->whereNull('parent_id')->with('children_categories')->get();
        return [
            'result'             => $entity,
            'article_categories' => $articleCategories,
            'module'             => $this->module
        ];
    }
}