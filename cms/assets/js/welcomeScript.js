const btn = document.getElementById("myBtn");

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

//  change dialog


/*
let change = document.getElementById("change");
let changeModal1 = document.getElementById("changeModel");
change.onclick = function () {
  changeModal1.style.display = "block";
};
*/
function showData(data, i) {
  document.getElementById("changeVideoShow").src = data;
  document.getElementById("changeViewModel").style.display = "block";
}
document
  .getElementById("closeChangeViewModel")
  .addEventListener("click", function () {
    document.getElementById("changeViewModel").style.display = "none";
  });
document.getElementById("changePopupClose")
  .addEventListener("click", function () {
    document.getElementById("changeModel").style.display = "none";
});
/*
document.getElementById("changeLogo").addEventListener("click", function () {
  document.getElementById("changeModel").style.display = "block";
});
document.getElementById("changeBg").addEventListener("click", function () {
  document.getElementById("changeModel").style.display = "block";
});
*/