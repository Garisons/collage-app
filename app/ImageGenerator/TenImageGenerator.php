<?php

namespace App\ImageGenerator;

use Closure;
use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Tzsk\Collage\Contracts\CollageGenerator;
use Tzsk\Collage\Exceptions\ImageCountException;

/**
 * @property Image $canvas
 */
class TenImageGenerator extends CollageGenerator
{
    /**
     * @throws ImageCountException
     */
    public function create($closure = null): Image
    {
        $this->check(10);

        $height = $this->file->getHeight() - $this->file->getPadding();
        $width = $this->file->getWidth() - $this->file->getPadding();

        $this->canvas = ImageManagerStatic::canvas($width, $height);

        $this->makeSelection($closure);

        return ImageManagerStatic::canvas(
            $this->file->getWidth(),
            $this->file->getHeight(),
            $this->file->getColor()
        )->insert($this->canvas, 'center');
    }

    public function grid()
    {
        $width = config('collage.image.width');
        $height = config('collage.image.height');
        $padding = config('collage.image.padding');

        $imageCount = 0;
        $lineCount = 0;

        for (; $imageCount < 5; $imageCount++, $lineCount++) {
            $image = $this->images->get($imageCount);
            $this->canvas->insert($image->fit($width, $height), 'top-left', $padding + $width * $lineCount + $padding * $lineCount, $padding);
        }

        $lineCount = 0;
        for (; $imageCount < 10; $imageCount++, $lineCount++) {
            $tenth = $this->images->get($imageCount);
            $this->canvas->insert($tenth->fit($width, $height), 'bottom-left', $padding + $width * $lineCount + $padding * $lineCount, $padding);
        }
    }

    /**
     * @param Closure|null $closure
     */
    protected function makeSelection(Closure $closure = null)
    {
        if ($closure) {
            call_user_func($closure, $this);
        } else {
            $this->grid();
        }
    }
}
