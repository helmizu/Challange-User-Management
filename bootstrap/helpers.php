<?php

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