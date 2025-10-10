<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use App\Repositories\Article\ArticleRepositoryInterface;

class HomeController extends BaseController
{
    public function __construct(
        ArticleRepositoryInterface $articleRepository, 
        ArticleCategoryRepositoryInterface $articleCategoryRepository
    ){
        $this->articleRepository = $articleRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
    }

    public function index(Request $request){
        $featureArticles  = $this->articleRepository->featureArticles();
        $homeCategories = $this->articleCategoryRepository->homeArticleCategories();
        $data  = array(
            'feature_articles' => $featureArticles,
            'home_categories' => $homeCategories,
            'title' => getSetting('title'),
            'meta_description' => getSetting('meta_description'),
        );
        return view('frontend.index',$data);
    }

    public function articles(Request $req){
        $categoryArticle  = $this->articleCategoryRepository->articleCategory($req->segment(1));
        $categoryWithChildrenIds = $this->articleCategoryRepository->getCategoryWithChildrenIds($categoryArticle);
        $articles  = $this->articleRepository->getArticleByCategoriesId($categoryWithChildrenIds, 14, true);
        $data  = array(
            'articles' => $articles,
            'title' => getSetting('title'),
            'meta_description' => getSetting('meta_description')
        );
        return view('frontend.news', $data);
    }

    public function article(Request $req){
        $detailArticle  = $this->articleRepository->detailArticle($req->slug);
        if(!$detailArticle){
            return abort(404);
        }
        $categoryArticle = $this->articleCategoryRepository->find($detailArticle->category_id);
        $relativeArticles  = $this->articleRepository->relativeArticles($detailArticle->id, $categoryArticle->id ?? 0);
        $data  = array(
            'detail_article' => $detailArticle,
            'relative_articles' => $relativeArticles,
            'category_article' => $categoryArticle,
            'title' => getTitle($detailArticle),
            'meta_description' => getDesc($detailArticle)
        );
        return view('frontend.news_detail', $data);
    }

    public function page(Request $req){
        $categoryArticle = $this->articleCategoryRepository->articleCategory($req->path());
        if(!$categoryArticle){
            return abort(404);
        }
        $data  = array(
            'detail_article' => $categoryArticle,
            'title' => getTitle($categoryArticle),
            'meta_description' => getDesc($categoryArticle)
        );  
        return view('frontend.page', $data);
    }

    public function search(Request $req){
        $articles  = $this->articleRepository->searchArticles($req, 10);
        $data  = array(
            'articles' => $articles,
            'title' => getSetting('title'),
            'meta_description' => getSetting('meta_description')
        );
        return view('frontend.search', $data);
    }

    public function contact(Request $req){
        $data  = array(
            'title' => getSetting('title'),
            'meta_description' => getSetting('meta_description'),
        );  
        return view('frontend.contact', $data);
    }
}