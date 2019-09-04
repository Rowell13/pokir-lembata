
// proses 1
var masukanpass = document.getElementById('pswd'),
      chk  = document.getElementById('chk'),
      label = document.getElementById('showhide');


     chk.onclick = function () {

      if(chk.checked) {

           masukanpass.setAttribute('type', 'text');
           label.textContent = 'Hide Passowrd';
       } else {

           masukanpass.setAttribute('type', 'password');
           label.textContent = 'Show Passowrd';
       }
 
     }

// proses 2
var input = document.getElementById('pswd2'),
    icon = document.getElementById('icon');

   icon.onclick = function () {

     if(input.className == 'active') {
        input.setAttribute('type', 'text');
        icon.className = 'fa fa-eye-slash';
       input.className = '';

     } else {
        input.setAttribute('type', 'password');
        icon.className = 'fa fa-eye-slash';
       input.className = 'active';
    }

   }