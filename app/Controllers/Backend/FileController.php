<?php
    namespace App\Http\Controllers\Backend;

    use App\Http\Requests\Backend\File\CreateFileRequest;
    use App\Repositories\Backend\File\FileRepositoryInterface;
    use App\Repositories\Backend\Gallery\AlbumRepositoryInterface;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class FileController extends Controller
    {

        //
        public $model;

        /**
         * @var AlbumRepositoryInterface
         */
        private $album;


        /**
         * FolderController constructor.
         */
        public function __construct(FileRepositoryInterface $model , AlbumRepositoryInterface $album)
        {

            $this->model = $model;
            $this->album = $album;
        }


        public function create(CreateFileRequest $request)
        {

            $album_id = $request->album_id;
            $album = $this->album->findByID($album_id);

            return view('backend.gallery.folder.create' , compact('album'));
        }


        /**
         * @param CreatePhotoRequest $
         */
        public function store(CreateFileRequest $request)
        {

            $data = $request->all();
            $album_id = $request->album_id;
            $user_id = Auth::User()->id;
            $photo = $request->file('file');
            $originalName = $photo->getClientOriginalName();
            $extension = $photo->getClientOriginalExtension();
            $size = $photo->getClientSize();
            $originalNameWithoutExt = substr($originalName , 0 , strlen($originalName) - strlen($extension) - 1);
            $number = mt_rand(1000000000 , 9999999999);
            $filename = $originalNameWithoutExt . '-' . $number . '-' . $album_id . "." . $extension;

            $p = $photo->move(
                base_path() . '/public/uploads/file' , $filename
            );

            $array = [
                'title'       => $originalNameWithoutExt ,
                'description' => $originalNameWithoutExt ,
                'size'        => $size ,
                'album_id'    => $album_id ,
                'user_id'     => $user_id ,
                'image'       => $filename ,
                'status'      => 1
            ];
            $this->model->store($array);

            return 'success';
        }


        public function fileByAlbum($id , CreateFileRequest $request)
        {

            $data = $this->model->getFileByAlbum($id);
            $file = $this->model;
            $album = $this->album->findByID($id);
            $albumgroup = $this->album->getAlbumByAlbumID($album->id);

            $breadcrumbs = $this->album->findParentAlbumByALbumID($album->album_id);
            if (count($breadcrumbs) > 0) {
                $parent = $this->album->getparent($breadcrumbs[0]->id);

                $grandparent = $this->album->getparent($breadcrumbs[0]->album_id);

            } else {
                $parent = '';

                $grandparent = '';
            }

            return view('backend.gallery.folder.single' , compact('data' , 'album' , 'albumgroup' , 'parent' , 'grandparent'));

        }


        public function editfileByAlbum($id , CreateFileRequest $request)
        {

            $data = $this->model->getFileByAlbum($id);
            $file = $this->model;
            $album = $this->album->findByID($id);
            $model = $this->album->findByID($id);
            $albumgroup = $this->album->getAlbumByAlbumID($album->id);

            $breadcrumbs = $this->album->findParentAlbumByALbumID($album->album_id);
            if (count($breadcrumbs) > 0) {
                $parent = $this->album->getparent($breadcrumbs[0]->id);

                $grandparent = $this->album->getparent($breadcrumbs[0]->album_id);

            } else {
                $parent = '';

                $grandparent = '';
            }

            return view('backend.gallery.folder.single' , compact('data' , 'album' , 'albumgroup' , 'parent' , 'grandparent' , 'model'));

        }
    }
