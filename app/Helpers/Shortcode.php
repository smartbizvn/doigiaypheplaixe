<?php
namespace App\Helpers;

use Illuminate\Support\Facades\View;

class Shortcode
{
    public function renderSlider($id): string
    {
        $slider = [];//Slider::with('images')->find($id);
        return View::make('shortcodes.slider', compact('slider'))->render();
    }

    public function renderVideo($id): string
    {
        $video = [];//Video::find($id);
        return View::make('shortcodes.video', compact('video'))->render();
    }
}   