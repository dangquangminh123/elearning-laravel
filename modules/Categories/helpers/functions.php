<?php 
    if (!function_exists('getSubCategories')) {
            function getSubCategories($categories, $old='', $parentId=0, $char='') {
                $id =request()->route()->category;
                if($categories) {
                    foreach($categories as $key => $category) {
                        if($category->parent_id == $parentId && $id!=$category->id) {
                            echo '<option value="'.$category->id.'"';
                            if($old == $category->id) {
                                echo ' selected';
                            }
                            echo '>'.$char.$category->name.'</option>';
                            unset($categories[$key]);
                            getSubCategories($categories, $old, $category->id, $char.' |- ');
                        }
                    }
                }
            }
    }