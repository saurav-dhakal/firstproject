<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
        public function process_and_display()
    {
    	$randomString = str_random(2).rand().str_random(2);

    	$home = new home;
    	$home ->home = $randomString;
    	$home ->save(); 

    	$messages = home::all();

    	foreach ($messages as $home => $value) {
    		echo $home->home."<br>";
    	}

    }
}
