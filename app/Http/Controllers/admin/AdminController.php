<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function adminDashboard(){
        $stds=Students::all();
        return view('admin.index',['stds'=>$stds]);
    }
    public function testAdmin(){
        $admin=new User;
        $admin->username='yasirDev';
        $admin->password='yasirDev';
        $admin->save();
    }
    public function exportStocks()
    {
        
        $stds=Students::all();
        $csvFileName = 'students.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $handle = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($handle, ['RegisterationNo','StudentName', 'FatherName', 'CNIC', 'Email', 'Gender', 'DOB', 'Department', 'MobileNumber', 'Image', 'SlipImage','certificate']);

        $userUrl=url("").'/public/uploads/images/users/';
        $slipUrl=url("").'/public/uploads/images/slips/';
        // Add CSV rows
        foreach ($stds as $std) {

            fputcsv($handle, [$std->registerationNo, $std->name, $std->fatherName, $std->cnic, $std->email,$std->gender, $std->dob, $std->department, $std->mobileNo, $userUrl.$std->image, $slipUrl.$std->slipImage, $std->certificate]);
        }

        fclose($handle);

        return Response::make(file_get_contents('php://output'), 200, $headers);
    }
}
