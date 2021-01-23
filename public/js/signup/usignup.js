/**********************************
*********   CSSIGNUP.JS   *********
**********************************/
function usignup() { 
      let inputs = document.querySelectorAll("#usiup");
      let btn = document.getElementById('resubmit');
      let perrors = document.getElementById('reerrors');
      let errors = [];

      errors = [];
      perrors.innerHTML = '';
      
      inputs.forEach(v => {
            if (v.value == "") {
                  btn.type = "button";
                  errors.push(v.name);
                  perrors.innerHTML = "<li>Please Don't Leave Empty Fields</li>";
            }
            else {
                  if (v.name == "usrfname") {
                        let nums = v.value.match(/[0-9]/ig) ?? "";
                        if (nums.length != 0) {
                              btn.type = 'button';
                              errors.push(v.name);
                              perrors.innerHTML += "<li>Please enter only letters: "+v.placeholder+"</li>";
                        }
                  }
                  else if (v.name == 'usrlname') {
                        let nums = v.value.match(/[0-9]/ig) ?? "";
                        if (nums.length != 0) {
                              btn.type = 'button';
                              errors.push(v.name);
                              perrors.innerHTML += "<li>Please enter only letters: "+v.placeholder+"</li>";
                        }
                  }
                  else if (v.name == "usrphonenumber") {
                        let nums = v.value.match(/[0-9]/g);
                        let len = v.value.split('').indexOf('+') != -1 ? v.value.length - 1 : v.value.length;
                        if (nums.length != len || nums.length != 12) {
                              btn.type = 'button';
                              errors.push(v.name);
                              perrors.innerHTML += "<li>Please enter valid phone number</li>";
                        }
                  }
            }
      });
      if (errors.length == 0) btn.type = 'submit';
}
