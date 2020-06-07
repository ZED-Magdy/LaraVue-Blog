<?php

namespace App\Traits;

use App\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait Imageable {

    public function addImages(){
        $images_url = $this->addImagesFiles();
        $images = [];
        foreach ($images_url as $image_url) {
            $image = new Image;
            $image->user_id = auth()->id();
            $image->url = $image_url;
            array_push($images,$image);
        }
       return $this->Images()->saveMany($images);
    
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
    /**
     *
     * @return array
     */
    private function addImagesFiles(){
        $images = request()->file('images');
        $path = 'public/images/';
        $urls = [];
        foreach($images as $image){
            $ext = $image->getClientOriginalExtension();
            $name = uniqid('',true).'.'.$ext;
            Storage::put($path.$name,file_get_contents($image));
            array_push($urls,'images/'.$name);
        }
        return $urls;
    }
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function Images(){
        return $this->morphMany(Image::class,'imageable');
    }
}