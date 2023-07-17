<?php
include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignOff</title>
  </head>
  <style>
      *{
          margin-top: 0px;
          padding-top: 0px;
      }
      @media (prefers-reduced-motion: no-preference) {
  :root {
    scroll-behavior: smooth;
  }
}

    .bg {
      background-image: url(./assets/back.png);
      background-position: center;
      background-repeat: repeat;
      background-size: cover;
      
    }
    .txtB {
      height: 50px;
      text-align: center;
      color: #00338d;
      text-align: center;
      font-size: 61px;
      margin-top: -20px;
      margin-left: 70px;
      font-family: "Oswald", sans-serif;
    }
    .text {
      background-image: url(./assets/edit.png);
      background-position: center;
      background-repeat: repeat;
      margin-left: 40px;
      border-radius: 15px;
      border: 1px solid grey;
      height: 50px;
      width: 250px;
      padding-left: 15px;
      font-size: 15px;
      padding-right: 10px;
    }
    .name {
      margin-left:px;

      font-size: 31px;
      color: grey;
      padding-top: 50px;
      font-family: "Oswald", sans-serif;
    }
    .name1{
      margin-left:130px;

      font-size: 31px;
      color: grey;
      padding-top: 50px;
      font-family: "Oswald", sans-serif;
    }
    .container1 {
      margin-top: 170px;
      margin-left: 110px;
    }
    .container2 {
      margin-top: 10px;
      margin-left: 90px;
    }
    .btn{
        
        height: 60px;
        width: 300px;
        margin-top: 50px;
        margin-left: 450px;
        border-radius: 15px;
        border: none;
    }
    .arrow{
        position: relative;
        left: -500px;
        top: 80px;
    }
    .del-image1:hover + .tooltiptext{
          Display:block;
          height:130px;
          width:370px;
          border:1px solid grey;
          overflow:hidden;
          z-index:2;
        
          
    }
    
    .del-image1{
      margin-left:100px;
    }
  </style>
  <body class="bg">
    <div>
      <div class="txtB">
        <img class="arrow" src="./assets/login.png" alt="">
        <h4>SignOff Message</h4>
      </div>
      <form>
        <div class="container1">
        <img class="del-image1"src="assets/info button.png">
        
          <label class="name">Main Text</label>
          <input
            class="text"style="
              background-image: url('assets/Group 159.png');
              background-repeat: no-repeat;
              background-position: 655px;
              height: 50px;
              width: 550px;
              
            "
          />
          <img src="./assets/Highlight Header Text.png" alt=""><br /><br />
        </div>
      </form>
      <div>
        <form>
          <div class="container2">
            <label class="name1">Footer Text</label>
            <input
           
              class="text"
              style="
                background-image: url('assets/Group 159.png');
                background-repeat: no-repeat;
                background-position: 655px;
                height: 120px;
                width: 550px;
              "
            />
            <img src="./assets/Highlight Header Text.png" alt="">
          </div>
        </form>
      </div>
      <div >
        <button class="btn" style="background-color: darkblue;color:white;font-size: 31px;" onclick="location.href='EditSignOffMessage.php';">Edit Message</button>
      </div>
    </div>
  </body>
</html>