<?php

namespace App\Http\Controllers\Backend\Minsitry;

use App\Http\Controllers\Controller;
use App\Models\Minsitry\Blog;
use App\Models\Minsitry\Category;
use Auth;
use App\Http\Requests\Backend\Ministry\CreateBlogRequest;

class BlogController extends Controller
{
     
    public $model;
    public $category;

        
        public function __construct(Blog $model , Category $category)
        {

            $this->model = $model;
            $this->category = $category;

           
        }




        public function index(Blog $model)
        {

            $data = $this->model->paginate(4);
            $category_id=$this->category->pluck('title','id');



            return view('backend.Ministry.Blog.index' , compact('data','category_id'));

        }


        public function create()
        {

            return view('backend.Ministry.Blog.create');
        }



        public function store(CreateBlogRequest $request)
        {

           $this->validate($request,array(

                'title'=>'required',
                'description'=>'required',
                'image'=>'required|mimes:jpg,jpeg,png,gif,svg,bmp',

           ));


                if ($request->hasFile('image')) 
         {
            $file = $request->file('image');
            $user_id = Auth::User()->id;

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
                'category_id'=>$request->category_id,
                'image' => $filename,
                'user_id'=>$user_id,
                
                
                
            ];


            $latest=$this->model->create($data);

            return redirect()->back();
        }


        public function edit($id)
        {

            $model = $this->model->find($id);
            $category_id=$this->category->pluck('title','id');


            $data = $this->model->paginate(4);


            
            return view('backend.Ministry.Blog.index' , compact('data','model','category_id'));
        
		}

        public function update($id , CreateBlogRequest $request)
        {
                 $this->validate($request,array(

                'title'=>'required',
                'description'=>'required',

           ));
              if ($request->hasFile('image')) 
         {
            
        
            $photo = $request->file('image');
            $user_id = Auth::User()->id;
            
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
                'category_id'=>$request->category_id,
                'image' => $filename,
                'user_id'=>$user_id,
                
            ];
            $this->model->find($id)->update($data);

            }
                else{
            $this->model->find($id)->update($request->all());
          
                 }

             return redirect('admin/blog');
           
        }

        public function delete($id)
        {

            $this->model->find($id)->delete();
             return redirect()->back();
        }
}
