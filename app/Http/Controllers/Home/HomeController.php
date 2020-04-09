<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\StudentSkill;
use App\Models\WorkSkill;
use App\Services\HomeService;
use App\models\homeImages;
use Auth;

class HomeController extends Controller
{
    protected $HomeService;
    public function __construct(HomeService $HomeService)
    {
        $this->HomeService = $HomeService;
    }
    public function index()
    {
        $user = Auth::user();
        $home = Home::first();
        $image = homeImages::where('publish', 1)->first();
        $image->image = url($image->image);
        $studentSkills = StudentSkill::all();
        $workSkills = WorkSkill::all();
        return view('Home.homePage', compact('home', 'image', 'studentSkills', 'workSkills', 'user'));
    }

    public function HomeAdmin()
    {
        $user = Auth::user();
        $home = Home::first();
        $home->image = url($home->image);
        $studentSkills = StudentSkill::all();
        $workSkills = WorkSkill::all();
        return view('Home.homePageAdmin', compact('home', 'studentSkills', 'workSkills', 'user'));
    }

    public function homeCheckChange(Request $request)
    {
        $check = $this->HomeService->CheckEdit($request);
        return $check;
    }

    function homeUpdate(Request $request)
    {
        $check = $this->HomeService->CheckEdit($request);
        if ($check['change']) {
            $home = Home::find(1);
            $home->content_1 = $request->content_1;
            $home->content_2 = $request->content_2;
            $home->content_3 = $request->content_3;
            $home->content_4 = $request->content_4;
            $home->save();
            return redirect(route('Home.Admin'))
                ->with('status', "首頁內容已成功更新");
        }
        throw new \Symfony\Component\HttpKernel\Exception\HttpException(404);
    }

    public function addStudentSkill(Request $request)
    {
        $this->HomeService->Validator($request->all())->validate();
        StudentSkill::create($request->all());
        return redirect()->route('Home.Admin');
    }

    public function addWorkSkill(Request $request)
    {
        $this->HomeService->Validator($request->all())->validate();
        WorkSkill::create($request->all());
        return redirect()->route('Home.Admin');
    }

    public function delStudentSkill(Request $request, StudentSkill $studentSkill)
    {
        $studentSkill->delete();
        return ['Finsh'];
    }

    public function delWorkSkill(Request $request, WorkSkill $workSkill)
    {
        $workSkill->delete();
        return ['Finsh'];
    }
}
