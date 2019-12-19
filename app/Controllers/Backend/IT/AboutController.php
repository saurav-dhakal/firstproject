<?php

namespace App\Http\Controllers\Backend\IT;

use App\Http\Controllers\Controller;
use App\Model\About;
use App\Http\Requests\Backend\CreateAboutRequest;
use Session;

class AboutController extends Controller
{
    
    public $model;

        
        public function __construct(About $model)
        {

            $this->model = $model;

           
        }




        public function index(About $model)
        {

            $data = $this->model->paginate(4);


            return view('backend.index' , compact('data'));

        }


        public function create()
        {

            return view('backend.About.create');
        }



        public function store(CreateAboutRequest $request)
        {
            $this->validate($request,array(

                'title'=>'required',
                'description'=>'required',
                'image'=>'required|mimes:jpg,jpeg,png,gif,svg,bmp',

           ));
           


                if ($request->hasFile('image')) 
         {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getClientSize();
            $originalNameWithoutExt = substr($originalName , 0 , strlen($originalName) - strlen($extension) - 1);
            $number = mt_rand(10000 , 99999);
            $filename = $originalNameWithoutExt . '-' . $number .  "." .$extension;
            $file = $request->file('image');
            $p = $file->move(
                base_path() . '/public/uploads/' , $filename
            );
            
            }
            
            $data = [
                
               'title' => $request->title,
                'description' => $request->description,
                'image'      => $filename ,

                
                
            ];


            $latest=$this->model->create($data);
        Session::flash('flash_success','Feedback has been successfully stored');

            return redirect()->back();
        }


        public function edit($id)
        {

            $model = $this->model->find($id);

            $data = $this->model->paginate(4);


            
            return view('backend.About.index' , compact('data','model'));
        
		}

        public function update($id , CreateAboutRequest $request)
        {
               $this->validate($request,array(

                'title'=>'required',
                'description'=>'required',

           ));
           

              if ($request->hasFile('image')) 
         {
            
        
            $photo = $request->file('image');
            $originalName = $photo->getClientOriginalName();
            $extension = $photo->getClientOriginalExtension();
            $size = $photo->getClientSize();
            $originalNameWithoutExt = substr($originalName , 0 , strlen($originalName) - strlen($extension) - 1);
            $number = mt_rand(10000 , 99999);
            $filename = $originalNameWithoutExt . '-' . $number . '-' . $extension;
            $photo = $request->file('image');

            $p = $photo->move(
                base_path() . '/public/uploads/' , $filename
            );


            $data = [
                
                 'title' => $request->title,
                'description' => $request->description,
                'image'      => $filename ,
           
            ];
            $this->model->find($id)->update($data);

            }
                else{
                    
            $this->model->find($id)->update($request->all());
                    
                 }

             return redirect('admin/about');
           
        }

        public function delete($id)
        {

            $this->model->find($id)->delete();
             return redirect()->back();
        }

      
}
