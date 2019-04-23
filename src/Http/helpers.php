<?php

use Infinety\MenuBuilder\Http\Models\Menu;

if (!function_exists('getMenuBySlug')) {
    function getMenuBySlug($slug)
    {
        return Menu::whereHas('items', function($query){
            $query->with('children');
            $query->where('enabled',1);
            $query->orderBy('order', 'asc');
        })->whereSlug($slug)->first();
    }
}

if (!function_exists('menu_builder')) {

    /**
     * Creates an html menu from the given slug
     *
     * @param   string  $slug
     * @param   string  $parentClass  Class/es for parent tags
     * @param   [type]  $childClass   Class/es for child tags
     * @param   [type]  $parentTag    Parent Tag. Default to: ul
     * @param   [type]  $childTag     Child Tag. Default to: li
     *
     * @return  html
     */
    function menu_builder($slug, $parentClass = null, $childClass = null, $parentTag = null, $childTag = null)
    {
        $menu = Menu::whereSlug($slug)->first();
        if (!$menu) {
            return '';
        }

        return $menu->render($parentTag, $childTag, $parentClass, $childClass);
    }
}

if (!function_exists('menu_name')) {

    /**
     * Return menu name as a string
     *
     * @param   string  $slug
     *
     * @return  string
     */
    function menu_name($slug)
    {
        $menu = Menu::whereSlug($slug)->first();
        if (!$menu) {
            return '';
        }

        return $menu->name;
    }
}

if (!function_exists('menu_json')) {

    /**
     * Return menu items in json format
     *
     * @param   string  $slug
     *
     * @return  json
     */
    function menu_json($slug)
    {
        $menu = Menu::whereSlug($slug)->first();
        if (!$menu) {
            return '';
        }

        return $menu->optionsMenu()->toJson();
    }
}
