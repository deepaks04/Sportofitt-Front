<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Status;
use App\User;
use App\Role;
use Auth;
use App\Area;
use Carbon\Carbon;
use DB;
use URL;
use Illuminate\Support\Facades\Route;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('verify.vendor');

    }

    public function skull(){
        try{
            $status = 200;
            $message = "";
        }catch(\Exception $e){
            $status = 500;
            $message = "Something went wrong ".$e->getMessage();
        }
        $response = [
            "message" => $message
        ];
        return response($response, $status);
    }

    public function getVendorList(){
        try{
            $status = 200;
            $message = "success";
            $role = Role::where('slug','vendor')->first();
            $userCount = User::where('role_id',$role->id)->count();
            if($userCount>0){
                $users = User::where('role_id',$role->id)->with('vendor')->get();
                $i = 0;
                foreach($users as $user){
                    $userData[$i] = $user;
                    if($user->vendor->area_id!=null){
                        $area = Area::find($user->vendor->area_id);
                        $userData[$i]['area'] = $area;
                    }else{
                        $userData[$i]['area'] = "";
                    }
                    $currentStatus = Status::find($user->status_id);
                    $userData[$i]['status'] = $currentStatus;
                    $i++;
                }
                $users = $userData;
            }else{
                $message = "no record found";
                $users = "";
            }
        }catch(\Exception $e){
            $status = 500;
            $message = "Something went wrong ".$e->getMessage();
            $users = "";
        }
        $response = [
            "message" => $message,
            "data"=>$users
        ];
        return response($response, $status);
    }

    public function create(Requests\CreateVendorRequest $request){
        try{
            $status = 200;
            $message = "Vendor registered Successfully";
            $role = Role::where('slug', 'vendor')->first();
            $userStatus = Status::where('slug', 'pending')->first();
            $vendor = "";
            $userData = $request->all();
            $userData['password'] = bcrypt($request->password);
            $userData['is_active'] = 1; // will be 1 after email verification
            $userData['status_id'] = $userStatus->id; // By Default Pending
            $userData['role_id'] = $role->id; // Vendor Role Id
            $userData['remember_token'] = csrf_token();
            $userData['updated_at'] = Carbon::now();
            $userData['created_at'] = Carbon::now();
            unset($userData['business_name']);
            unset($userData['password2']);
            // $user = User::create($userData); //Mass assignment
            // $user->id; last inserted id
            $userId = DB::table('users')->insertGetId($userData);
            $vendorData['business_name'] = $request->business_name;
            $vendorData['user_id'] = $userId;
            $vendorData['updated_at'] = Carbon::now();
            $vendorData['created_at'] = Carbon::now();
            // Calling a method that is from the VendorsController
            $result = $this->insert($vendorData);
            if (!$result['status']) {
                User::destroy($userId);
                throw new \Exception($result['message']);
            }else{
                $vendor = User::where('id',$userId)->with('vendor')->first();
            }
        }catch(\Exception $e){
            $status = 500;
            $message = "Something went wrong ".$e->getMessage();
            $vendor = "";
        }
        $response = [
            "message" => $message,
            "data"=>$vendor
        ];
        return response($response, $status);
    }

    public function insert($vendorData){
        try {
            DB::table('vendors')->insert($vendorData);
            $result['status'] = true;
            return $result;
        } catch (\Exception $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function updateProfile(Requests\UpdateVendorProfileRequest $request,$id)
    {
        try {
            $status = 200;
            $message =  "Settings updated successfully";
            $vendorInformation = "";
            $user = $request->all();
            $vendor = $request->all();
            $userKeys = array(
                'email',
                'username',
                'business_name',
                'longitude',
                'latitude',
                'area_id',
                'description',
                '_method',
                'address',
                'contact',
                'postcode',
                'commission'
            );
            $user = $this->unsetKeys($userKeys, $user);
            $vendorKeys = array(
                'email',
                'username',
                'fname',
                'lname',
                '_method',
                'profile_picture'
            );
            $vendor = $this->unsetKeys($vendorKeys, $vendor);
            $systemUser = User::findOrFail($id);
            if ($request->file('profile_picture')!=null) {
                /* File Upload Code */
                $vendorUploadPath = public_path().env('VENDOR_FILE_UPLOAD');
                $vendorOwnDirecory = $vendorUploadPath.sha1($systemUser->id);
                $vendorImageUploadPath = $vendorOwnDirecory."/"."profile_image";
                /* Create Upload Directory If Not Exists */
                if (! file_exists($vendorImageUploadPath)) {
                    File::makeDirectory($vendorImageUploadPath, $mode = 0777, true, true);
                    // chmod($vendorOwnDirecory, 0777);
                    // chmod($vendorImageUploadPath, 0777);
                }
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                $filename = sha1($systemUser->id . time()) . ".{$extension}";
                $request->file('profile_picture')->move($vendorImageUploadPath, $filename);
                // chmod($vendorImageUploadPath, 0777);

                /* Rename file */
                $user['profile_picture'] = $filename;
            }
            $systemUser->update($user);
            $systemUser->vendor()->update($vendor);
            $vendorInformation = User::where("id",$id)->with('vendor')->first();
            if ($vendorInformation->profile_picture != null) {
                $vendorUploadPath = URL::asset(env('VENDOR_FILE_UPLOAD'));
                $vendorOwnDirecory = $vendorUploadPath . "/" . sha1($systemUser->id) . "/" . "profile_image/";
                $vendorInformation->profile_picture = $vendorOwnDirecory.$vendorInformation->profile_picture;
            }
        } catch (\Exception $e) {
            $status = 500;
            $vendorInformation = "";
            $message = "Something went wrong ".$e->getMessage();
        }
        $response = [
            "message" => $message,
            "data" => $vendorInformation
        ];
        return response($response, $status);
    }

    public function getProfile($id)
    {
        try{
            $status = 200;
            $message = "success";
            $user = User::where('id',$id)->with('vendor')->first();
            $vendorUploadPath = URL::asset(env('VENDOR_FILE_UPLOAD'));
            $vendorOwnDirecory = $vendorUploadPath . "/" . sha1($user->id) . "/" . "profile_image/";
            if ($user->profile_picture == null) {
                $user->profile_picture = $user->profile_picture;
            } else {
                $user->profile_picture = $vendorOwnDirecory . $user->profile_picture;
            }
        }catch(\Exception $e){
            $status = 500;
            $message = "Something went wrong ".$e->getMessage();
            $user = "";
        }
        $response = [
            "message" => $message,
            "data"=>$user
        ];
        return response($response, $status);
    }

    public function getBillingInformation($id)
    {
        try{
            $user = User::findOrFail($id);
            $vendor = $user->vendor()->first();
            $billing = $vendor->billingInfo()->first();
            if ($billing != null) {
                $message = 'success';
                $status = 200;
                $billing = $billing->toArray();
            } else {
                $status = 200;
                $message = 'Please update your billing information';
                $billing = "";
            }
        }catch(\Exception $e){
            $status = 500;
            $message = "Something went wrong ".$e->getMessage();
            $billing = "";
        }
        $response = [
            "message" => $message,
            "data" => $billing
        ];
        return response($response, $status);
    }

    public function updateBillingInformation(Requests\Billing $request,$id)
    {
        try {
            $user = Auth::user();
            $vendor = $user->vendor()->first();
            $billing = $vendor->billingInfo()->first();
            if ($billing != null) { // Update If exists
                $data = $request->all();
                unset($data['_method']);
                $vendor->billingInfo()->update($data);
            } else { // Insert if not exists
                $data = $request->all();
                unset($data['_method']);
                $data['vendor_id'] = $vendor->id;
                $data['created_at'] = Carbon::now();
                $data['updated_at'] = Carbon::now();
                $vendor->billingInfo()->insert($data);
                // $billingInfo = Billing::create($data);
                // $user->vendor()->update(array('billing_info_id'=>$billingInfo->id));
            }
            $status = 200;
            $message = "saved successfully";
        } catch (\Exception $e) {
            echo $e->getMessage();
            $status = 500;
            $message = "something went wrong";
        }
        $response = [
            "message" => $message
        ];
        return response($response, $status);
    }

}
