
<?php
include_once('security.php');
?>
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
<style>

*,
*::before,
*::after {
  box-sizing: border-box;
}

@media (prefers-reduced-motion: no-preference) {
  :root {
    scroll-behavior: smooth;
  }
}


    body{
        
        margin: 0px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }


    @font-face {    
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    p{
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }
    .question{
        color:grey;
        font-size:25px;
        padding-left:20%;

    }
    .test1{
        padding-bottom:20px;
    }
    .delete{
       float:right;
        background-repeat:no-repeat;
    }
    .imgg{
        float:right;
        padding-right:200px;
    }
    .img1{
        float:right;
        margin-left:30%;
    }
    .add-button {
        right:10px;
        bottom:10px;
        position: fixed;
    }
    
.feedback-form {
    max-width: 700px;
    margin: 0px auto;
}
.btn-custom-small {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-width: 157px;
    height: 50px;
    color: #fff;
    background: #00338d;
    font-size: 24px;
    text-decoration: none;
    border-radius: 10px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    cursor: pointer;
    border: 0px;
    padding: 0px 30px;
}
.justify-content-between {
    justify-content: space-between;
}
.d-flex {
    display: flex;
}
.feedback-form-row {
    display: flex;
    margin-bottom: 40px;
}
.feedback-form-question {
    flex: 1 1 auto;
    padding-right: 30px;
}
.feedback-form-row h3 {
    margin: 0px;
    padding: 0px 0px 10px 0;
    color: #838383;
    font-size: 28px;
    font-family: 'UNIVERSFORKPMG-BOLD';
}
.feedback-form-row p {
    margin: 0px;
    padding: 0px 0px 0px 0;
    color: #838383;
    font-size: 22px;
    font-family: 'UNIVERSFORKPMG-BOLD';
}
.feedback-form-actions {
    display: flex;
    justify-content: center;
    align-items: flex-start;
}
.btn-delete {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    cursor: pointer;
    background: none;
    border: none;
    margin-left: 50px;
}

.rating-icons {
    display: flex;
    align-items: flex-start;
}
.rating-icons a {
    margin: 0px 10px;
    display: inline-flex;
}
</style>
<body>
   <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px">

        <form action="select_template.php" method="post">
            <div style="width: 800px;height:100px;margin:auto;">
                <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"onclick="location.href='select_template.php';"></div>
                <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
            Event Feedback</div>
            </div>

            <div class="feedback-form">
                <div class="feedback-form-row">
                    <div class="feedback-form-question">
                        <h3>Question 01</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                    <div class="feedback-form-actions">
                        <button class="btn-custom-small">Edit</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
                <div class="feedback-form-row">
                    <div class="feedback-form-question">
                        <h3>Question 01</h3>
                    </div>
                    <div class="feedback-form-actions">
                        <button class="btn-custom-small">Edit</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
                <div class="feedback-form-row">
                    <div class="feedback-form-question">
                        <h3>Question 01</h3>
                    </div>
                    <div class="feedback-form-actions">
                        <button class="btn-custom-small">Edit</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
                <div class="feedback-form-row">
                    <div class="feedback-form-question">
                        <h3>Question 01</h3>
                    </div>
                    <div class="feedback-form-actions">
                        <button class="btn-custom-small">Edit</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
                <div class="feedback-form-row">
                    <div class="feedback-form-question">
                        <h3>Question 01</h3>
                    </div>
                    <div class="feedback-form-actions">
                        <button class="btn-custom-small">Edit</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
                <div class="feedback-form-row justify-content-between">
                    <h3>Ratings</h3>
                    <div class="rating-icons">
                        <a href="javascript: void(0);"><img src="assets/star.png"></a>
                        <a href="javascript: void(0);"><img src="assets/star.png"></a>
                        <a href="javascript: void(0);"><img src="assets/star.png"></a>
                        <a href="javascript: void(0);"><img src="assets/star.png"></a>
                        <a href="javascript: void(0);"><img src="assets/star.png"></a>
                    </div>
                </div>    
            </div>
            
            <div class="add-button" id="btnadd"><img src="assets/Add Button.png"></div>
        </form>
    </div>
</body>
</html>
