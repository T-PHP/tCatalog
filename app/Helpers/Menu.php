<?php
namespace Helpers;
/**
 * creates a menu from a object
 * usage example:
 * $data['menu'] = Menu::getList($pages, $id = 'pageID', $title = 'pageTitle', $slug = 'pageSlug', $parent = 'pageParent');
 */
class Menu
{
    /**
     * getList creates a menu from a object
     * @param  object  $rows   object of keys/values
     * @param  int     $id     the id
     * @param  string  $title  name of the item
     * @param  string  $slug   url friendly name
     * @param  int     $parent id of parent element
     * @param  int     $depth  level of the loop
     * @return string          formatted menu
     */
    public static function getList($rows, $id, $title, $slug, $parent, $depth = 0, $style = '')
    {
        // Start a new list
        $newList = null;
        //loop through the rows
        foreach ($rows as $key => $row) {
            if ($row->$parent == $depth) {
                // Add an UL tag when LI exists
                $newList == null ? $newList = "<ul class='list-unstyled' style='$style'>\n" : $newList;
                $newList .= "<li><a href='".DIR.'c'.$row->$id.'-'.$row->$slug.".html'><i class='fa fa-angle-right'></i> ".$row->$title."</a>";
                // Find childrens
                $newList .= self::getList(array_slice($rows, $key), $id, $title, $slug, $parent, $row->$id, $style = '');
                $newList .= "</li>\n";
            }
        }
        // Add an UL end tag
        strlen($newList) > 0 ? $newList .= "</ul>\n" : $newList;
        return $newList;
    }
}