<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function faq()
    {
        $faqs = Faq::select('id','title','description')->get();
        return response()->json([
            "status" => true,
            "message" => "faq fetched success",
            "data" => $faqs,
        ]);
    } 
    public function service(){
        $services = Service::select('id','name','slug','image','image_url','requirements')->get();
        return response()->json([
            "statue" => true,
            "message" => "service api fetced",
            "data" => $services,
        ]);
    }
    public function viewService($slug){
        $service = Service::where('slug',$slug)->select('name','slug','image','image_url','requirements')->first();
        return response()->json([
            "status" => true,
            "message" => "success",
            "data" => $service
        ]);
    }
    public function bookService(Request $request){
        $request->validate([
            ''
        ]);
    }
}
