<?php
include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || File Upload</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/customstyle.css">
</head>
<body>
    <div class="container file-upload">
        <div class="title-bar">
            <a href="javascript: void(0);" class="left-arrow" onclick="location.href='services.php';">
                Back
            </a>
            <h1>Edit Hotspot</h1>
        </div>
        <div class="file-upload-container">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="label">
                            Hotspot Type
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control">
							<option>Please select</option>
							<option>Item Type</option>
							<option>Item Type</option>
							<option>Item Type</option>
						</select>
                    </div>    
                </div>
                <div class="row mb-5">
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="label">
                            File Type
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control">
							<option>Please select</option>
							<option>Item Type</option>
							<option>Item Type</option>
							<option>Item Type</option>
						</select>
                    </div>    
                </div>
                <div class="row mb-5">
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="label">
                            File: 
                        </label>
                        <div class="filename-extension">
                            File name
                        </div>
                    </div>
                    <div class="col-sm-8 d-flex">
                        <div class="form-control-file-container">
                            <a href="javascript: void(0);" class="btn-custom-small">Select file</a>
                            <input class="form-control" type="file" id="formFile" placeholder="Select file" >
                        </div>
                    </div>    
                </div>
                <div class="row mb-5">
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="label">
                            Hotspot Location
                        </label>
                    </div>
                    <div class="col-sm-8 d-flex align-items-center">
                        <input class="text-box text-center" type="text" placeholder="x:00">
                        <input class="text-box text-center mx-5" type="text" placeholder="y:00">
                        <input class="text-box text-center" type="text" placeholder="z:00">
                    </div>    
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-8 offset-sm-4">
                    <button class="btn-custom-small">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>