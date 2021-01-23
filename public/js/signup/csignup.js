/**********************************
*********   CSSIGNUP.JS   *********
**********************************/

function csignup() { 
      let inputs = document.querySelectorAll("#csiup");
      let btn = document.getElementById('resubmit');
      let perrors = document.getElementById('reerrors');
      let errors = [];

      btn.addEventListener('click', function () {
            errors = [];
            perrors.innerHTML = '';
            inputs.forEach(v => {
                  if (v.value == "") {
                        btn.type = "button";
                        errors.push(v.name);
                        perrors.innerHTML = "<li>Please Don't Leave Empty Fields</li>";
                  }
                  else {
                        if (v.name == 'companyname') {
                              let valid = v.value.match(/[a-z]/gi).length;
                              if (valid != v.value.length) {
                                    btn.type = 'button';
                                    errors.push(v.name);
                                    perrors.innerHTML += "<li>Please enter only letters: "+v.placeholder+" </li>";
                              }
                        }
                        else if (v.name == 'phonenumber') {
                              let valid = v.value.match(/[0-9]/gi).length;
                              if (valid != 12) {
                                    btn.type = 'button';
                                    errors.push(v.name);
                                    perrors.innerHTML += "<li>Please enter valid phone number</li>";
                              }
                        }
                  }
            });
            if (errors.length == 0) btn.type = 'submit';
      })
}
csignup();