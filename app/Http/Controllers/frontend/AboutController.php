<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutHandler extends Controller
{
    public function process_and_display()
    {
    	$randomString = str_random(2).rand().str_random(2);

    	$about = new about;
    	$about ->about = $randomString;
    	$about ->save(); 

    	$messages = about::all();

    	foreach ($messages as $about => $value) {
    		echo $about->about."<br>";
    	}

    }
}
