<?php
namespace App\Repositories\Menu;

use App\Repositories\RepositoryInterface;

interface MenuRepositoryInterface extends RepositoryInterface
{
    public function list($request);
    public function parentMenu();
}
