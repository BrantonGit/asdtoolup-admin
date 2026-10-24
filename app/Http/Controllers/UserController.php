<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\User;
use TradeInTradeUp\Submissions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use TradeInTradeUp\Mail\ForgotPassword;
use TradeInTradeUp\FileUpload;
use TradeInTradeUp\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Auth;
use Validator;
use TradeInTradeUp\Mail\ToggleEmail;
use TradeInTradeUp\Mail\UpdateUser;


class UserController extends Controller
{
    public function ___construct(){
        // $this->middleware('auth');
    }

    //===========================
    //API Functions
    //===========================
    public function getCustomers(){
        //This is an API example. We need to return the data as json.
        //Backend views must utilize the API call to reduce repetitive functionality.
        // return "?";
        if(Auth::user()->role == 0){
            abort(401);
        } 

        if(!$this->isCustomer()){
            $users = User::select()->where('role', 0)->get();
            return $users;
        } else {
            abort(401, "User does not have permission to access this.");
        }
    }

    public function testapi(request $request){
        $response = 'post request returned';
       return response($response, 200);
    }

    

    public function getAllUsers(){
        $user = Auth::User();
        if($this->isMaster()){
            $users = User::select()->where('id', '!=', $user->id)->get();
            return $users;
        } else{
            abort(401, "User does not have permission to access this.");
        }
    }

    public function getCustomer($id){
        $customer = User::select()->where('id', $id)->first();
        $submissions = Submissions::select()->where('customer_id', $id)->with('author')->with('payment_section')->get();
        $arr = [
            "user" => $customer,
            "submissions" => $submissions
        ];
        return $arr;
    }

    public function getMyInfo(){
        $user = Auth::User();
        return $user;
    }
    public function settingsUpdate(request $request){

        $curUser = Auth::User();
        $user = User::select()->where('id', $curUser->id)->first();
        $user->update([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'city' => $request->input('city'),
            'postal' => $request->input('postal'),
            'address' => $request->input('address'),
            'company' => $request->input('company'),
            'phone' => $request->input('phone'),
        ]);
        $user->save();

        return redirect('/settings');
    }
    public function updateProfileApi(request $request){
        $curUser = Auth::User();
        $info = $request;
        $lang = $request->lang;
        // return $lang;
        $currentStatus = $curUser->notifications;
        if((strlen($request->currentPassword) != 0) && (strlen($request->newPasswordConfirmed) != 1)){
            if (Hash::check($request->currentPassword, Auth::User()->password)) {
                //Check new passwords.
                if($request->newPasswordConfirmed == $request->newPassword){
                    if(strlen($request->newPasswordConfirmed) > 3){
                        $curUser->update(['password' => bcrypt($request->input('newPasswordConfirmed'))]);
                    } else {
                        return response(['dataEn' => 'Your new password is not long enough.', 'dataFr' => 'Your new password is not long enough.'], 403);
                    }
                } else {
                    return response(['dataEn' => 'Your passwords do not match.', 'dataFr' => 'Your passwords do not match.'], 403);
                }
            } else {
                return response(['message' => 'Your current password is invalid.'], 403);
            }

        }

        $curUser->update([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'city' => $request->input('city'),
            'postal' => $request->input('postal'),
            'address' => $request->input('address'),
            'company' => $request->input('company'),
            'phone' => $request->input('phone'),
            'notifications' => $request->input('receiveEmails')
        ]);
        $curUser->save();

        $newStatus = Auth::User()->notifications;
        if($currentStatus !== $newStatus){
            //User changed their email notification status from what it was previously
            if($newStatus == 0){

                //Emails turned off
                $on = 0;

            } else {

                //Emails turned on;
                $on = 1;

            }
            Mail::to($curUser)->send(new ToggleEmail($on, $curUser, $lang));
        }

        if($curUser->notifications == 1){
            Mail::to($curUser)->send(new UpdateUser($curUser, $lang));
        }

        return response(["en_message" => "Your changes have been made!", "fr_message" => "Vos modifications ont été apportées!"], 200);
    }

    public function existingUser(request $request){
        $email = $request->input('email');
        $check = User::select()->where('email', $email)->count();
        $found = 0;
        if($check > 0){
            $name = User::select()->where('email', $email)->pluck('fname', 'lname')->first();
            $found = [1, $name];
        }

            $oldfilePath = '/uploads/'. $request->input('email') . '/new';
            Storage::disk('local')->deleteDirectory($oldfilePath);
            FileUpload::where('folder', $request->input('email'))->where('size', 'new')->delete();

            return $found;

    }
    public function existingUsersInfo(request $request){
        //Look for auth token first, make sure its the actual user requesting it
        $email = $request->input('email');
        // if($check > 0){
            $info = User::select()->where('email', $email)->first();

        // }
        return $info;
    }


    //===========================
    //Back-End Views
    //===========================
    public function getCustomersView(request $request){
        if(Auth::user()->role == 0){
            abort(401);
        } 

        // $users = $this->getCustomers();
        if(strlen($request->input('sort_date')) > 0){
            $date = $request->input('sort_date');
        } else{
            $date = "newest";
        }
        if($date == 'oldest'){
            $ord = 'ASC';
        } else {
            $ord = 'DESC';
        }
        if(strlen($request->input('sort_count')) > 0){
            $count = $request->input('sort_count');
        } else{
            $count = 10;
        }
        if(strlen($request->input('sort_status')) > 0){
            $status = $request->input('sort_status');
        } else {
            $status = 0;
        }

            if($status != 0){
                $users = User::select()->where('role', 0)->orderBy($status, $ord)->paginate($count);
            } else{
        // return $date;
        $users = User::select()->where('role', 0)->orderBy('created_at', $ord)->paginate($count);
            }
        return view('users', [
            'users' => $users,
            'selected_status'=>$status,
            'selected_date1'=>$date,
            'selected_count'=>$count
        ]);
    }
    public function settingsView(){
        if(Auth::user()->role == 0){
            abort(401);
        } 
        $myInfo = $this->getMyInfo();
        return view('settings', ['info' => $myInfo]);
    }
    public function getCustomerView($id){
        
        if(Auth::user()->role == 0){
            abort(401);
        } 
        $arr = $this->getCustomer($id);

        // return $arr;

        return view('user', [
            'user' => $arr['user'],
            'submissions' => $arr['submissions']
        ]);
    }




    //API
    public function loginApi(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response([
                'en_message' => 'No account associated with that email address.',
                'fr_message' => 'Aucun compte n’est associé à cette adresse de courriel.',
            ], 422);
        }

        $throttleKey = Str::transliterate(Str::lower((string) $request->input('email')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return response([
                'en_message' => "You have attempted to login too many times. Try again in {$seconds} seconds.",
                'fr_message' => "Vous avez effectué trop de tentatives de connexion. Veuillez réessayer dans {$seconds} secondes.",
            ], 403);
        }

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (! auth()->attempt($loginData)) {
            RateLimiter::hit($throttleKey, 60);

            return response([
                'en_message' => 'Your password or email address do not match our records.',
                'fr_message' => 'Votre mot de passe ou adresse courriel ne correspond pas à ce que nous avons dans nos dossiers.',
            ], 422);
        }

        RateLimiter::clear($throttleKey);

        return $user->createToken('Token Granted');
    }


    public function registerApi(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            return response("An account with this email address already exists.", 422);
            //I don't think this response ever gets sent to the user, but translation is:
            //Un compte associé à cette adresse de courriel existe déjà.
        } else {
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'File Type must be in jpeg,jpg,png.',
                'image' => 'The file must be an image file with the type jpeg, jpg, png.',
                'max' => 'Please upload a file under 5MB for :attribute',
            ];

            $attributes = [
                'fname' => 'first name',
                'lname' => 'last name',
            ];

            $validator = Validator::make($request->all(), [
                'fname'=>'required|max:50',
                'lname'=>'required|max:50',
                'email'=>'required|email|unique:users',
                'password'=>'required',
                'city'=>'required|max:100',
                'phone'=>'required|max:25',
                'postal'=>'required|max:100',
                'company'=>'required|max:100'
            ], $messages, $attributes);

            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()->all()], 403);
            }
            // return bcrypt($request->password);
        $newUser = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'postal' => $request->postal,
            'company' => $request->company
        ]);
        if($newUser){
            if (Hash::check($request->password, $newUser->password)) {
                $token = $newUser->createToken('Token Granted')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            }
        }
        }
    }

    public function getInfo(Request $request){
        if(Auth::id()){
            $user = User::select()->where('id', Auth::id())->first();
            return response($user, 200);
        } else {
            return response('User not found', 422);
        }
    }

    public function forgotPasswordApi(Request $request){
        if($request->input("lang") == "fr"){
            $lang = "fr";
        } else {
            $lang = "en";
        }
        $user = User::where('email', $request->input('email'))->first();

        if (!$user){
            return response(['dataEn' => 'No account is associated with this email.', 'dataFr' => 'Aucun compte n’est associé à cette adresse de courriel.'], 403);
        }

        $token = Token::create([
            'user_id' => $user->id,
            'token' => uniqid(),
            'expire_at' => Carbon::now()->addHour()
        ]);
        $token->save();

        // return $token;
        Mail::to($user)->send(new ForgotPassword($token, $request, $lang));

        return response(['data' => 'Email sent.'], 200);

    }
    public function resetPasswordApi(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'vpassword' => 'required|same:password'
        ]);

        if ($validator->fails()){
            return response(['data' => $validator->errors()], 433);
        }

        $token = $request->input('token');
        // return $token;
        $dbToken = Token::select()->where('token', $token)->where('expire_at', '>', Carbon::now())->first();
        if(!$dbToken){
            return response(['dataEn' => 'There was an error.', 'dataFr' => 'Une erreur est survenue.'], 403);
        }

        $user = User::where('id', $dbToken->user_id)->first();
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return response(['dataEn' => "Your changes have been made!", 'dataFr' => "Vos modifications ont été apportées!"], 200);

    }
    //Do we need email verification? Most likely. Follow up.
    public function verifyEmail(){}


    

}
