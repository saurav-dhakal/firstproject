<?php

namespace App\Http\Controllers\Backend\Minsitry;

use App\Http\Controllers\Controller;
use App\Models\Minsitry\Logo;
use App\Http\Requests\Backend\Ministry\CreateLogoRequest;

class LogoController extends Controller
{
     public $model;

        
        public function __construct(Logo $model)
        {

            $this->model = $model;

           
        }




        public function index(Logo $model)
        {

            $data = $this->model->paginate(4);


            return view('backend.Ministry.Logo.index' , compact('data'));

        }


        public function create()
        {

            return view('backend.Ministry.Logo.create');
        }



        public function store(CreateLogoRequest $request)
        {

           $this->validate($request,array(

                'title'=>'required',
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
                base_path() . '/public/uploads/logo/' , $filename
            );
            
            }
            
            $data = [
                
               'title' => $request->title,
                'image'      => $filename ,

                
                
            ];


            $latest=$this->model->create($data);

            return redirect()->back();
        }


        public function edit($id)
        {

            $model = $this->model->find($id);

            $data = $this->model->paginate(4);


            
            return view('backend.Ministry.Logo.index' , compact('data','model'));
        
		}

        public function update($id , CreateLogoRequest $request)
        {

               $this->validate($request,array(

                'title'=>'required',

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
                base_path() . '/public/uploads/logo/' , $filename
            );


            $data = [
                
                 'title' => $request->title,
                'image'      => $filename ,
           
            ];
            }
                else{
            $data = [
                
                 'title' => $request->title,
                
           
            ];
                 }

            $this->model->find($id)->update($data);
             return redirect('admin/logo');
           
        }

        public function delete($id)
        {

            $this->model->find($id)->delete();
             return redirect()->back();
        }
}
