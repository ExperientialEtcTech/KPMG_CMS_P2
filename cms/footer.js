window.addEventListener("click", function (event) {
  let targetElement = event.target.classList.contains("modal");
  if (targetElement == true) {
    document.getElementById(event.target.id).style.display = "none";
  }
  let video = document.getElementById("video-src")
  if (video) {
    video.pause();
  };
  let video1 = document.getElementById("video-container")
  if (video1) {
    video1.pause();
  };
});
