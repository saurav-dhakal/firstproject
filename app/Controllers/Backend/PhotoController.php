<?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Requests\Backend\Gallery\CreatePhotoRequest;
    use App\Repositories\Backend\Gallery\AlbumRepositoryInterface;
    use App\Repositories\Backend\Photo\PhotoRepositoryInterface;
    use Folklore\Image\Facades\Image;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class PhotoController extends Controller
    {

    

        /**
         * @var PhotoRepositoryInterface
         */
        private $model;

        /**
         * @var AlbumRepositoryInterface
         */
        private $album;


        /**
         * PhotoController constructor.
         */
        public function __construct(PhotoRepositoryInterface $model , AlbumRepositoryInterface $album)
        {

            $this->model = $model;
            $this->album = $album;
        }


        public function index()
        {

            $this->model->all();

        }


        public function create(CreatePhotoRequest $request)
        {

            $album_id = $request->album_id;
            $album = $this->album->findByID($album_id);

            return view('backend.gallery.photo.create' , compact('album'));
        }


        /**
         * @param CreatePhotoRequest $
         */
        public function store(CreatePhotoRequest $request)
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
                base_path() . '/public/uploads/photo' , $filename
            );
            Image::make(base_path() . '/public/uploads/photo/' . $filename, array(
                'width' => 200,
                'height' => 250,
            ))->save(base_path() . '/public/uploads/photo/thumbnail/' . $filename);
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


        public function photoByAlbum($id , CreatePhotoRequest $request)
        {

            $data = $this->model->getPhotoByAlbum($id);
            $photo = $this->model;
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
            //            $album_ids = $album->album_id;
            /*    while ($album_ids != "0") {
                    $album = $this->album->findByID($album_ids);
                    $album_idss = $album->id;
                    print_r($album_idss);
                }

                exit;*/

            //            dd($albumgroup);

            return view('backend.gallery.album.single' , compact('data' , 'album' , 'albumgroup' , 'photo' , 'breadcrumbs' , 'parent' , 'grandparent'));

        }


        public function edit($id , CreatePhotoRequest $request)
        {

            $model = $this->model->findByID($id);
            $album_id = $model->album_id;
            $album = $this->album->listBYPhotoAlbum();

            return view('backend.gallery.photo.edit' , compact('model' , 'album' , 'album_id'));

        }


        public function update($id , CreatePhotoRequest $request)
        {

            $photo_to_update = $this->model->findByID($id);
            $album_id = $photo_to_update->album_id;

            $uploaded_image = $request->file('image_file');
            $parameter = $request->all();

            if (isset($uploaded_image)) {
                $originalName = $uploaded_image->getClientOriginalName();
                $extension = $uploaded_image->getClientOriginalExtension();
                $size = $uploaded_image->getClientSize();
                $originalNameWithoutExt = substr($originalName , 0 , strlen($originalName) - strlen($extension) - 1);
                $number = mt_rand(1000000000 , 9999999999);
                $filename = $originalNameWithoutExt . '-' . $number . '-' . $photo_to_update->id . "." . $extension;

                $p = $uploaded_image->move(
                    base_path() . '/public/uploads/photo' , $filename
                );
                unset($parameter['image_file']);
                $parameter['image'] = $filename;
                $photo_to_update->update($parameter);

            } else {

                unset($parameter['image_file']);
                $this->model->update($id , $parameter);
            }

            return redirect('admin/photo_by_album/' . $album_id);
        }


        public function delete($id)
        {

            $this->model->delete($id);

            return redirect()->back();

        }




        public function slideshow($id , CreatePhotoRequest $request)
        {

            $data = $this->model->getPhotoByAlbumALL($id);

            $album = $this->album->findByID($id);

            return view('backend.gallery.album.slideshow' , compact('data' , 'album'));

        }



    }
