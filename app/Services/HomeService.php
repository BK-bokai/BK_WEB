<?php

namespace App\Services;

// use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Home;
use App\Models\StudentSkill;
use App\Models\WorkSkill;
use Illuminate\Support\Facades\Validator;
class HomeService
{

    public function validator(array $data)
    {
        return Validator::make($data, [
            'skill' => ['required', 'string', 'max:255'],
        ], [
            'skill.required'    => '請輸入技能名稱。',
        ]);
    }

    public function CheckEdit(Request $request)
    {
        $content_1 = Home::find(1)->content_1;
        $content_2 = Home::find(1)->content_2;
        $content_3 = Home::find(1)->content_3;
        $content_4 = Home::find(1)->content_4;

        if (
            $request->content_1 != $content_1 ||
            $request->content_2 != $content_2 ||
            $request->content_3 != $content_3 ||
            $request->content_4 != $content_4
        ) {
            return ['change' => True];
        } else {
            return ['change' => False];
        }
    }


}