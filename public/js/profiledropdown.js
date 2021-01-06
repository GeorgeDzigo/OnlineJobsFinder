function dropdown() { 
      let drop = document.getElementById("profile-drop");
      drop.addEventListener('mouseenter', function () {
            document.getElementById("dropdown").style.display = "block";
      });
      drop.addEventListener('mouseleave', function () { 
            document.getElementById("dropdown").style.display = "none";
      })
}

dropdown();