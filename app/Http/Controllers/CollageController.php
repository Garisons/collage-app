<?php

namespace App\Http\Controllers;

use App\ImageGenerator\TenImageGenerator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Tzsk\Collage\Facade\Collage;

class CollageController extends Controller
{
    public function index(): Factory|View|Application|Response
    {
        $width = config('collage.image.width');
        $height = config('collage.image.height');
        $padding = config('collage.image.padding');

        $collageWidth = ($width * 5) + ($padding * 6);
        $collageHeight = ($height * 2) + ($padding * 3);

        $files = File::files('../public/storage/assets/');
        $rgbaColor = [0,0,0,0];

        $image = Collage::make($collageWidth, $collageHeight)
            ->with([8 => TenImageGenerator::class])
            ->background($rgbaColor)
            ->from($files);
        return $image->response('png');
    }
}
