<?php

namespace App\Helpers;

class Pagination{
    public static function getPages($contents,$request){
        if (isset($request['page'])) {
            unset($request['page']);
        }
        if(count($request)>0){
            $url = request()->url()."?".http_build_query($request);
        } else {
            $url = request()->url()."?";
        }
        $pagination = [];
        if(isset($contents->current_page) && $contents->last_page > 1){
            $pagination['current_page'] = $contents->current_page;
            $pagination['last_page'] = $contents->last_page;
            $pagination['pages'] = []; 
            if($pagination['last_page'] > 10){
                if($pagination['current_page'] < 5){
                    $pagination['pages'] = [1,2,3,4,5,6,7,8,9];
                } else if($pagination['current_page'] > ($pagination['last_page'] - 5) ){
                    for ($i=($pagination['last_page'] - 9); $i <= $pagination['last_page'] ; $i++) { 
                        array_push($pagination['pages'],$i);
                    }
                } else {
                    for ($i=($pagination['current_page'] - 4); $i < $pagination['current_page'] ; $i++) { 
                        array_push($pagination['pages'],$i);
                    }
                    for ($i=$pagination['current_page']; $i < ($pagination['current_page'] + 5); $i++) { 
                        array_push($pagination['pages'],$i);
                    }
                }
            } else{
                for ($i=1; $i <= $contents->last_page ; $i++) { 
                    array_push($pagination['pages'],$i);
                }
            }
            $pagination['url'] = $url;
            if($pagination['current_page'] > 1){
                $pagination['previous'] = $pagination['current_page'] - 1;
            }
            if($pagination['current_page'] != $pagination['last_page'] ){
                $pagination['next'] = $pagination['current_page'] + 1;
            }
        }



        return $pagination;
    }

}