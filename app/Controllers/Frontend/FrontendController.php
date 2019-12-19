<?php

    namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Minsitry\Slider;
use App\Models\Minsitry\Post;
use App\Models\Minsitry\GalleryPhoto;
use App\Models\Minsitry\Audio;
use App\Models\Minsitry\Category;
use App\Models\Ministry\Whoiswho;
use App\Models\Minsitry\Notice;
use App\Models\Minsitry\PressRelease;
use App\Models\Minsitry\Recent;
use App\Models\Minsitry\Administration;
use App\Models\Minsitry\Ayurvedic;
use App\Models\Minsitry\Law;
use App\Models\Minsitry\School;
use App\Models\Minsitry\About;
use App\Models\Minsitry\Socialdevelopment;
use App\Models\Minsitry\Socialhealth;
use App\Models\Minsitry\Medicine;
use App\Models\Minsitry\Youthplay;
use App\Models\Minsitry\Nursing;
use App\Models\Minsitry\rule;
use App\Models\Minsitry\letter;
use App\Models\Minsitry\direction;
use App\Models\Minsitry\bill;
use App\Models\Minsitry\Video;
use App\Models\Minsitry\Economy;
use App\Models\Minsitry\EducationDivision;
use App\Models\Minsitry\Education_Discipline;
use App\Models\Minsitry\Epidemiology_Health;
use App\Models\Minsitry\Health_Division;
use App\Models\Minsitry\Citizen;
use App\Models\Minsitry\FunctionOf;
use App\Models\Minsitry\Publication;






    
    class FrontendController extends Controller
    {
        private $_data=
        [
            'administration_menu'=>null,
        ];


public function __construct()
{
    $this->_data['administration_menu']=Administration::all();
    $this->_data['educationdivision_menu']=EducationDivision::all();
    $this->_data['educationdiscipline_menu']=Education_Discipline::all();
    $this->_data['healthdivision_menu']=Health_Division::all();
    $this->_data['epidemiology_menu']=Epidemiology_Health::all();
    $this->_data['youthplay_menu']=Youthplay::all();
    $this->_data['socialdevelopment_menu']=Socialdevelopment::all();

    view()->share($this->_data);

}



    public function index(Slider $slider, Category $cata)
    { 
      $sdata=$slider->latest()->take(3)->get();
         $cdata=$cata->latest()->first();
            return view('frontend.ministry.index',compact('sdata','cdata'));

       
    }
      public function about(About $about)
    { 
           $notice_data=$about->paginate(2);
   
            return view('frontend.ministry.about',compact('notice_data'));

       

       
    }
       
        public function organization()
    { 
            return view('frontend.ministry.organization');

       
    }
        public function who(Whoiswho $who)

    { 
        $wdata=$who->paginate(13);
    
            return view('frontend.ministry.who',compact('wdata'));

       
    }

   public function contact()
    { 
            return view('frontend.ministry.contact');

       
    }
     public function link()
    { 
            return view('frontend.ministry.link');

       
    }
    public function video(Video $audio)
    {       
          $audio_data=$audio->all();
            return view('frontend.ministry.video',compact('audio_data'));

       
    }
    public function audio(Audio $audio)
    { 
        $audio_data=$audio->all();
           
            return view('frontend.ministry.audio',compact('audio_data'));

       
    }
      
     public function photo(GalleryPhoto $photo)
    { 

        $image_data=$photo->paginate(6);
            return view('frontend.ministry.photo',compact('image_data'));

       
    }
          public function minister()
    { 

   
            return view('frontend.ministry.right_minister');

       
    }

           public function secretary()
    { 

   
            return view('frontend.ministry.secretary');

       
    }
            public function spokes()
    { 

   
            return view('frontend.ministry.spokes');

       
    }

      public function notice(Notice $notice)
    { 

        $notice_data=$notice->latest()->paginate(5);
        
   
            return view('frontend.ministry.notice',compact('notice_data'));

       
    }
     public function press(PressRelease $press)
    { 
        $press_data=$press->latest()->paginate(5);

   
            return view('frontend.ministry.press',compact('press_data'));

       
    }
     public function recent(Recent $recent)
    { 
        $recent_data=$recent->latest()->paginate(5);

   
            return view('frontend.ministry.recent_update',compact('recent_data'));

       
    }
 

    
     public function feedback()
    { 
            return view('frontend.ministry.feedback');

       
    }
        public function letter(letter $notice)
    { 
        $notice_data=$notice->latest()->paginate(2);
            return view('frontend.ministry.letter',compact('notice_data'));

       
    }    
     public function bill(bill $notice)
    { 
        $notice_data=$notice->latest()->paginate(5);
            return view('frontend.ministry.bill',compact('notice_data'));

       
    }
        public function direction(direction $notice)
    { 
        $notice_data=$notice->latest()->paginate(3);
            return view('frontend.ministry.direction',compact('notice_data'));

       
    }
        public function rule(Rule $notice)
    { 
        $notice_data=$notice->latest()->paginate(3);
            return view('frontend.ministry.rule',compact('notice_data'));

       
    }


  
  


 


      public function administration(Administration $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.administration',compact('notice_data'));

       
    }

      public function school(school $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.school',compact('notice_data'));

       
    }



      public function ayurvedic(Ayurvedic $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.ayurvedic',compact('notice_data'));

       
    }

      public function economy(Economy $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.economy',compact('notice_data'));

       
    }

      public function law(Law $notice)
    { 

        $notice_data=$notice->latest()->paginate(3);

            return view('frontend.ministry.law',compact('notice_data'));

       
    }

      public function medicine(Medicine $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.medicine',compact('notice_data'));

       
    }

      public function nursing(Nursing $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.nursing',compact('notice_data'));

       
    }

      public function Socialdevelopment(Socialdevelopment $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.Socialdevelopment',compact('notice_data'));

       
    }


      public function Socialhealth(Socialhealth $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.socialhealth',compact('notice_data'));

       
    }
          public function youthplay(Youthplay $notice)
    { 

        $notice_data=$notice->paginate(2);
   
            return view('frontend.ministry.youthplay',compact('notice_data'));

       
    }

    public function recent_onepage($id, Recent $recent)
    {
      
          $data=$recent->find($id);
           // dd($data);
          return view('frontend.ministry.recent.onepage',compact('data'));
    }
 public function press_onepage($id, PressRelease $recent)
    {
      
          $data=$recent->find($id);
          return view('frontend.ministry.press.onepage',compact('data'));
        }
    
  
 public function notice_onepage($id, Notice $recent)
    {
      
          $data=$recent->find($id);

          return view('frontend.ministry.notice.onepage',compact('data'));
        }
        
        
        

    public function healthmenu($slug)
    {
                $data=Health_Division::where('slug',$slug)->get();
                return view('frontend.ministry.page.single',compact('data'));

    }


      public function administration_menu($slug)
    {
                $data=Administration::where('slug',$slug)->get();
                return view('frontend.ministry.page.single',compact('data'));

    }

          public function educationdivision_menu($slug)
    {
                $data=EducationDivision::where('slug',$slug)->get();
                return view('frontend.ministry.page.single',compact('data'));

    }



      public function educationdiscipline_menu($slug)
    {
                $data=Education_Discipline::where('slug',$slug)->get();
                return view('frontend.ministry.page.single',compact('data'));

    }



      public function epidemiology_menu($slug)
    {
                $data=Epidemiology_Health::where('slug',$slug)->get();
                return view('frontend.ministry.page.single',compact('data'));

    }


      public function youthplay_menu($slug)
    {
                $data=Youthplay::where('slug',$slug)->get();
                return view('frontend.ministry.page.single',compact('data'));

    }



      public function socialdevelopment_menu($slug)
    {
                $data=Socialdevelopment::where('slug',$slug)->get();
                return view('frontend.ministry.page.single',compact('data'));

    }


        public function citizen(Citizen $about)
    { 
          $data=$about->first();
          
            return view('frontend.ministry.citizen',compact('data'));

     }
           public function role(FunctionOf $about )
    {       
            $data=$about->paginate(2);
            return view('frontend.ministry.role',compact('data'));

       
    }


     public function publication(Publication $publication)
    { 

        $data=$publication->latest()->paginate(5);
            return view('frontend.ministry.publication',compact('data'));

       
    }
    





    }