function onbtnclick() { 
      let query = document.getElementById("search-field").value;
      let error = document.getElementById("error");
      error.innerHTML = "";
      let exp = query.split("").filter(v => { if (parseInt(v) != v && v != " " && v != "<" && v != ">" || v === '-') return v;});
      let nowthsp = query.split("").filter(v => v != " ");

      if (exp.length != nowthsp.length) {
            error.innerHTML += "<h3>Please Enter only letters</h3>";
      }
      else window.location.replace("../public/index.php?s=" + query.split("").map(v => v == " " ? "+" : v).join(""));
      
}