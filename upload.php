<?php
require_once "Backend/upload.php";

$filename = $_FILES['file']['name'];
//echo $filename;

$location = "upload/" . $filename;
move_uploaded_file($_FILES['file']['tmp_name'], $location);

if (isset($_POST['share'])) {
    readCSVForOneShare($location, $_POST['share']);

}
else {
    readCSV($location);
}