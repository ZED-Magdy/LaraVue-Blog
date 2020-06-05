<?php

namespace App\Traits;

use App\Image;

trait Imageable {

    public function addImage(){
        $image_url = $this->addImageFile();
        $image = new Image;
        $image->user_id = auth()->id();
        $image->url = $image_url;
        $this->Images()->save($image);
    }
    /**
     *
     * @param integer $id
     * @return bool
     */
    public function deleteImage(int $id) :bool {
        $image = $this->Images()->where('id',$id)->first();
        $this->deleteImageFile($image->url);
        $image->delete();
        return true;
    }
    /**
     *
     * @param array $ids
     * @return bool
     */
    public function deleteImages(array $ids = null) :bool {
        if(!$ids){
            $images = $this->Images()->get();
        }else{
            $images = $this->Images()->whereIn('id',$ids)->get();
        }
        foreach($images as $image) {
            $this->deleteImageFile($image->url);
            $image->delete();
        }
        return true;
    }
    /**
     *
     * @param string $url
     * @return void
     */
    private function deleteImageFile(string $url){
        //TODO: 
    }
    private function addImageFile(){
        //TODO: add Image from request
    }
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function Images(){
        return $this->morphMany(Image::class,'imageable');
    }
}