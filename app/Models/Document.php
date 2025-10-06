<?php
namespace App\Models;

use App\Models\BaseModel;
use Carbon\Carbon;

class Document extends BaseModel
{
    public $table = 'documents';
    protected $guarded = [];

    public function setDateIssueAttribute($value)
    {
        if ($value) {
            $this->attributes['date_issue'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        }
    }

    public function getDateIssueAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    public function classInfo()
    {
        return $this->belongsTo(InfoDocument::class, 'class_document');
    }

    public function agencyInfo()
    {
        return $this->belongsTo(InfoDocument::class, 'agency_document');
    }

    public function fieldInfo()
    {
        return $this->belongsTo(InfoDocument::class, 'field_document');
    }

    public function typeInfo()
    {
        return $this->belongsTo(InfoDocument::class, 'type_document');
    }
}
