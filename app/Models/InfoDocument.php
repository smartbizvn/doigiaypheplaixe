<?php
namespace App\Models;

use App\Models\BaseModel;

class InfoDocument extends BaseModel
{
    public $table = 'info_documents';
    protected $guarded = [];
    
    public const CLASS_DOCUMENT  = 'class_document';
    public const AGENCY_DOCUMENT = 'agency_document';
    public const FIELD_DOCUMENT  = 'field_document';
    public const TYPE_DOCUMENT   = 'type_document';

    public const TYPES = [
        ['id' => self::CLASS_DOCUMENT, 'name' => 'Lớp văn bản'],
        ['id' => self::AGENCY_DOCUMENT, 'name' => 'Cơ quan ban hành'],
        ['id' => self::FIELD_DOCUMENT, 'name' => 'Lĩnh vực văn bản'],
        ['id' => self::TYPE_DOCUMENT, 'name' => 'Loại văn bản']
    ];

    public static function getTypes()
    {
        return collect(self::TYPES)->map(function ($item) {
            return (object) $item;
        });
    }

    public static function typesAsKeyValue(): array
    {
        return collect(self::TYPES)->pluck('name', 'id')->toArray();
    }

    public function getTypeNameAttribute(): ?string
    {
        return self::typesAsKeyValue()[$this->type] ?? null;
    }
}
