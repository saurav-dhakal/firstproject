Route::group(['namespace'  => 'IT'], function () {
	
  Route::get('about' , 'AboutController@index')->name('about');
  Route::get('about/create' , 'AboutController@create')->name('about.create');
  Route::post('about/store' , 'AboutController@store')->name('about.store');
  Route::get('about/{id}/edit' , 'AboutController@edit')->name('about.edit');
  Route::get('about/{id}/delete' , 'AboutController@delete')->name('about.delete');
  Route::patch('about/{id}' , 'AboutController@update')->name('about.update');
 
 });