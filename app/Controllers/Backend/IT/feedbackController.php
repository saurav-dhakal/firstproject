<?php

namespace App\Http\Controllers\Backend\Minsitry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Minsitry\Feedback;
use App\Http\Requests\Backend\Ministry\CreateFeedbackRequest;
use Session;

class feedbackController extends Controller
{
    public $model;
        
        

    public function __construct(Feedback $model )
   {

       $this->model = $model;
   }


   public function index(Feedback $model)
   { 
       $data = $this->model->paginate(4);
      return view('backend.Ministry.feedback.index' , compact('data'));

   }


   public function create()
    {

      return view('backend.Feedback.create');
    }


    public function store(CreateFeedbackRequest $request)
    {

        $data = $request->all();
    

         $this->model->create($data);
      
        return redirect()->back();
    }


    public function edit($id)
    {

    	$model = $this->model->find($id);
   	    $data = $this->model->paginate(4);
        return view('backend.Feedback.index' , compact('data','model'));
    }



    public function update($id , CreateFeedbackRequest $request)
   {

    $this->model->find($id)->update($request->all());
        Session::flash('flash_success','Feedback has been successfully updated');

    return redirect('admin/Feedback');
           
    }


    public function delete($id)
    {

    $this->model->find($id)->delete();
        Session::flash('flash_success','Feedback has been successfully deleted');
        return redirect()->back();
   }

 
}
