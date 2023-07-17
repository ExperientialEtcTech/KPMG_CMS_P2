const span2 = document.getElementById("close2");

span2.onclick = function () {
  document.getElementById("myModal2").style.display = "none";
};

// // When the user clicks anywhere outside of the modal, close it

function viewData(data, type) {
  let checkImage = isImage(data);
  let html = "";
  if (checkImage) {
    html = "<img src='" + data + "' alt='image' class='img-fluid'>";
  } else {
    let checkVideo = isVideo(data);
    if (checkVideo) {
      html = ` <video  controls class="video" id="video-container">
        <source src=${data} id="kal-slide" type="video/mp4">
        Your browser does not support the video tag.
        </video>"`;
    } else if (data.split(".").pop() === "pdf") {
      html = `<iframe   src="${data}">`;
    } else {
      html = "<span> preview is not available</span>";
    }
  }

  document.getElementById("h2-title").innerText = type;
  document.getElementById("viewModelBody").innerHTML = html;
  document.getElementById("myModal2").style.display = "block";
}
//  change dialog

let change = document.getElementById("change");

let changeModal1 = document.getElementById("changeModel");

change.onclick = function () {
  changeModal1.style.display = "block";
  localStorage.setItem("field", "loop_vid");
  document.getElementById("videoTitle").innerText = "Welcome Video";
  document.getElementById("changeField").value = "showVideo";
};

function showData(data, i) {
  document.getElementById("changeVideoShow").src = data;
  document.getElementById("changeViewModel").style.display = "block";
}
document
  .getElementById("closeChangeViewModel")
  .addEventListener("click", function () {
    document.getElementById("changeViewModel").style.display = "none";
  });
document
  .getElementById("changePopupClose")
  .addEventListener("click", function () {
    document.getElementById("changeModel").style.display = "none";
    document.getElementById("filebrowser").innerText = "";
    document.getElementById("filetag").value = "";
  });
document.getElementById("changeLogo").addEventListener("click", function () {
  document.getElementById("changeModel").style.display = "block";
  localStorage.setItem("field", "KPMG_logo");
  document.getElementById("videoTitle").innerText = "Welcome Screen Logo";
  document.getElementById("changeField").value = "showImage";
});
document.getElementById("changeBg").addEventListener("click", function () {
  document.getElementById("changeModel").style.display = "block";
  localStorage.setItem("field", "bg_vid");
  document.getElementById("videoTitle").innerText = "Welcome Screen BG";
  document.getElementById("changeField").value = "showImage";
});
function isImage(url) {
  return /\.(jpg|jpeg|png|webp|avif|gif|svg)$/.test(url);
}
function isVideo(url) {
  return /\.(mp4|mov|m4v|webm|ogv|ogg|avi|flv|wmv|mpg|mpeg|m2v|mkv|3gp|3g2)$/.test(
    url
  );
}

function showDataModel(data, type) {
  let filename = data.substring(data.lastIndexOf("/") + 1);
  document.getElementById("fileName").innerText = filename;
  let html = "";
  if (type == "image") {
    html = "<img src='" + data + "' alt='image' class='img-fluid'>";
  } else if (type == "video") {
    html =
      "<video controls ><source src='" + data + "' type='video/mp4'></video>";
  } else if (type == "pdf") {
    html = `<iframe   src="${data}">`;
  } else {
    html = "<span>Preview is not available</span>";
  }
  document.getElementById("changeViewBody").innerHTML = html;
  document.getElementById("changeViewModelUpdate").style.display = "block";
}
document
  .getElementById("closeChangeViewModelUpdate")
  .addEventListener("click", function () {
    document.getElementById("changeViewModelUpdate").style.display = "none";
  });

function UpdateData(data, fileName) {
  let field = localStorage.getItem("field");
  if (field == "loop_vid") {
    document.getElementById("loop_vid").value = data;
    document.getElementById("loopVidText").innerText = fileName;
    sessionStorage.setItem("loop_vid", data);
  } else if (field == "KPMG_logo") {
    sessionStorage.setItem("KPMG_logo", data);
    document.getElementById("KPMGLogo").innerText = fileName;

    document.getElementById("KPMG_logo").value = data;
  } else if (field == "bg_vid") {
    document.getElementById("bg_vid").value = data;
    document.getElementById("BgVidName").innerText = fileName;
    sessionStorage.setItem("bg_vid", data);
  }
  document.getElementById("changeModel").style.display = "none";

  localStorage.removeItem("field");
  localStorage.setItem("save", false);
}
