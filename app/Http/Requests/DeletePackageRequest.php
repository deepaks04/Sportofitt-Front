<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\SessionPackage;
use App\AvailableFacility;
use Auth;
use App\PackageType;

class DeletePackageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route('id');//SessionPackageID
        $packageType = PackageType::where('slug','=','package')->first();
        $package = SessionPackage::where(array(
            'id' => $id,
            'package_type_id' => $packageType->id
        ))->first();
        if($package!=null){
            $facility = AvailableFacility::find($package->available_facility_id);
            if($facility==null){
                return false;
            }else{
                $user = Auth::user();
                $vendor = $user->vendor($user->id)->first();
                $isOwner = AvailableFacility::where('id','=',$package->available_facility_id)->where('vendor_id','=',$vendor->id)->count();
                if($isOwner){
                    return true;
                }else{
                    return false;
                }
            }
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}