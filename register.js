function register() {
  const name = document.getElementById("name").value;
  const lastname = document.getElementById("lastname").value;
  const username = document.getElementById("user").value;
  const company_id = document.getElementById("company_id").value;
  const department_id = document.getElementById("department_id").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("pass").value;
  const phone = document.getElementById("phone").value;
  const role = document.getElementById("role").value;

  if (!username) return showAlert("warning", "Username", "Username must not be blank!");
  if (!email) return showAlert("warning", "Email", "Email must not be blank!");
  if (!password) return showAlert("warning", "Password", "Password must not be blank!");
  
  
  if (!ValidateEmail(email)) return showAlert("warning", "Invalid email", "The format of the email is not valid!");

  const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
  if (!strongRegex.test(password)) {
    return showAlert("warning", "Password", "Password must include uppercase, lowercase, special character, and numeric letter!");
  }

  $.ajax({
    url: "./php/register.php",
    method: "POST",
    data: {
        name:name,
        lastname :lastname,
        username: username,
        company_id:company_id,
        department_id:department_id,
        password: password,
        email: email,
        name: name,
        phone: phone,
        role:role
    },
    success: handleRegistrationSuccess,
  });
}
function handleRegistrationSuccess(data) {
    switch (data) {
        case 0:
            showAlert("info", "Already in use", "This username is already in use!");
            break;
        case 1:
            showAlert("info", "Already in use", "This email is already in use!");
            break;
        case 2:
            showSuccessMessage();
            redirectToIndex();
    }
  }
  
function showSuccessMessage() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    Toast.fire({
        icon: 'success',
        title: 'Registration Successful. Your account has been created successfully! Redirecting to login page'
      });
    }

function ValidateEmail(mail) {
        return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail);
      }


function showAlert(icon, title, text) {
        Swal.fire({
          icon: icon,
          title: title,
          text: text,
          background: '#c0c2c9',
          timer: 1500,
          showConfirmButton: false,
        });
      }
function redirectToIndex() {
        setTimeout(() => {
          window.location.href = "./index.html";
        }, 3000);
      }

