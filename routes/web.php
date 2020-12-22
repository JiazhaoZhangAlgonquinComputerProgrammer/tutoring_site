<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\TutoringCourseController;
use App\Http\Controllers\TutorController;
use App\Mail\AppointmentMail;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', "TuteeController@login");

// Route::get('/hello', function () {
//     return "Hello?????";
// });

// Route::get('/sendEmail',function(){

//     $returnValue = Mail::to('zhan0599@algonquinlive.com')->send(new AppointmentMail(['helloWorld']));

//     return "send email ...".$returnValue;

// });

// Route::get('/admin', [AdminController::class, 'index']);
Route::get('/tutee/register', "TuteeController@register");
Route::get('/tutee/login', "TuteeController@login");
Route::get('/tutee/bookappointment', "TuteeController@bookappointment");
Route::post('/tutee/bookappointment', "TuteeController@bookappointment");
Route::get('/tutee/dashboard', "TuteeController@dashboard");
Route::post('/tutee/registerNewTutee', "TuteeController@store");
Route::post('/tutee/tuteeLogIn', "TuteeController@tuteeLogIn");
Route::post('/tutee/findTutors', "TuteeController@findTutors");
Route::post('/tutee/submitbooking', "TuteeController@handleBooking");
Route::get('/tutee/checkAppointments', "TuteeController@checkAppointments");
Route::get('/tutee/logout', "TuteeController@logout");

Route::get('/admin', "AdminController@index");
Route::get('/admin/index', "AdminController@index");
Route::post('/admin/post', "PostController@store");
Route::get('/admin/register', "AdminController@register");
Route::get('/admin/dashboard', "AdminController@dashboard");
Route::get('/admin/logout', "AdminController@logout");
Route::post('/admin/login', "AdminController@login");

Route::get('/admin/dashboard/registerCourse', "TutorController@registerCourse");
Route::get('/admin/dashboard/myCourses',"TutorController@showCourses");
Route::get('/admin/dashboard/postmyschedual',"TimeSlotController@index");
Route::get('/admin/dashboard/displaymytimeslots',"TimeSlotController@showAllTimeSlots");

Route::post('/timeslot/add', 'TimeSlotController@store');
Route::post('/timeslot/find', 'TimeSlotController@findTimeSlotsByUserAndDate');

Route::post('/course/add', 'TutoringCourseController@store');
Route::get('/tutor/{username}/timeslot/{date}', 'TimeSlotController@getTutorTimeSlotsByDate');
Route::get('/tutor/{email}/availabletimeslot/{date}', 'TimeSlotController@getTutorAvailableTimeSlotsByDate');
Route::get('/tutor/{email}/courses', 'TutorController@getCourses');
Route::get('/tutor/registration', "TutorController@registration");
Route::post('/tutor/registerNewTutor', "TutorController@addNewTutor");
