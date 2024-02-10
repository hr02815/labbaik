<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'cnic' => ['required', 'numeric', 'digits:13', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'salary' => ['required', 'integer'],
            'dob' => ['required', 'date'],
            'role_id' => ['required', 'integer']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    public function store(Request $request)
    {
        //dd($data);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'cnic' => ['required', 'numeric', 'digits:13', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'salary' => ['required', 'integer'],
            'dob' => ['required', 'date'],
            'role_id' => ['required', 'integer']

        ]);
 
        if ($validator->fails()) {
            return redirect(route('auth.register'))
                        ->withErrors($validator)
                        ->withInput();
        }
 
        // Retrieve the validated input...
        $validated = $validator->validated();
        $data = $validated; 
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cnic' => $data['cnic'],
            'phone' => $data['phone'],
            'salary' => $data['salary'],
            'dob' => $data['dob'],
            'role_id' => $data['role_id'],
        ]);

        session()->flash('success','User Created Successfully');

        return redirect(route('users.index'));
    }
    public function showUserListing(Request $request)
    {
        $role = $request->query('role');
        if($role!= null){
            \Log::info($role);
            $users = User::where('role_id',$role)->get();
            return view('auth.index')->with('users',$users);
        }
        \Log::info("in here");

        return view('auth.index')->with('users',User::all());
    }

    public function show_history(Request $request,User $user)
    {
        \Log::info("in here");
        //dd(gettype($user->history));
        //dd($request->all());
        

        return view('auth.history')->with('user',$user);

    }
    public function get_history(Request $request,User $user)
    {
        \Log::info("in here");
        //dd(gettype($user->history));
        //dd($request->all());
        $month = $request['month'];
        $year = $request['year'];
        //dd($month,$year);
        $history = $user->history()->whereRaw(" MONTH(created_at) = $month AND YEAR(created_at) = $year AND time_out IS NOT NULL")->get()->toArray();
        $leaves = $user->requests()->whereRaw(" MONTH(from_date) = $month AND YEAR(from_date) = $year  AND status = 'Accepted'")->get()->toArray();
       // $leaves = $user->requests()->whereRaw("MONTH(created_at) = $month AND YEAR(created_at) = $year AND status = 'Accepted'")->get();
     // dd(gettype($history)); 
       return response()->json([    
            'status' => "success",
            "message" => "succesfully fetched",
            "data" => array(
                "history" =>  $history, 
                "leaves" =>  $leaves
            )]);
    }
    

    public function edit(User $user) {

        return view('auth.register')->with('user',$user);
        
    }
    public function create() {

        return view('auth.register');
        
    }

    public function update(User $user, Request $req) {

        $data = $req->all();
        $user->update(
            [
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cnic' => $data['cnic'],
            'phone' => $data['phone'],
            'salary' => $data['salary'],
            'dob' => $data['dob'],
            'role_id' => $data['role_id']
        ]
    );

        session()->flash('success','User Updated Successfully');

        return redirect(route('users.index')); 
    }

    public function destroy(User $user) {
            session()->flash('success','User Deleted Successfully');
            $user->delete();
        
        return redirect(route('users.index')); 

    }
}
