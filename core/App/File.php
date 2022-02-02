<?php

namespace App;

class File
{
    private $uploadDirectory;
    private $fileData;
    private $extension;
    private $tempFile;
    private $name;
    private $target;
    private $mimeType;
    private $validImages = [
        "image/png", "image/jpg", "image/jpeg", "image/gif"
    ];

    /**
     * l'index dans $_FILES[$index] et _construct($index) correspond à imageVelo, spécifié dans le template de création
     * dans l'input de type "file" name="imageVelo" 
     */
    public function __construct($index)
    {
        $this->uploadDirectory = dirname(__DIR__) . "/../images/";
        $this->fileData = $_FILES[$index]; // ["imageVelo"]
        $this->tempFile = $this->fileData['tmp_name'];
        $this->mimeType = $this->fileData['type'];
        $this->extension = pathinfo($this->fileData['name'], PATHINFO_EXTENSION); // donne l'extension du fichier
        $this->name = uniqid() . "." . $this->extension; // uniqid génère id unique
        $this->target = $this->uploadDirectory . $this->name;
    }

    /**
     * upload l'image dans le fichier images grace à la methode move_uploaded_file
     * FROM $this->tempFile TO $this->target
     */
    public function upload()
    {
        // var_dump($_FILES);
        // die();
        move_uploaded_file($this->tempFile, $this->target);
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * vérifie si le fichier sélectionné par l'utilisateur est une image en le comparant
     * avec les extensions contenues dans le tableau validImages
     */
    public function isImage(): Bool
    {
        $result = false;
        if (in_array($this->mimeType, $this->validImages)) {
            $result = true;
        }
        return $result;
    }
}
