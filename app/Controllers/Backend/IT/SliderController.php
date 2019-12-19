<?php

namespace App\Http\Controllers\Backend\Minsitry;

use App\Http\Controllers\Controller;
use App\Models\Minsitry\Slider;
use App\Http\Requests\Backend\Ministry\CreateSliderRequest;

class SliderController extends Controller
{
    public $model;

        
        public function __construct(Slider $model)
        {

            $this->model = $model;

           
        }




        public function index(Slider $model)
        {

            $data = $this->model->paginate(4);


            return view('backend.Ministry.Slider.index' , compact('data'));

        }


        public function create()
        {

            return view('backend.Ministry.Slider.create');
        }



        public function store(CreateSliderRequest $request)
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
                base_path() . '/public/uploads/Slider/' , $filename
            );
            
            }
            
            $data = [
                
               'title' => $request->title,
               'description' => $request->description,
                'image'      => $filename ,

                
                
            ];


            $latest=$this->model->create($data);

            return redirect()->back();
        }


        public function edit($id)
        {

            $model = $this->model->find($id);

            $data = $this->model->paginate(4);


            
            return view('backend.Ministry.Slider.index' , compact('data','model'));
        
		}

        public function update($id , CreateSliderRequest $request)
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
                base_path() . '/public/uploads/Slider/' , $filename
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

             return redirect('admin/slider');
           
        }

        public function delete($id)
        {

            $this->model->find($id)->delete();
             return redirect()->back();
        }
}
