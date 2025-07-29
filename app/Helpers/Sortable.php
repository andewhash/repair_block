<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class Sortable
{
    protected $collection;
    protected $defaultSort;
    protected $defaultDirection;

    public function __construct(Collection $collection, $defaultSort = null, $defaultDirection = 'asc')
    {
        $this->collection = $collection;
        $this->defaultSort = $defaultSort;
        $this->defaultDirection = $defaultDirection;
    }

    public function link($title, $sortBy)
    {
        $sort = request('sort', $this->defaultSort);
        $direction = request('direction', $this->defaultDirection);
        
        $icon = '';
        if ($sort === $sortBy) {
            $icon = $direction === 'asc' ? '↑' : '↓';
        }
        
        $url = request()->fullUrlWithQuery([
            'sort' => $sortBy,
            'direction' => $sort === $sortBy && $direction === 'asc' ? 'desc' : 'asc'
        ]);
        
        return new HtmlString("<a href='{$url}' class='sortable'>{$title} {$icon}</a>");
    }
}