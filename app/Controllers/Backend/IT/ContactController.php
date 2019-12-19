<?php

namespace App\Http\Controllers\Backend\Minsitry;
use App\Models\Minsitry\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Ministry\CreateContactRequest;
class ContactController extends Controller
{
     public $model;
        
        

        public function __construct(Contact $model )
        {

            $this->model = $model;
           
            
        }


        public function index(Contact $model)
        {

            $data = $this->model->paginate(4);


            return view('backend.Ministry.Contact.index' , compact('data'));

        }


        public function create()
        {

            return view('backend.Ministry.Contact.create');
        }


        public function store(CreateContactRequest $request)
        {

            $this->validate($request, array(


                'title'=>'required',
                'email'=>'required|email',
                'message'=>'required',
                'phone_no'=>'required',
                'website'=>'required',
                'address'=>'required',
                


            ));



            $this->model->create($request->all());
            return redirect()->back();

        }


        public function edit($id)
        {

            $model = $this->model->find($id);
         
            $data = $this->model->paginate(4);
            

            return view('backend.Ministry.Contact.index' , compact('data','model'));
        
		}

        public function update($id , CreateContactRequest $request)
        {

            $this->validate($request, array(


                'title'=>'required',
                'email'=>'required|email',
                'message'=>'required',
                'phone_no'=>'required',
                'website'=>'required',
                'address'=>'required',
            ));

            $this->model->find($id)->update($request->all());
             return redirect('admin/contact');
           
        }


        public function delete($id)
        {

            $this->model->find($id)->delete();
             return redirect()->back();
        }
}
