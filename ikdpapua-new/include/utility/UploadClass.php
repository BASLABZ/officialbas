<?php
class UploadClass{
    
    var $FileName;   
    var $TempFileName;
    var $UploadDirectory;
    var $ValidExtensions;
    var $Message;
    var $MaximumFileSize;
    var $IsImage;
    var $Email;
    var $MaximumWidth;
    var $MaximumHeight;
 

  
    function ValidateExtension()
    {
        $FileName = trim($this->FileName);
        $FileParts = pathinfo($FileName);
        $Extension = strtolower($FileParts['extension']);
        $ValidExtensions = $this->ValidExtensions;

        if (!$FileName) {
            $this->SetMessage("ERROR: File name is empty.");
            return false;
        }

        if (!$ValidExtensions) {
            $this->SetMessage("WARNING: All extensions are valid.");
            return true;
        }

        if (in_array($Extension, $ValidExtensions)) {
            $this->SetMessage("MESSAGE: The extension '$Extension' appears to be valid.");
            return true;
        } else {
            $this->SetMessage("Error: The extension '$Extension' is invalid.");
            return false;  
        }

    }

   
    function ValidateSize()
    {
        $MaximumFileSize = $this->MaximumFileSize;
        $TempFileName = $this->GetTempName();
        $TempFileSize = filesize($TempFileName);

        if($MaximumFileSize == "") {
            $this->SetMessage("WARNING: There is no size restriction.");
            return true;
        }

        if ($MaximumFileSize <= $TempFileSize) {
            $this->SetMessage("ERROR: The file is too big. It must be less than $MaximumFileSize and it is $TempFileSize.");
            return false;
        }

        $this->SetMessage("Message: The file size is less than the MaximumFileSize.");
        return true;
    }

    
    function ValidateExistance()
    {
        $FileName = $this->FileName;
        $UploadDirectory = $this->UploadDirectory;
        $File = $UploadDirectory . $FileName;

        if (file_exists($File)) {
            $this->SetMessage("Message: The file '$FileName' already exist.");
            $UniqueName = rand() . $FileName;
            $this->SetFileName($UniqueName);
            $this->ValidateExistance();
        } else {
            $this->SetMessage("Message: The file name '$FileName' does not exist.");
            return false;
        }
    }

    
    function ValidateDirectory()
    {
        $UploadDirectory = $this->UploadDirectory;

        if (!$UploadDirectory) {
            $this->SetMessage("Direktori upload belum disetting.");
            return false;
        }

        if (!is_dir($UploadDirectory)) {
            $this->SetMessage("Folder '$UploadDirectory' tidak ditemukan.");
            return false;
        }

        if (!is_writable($UploadDirectory)) {
            $this->SetMessage("Folder '$UploadDirectory' tidak writable.");
            return false;
        }

        if (substr($UploadDirectory, -1) != "/") {
            $this->SetMessage("traling slash does not exist.");
            $NewDirectory = $UploadDirectory . "/";
            $this->SetUploadDirectory($NewDirectory);
            $this->ValidateDirectory();
        } else {
            $this->SetMessage("traling slash exist.");
            return true;
        }
    }

   
    function ValidateImage() {
        $MaximumWidth = $this->MaximumWidth;
        $MaximumHeight = $this->MaximumHeight;
        $TempFileName = $this->TempFileName;

    if($Size = @getimagesize($TempFileName)) {
        $Width = $Size[0];   
        $Height = $Size[1];  
    }
        if ($Width == $MaximumWidth && $Height == $MaximumHeight) {
            $this->SetMessage("Dimensi gambar harus $Width x $Height ");
            return false;
		}         
        return true;
    }

    
    function SendMail() {
        $To = $this->Email;
        $Subject = "File Uploaded";
        $From = "From: Uploader";
        $Message = "A file has been uploaded.";
        mail($To, $Subject, $Message, $From);
        return true;
    }


   
    function UploadFile()
    {

        if (!$this->ValidateExtension()) {
            die($this->GetMessage());
        } 

        else if (!$this->ValidateSize()) {
            die($this->GetMessage());
        }

        else if ($this->ValidateExistance()) {
            die($this->GetMessage());
        }
/*
        else if (!$this->ValidateDirectory()) {
            die($this->GetMessage());
        }
		
        else if ($this->IsImage && !$this->ValidateImage()) {
            die($this->GetMessage());
        }
		*/

        else {

            $FileName = $this->FileName;
            $TempFileName = $this->TempFileName;
            $UploadDirectory = $this->UploadDirectory;

            if (is_uploaded_file($TempFileName)) { 
                move_uploaded_file($TempFileName, $UploadDirectory . $FileName);
                return true;
            } else {
                return false;
            }

        }

    }

   
    function SetFileName($argv)
    {
        $this->FileName = $argv;
    }

    function SetUploadDirectory($argv)
    {
        $this->UploadDirectory = $argv;
    }

    function SetTempName($argv)
    {
        $this->TempFileName = $argv;
    }

    function SetValidExtensions($argv)
    {
        $this->ValidExtensions = $argv;
    }

    function SetMessage($argv)
    {
        $this->Message = $argv;
    }

    function SetMaximumFileSize($argv)
    {
        $this->MaximumFileSize = $argv;
    }

    function SetEmail($argv)
    {
        $this->Email = $argv;
    }
   
    function SetIsImage($argv)
    {
        $this->IsImage = $argv;
    }

    function SetMaximumWidth($argv)
    {
        $this->MaximumWidth = $argv;
    }

    function SetMaximumHeight($argv)
    {
        $this->MaximumHeight = $argv;
    }   
    function GetFileName()
    {
        return $this->FileName;
    }

    function GetUploadDirectory()
    {
        return $this->UploadDirectory;
    }

    function GetTempName()
    {
        return $this->TempFileName;
    }

    function GetValidExtensions()
    {
        return $this->ValidExtensions;
    }

    function GetMessage()
    {
        if (!isset($this->Message)) {
            $this->SetMessage("No Message");
        }

        return $this->Message;
    }

    function GetMaximumFileSize()
    {
        return $this->MaximumFileSize;
    }

    function GetEmail()
    {
        return $this->Email;
    }

    function GetIsImage()
    {
        return $this->IsImage;
    }

    function GetMaximumWidth()
    {
        return $this->MaximumWidth;
    }

    function GetMaximumHeight()
    {
        return $this->MaximumHeight;
    }
}

/* example */
/*
echo "<form enctype='multipart/form-data'  method='POST'>"
."<input name='upload' type='file' /><input type='submit' value='Upload' />"
."</form>";


if($_FILES['upload']['tmp_name']) {
    $upload = new Upload();
    $upload->SetFileName($_FILES['upload']['name']);
    $upload->SetTempName($_FILES['upload']['tmp_name']);
    $upload->SetUploadDirectory("../../images"); //Upload directory, this should be writable
    $upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png')); //Extensions that are allowed if none are set all extensions will be allowed.
    //$upload->SetEmail("Sidewinder@codecall.net"); //If this is set, an email will be sent each time a file is uploaded.
    //$upload->SetIsImage(true); //If this is set to be true, you can make use of the MaximumWidth and MaximumHeight functions.
    //$upload->SetMaximumWidth(60); // Maximum width of images
    //$upload->SetMaximumHeight(400); //Maximum height of images
    $upload->SetMaximumFileSize(300000); //Maximum file size in bytes, if this is not set, the value in your php.ini file will be the maximum value
    echo $upload->UploadFile();

}
*/
?>