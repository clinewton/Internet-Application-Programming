<?php
    class FileUploader{

        //Member variables
        private static $target_directory = "uploads/";
        private static $size_limit = 50000;
        private $uploadOk = false;
        private $file_original_name;
        private $file_type;
        private $file_size;
        private $final_file_name;

        //Getters and setter
        public function setOriginalName($name){
            $this->file_original_name = $name;
        }

        public function getOriginalName(){
            return $this->file_original_name;
        }

        public function setFileType($type){
            $this->file_type = $type;
        }

        public function getFiletype(){
            return $this->file_type;
        }

        public function setFileSize($size){
            $this->file_size = $size;
        }

        public function getFileSize(){
            return $this->file_size;
        }

        public function setFinalFileName($file_name){
            $this->final_file_name = $file_name;
        }

        public function getFinalFileName(){
            return $this->final_file_name;
        }

        //Methods
        public function uploadFile(){
            if($this->fileSizeIsCorrect() && $this->fileTypeIsCorrect() && !$this->fileAlreadyExists()){
                $this->uploadOk = true;
                if($this->uploadOk){
                    $upload = $this->moveFile();
                    return $upload;
                }
            } else if (!$this->fileSizeIsCorrect()) {
                echo "Sorry, your file is too large. :(<br>";
            } else if (!$this->fileTypeIsCorrect()){
                echo "Sorry, your file is not an image. :(<br>";
            } else if ($this->fileAlreadyExists()){
                echo "File already exists. :(<br>";
            }
            return $this->uploadOk;
        }
        public function fileAlreadyExists(){
            $fileName = FileUploader::$target_directory.$this->getOriginalName();
            if(file_exists($fileName)){
                $exists = true;
            } else {
                $exists = false;
            }
            return $exists;
        }
        public function saveFilePathTo(){}
        public function moveFile(){
            $fileName = $this->getOriginalName();
            $target_file = FileUploader::$target_directory.basename($fileName);
            $tmp_name = $this->getFinalFileName();
            $moved = move_uploaded_file($tmp_name,$target_file);
            return $moved;
        }
        public function fileTypeIsCorrect(){
            if(($this->getFiletype() == "jpg") || ($this->getFiletype() == "png") || ($this->getFiletype() == "jpeg") || ($this->getFiletype() == "gif")){
                $type = true;
            } else {
                $type = false;
            }
            return $type;
        }
        public function fileSizeIsCorrect(){
            $size = true;
            if ($this->getFileSize() > FileUploader::$size_limit){
                $size =  false;
            }
            return $size;
        }
        public function fileWasSelected(){}

    }

?>