(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation');
    
    // Loop over them and prevent submission
    // Array.prototype.slice.call(forms)
    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            spinBtn();
            form.classList.add('was-validated');
        }, false)
        })
    })()
   

    function spinBtn(){
        const spinOn = document.querySelector('.spinOn');
        const spinOff = document.querySelector('.spinOff');

        spinOff.style.display = "none";
        spinOn.style.display = "block"

        setTimeout(()=>{
            spinOff.style.display = "block";
            spinOn.style.display = "none";
        },2000)

    }

    function checkPassword() {
        // alert(document.querySelector('.passwords').value+'ooo');
        const password = document.querySelector('.passwords');
        const confirmPassword = document.querySelector('.confirmPassword');
        // alert(password,confirmPassword)
alert(password.value.length)
        if (password.value != confirmPassword.value) {
            document.getElementById('msgPassword').style.display="block";
            setTimeout(() => {

                document.getElementById('msgPassword').style.display="none";
                password.value=""
                confirmPassword.value="";    
            }, 2000);
        }else if(password.value.length < 4){
            alert('no')
        }

    }

    function ValidateEmail() {

        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        const email = document.querySelector('.email');
        
        const emailMsg = document.querySelector('.invalid-email');
      
        if (!email.value.match(validRegex)) {
              emailMsg.style.color= "red";
              emailMsg.style.display = 'block';
              setTimeout(()=>{
                  emailMsg.style.display = 'none';
                  email.value=""
              },2000)
          return false;
        } 
      
      }

      function controlEspace(){
        const nom = document.querySelector('.nom');
        const prenom = document.querySelector('.prenom');
        nom.value= ltrim(nom.value);
        nom.value= rtrim(nom.value);
        prenom.value= ltrim(prenom.value);
        prenom.value= rtrim(prenom.value);

        
        alert((nom.value))
    }



    function ltrim(str) {
        if(!str) return str;
        return str.replace(/^\s+/g, '');
    }

    function rtrim(str) {
        if(!str) return str;
        return str.replace(/\s+$/g, '');
    }