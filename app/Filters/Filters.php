<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $bulider;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($bulider)
    {
        $this->bulider = $bulider;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        
        return $this->bulider;
    }

    public function getFilters()
    {
        $filters = array_intersect(array_keys($this->request->all()), $this->filters);

        return $this->request->only($filters);
    }
}