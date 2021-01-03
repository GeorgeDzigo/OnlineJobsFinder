function inputChecker()  {
      let inputs = document.querySelectorAll('#in');
      let error = document.getElementById("errors");
      let btn = document.getElementById("submit");
      
      let errors = [];
      error.innerHTML = '';
      
      let arr = [];
      inputs.forEach(v => arr.push(v.name))

      // Inputs with text only
      let txt = [arr[0], arr[1], arr[2], arr[6], arr[8]];
      // inputs
      inputs.forEach(v => {
            if (v.value == "") {
                  btn.type = "button"
                  errors.push(v.name);
                  error.innerHTML += "<li>Please Provide " + v.placeholder + "</li>";
            }
            // Check for numbers in text fields
            else if (v.value != "") {
                  for (let i = 0; i < txt.length; i++) {
                        console.log(txt[i]);
                        break;
                  }
            }
      });
}
