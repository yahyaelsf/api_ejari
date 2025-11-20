<?php


namespace App\Services;

use App\Constants\ResourceTypes;
use App\Models\Attachment;
use FFMpeg\FFProbe;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class FileService
{

    protected $mainStorage = "uploads";

    protected function renameAndMoveTo($file, $destination)
    {
        $fileName = ($destination ? $destination . '/' : '');
        $fileName = $fileName . time() . uniqid() . '.' . $file->getClientOriginalExtension();
        $fileName = trim($fileName);
        $fileOriginalName = $file->getClientOriginalName();

        $file->move($this->mainStorage . '/' . $destination, $fileName);

        return [$fileOriginalName, $fileName];
    }

    public function moveTo($file, $destination)
    {
        $fileName = $destination . '/';
//        $fileName = $fileName . time() . uniqid() . '.' . $file->getClientOriginalExtension();
//        $fileName = trim($fileName);
        $fileOriginalName = $fileName . $file->getClientOriginalName();
        $fileName = str_replace(' ', '_', $fileOriginalName);
        $fileName = trim($fileName);
        $file->move($this->mainStorage . '/' . $destination, $fileName);

        return [$fileOriginalName, $fileName];
    }

    public function uploadFile($file, $destination = '')
    {
        return $this->renameAndMoveTo($file, $destination);
    }


    public function saveFile(Model $model, $file, $destination = '')
    {

        $uploadedFile = $this->uploadFile($file, $destination);//[1]
        $fileOriginalName = $uploadedFile[0];
        $fileName = $uploadedFile[1];
        return $model->resources()->create([
            's_title' => $fileOriginalName,
            's_filename' => $fileName,
            's_directory' => $destination
        ]);
    }

    public function saveCover(Model $model, $file, $destination = '')
    {
        $fileName = $this->uploadFile($file, $destination)[1];

        return $model->update(['s_cover' => $fileName]);
    }

    public function multipleFileUpload(Model $model, $files, $destination = '', $fileType = "")
    {
        foreach ($files as $file) {
            $this->saveFile($model, $file, $destination);
        }

    }

    public function saveBase64Image($image, $path = "")
    {
        $imageName = $path . '/' . uniqid('', true) . time() . '.' . 'png';
        Image::make($image)->save(public_path() . '/uploads/' . $imageName);
        return $imageName;
    }

    public function saveBase64Cover(Model $model, $file, $destination = '')
    {
        $fileName = $this->saveBase64Image($file, $destination);

        return $model->cover()->updateOrCreate(['s_type' => ResourceTypes::COVER], [
            's_filename' => $fileName,
            's_directory' => $destination
        ]);
    }

    public function getVideoDuration($path)
    {
        $ffprobe = FFProbe::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe'
        ]);

        $path = public_path($path);
        return $ffprobe->format($path)->get('duration');
    }

    public function convertBase64TOUrl($details, $path="")
    {
        if(!$details){
            return $details;
        }

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->loadHtml(mb_convert_encoding($details, 'HTML-ENTITIES', 'UTF-8'));
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $imageName = $this->saveBase64Image($src, $path);
                $image->removeAttribute('src');
                $image->setAttribute('src', asset('uploads/' . $imageName));
            }
        }
        return $dom->savehtml($dom->documentElement) . PHP_EOL . PHP_EOL;
    }
}
