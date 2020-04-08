<?php

namespace App\Services;

// use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Home;
use App\Models\homeImages;
use App\Models\StudentSkill;
use App\Models\WorkSkill;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
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

    public function uploadImg($image)
    {
        // $photo = $request->file('photo');
        $imageName = $image->getClientOriginalName();

        // //檔案相對路徑
        $imageRelativePath = 'imageHome\\' . $imageName;
        //檔案存取目錄為對外公開public目錄下的相對位置
        $imagePath = public_path($imageRelativePath);

        $existImage = homeImages::where('image', $imageRelativePath)->first();

        if (is_file($imagePath) || $existImage !== null) {
            $msg = [
                'status' => false,
                'errors' => ['image' => '檔案已存在'],
            ];
        } else {
            $imSize = getimagesize($image);
            $imX = $imSize[0];
            $imY = $imSize[1];

            if ($imX > $imY) {
                $imX = $imY;
            } else {
                $imY = $imX;
            }

            $newIm = imagecreatetruecolor(600, 600); //代表了一幅大小为 $imX和 $imY的黑色图像

            $source = imagecreatefromjpeg($image); //从给定的文件名取得的图像

            ImageCopyResampled($newIm, $source, 0, 0, 0, 0, 600, 600, $imSize[0], $imSize[1]); //重采样拷贝部分图像并调整大小

            imagejpeg($newIm, $imagePath);
            Log::notice('原圖片路徑 = ' . $image);
            Log::notice('圖片類型 = ' . $image->getMimeType());
            Log::notice('新圖片路徑 = ' . $imagePath);
            $msg = [
                'status' => True,
                'Path' => $imageRelativePath
            ];
        }
        return  $msg;
    }


}