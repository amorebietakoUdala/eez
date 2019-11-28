<?php

namespace App\Pagination;

class PaginatedCollection
{
    public $rows;
    public $total;
    public $count;

    public function __construct(array $rows, $totalRows)
    {
        $this->rows = $rows;
        $this->total = $totalRows;
        $this->count = count($rows);
    }

//    public function getRows()
//    {
//        return $this->rows;
//    }
//
//    public function getTotal()
//    {
//        return $this->total;
//    }
//
//    public function getCount()
//    {
//        return $this->count;
//    }
//
//    public function setRows($rows)
//    {
//        $this->rows = $rows;
//
//        return $this;
//    }
//
//    public function setTotal($total)
//    {
//        $this->total = $total;
//
//        return $this;
//    }
//
//    public function setCount($count)
//    {
//        $this->count = $count;
//
//        return $this;
//    }
//
//    public function __toArray()
//    {
//        $pca = [
//            'rows' => $this->rows,
//            'total' => $this->total,
//            'count' => $this->count,
//        ];
//
//        return $pca;
//    }
}
