<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
        public function process_and_display()
    {
    	$randomString = str_random(2).rand().str_random(2);

    	$contact = new contact;
    	$contact ->contact = $randomString;
    	$contact ->save(); 

    	$messages = contact::all();

    	foreach ($messages as $contact => $value) {
    		echo $contact->contact."<br>";
    	}

    }
}
