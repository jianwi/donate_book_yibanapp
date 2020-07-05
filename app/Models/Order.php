<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function generateCertificate()
    {
        $date = date('Y 年 m 月 d 日',$this->created_at->getTimestamp());
        return \Intervention\Image\Facades\Image::make("img/book.png")
            ->text("尊敬的 {$this->name} 同学, 感谢您于 {$date}",250,630,function($font) {
                $font->file('font/msyhbd.ttf');
                $font->size(62);
                $font->align('justify');
//                $font->color();
            })
            ->text("通过易班平台捐赠 {$this->count} 本图书，我们会妥善安排您捐赠的图书！",120,750,function($font) {
                $font->file('font/msyhbd.ttf');
                $font->size(62);
                $font->align('justify');
//                $font->color();
            })
            ->response("png",80);
    }


    public function sendEmail()
    {

    }
}
