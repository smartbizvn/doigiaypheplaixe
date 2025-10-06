<?php
namespace App\Models;

use App\Models\BaseModel;

class Article extends BaseModel
{
    public $table = 'articles';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class,'category_id');
    }
}
