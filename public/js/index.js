/*
*     function name : onbtnclick()
*     desc: This function checks input fields and
*           searches for keywords for php and redirects
*/ 

function onbtnclick() { 
      let input = document.getElementById("search-field").value;
      let error = document.getElementById("error");
      let category = document.getElementById("category").value;
      error.innerHTML = "";
      let exp = input.split("").filter(v => { if (parseInt(v) != v && v != " " && v != "<" && v != ">" || v === '-') return v;});
      let nowthsp = input.split("").filter(v => v != " ");

      if (input.length == 0 && category == "Category") window.location.replace("../routes/index.php");
      else if (exp.length != nowthsp.length) error.innerHTML += "<h3>Please Enter only letters</h3>";
      
      else if (input.length != 0 && category != "Category") window.location.replace("../routes/?s=" + input.split("").map(v => v == " " ? "+" : v).join("") + "&c=" + category);
      
      else if (input.length == 0 && category != "Category") window.location.replace("../routes/?s=-&c=" + category);
      
      else window.location.replace("../routes/index.php?s=" + input.split("").map(v => v == " " ? "+" : v).join(""));
}