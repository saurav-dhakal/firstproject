<?php

namespace App\Http\Controllers\Backend\Minsitry;

use App\Http\Controllers\Controller;
use App\Models\Minsitry\Post;
use App\Http\Requests\Backend\Ministry\CreatePostRequest;
class PostController extends Controller
{
   public $model;

        
        public function __construct(Post $model)
        {

            $this->model = $model;

           
        }




        public function index(Post $model)
        {

            $data = $this->model->paginate(4);


            return view('backend.Ministry.Post.index' , compact('data'));

        }


        public function create()
        {

            return view('backend.Ministry.Post.create');
        }



        public function store(CreatePostRequest $request)
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
                base_path() . '/public/uploads/post/' , $filename
            );
            
            }
            
            $data = [
                
               'title' => $request->title,
               'title_ne' => $request->title_ne,
                'description' => $request->description,
                'description_ne' => $request->description_ne,
               
                'image'      => $filename ,

                
                
            ];


            $latest=$this->model->create($data);

            return redirect('admin/post');
        }


        public function edit($id)
        {

            $model = $this->model->find($id);

            $data = $this->model->paginate(4);


            
            return view('backend.Ministry.Post.create' , compact('data','model'));
        
		}

        public function update($id , CreatePostRequest $request)
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
                base_path() . '/public/uploads/post/' , $filename
            );


            $data = [
                
                 'title' => $request->title,
                'description' => $request->description,
               'title_ne' => $request->title_ne,

                'description_ne' => $request->description_ne,
                
                'image'      => $filename ,
           
            ];
            $this->model->find($id)->update($data);


            }
                else{
            $latest=$this->model->find($id)->update($request->all());

                 }

             return redirect('admin/post');
           
        }

        public function delete($id)
        {

            $this->model->find($id)->delete();
             return redirect()->back();
        }
}
