<?php

namespace App\Traits;

use App\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait Imageable {
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function Images(){
        return $this->morphMany(Image::class,'imageable');
    }
    /**
     *
     * @param string $requestKey
     * @param boolean $isArray
     * @return bool
     */
    public function addImages(string $requestKey,bool $isArray){
        $images = request()->file($requestKey);
        if(!$isArray){
            $url = $this->addImageFile($images);
            $image = $this->addSingleImage($url);
            $this->Images()->save($image);
            return true;
        }
        $imageInstances = [];
        foreach ($images as $image) {
            $url = $this->addImageFile($image);
            $imageInstances[] = $this->addSingleImage($url);
        }
        $this->Images()->saveMany($imageInstances);
        return true;
    }
    /**
     *
     * @param string $url
     * @return Image
     */
    private function addSingleImage($url){
        $image = new Image;
        $image->user_id = auth()->id();
        $image->url = $url;
        return $image;
        
    }
    /**
     *
     * @param UploadeFile $image
     * @return string
     */
    private function addImageFile($image){
        $path = 'public/images/';
        $ext = $image->getClientOriginalExtension();
        $name = uniqid('',true).'.'.$ext;
        Storage::put($path.$name,file_get_contents($image));
        return "images/".$name;
    }
    /**
     *
     * @param integer $id
     * @return bool
     */
    public function deleteImages() :bool {
        $images = $this->Images()->get();
        if($this->deleteImagesFiles($images)){
            foreach($images as $image){
                $image->delete();
            }
        }
        return true;
    }
    /**
     *
     * @param Collection $images
     * @return bool
     */
    private function deleteImagesFiles(Collection $images){
        foreach ($images as $image) {
            Storage::delete('public/'.$image->url);
        }
        return true;
    }
    
}