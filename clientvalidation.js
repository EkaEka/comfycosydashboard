
function userDataChanged(){

var oForm = document.forms[0];
var firstname = oForm.elements["firstname"].value;
var secondname = oForm.elements["secondname"].value;
var email = oForm.elements["email"].value;
var username = oForm.elements["username"].value;
var pwd1 = oForm.elements["password1"].value;
var pwd2 = oForm.elements["password2"].value;

var enabled = true;
var initialClass = document.getElementById("signup-btn").className;
if (passwordsOK(pwd1,pwd2) && namesOK(firstname,secondname) && usernameOK(username) && emailOK(email)) {
//enable the submit button 
var newClass = removeString("disabled",initialClass);
document.getElementById("signup-btn").className = newClass;
console.log("valid");
} else {
//enabled = false;
//alert('invalid data');
//disable the submit button
document.getElementById("signup-btn").className = initialClass+ " disabled";
console.log("invalid");
}
 

}

function namesOK(firstname,secondname){
  /*if (CheckPassword(pwd1) && CheckPassword(pwd2) && (pwd1 == pwd2)) {
 return true;
  } else {
  return false;
  }*/
  
  return true;
}
function emailOK(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return true; //e.test(email);
} 

function usernameOK(username){
 /* if (CheckPassword(pwd1) && CheckPassword(pwd2) && (pwd1 == pwd2)) {
 return true;
  } else {
  return false;
  }*/
  return true;
}

function passwordsOK(pwd1,pwd2){
  if (CheckPassword(pwd1) && CheckPassword(pwd2) /*&& (pwd1 == pwd2)*/) {
 console.log("valid passwords");
 return true;
  } else {
  console.log("invalid passwords");
  return false;
  }
}

function CheckPassword(password) 
{ 
var passwordPattern=  /^[A-Za-z]\w{7,14}$/;


if(password.match(passwordPattern)) 
{ 
//alert('Correct, try another...')
return true;
}
else
{ 
//alert('Wrong...!')
return false;
}
}
//////////////////////////////////////////////////////////////////
//////////////////////////MODIFY CLASSES//////////////////////////
//////////////////////////////////////////////////////////////////
function removeString(string,source) { 

return source.replace
      ( /(?:^|\s)disabled(?!\S)/g , '' );


}

//////////////////////////////////////////////////////////////////
function comparePasswords(password1,password2) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 



function usernameChanged(){
}
function emailChanged(){

var oForm = document.forms[0];
emailtext = oForm.elements["password1"].value;
  if (validateEmail(emailtext)) {
  document.getElementById("email-comment").innerHTML = "kargad";
  } else {
  document.getElementById("email-comment").innerHTML = "tsudad";
  }
}
function password1Changed(){
//var pwd = document.getElementById("password1").value;

var oForm = document.forms[0];
pwd = oForm.elements["password1"].value;
  if (CheckPassword(pwd)) {
  document.getElementById("pwd1-comment").innerHTML = "kargad";
  } else {
  document.getElementById("pwd1-comment").innerHTML = "tsudad";
  }
}


function submitButtonHit(){
}
 