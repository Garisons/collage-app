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

        $one = $this->images->get(0);
        $this->canvas->insert($one->fit($width, $height), 'top-left', $padding, $padding);

        $two = $this->images->get(1);
        $this->canvas->insert($two->fit($width, $height), 'top-left', $padding + 362 + $padding, $padding);

        $three = $this->images->get(2);
        $this->canvas->insert($three->fit($width, $height), 'top-left', $padding + 362 * 2 + $padding * 2, $padding);

        $four = $this->images->get(3);
        $this->canvas->insert($four->fit($width, $height), 'top-left', $padding + 362 * 3 + $padding * 3, $padding);

        $fifth = $this->images->get(4);
        $this->canvas->insert($fifth->fit($width, $height), 'top-left', $padding + 362 * 4 + $padding * 4, $padding);

        $sixth = $this->images->get(5);
        $this->canvas->insert($sixth->fit($width, $height), 'bottom-left', $padding, $padding);

        $seventh = $this->images->get(6);
        $this->canvas->insert($seventh->fit($width, $height), 'bottom-left', $padding + 362 + $padding, $padding);

        $eighth = $this->images->get(7);
        $this->canvas->insert($eighth->fit($width, $height), 'bottom-left', $padding + 362 * 2 + $padding * 2, $padding);

        $ninth = $this->images->get(8);
        $this->canvas->insert($ninth->fit($width, $height), 'bottom-left', $padding + 362 * 3 + $padding * 3, $padding);

        $tenth = $this->images->get(9);
        $this->canvas->insert($tenth->fit($width, $height), 'bottom-left', $padding + 362 * 4 + $padding * 4, $padding);
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
