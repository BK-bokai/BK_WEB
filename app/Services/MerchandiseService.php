<?php

namespace App\Services;

// use App\Repositories\MemberRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MerchandiseService
{
    public function createValidator(array $data)
    {
        //驗證規則
        $rules = [
            //商品狀態
            'status' => [
                'required',
                'in:C,S' //S前面不能有空格
            ],
            //商品名稱
            'name' => [
                'required',
                'max:80',
            ],
            //商品英文名稱
            'name_en' => [
                'required',
                'max:80',
            ],
            //商品介紹
            'introduction' => [
                'required',
                'max:2000',
            ],
            //商品英文介紹
            'introduction_en' => [
                'required',
                'max:2000',
            ],
            //商品照片
            'photo' => [
                'file',
                'image',
                'max:10240', //10 MB
            ],
            //商品價格
            'price' => [
                'required',
                'integer',
                'min:0',
            ],
            //商品剩餘數量
            'remain_count' => [
                'required',
                'integer',
                'min:0',
            ],
        ];

        return Validator::make($data, $rules);
    }

    public function uploadImg($photo)
    {
        // $photo = $request->file('photo');
        $photoName = $photo->getClientOriginalName();

        // //檔案相對路徑
        $photoRelativePath = 'imageMerchandise\\' . $photoName;
        //檔案存取目錄為對外公開public目錄下的相對位置
        $photoPath = public_path($photoRelativePath);

        $existPhoto = Merchandise::where('photo', $photoRelativePath)->first();

        if (is_file($photoPath) || $existPhoto !== null) {
            $msg = [
                'status' => false,
                'errors' => ['photo' => '檔案已存在'],
            ];
        } else {
            $imSize = getimagesize($photo);
            $imX = $imSize[0];
            $imY = $imSize[1];

            if ($imX > $imY) {
                $imX = $imY;
            } else {
                $imY = $imX;
            }

            $newIm = imagecreatetruecolor(600, 600); //代表了一幅大小为 $imX和 $imY的黑色图像

            $source = imagecreatefromjpeg($photo); //从给定的文件名取得的图像

            ImageCopyResampled($newIm, $source, 0, 0, 0, 0, 600, 600, $imSize[0], $imSize[1]); //重采样拷贝部分图像并调整大小

            imagejpeg($newIm, $photoPath);
            Log::notice('原圖片路徑 = ' . $photo);
            Log::notice('圖片類型 = ' . $photo->getMimeType());
            Log::notice('新圖片路徑 = ' . $photoPath);
            $msg = [
                'status' => True,
                'Path' => $photoRelativePath
            ];
        }
        return  $msg;
    }

    public function buyValidator(array $data)
    {
        //驗證規則
        $rules = [
            //商品購買數量
            'buy_count' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
        return Validator::make($data, $rules);
    }
}
