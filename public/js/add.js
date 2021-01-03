function inputChecker()  {
      let inputs = document.querySelectorAll('#in');
      let error = document.getElementById("errors");
      let btn = document.getElementById("submit");
      
      let errors = [];
      error.innerHTML = '';
      inputs.forEach(v => {
            if (v.value == "") {
                  btn.type = "button"
                  errors.push(v.name);
                  error.innerHTML += "<li>Please Provide "+ v.placeholder +"</li>";
            }
            else {
                  

            }
      });
}
