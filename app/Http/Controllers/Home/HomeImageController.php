<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\homeImages;
use Illuminate\Support\Facades\Auth;
use App\Services\HomeService;

class HomeImageController extends Controller
{
    protected $HomeService;
    public function __construct(HomeService $HomeService)
    {
        $this->HomeService = $HomeService;
    }
    public function showImages()
    {
        $user = Auth::user();
        $images = homeImages::all();
        return view('Home.homeImage', compact('images', 'user'));
    }

    public function Create(Request $request)
    {
        if ($request->hasFile('image')) {
            //有上傳圖片
            $image = $request->file('image');
            $uploadImage = $this->HomeService->uploadImg($image);
            if ($uploadImage['status']) {
                $homeImage = [
                    'image' => $uploadImage['Path'],
                ];
                homeImages::create($homeImage);
                return redirect()->route('Home.Image');
            } else {
                $errors = $uploadImage['errors'];
                return redirect()->back()->withErrors($errors);
            }
        }
    }

    public function Update(Request $request,homeImages $image){
        $oldImage = homeImages::where('publish',1)->first();
        // if(!isNull($oldImage)){
        //     $oldImage->publish=0;
        //     $oldImage->save();
        // }
        // $image->publish=1;
        // $image->save();
        return [$oldImage];
    }
}
