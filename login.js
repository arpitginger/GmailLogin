function loginvalid() {
  var email = document.getElementById("email").value;
  var pwd = document.getElementById("password").value;

  var filter =
    /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var pwd_expression =
    /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;

  if (email == "") {
    alert("Please enter your user email id");
  } else if (!filter.test(email)) {
    alert("Invalid email");
  } else {
    if (pwd == " ") {
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
      alert("Login Successful");
      // window.location.replace = "controllerUserData.php";
    }
  }
}
function forgot(){
  window.location.href = "forgot.php";
}
