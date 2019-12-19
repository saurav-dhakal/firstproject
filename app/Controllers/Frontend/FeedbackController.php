<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Minsitry\Feedback;
use App\Http\Requests\Backend\Ministry\CreateFeedbackRequest;

use Session;

class FeedbackController extends Controller
{
    
    public $model;
        
        

    public function __construct(Feedback $model )
   {

       $this->model = $model;
   }





    public function feedback_store(CreateFeedbackRequest $request)
    {

        $data = $request->all();
        
     

         $this->model->create($data);
        
        Session::flash('flash_success','Your information/feedback has been submitted successfully.');

        return redirect()->back();
    }



 
}
