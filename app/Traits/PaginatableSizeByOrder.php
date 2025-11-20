<?php
namespace App\Traits;

trait PaginatableSizeByOrder
{
    private $pageSizeLimit = 100;

    public function getPerPage()
    {
        $pageSize = request('per_page', $this->perPage);
        return min($pageSize, $this->pageSizeLimit);
    }
}
