<?php
namespace App\Models;
class ArticleCategory extends BaseModel {

    public $table = 'article_categories';

    protected $guarded = [];


    public function children_categories()
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id')->with('children_categories')->orderBy('order', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(ArticleCategory::class,'parent_id');
    }

    public function getBreadcrumbAttribute(): string
    {
        $names = [];
        $category = $this;
        while ($category) {
            array_unshift($names, $category->name);
            $category = $category->parent;
        }
        return implode(' > ', $names);
    }
}
