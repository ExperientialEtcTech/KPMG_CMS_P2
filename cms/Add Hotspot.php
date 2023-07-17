<?php
include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" language="javascript"></script>
        <title>KPMG</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    	<link rel="stylesheet" href="./assets/css/bootstrap.css">
    	<link rel="stylesheet" href="./assets/css/customstyle.css">
    </head>
    <body>

	<form action="select_template.php" method="post">
		<div class="container">
			<div class="add-hotspot-content">
				<div class="title-bar">
					<h2>Add Hotspot</h2>
				</div>
				<div class="row mb-5">
					<label class="col-sm-4">
					File Type
					</label>
					<div class="col-sm-8">
						<select class="form-control" id="hotspot" name="hotspot">
							<option>Please select</option>
							<option value="service" onclick="location.href='Service and Sectors.php';">jpg</option>
							<option value="sector"onclick="location.href='Service and Sectors.php';">png</option>
							<option value="sector"onclick="location.href='Service and Sectors.php';">ppt</option>
						</select>
					</div>
				</div>
				<div class="row mb-5">
					<label class="col-sm-4">
					File: 
					</label>
					<div class="col-sm-8">
						<div class="form-control-file-container">
							<a href="javascript: void(0);" class="btn-custom-small">Select file</a>
							<input class="form-control" type="file" id="formFile" placeholder="Select file" >
						</div>
					</div>
				</div>
				<div class="row mb-5">
					<label class="col-sm-4">
						Hotspot Location
					</label>
					<div class="col-sm-8">
						<div class="edit-control">
							<a href="javascript: void(0);" class="edit-icon">Edit</a>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 offset-sm-4">
						<button class="btn-custom-small">
							Save
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>

        <!-- <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 20px">
        <div style="width: 800px;height:100px;margin:auto;">
        </div>
        <div class="hello">
        <div>
        <h1 class="helloo">Add Hotspot</h1>
        <div>
        <div class="name3">
        <form>
            <div>
            
            <br><br><br>
            <div>
                <label class="name1">File:Filename:file</label>
                <div class="new">
                    select file
                </div>
            </div>
            <br><br>
            <div>
            <label class="name1">Hotspot location</label>
            <input class="text"type="text"  name="fname" style="background-image:url('assets/Group 159.png');background-repeat:no-repeat;background-position:right;">
            <div>
        </form>
        <div>
            <div class="edit">
                <center>
                <h3 onclick="location.href='hotspot content.php';" >Save</h3>
                <center>
            </div>
        </div> -->
		
    </body>
</html>