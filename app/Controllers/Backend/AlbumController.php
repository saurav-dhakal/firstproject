<?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Requests\Backend\Gallery\CreateAlbumRequest;
    use App\Repositories\Backend\File\FileRepositoryInterface;
    use App\Repositories\Backend\Gallery\AlbumRepositoryInterface;
    use App\Repositories\Backend\Photo\PhotoRepositoryInterface;
    use Illuminate\Http\Request;
    use Session;

    use App\Http\Controllers\Controller;

    class AlbumController extends Controller
    {

        //
        /**
         * @var AlbumRepositoryInterface
         */
        private $album;

        /**
         * @var PhotoRepositoryInterface
         */
        private $photo;

        /**
         * @var FileRepositoryInterface
         */
        private $file;


        /**
         * AlbumController constructor.
         *
         * @param AlbumRepositoryInterface $album
         */
        public function __construct(AlbumRepositoryInterface $album , PhotoRepositoryInterface $photo , FileRepositoryInterface $file)
        {

            $this->album = $album;
            $this->photo = $photo;
            $this->file = $file;
        }


        public function index($type)
        {

            $data = $this->album->all($type);

            $count = $this->album->count($type);
            $photo = $this->photo;
            $file = $this->file;

            return view('backend.gallery.album.index' , compact('data' , 'count' , 'photo' , 'file'));
        }


        public function create()
        {

            //            $data = $this->album->all();

            return view('backend.gallery.album.create');
        }


        /**
         * @param CreateAlbumRequest $
         */
        public function store(CreateAlbumRequest $request)
        {

            //            dd($request->all());
            $this->album->store($request->all());

            return redirect()->back();
        }


        public function edit($id , $type , CreateAlbumRequest $request)
        {

            $data = $this->album->all($type);
            $photo = $this->photo;
            $count = $this->album->count($type);
            $model = $this->album->findByID($id);

            return view('backend.gallery.album.index' , compact('model' , 'data' , 'count','photo'));
        }


        public function delete($id , CreateAlbumRequest $request)
        {

            $model = $this->album->findByID($id)->delete();

            return redirect()->back();
        }


        public function show($id , CreateAlbumRequest $request)
        {

            $album = $this->album->findPhotoBYAlbumID($id);

            return view('backend.gallery.album.single' , compact('album'));
        }


        public function update($id , CreateAlbumRequest $request)
        {

            $album = $this->album->update($id , $request->all());

            return redirect()->back();
        }
    }
