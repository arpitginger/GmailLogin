function registration() {
  var name = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var pwd = document.getElementById("password").value;
  var cpwd = document.getElementById("password2").value;
  var check = document.getElementById("check");

  var pwd_expression =/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;
  var letters = /^[A-Za-z]+$/;
  var filter =/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var tel = /^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/;

  if (name == "") {
    alert("Please enter your name");
  } else if (name.length < 6 || name.length > 16) {
    alert("Name must be between 6 to 15 characters long.");
  } else if (!letters.test(name)) {
    alert("Name field required only alphabet characters");
  } else {
    if (email == "") {
      alert("Please enter your user email id");
    } else if (!filter.test(email)) {
      alert("Invalid email");
    } else {
      if (phone == "") {
        alert("Please enter the phone number.");
      } else if (!tel.test(phone)) {
        alert("Phone number field required only numbers of 10 digits");
      } else {
        if (pwd == "") {
          alert("Please enter Password");
        } else if (!pwd_expression.test(pwd)) {
          alert(
            "1 Upper case,1  Lower case, 1 Special character(#?!@$%^&*-) and 1 Numeric letter are required in Password field"
          );
        } else if (document.getElementById("password").value.length < 6) {
          alert("Password minimum length is 6");
        } else if (document.getElementById("password").value.length > 12) {
          alert("Password max length is 12");
        } else {
          if (cpwd == "") {
            alert("Enter Confirm Password");
          } else if (cpwd != pwd) {
            alert("Password not Matched");
            location.reload();
          } else {
            if (!check.checked) {
              alert("Please tick the checkbox.");
            } else {
              alert("Checking Details");
              // window.location.href = "controllerUserData.php";
            }
          }
        }
      }
    }
  }
}
function clearFunc() {
  document.getElementById("username").value = "";
  document.getElementById("email").value = "";
  document.getElementById("phone").value = "";
  document.getElementById("password").value = "";
  document.getElementById("password2").value = "";
}
