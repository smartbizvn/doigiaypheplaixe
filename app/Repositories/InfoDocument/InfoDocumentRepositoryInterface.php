<?php
namespace App\Repositories\InfoDocument;

use App\Repositories\RepositoryInterface;

interface InfoDocumentRepositoryInterface extends RepositoryInterface
{
    public function list($request);
}
