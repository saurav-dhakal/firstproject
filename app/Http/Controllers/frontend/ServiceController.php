<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
       public function process_and_display()
    {
    	$randomString = str_random(2).rand().str_random(2);

    	$service = new service;
    	$service ->service = $randomString;
    	$service ->save(); 

    	$messages = service::all();

    	foreach ($messages as $service => $value) {
    		echo $service->service."<br>";
    	}

    }
}
