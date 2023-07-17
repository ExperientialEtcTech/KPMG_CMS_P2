<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" language="javascript"></script>

    <title>KPMG</title>
</head>


</head>

<body>

    <div id="changeViewModel" class="modal">

        <!-- Modal content -->
        <div id="myModal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">

                    <h2>Add Service</h2>
                </div>
                <div class="modal-body">
                    <div class="modal-center-content">
                        <form method="POST">
                            <input type="hidden" name="parentid" value="<?php echo $parentId; ?>" />
                            <div class="popup-row">
                                <div class="popup-col d-flex width3">
                                    <label>Service Name</label>
                                </div>
                                <div class="popup-col width7">
                                    <input type="text" name="service" class="text-box" />
                                </div>
                            </div>
                            <!--
                        <div class="popup-row">
                            <div class="popup-col d-flex width3">
                                <label>Has Content? </label>
                            </div>
                            <div class="popup-col width7">
                                <select id="servicetype" name="servicetype" class="text-box">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
-->
                            <div class="popup-row">
                                <div class="popup-col d-flex width3">
                                    <label>Icon Url</label>
                                </div>
                                <div class="popup-col width7">
                                    <input type="text" name="iconUrl" class="text-box" />
                                    <!--
                                <div class="form-control-file-container">
                                <a href="javascript: void(0);" class="btn-custom-small">Select file</a>
                                <input class="form-control" type="file" id="formFile" placeholder="Select file" >
-->
                                </div>
                            </div>
                    </div>
                    <div class="popup-row mb-0 justify-content-center">
                        <input type="submit" name="addservice" class="btn-custom-small" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="footer.js"></script>
    <script>
    const btnadd = document.getElementById("btnadd");
    const modal = document.getElementById("myModal");
    const modal1 = document.getElementById("changeViewModel");
    const span = document.getElementById("closeChangeViewModel");

    btnadd.onclick = function() {
        modal.style.display = "block";
        modal1.style.display = "block";
    };
    span.onclick = function() {
        modal.style.display = "none";
        modal1.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target.id == "myModal") {
            modal.style.display = "none";
            modal1.style.display = "none";
        }
    };
    </script>