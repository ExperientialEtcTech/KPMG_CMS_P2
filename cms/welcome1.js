const btn = document.getElementById("video-btn");

const btn1 = document.getElementById("myBtn1");

const btn2 = document.getElementById("myBtn2");
const modal = document.getElementById("myModal");

const modal1 = document.getElementById("myModal1");
const modal2 = document.getElementById("myModal2");
const span = document.getElementById("close");
const span1 = document.getElementById("close1");
const span2 = document.getElementById("close2");

btn.onclick = function () {
  modal2.style.display = "none";
  modal1.style.display = "none";
  modal.style.display = "block";
};
btn1.onclick = function () {
  modal1.style.display = "block";
  modal2.style.display = "none";
  modal.style.display = "none";
};
btn2.onclick = function () {
  modal2.style.display = "block";
  modal1.style.display = "none";
  modal.style.display = "none";
};
span.onclick = function () {
  modal.style.display = "none";
};
span1.onclick = function () {
  modal1.style.display = "none";
};
span2.onclick = function () {
  modal2.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  console.log(event);
  if (event.target.id == "myModal") {
    modal.style.display = "none";
  }
  if (event.target.id == "myModal1") {
    modal1.style.display = "none";
  }
  if (event.target.id == "myModal2") {
    modal2.style.display = "none";
  }
};
