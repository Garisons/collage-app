<?php

namespace App\Http\Controllers;

use App\Helpers\StorageHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CollageController extends Controller
{
    const ASSET_DIR = 'public/assets';

    public function index(): Factory|View|Application
    {
        $files = StorageHelper::getFiles(self::ASSET_DIR);
        return view('collage.index', [
            'images' => $files,
        ]);
    }
}
