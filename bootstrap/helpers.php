<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('paginateUrl')) {
    function paginateUrl($pageNumber)
    {
      $route = Route::currentRouteName();
      $currentQuery = request()->query();
      $currentQuery['page'] = $pageNumber;
      $url = route($route, $currentQuery);
      return $url;
    }
}

if (!function_exists('routeWithQuery')) {
  function routeWithQuery($route, $query)
  {
    $currentQuery = request()->query();
    $url = route($route, array_merge($currentQuery, $query));
    return $url;
  }
}