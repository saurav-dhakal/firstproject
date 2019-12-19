<?php

namespace App\Http\Controllers\Backend\Minsitry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Minsitry\FunctionOf;

class FunctionController extends Controller
{
       public $model;

        
        public function __construct(FunctionOf $model)
        {

            $this->model = $model;

           
        }




        public function index()
        {

            $data = $this->model->paginate(4);


            return view('backend.Ministry.Function.index' , compact('data'));

        }


        public function create()
        {

            return view('backend.Ministry.Function.create');
        }



        public function store(Request $request)
        {

           
$this->validate($request,array(

                'title'=>'required',
                'description'=>'required',

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
            
            $data = [
                
               'title' => $request->title,
               'description' => $request->description,
                'image'      => $filename ,

                
                
            ];

            $latest=$this->model->create($data);
          }
          else{
            $detault ='logo.png';

            $data =[
                'title' => $request->title,
               'description' => $request->description,
                'image'      => $detault ,
            ];

            $latest=$this->model->create($data);
            }

            return redirect()->back();
        }


        public function edit($id)
        {

            $model = $this->model->find($id);

            $data = $this->model->paginate(4);


            
            return view('backend.Ministry.Function.index' , compact('data','model'));
        
		}

        public function update($id , Request $request)
        { $this->validate($request,array(

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

             return redirect('admin/function');
           
        }

      public function delete($id)
        {

            $data=$this->model->find($id); 
        if(file_exists('public/uploads/'.$data->image) AND !empty($data->image)){ 
        unlink('public/uploads/'.$data->image);
     } 
        try{

            $data->delete();
            $bug = 0;
        }
        catch(\Exception $e){
            $bug = $e->errorInfo[1];
        } 
        if($bug==0){
            echo "success";
        }else{
            echo 'error';
        }
            
             return redirect()->back();
        }
}
