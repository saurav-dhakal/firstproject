<?php

namespace App\Http\Controllers\Backend\Minsitry;
use App\Models\Minsitry\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Ministry\CreateCategoryRequest;
class CategoryController extends Controller
{
     public $model;
        
        

        public function __construct(Category $model )
        {

            $this->model = $model;
           
            
        }


        public function index(Category $model)
        {

            $data = $this->model->paginate(4);


            return view('backend.Ministry.Category.index' , compact('data'));

        }


        public function create()
        {

            return view('backend.Ministry.Category.create');
        }


        public function store(CreateCategoryRequest $request)
        {
               $this->validate($request,array(

                'title'=>'required',

           ));

            $this->model->create($request->all());
             return redirect('admin/category');
            

        }


        public function edit($id)
        {

            $model = $this->model->find($id);
         
            $data = $this->model->paginate(4);
            

            return view('backend.Ministry.Category.create' , compact('data','model'));
        
		}

        public function update($id , CreateCategoryRequest $request)
        {
             $this->validate($request,array(

                'title'=>'required',

           ));
            $this->model->find($id)->update($request->all());
             return redirect('admin/category/create');
           
        }


        public function delete($id)
        {

            $this->model->find($id)->delete();
             return redirect()->back();
        }
}
