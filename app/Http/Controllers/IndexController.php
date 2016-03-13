<?php

namespace App\Http\Controllers;

use App\Area;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Helpers\APIResponse;
use App\Http\Services\IndexService;

class IndexController extends Controller
{

    /**
     *
     * @var mixed null | App\Http\Services\IndexService
     */
    protected $service = null;

    public function __construct()
    {
        $this->service = new IndexService();
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $reponse = array();
        try {
            $data = $request->all();
            $vendors = $this->service->getVendors($data);
            APIResponse::$message['success'] = 'No result found.';
            if (!empty($data['category']) && $subCategory = SubCategory::getSubCategoryById($data['category'])) {
                $subCategory->rootCategory;
                $reponse['category'] = $subCategory;
            }

            if (!empty($data['area_id']) && $area = Area::getAreaById($data['area_id'])) {
                $area->cities;
                $reponse['area'] = $area;
            }

            if ($vendors) {
                APIResponse::$data = $vendors->toArray();
                APIResponse::$message['success'] = "";
            }
        } catch (Exception $exception) {
            APIResponse::handleException($exception);
        }

        return APIResponse::sendResponse();
    }
    
    /**
     * Get featured facilities.
     * 
     * @return App\AvailableFacilities
     */
    public function featuredListing()
    {
        try {
            APIResponse::$data = $this->service->getFacilities(array('is_featured', '=', 1));
        } catch (Exception $exception) {
            APIResponse::handleException($exception);
        }

        return APIResponse::sendResponse();
    }

    /**
     * Get all lates available facilities those are added recently.
     * 
     * @return App\AvailableFacilities
     */
    public function latestFacilities()
    {
        try {
            APIResponse::$data = $this->service->getFacilities(array('is_featured', '!=', 1));
        } catch (Exception $exception) {
            APIResponse::handleException($exception);
        }

        return APIResponse::sendResponse();
    }
  
}