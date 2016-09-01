<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
class BlogController extends Controller
{

    public function getIndex()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        
        return view('blog.index')->withPosts($posts);

    }


    public  function getSingle($slug)
    {
        $post = Post::where('slug','=',$slug)->first();

        return view('blog.single')->withPost($post);
    }
//
//    public static function slug($title, $separator = '-')
//    {
//        //$title = static::ascii($title);
//        $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));
//        $flip = $separator == '-' ? '_' : '-';
//        $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);
//        $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);
//
//        return trim($title, $separator);
//     }
//    function utf8_urldecode($str) {
//        $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
//        return html_entity_decode($str,null,'UTF-8');;
//    }


}
