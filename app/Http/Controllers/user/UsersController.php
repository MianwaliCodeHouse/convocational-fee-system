<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Guests;
use App\Models\stdSlip;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function userDashboard()
    {
        $userId = session()->get('userId');
        $std = Students::find($userId);
        $slip = stdSlip::where('stdId', $userId)->first();
        $guest = Guests::where('stdId', $userId)->count();

        return view('user.dashboard.index', ['std' => $std, 'guestNo' => $guest, 'slip' => $slip]);
    }
    public function submitSlip(Request $request){
        // Validate the request
        // $request->validate([
        //     'slip_copy' => 'required|image|mimes:jpeg,png,jpg,gif|max:155600', // 25KB
        //     'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:155600', // 25KB
            
        // ]);
        // Validate the request
$request->validate([
    'slip_copy' => 'required|image|mimes:jpeg,png,jpg,gif|max:155', // 25KB
    'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:155', // 25KB
    'invite' => 'required|in:yes,no',
    'certificate' => 'required_if:invite,yes|in:silver_madel,gold_madel,Distinction_certificate',
    
]);

        // Upload images
        $slipCopyName = time() . '_slip.' . $request->file('slip_copy')->extension();
        $request->file('slip_copy')->move(public_path('uploads/images/slips'), $slipCopyName);

        $userImageName = time() . '_user.' . $request->file('user_image')->extension();
        $request->file('user_image')->move(public_path('uploads/images/users'), $userImageName);

        // Save data to database
        $student = Students::find(session()->get('userId'));
        $student->slipImage = $slipCopyName;
        $student->image = $userImageName;
        $student->certificate = $request->input('certificate', null);
        $student->status = 3;
        $student->save();
        // Upload image
        if($request->invite=='yes'){

        
        $imageName = time() . '.' . $request->file('guest_image')->extension();
        $request->file('guest_image')->move(public_path('uploads/images/'), $imageName);

        // Save data to database
        $guest = new Guests;
        $guest->stdId = session()->get('userId');
        $guest->name = $request->input('guest_name');
        $guest->father = $request->input('guest_f_name');
        $guest->cnic = $request->input('guest_cnic');
        $guest->image = $imageName;
        $guest->save();
    }
        return redirect(route('userDashboard'));
    }
    public function downloadSlip(){
        $std = Students::find(session()->get('userId'));
            $std->status = 2;
            $std->save();
    }
    public function VerifySlip($id){
        $slip = stdSlip::where('slipId',$id)->count();
        return $slip;
    }
    public function submitGuest(Request $request)
    {
        // Validate the request
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_f_name' => 'required|string|max:255',
            'guest_cnic' => 'required|numeric',
            'guest_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:25600', // 25KB
        ]);

        // Upload image
        $imageName = time() . '.' . $request->file('guest_image')->extension();
        $request->file('guest_image')->move(public_path('uploads/images/'), $imageName);

        // Save data to database
        $guest = new Guests;
        $guest->stdId = session()->get('userId');
        $guest->name = $request->input('guest_name');
        $guest->father = $request->input('guest_f_name');
        $guest->cnic = $request->input('guest_cnic');
        $guest->image = $imageName;
        if ($guest->save()) {
            $std = Students::find(session()->get('userId'));
            $std->status = 1;
            $std->save();
            return redirect(route('userDashboard'));
        }
    }
    public function userRegister()
    {
        return view('user.register');
    }
    public function userRegistered(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'father_name' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'cnic' => 'required|numeric|unique:students,cnic',
            'email' => 'required|email|unique:students,mobileNo',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
            'program' => 'required|in:bscs,bsit',
            'registration_number' => 'required|string|unique:students,registerationNo',
            'contact_number' => 'required|numeric|unique:students,mobileNo',

        ]);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->route('user.register')->withErrors($validator)->withInput();
        }

        // Create a new Student instance
        $student = new Students([
            'name' => $request->input('username'),
            'fatherName' => $request->input('father_name'),
            'dob' => $request->input('birth_date'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'cnic' => $request->input('cnic'),
            'mobileNo' => $request->input('contact_number'),
            'password' => bcrypt($request->input('password')),
            'department' => $request->input('program'),
            'registerationNo' => $request->input('registration_number'),
        ]);

        // Save the Student instance to the database
        $student->save();
        $createSlip = new stdSlip;
        $createSlip->stdId = $student->id;
        $createSlip->slipId = time() . random_int(982, 89834);
        $createSlip->save();
        return redirect(route('user.login'));
    }
}
