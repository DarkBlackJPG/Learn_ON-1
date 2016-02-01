<?php

//course routes
Route::get ('/','WelcomeController@index');
Route::get('main','CoursesController@main');
Route::post('lecture/{id}','CoursesController@lecture');
Route::get('getLecture/{id}','CoursesController@getLecture');
Route::get('test/{id}','CoursesController@test');
Route::post('question/{id}','CoursesController@question');
Route::get('getQuestion/{id}','CoursesController@getQuestion');
Route::resource('courses','CoursesController');
Route::get('categories','CoursesController@categories');
Route::post('course_img','CoursesController@course_img');
Route::post('delete_course/{id}','CoursesController@delete_course');
Route::post('enroll/{id}','CoursesController@enroll');
Route::get('lectures/{id}/edit','CoursesController@editLecture');
Route::get('lectures/{id}','CoursesController@course_lecture');
Route::get('exam/{id}','CoursesController@getExam');
Route::get('exam/{id}/edit','CoursesController@getExamEdit');
Route::patch('questionUpdate/{id}','CoursesController@questionUpdate');
Route::patch('lectureUpdate/{id}','CoursesController@lectureUpdate');
Route::post('delete_lecture/{id}','CoursesController@delete_lecture');
Route::post('lecture_pdf','CoursesController@lecture_pdf');
Route::post('quit/{id}','CoursesController@quit');
Route::post('save','CoursesController@save');
Route::post('delete_question/{id}','CoursesController@delete_question');
Route::get('redirecting/{id}','CoursesController@redirecting');
Route::get('mycourses','CoursesController@getMyCourses');
Route::get('see/{id}','CoursesController@see');
Route::get('finish/{id}','CoursesController@finish');
Route::post('comment','CoursesController@comment');
Route::post('comment_delete/{id}','CoursesController@comment_delete');


Route::Controllers([
    'auth'=>'Auth\AuthController',
    'password'=>'Auth\PasswordController',
]);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'password' => 'Auth\PasswordController',
]);
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);


route::get('tags/{tags}','TagsController@show');

route::get('account','PagesController@account');
route::get('users/{id}','UsersController@show');
route::get('users','UsersController@index');
route::get('add_user','UsersController@getAdd_User');

// Edit account routes
route::post('edit_pass','EditUsersController@postEdit_pass');
route::post('edit_img','EditUsersController@postEdit_img');
route::post('edit_username','EditUsersController@postEdit_username');
route::post('edit_email','EditUsersController@postEdit_email');
route::post('delete_account','EditUsersController@postDelete_account');

// Edit user account routes
route::post('admin_edit_pass','UsersController@postAdmin_Edit_pass');
route::post('admin_edit_username','UsersController@postAdmin_Edit_username');
route::post('admin_edit_email','UsersController@postAdmin_Edit_email');
route::post('admin_delete_user','UsersController@postAdmin_Delete_user');
route::post('admin_add_user','UsersController@postAdmin_Add_user');
route::post('admin_user','UsersController@postAdmin_user');
route::post('user_admin','UsersController@postUser_admin');

//Edit static pages routes
Route::get('about','PagesController@getAbout');
Route::get('help','PagesController@getHelp');
Route::get('terms&conditions','PagesController@getTerms');
Route::post('about','PagesController@postAbout');
Route::get ('contact','PagesController@getContact');

//Search routes
route::post('searchTags','TagsController@postSearch');
Route::post('search','CoursesController@postSearch');
Route::post('search_users','PagesController@postSearchUser');
Route::post('search_lectures','PagesController@postSearchLecture');

//library routes
Route::get('library','PagesController@library');
Route::get('library/{id}','PagesController@show');


