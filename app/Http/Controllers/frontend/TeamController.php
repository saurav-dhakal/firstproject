<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
        public function process_and_display()
    {
    	$randomString = str_random(2).rand().str_random(2);

    	$team = new team;
    	$team ->team = $randomString;
    	$team ->save(); 

    	$messages = team::all();

    	foreach ($messages as $team => $value) {
    		echo $team->team."<br>";
    	}

    }
}
