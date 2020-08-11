<?php


namespace App\Utilities;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class GestionMedia
{
    private $mediaAlbum;
    private $slugger;

    public function __construct($mediaAlbum, SluggerInterface  $slugger)
    {
        $this->mediaAlbum = $mediaAlbum;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file, $media = null)
    {

        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFileName);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        // Deplacement du fichier dans le repertoire dedié
        try {
            if ($media === 'pochette') $file->move($this->mediaAlbum, $newFilename);
            else $file->move($this->mediaAlbum, $newFilename);
        }catch (FileException $e){

        }

        return $newFilename;

    }

    /**
     * Suppression de l'ancien media sur le server
     *
     * @param $ancienMedia
     * @param null $media
     * @return bool
     */
    public function removeUpload($ancienMedia, $media = null)
    {
        if ($media === 'cover') unlink($this->mediaAlbum.'/'.$ancienMedia);
        elseif ($media === 'img1920') unlink($this->media1920.'/'.$ancienMedia);
        elseif ($media === 'img480') unlink($this->media480.'/'.$ancienMedia);
        else unlink($this->media250.'/'.$ancienMedia);

        return true;
    }
}