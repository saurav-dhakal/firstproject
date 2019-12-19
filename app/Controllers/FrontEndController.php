<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Video;
use Illuminate\Support\Facades\Auth;
use Image;
use App\Channel;
use App\Video_Playlist;
use App\Playlist;
use App\Video_History;
use App\Count;
use App\Total_Count;
use App\Like;
use App\Favourite;
use App\Models\Access\User\User;
use App\Category;

class FrontEndController extends Controller
{
    public function forhome(){

        $category=Category::all();
        $video= new Video();

        // foreach($videox as $row)
        // {
        //     $file='public/uploads/photo/' . $row->featured_image;
        
        // ## open and read video file
        // $handle = fopen($file, "r");
        // ## read video file size
        // $contents = fread($handle, filesize($file));
        // fclose($handle);
        // $make_hexa = hexdec(bin2hex(substr($contents,strlen($contents)-3)));
        // if (strlen($contents) > $make_hexa)
        // {
        // $pre_duration = hexdec(bin2hex(substr($contents,strlen($contents)-$make_hexa,3))) ;
        // $post_duration = $pre_duration/1000;
        // $timehours = $post_duration/3600;
        // $timeminutes =($post_duration % 3600)/60;
        // $timeseconds = ($post_duration % 3600) % 60;
        // $timehours = explode(".", $timehours);
        // $timeminutes = explode(".", $timeminutes);
        // $timeseconds = explode(".", $timeseconds);
        // $duration = $timehours[0]. ":" . $timeminutes[0]. ":" . $timeseconds[0];
        // echo $duration;
        // echo $row->title;
        // }
        //     }


    	return view('frontend.pages.home',compact('category','video'));

    }

    public function trending(){

      $video = Video::orderBy('id' , 'ascd')->paginate(12);

    return view('frontend.pages.trending')->with('video' , $video);


    }

    public function forchannel(){

    	$channel=Channel::all();


    	return view('frontend.pages.channel.channel',compact('channel'));
	
	}

	public function forupload(Category $category){
            $data=$category->pluck('title','id');



		return view('frontend.pages.upload',compact('data'));
	}

//for video store
	        public function store(Request $request)
        {

            $this->validate($request , [
                'title'    => 'required' ,
                'file'     => 'required',
            ]);

            $video = new Video();

            $video->title = $request->title;
            $video->description = $request->description;
            $video->category_id= $request->category_id;
            

            if ($request->hasFile('file')) {

                $file = $request->file('file');
                $filenamevideo = $file->getClientOriginalName();
                $path = public_path() . '/uploads/video';
                $videosize = $file->getClientSize();
                $file->move($path , $filenamevideo);
                $video->file = $filenamevideo;
                $video->size = $videosize;
            }

            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $p = $image->move(
                    base_path() . '/public/uploads/photo' , $filename
                );
               $video->featured_image = $filename;

            }

            $video->user_id = Auth::User()->id;
            $video->save();

            return redirect()->back();

            // just for showing the id of the data

        }


	public function forwatch($id,Video_Playlist $videoplaylist,Playlist $playlist){

            $user=new User();
            $video=Video::find($id);
			$allvideos=Video::orderBy('id','asc')->get();
            
            $data=$playlist->pluck('title','id');
            $history = new Video_History();
            $check = $history->select('user_id')->where('user_id' , '=' , Auth::user()->id)->where('video_id' , '=' , $id)->count();
                if($check==0){
                $history->user_id = Auth::User()->id;
                $history->video_id = $id;
                $history->save();

                }
                else{
			    }


			return view('frontend.pages.watch',compact('video','allvideos','data','user'));

	}


    public function showvideobycategory($id,Category $category){

             $cat=$category->find($id);

        $data=Video::where('category_id',$id)->get();
        
        return view('frontend.pages.category',compact('data','cat'));

    }

//for channel creation and store
     public function fchannelcreate()
    {
        return view('frontend.pages.channel.create');  
    }

    public function forchannelstore(Request $request)
    {
           

        $this->validate($request,array(
                'name'=>'required',
                'description'=>'min:5',
            ));
        
        $channel= new Channel();

        $count = $channel->select('user_id')->where('user_id' , '=' , Auth::user()->id)->count();
        if($count==0 || $count==1)
        {
        $channel->name=$request->name;
        $channel->description=$request->description;
        
         if ($request->hasFile('image')) 
         {
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $p = $image->move(
                base_path() . '/public/uploads/photo' , $filename
            );          

          $channel->image = $filename;      
        }

        $channel->user_id=Auth::user()->id;
        $channel->save(); 
        return redirect()->route('fchannel.show',$channel->id); 

        }
        else{

            echo "Channel Already Created";
            return redirect()->route('fchannel');
        }
    }

    public function fchannelshow($id)
    {
        $channel=Channel::find($id);
            $allvideos=Video::orderBy('id','asc')->get();


        return view('frontend.pages.channel.aboutchannel',compact('channel','allvideos'));

    }
    public function register(){
        
        return view('frontend.auth.register');
    }

}
