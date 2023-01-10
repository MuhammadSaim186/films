<?php

namespace App\Http\Controllers;

use App\Films;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Image;
use Carbon\Carbon;
use App\Photo;
use App\User as AppUser;
use Intervention\Image\Exception\NotReadableException;

date_default_timezone_set('Asia/Karachi');

class ApiController extends Controller
{
    public function login(Request $request)
    {
        checkParams(array('phone'));

        $user = User::where(['phone' => $request->phone])->first();

        if ($user) {
            if ($user->user_type == 'user') {
                if ($user->is_active == 0) {
                    return response()->json(['status' => 'error', 'msg' => 'Your account is not active, Contact Administrator']);
                } else {

                    $user['token'] = ($user->createToken('token')->plainTextToken);
                    // $otp = 1234;
                    $otp = mt_rand(1000, 9999);
                    $user['otp'] = $otp;
                    $userUpdate = User::find($user->id);
                    $userUpdate->is_online = 1;
                    $userUpdate->save();


                    return response()->json(['status' => 'success', 'msg' => 'Successfully Login', 'data' => $user]);
                }
            } else {
                return response()->json(['status' => 'error', 'msg' => 'UserType must be user']);
            }
        } else {
            $user = new User();
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->user_type = "user";
            $user->save();
            $users = User::where('id', $user->id)->first();
            $users['token'] =  $users->createToken('token')->plainTextToken;
            $otp = 1234;

            $users['otp']    = $otp;

            return response()->json(['status' => 'success', 'msg' => 'Successfully Login', 'data' => $users]);
        }
    }



    public function addFilm(Request $request)
    {
        checkParams(['Name', 'Description', 'Rating', 'ReleaseDate', 'TicketPrice', 'Country',"Genre","Photo"]);
        if($request->has('image')){
            $files = $request->file('image');
            $ImageUpload = Image::make($files);
            $originalPath = public_path('uploads/');
            $time = time();
            $ImageUpload->save($originalPath.$time.$files->getClientOriginalName());
            $image = $time.$files->getClientOriginalName();

        }
        $film = new Films();
        $film->Name = $request->Name;
        $film->Description = $request->Description;
        $film->Rating = $request->Rating;
        $film->ReleaseDate = date("Y-m-d",strtotime($request->ReleaseDate));
        $film->TicketPrice = $request->TicketPrice;
        $film->Country = $request->Country;
        $film->Genre = $request->Genre;
        $film->slug::slug($request->Name);
        $film->Photo = $image;
        $film->save();
        return response()->json(['status' => 'success', 'msg' => 'film is added successfully']);
    }


    public function logout(Request $request)
    {
        checkParams(['user_id']);
        $user = User::find($request->user_id);
        $user->is_online = 0;
        $user->save();
        return response()->json(['status' => 'success', 'msg' => 'User has successfully logout']);
    }



}
