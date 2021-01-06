function inputChecker()  {
      let inputs = document.querySelectorAll('#in');
      let error = document.getElementById("errors");
      let btn = document.getElementById("submit");
      
      let errors = [];
      error.innerHTML = '';
      
      let arr = [];
      inputs.forEach(v => arr.push(v.name));

      // Inputs with text only
      let txt = [arr[0], arr[1], arr[2], arr[4]];
      // inputs
      inputs.forEach(v => {
            if (v.value == "") {
                  btn.type = "button"
                  errors.push(v.name);
                  error.innerHTML += "<li>Please Provide " + v.placeholder + "</li>";
            }
            
      });

      if (errors.length == 0) {
            error.innerHTML = "";
            inputs.forEach(v => {
                  if (v.name == "category") {
                        btn.type = "button";
                        if (v.value == "Category") {
                              btn.type = "button";
                              errors.push(v.name);
                              error.innerHTML += "<li>Please Select Category</li>";
                        }

                  }
                  else {
                        for (let i = 0; i < txt.length; i++) {
                              if (v.name == txt[i]) {
                                    btn.type = "button";
                                    let exp = v.value.split("").filter(v => { if (parseInt(v) != v && v != " " && v != "<" && v != ">" || v === '-') return v;});
                                    let nowthsp = v.value.split("").filter(v => v != " ");
                                    if (exp.length != nowthsp.length) {
                                          btn.type = "button";
                                          errors.push(v.name);
                                          error.innerHTML += "<li>Please Enter only letters: " + v.placeholder + "</li>";
                                    } else if (errors.length == 0) btn.type = "submit";
                              }
                        }
                  }
            });
      }
}


function register() { 
      let inputs = document.querySelectorAll("#re");
      let btn = document.getElementById('resubmit');
      let perrors = document.getElementById('reerrors');
      let errors = [];
      errors = [];
      perrors.innerHTML = '';

      inputs.forEach(v => {
            if (v.value == "") {
                  btn.type = "button";
                  errors.push(v.name);
                  perrors.innerHTML = "<li>Please Don't Leave Empty Fields</li>"
            }
      });
      if (errors.length == 0) {
            inputs.forEach(v => {
                  if (v.name == "companyname") {
                        btn.type = "button";
                        let exp = v.value.split("").filter(v => { if (parseInt(v) != v && v != " " && v != "<" && v != ">" || v === '-' || v != "@") return v; });
                        let nowthsp = v.value.split("").filter(v => v != " ");
                        if (exp.length != nowthsp.length) {
                              btn.type = "button";
                              errors.push(v.name);
                              perrors.innerHTML += "<li>Please Enter only letters: " + v.placeholder + "</li>";
                        }
                  }
                  else if (v.name == "companyemail") {
                        
                        btn.type = "button";
                        let exp = v.value.split("").filter(v => { if (parseInt(v) != v && v != " " && v != "<" && v != ">" || v === '-' || v === "_" || v === '.') return v; });
                        let nowthsp = v.value.split("").filter(v => v != " ");
                        console.log(exp);
                        if (exp.length != nowthsp.length || exp.indexOf("@") == -1) {
                              btn.type = "button";
                              errors.push(v.name);
                              perrors.innerHTML += "<li>Please Enter Valid Email</li>";
                        }
                  }
                  else if (v.name == "phonenumber") {
                        btn.type = 'button';
                        let exp = v.value.match(/[0-9]/gi);
                        let p = v.value.charAt(0) == "+";
                        if (p == true && exp.length != v.value.length - 1 || p == false && exp.length != v.value.length) {
                              btn.type = "button";
                              errors.push(v.name);
                              perrors.innerHTML += "<li>Please Enter only Numbers: " + v.placeholder + "</li>";
                        }
                        else if (p == true && v.value.length - 1 != 12 || p == false && v.value.length != 10) {
                              btn.type = "button";
                              errors.push(v.name);
                              perrors.innerHTML += "<li>Please Enter Valid Phone Number</li>";
                        }
                        else if (errors.length == 0) btn.type = "submit";
                  }
                  else btn.type = "submit";
                  
            });
      }
}