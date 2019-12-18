<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
        public function process_and_display()
    {
    	$randomString = str_random(2).rand().str_random(2);

    	$blog = new blog;
    	$blog ->blog = $randomString;
    	$blog ->save(); 

    	$messages = blog::all();

    	foreach ($messages as $blog => $value) {
    		echo $blog->blog."<br>";
    	}

    }
}
