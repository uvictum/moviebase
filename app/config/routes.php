<?php
return array(
        "'^\/$'" => "home/display",
        "'^\/search\?search_cond=By\+((actors)|(title)){1}&search_val=[A-Za-zА-Яа-я0-9]*$'" => "home/search",
        "'^\/\?page=[0-9]{1,5}&page_elems=((10)|(20)|(50)){1}(&search_cond=(Title|Actors)&search_val=%[A-Za-zА-Яа-я0-9]*%){0,1}$'" => "home/displayContent",
        "'^\/movies\/[0-9]{1,8}$'" => "moviePage/show",
        "'^/upload$'" => "upload/getFile",
        "'^/add$'" => "upload/addMovie",
        "'^/delete\/[0-9]{1,8}$'" => "moviePage/delete");