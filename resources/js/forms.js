// Example starter JavaScript for disabling form submissions if there are invalid fields
(function validar() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()


var inputs = document.querySelectorAll(".cpf");

// Loop over them and prevent submission
Array.prototype.slice.call(inputs)
  .forEach(function (input) {
    input.addEventListener('keypress',()=>{
    
      let len = input.value.length

      if(len === 3 || len === 7) {
        input.value += '.'
      }else if(len === 11){
        input.value += '-'
      }

    })
  })

