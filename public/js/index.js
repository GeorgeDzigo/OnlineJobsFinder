function onbtnclick() { 
      let input = document.getElementById("search-field").value;
      let error = document.getElementById("error");
      error.innerHTML = "";
      let exp = input.split("").filter(v => { if (parseInt(v) != v && v != " " && v != "<" && v != ">" || v === '-') return v;});
      let nowthsp = input.split("").filter(v => v != " ");

      if (input.length == 0) window.location.replace("../public/index.php");
      else if (exp.length != nowthsp.length) {
            error.innerHTML += "<h3>Please Enter only letters</h3>";
      }
      else window.location.replace("../public/index.php?s=" + input.split("").map(v => v == " " ? "+" : v).join(""));
      
}