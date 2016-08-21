<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader {

    protected $image;

    public function __construct(ImageManager $image)
    {
        $this->image = $image;
    }

    public function store(UploadedFile $file)
    {
        $filename = join('.', [
            str_random(32),
            $file->guessExtension()
        ]);

        return $this->storeAs($file, 'covers', $filename);
    }

    public function storeAs(UploadedFile $file, $directory, $filename = null)
    {
        $dir = storage_path("app/$directory");

        if(! file_exists($dir)){
            mkdir($dir, 0755, true);
        }

        if($file->isValid()){
            if($file->move($dir, $filename)){
                $this->image->make("$dir/$filename")
                    ->fit(300, 400)
                    ->save();
                return "$directory/$filename";
            }
        }
    }

}
