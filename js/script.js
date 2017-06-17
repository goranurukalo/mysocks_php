window.onload = function() {
  var searchtext = document.getElementById('searchtext');
  var searchimg = document.getElementById('submitsearch');
  searchtext.addEventListener("blur", function(e){
    if(searchtext.value){
      document.getElementById("searchtext").className = "addsearch";
      document.getElementById("submitsearch").className = "addsearchimg";
    }
    else{
      document.getElementById("searchtext").className = "";
      document.getElementById("submitsearch").className = "";
    }
  });
  var nlmail = document.getElementById('nlmail');
  nlmail.addEventListener("blur", function(e){
    if(nlmail.value){
      document.getElementById("nlmail").className = "addnlmail";
      document.getElementById("nlsubmit").className = "addnlsubmit";
    }
    else{
      document.getElementById("nlmail").className = "";
      document.getElementById("nlsubmit").className = "";
    }
  });

};
//
//  REGEX FUNCTION
//
function fastRegExFunction(elementID,regEx,validationText){
    var element = document.getElementById(elementID);
    if(!regEx.test(element.value)){

      element.style.borderColor = '#FF0000';
      
      if(element.value){
        element.setCustomValidity(validationText);
      }else{
        element.setCustomValidity('Please fill out this field.');
      }
      return 1;
    }else{
      element.style.borderColor = '';
      element.setCustomValidity('');
      return 0;
    }
    return 0;
}
function regResult(errNumber){
  if(!errNumber){return true;}
  return false;
}
// oninput="setCustomValidity('');"   <- html
// oninput=\"setCustomValidity('');\"   <- echo 

//
//
  var regSearch = /^[\w\s\d]+$/;
  var regEmail = /^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/;
  var regFirstName = /^[A-Z]{1}[a-z]{2,30}$/;
  var regLastName = /^[A-Z]{1}[a-z]{3,30}$/;
  var regPassword = /^[a-zA-Z0-9!@#$%^&*.]{6,127}$/;
  var regTextArea = /^[\w\d\s\.\,\!\?]{2,255}$/;
  var regFullName = /^[A-Z]{1}[a-z]{3,30}\s[A-Z]{1}[a-z]{3,30}$/;
  var regNumber = /^\d+$/;
//
//

//header
function sendme(){
  if(regSearch.test(searchtext.value)){
    return true;
  }
  return false;
}
//footer
function sendsubscribe(){
  var err=0;
  err += fastRegExFunction('nlmail',regEmail,'Nije dobar email.');
  return regResult(err);
}

//unsubscribe
function unsubscribemail(){
  var err=0;
  err += fastRegExFunction('unsubemail',regEmail,'Nije dobar email.');
  return regResult(err);
}
//register
function registration(){
  var err = 0;
  err += fastRegExFunction('registername',regFirstName,'Nije dobar firstname.');
  err += fastRegExFunction('registerlastname',regLastName,'Nije dobar lastname.');
  err += fastRegExFunction('registeremail',regEmail,'Nije dobar email.');
  err += fastRegExFunction('registerpass',regPassword,'Nije dobar password.');
  err += fastRegExFunction('registerpassagain',regPassword,'Nije dobar password.');
  if(document.getElementById("registerpass").value!=document.getElementById("registerpassagain").value){
    err++;
    document.getElementById("registerpassagain").style.borderColor = '#FF0000';
  }
  else{
    document.getElementById("registerpassagain").style.borderColor = '';
  }
  return regResult(err);
}
//oneproduct
function submitoneproduct(){
  var err=0;
  if(!regNumber.test(document.getElementById("productID").value)){err++;}
  if(!regNumber.test(document.getElementById("oneproductquantity").value)){
    if(document.getElementById("oneproductquantity").value>10 || document.getElementById("oneproductquantity").value<1){
      err++;
    }
  }
  return regResult(err);
}
//myprofile
function submitmyprofile(){
  var err=0;
  err += fastRegExFunction('firstname',regFirstName,'Nije dobar firstname.');
  err += fastRegExFunction('lastname',regLastName,'Nije dobar lastname.');
  return regResult(err);
}
// login
function submitlogin(){
  var err=0;
  err += fastRegExFunction('logemail',regEmail,'Nije dobar email.');
  err += fastRegExFunction('logpass',regPassword,'Nije dobar password.');
  return regResult(err);
}
//forgotpassword
function submitforgotemail(){
  var err=0;
  err += fastRegExFunction('registeremail',regEmail,'Nije dobar email.');
  return regResult(err);
}
//contactus
function submitcontactform(){
  var err=0;
  err += fastRegExFunction('contusfullname',regFullName,'Nije dobar fullname.');
  err += fastRegExFunction('contusemail',regEmail,'Nije dobar email.');
  err += fastRegExFunction('contusquestion',regTextArea,'Nije dobar question.');
  return regResult(err);
}