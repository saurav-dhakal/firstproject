<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
        public function process_and_display()
    {
    	$randomString = str_random(2).rand().str_random(2);

    	$project = new project;
    	$project ->project = $randomString;
    	$project ->save(); 

    	$messages = project::all();

    	foreach ($messages as $project => $value) {
    		echo $project->project."<br>";
    	}

    }
}
