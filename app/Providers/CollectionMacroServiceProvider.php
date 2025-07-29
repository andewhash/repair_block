<?php

namespace App\Providers;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('sortable', function ($defaultSort = null, $defaultDirection = 'asc') {
            return new \App\Helpers\Sortable($this, $defaultSort, $defaultDirection);
        });
    }
}