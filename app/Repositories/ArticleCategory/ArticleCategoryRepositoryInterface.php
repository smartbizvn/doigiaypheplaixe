<?php
namespace App\Repositories\ArticleCategory;
use App\Repositories\RepositoryInterface;

interface ArticleCategoryRepositoryInterface extends RepositoryInterface
{
    public function list($request);
    public function parentCategory();
}