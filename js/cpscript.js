var regSearch = /^[\w\s\d]+$/;
var regEmail = /^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/;
var regFirstName = /^[A-Z]{1}[a-z]{2,30}$/;
var regLastName = /^[A-Z]{1}[a-z]{3,30}$/;
var regPassword = /^[a-zA-Z0-9!@#$%^&*.]{6,127}$/;
var regTextArea = /^[\w\d\s\.\,\!\?]{2,255}$/;
var regFullName = /^[A-Z]{1}[a-z]{3,30}\s[A-Z]{1}[a-z]{3,30}$/;
var regNumber = /^\d+$/;
var regTimeOfReg = /^[1-9]{1}[0-9]{9}$/;
var regVerificationCode = /^[A-z0-9]{20}$/;
var regSalePercent = /^[1-9]{0,1}[0-9]{1,2}$|^100$/;

var regProductName = /^[A-z0-9\s]{3,127}$/;
var regProductPrice = /^[0-9]{1,4}(\.?[0-9]{2})?$/;
var regProductDescription = /^[a-zA-Z0-9\!\$\%\&\.\,\s]{3,254}$/;
var regProductQuantity = /^[0-9]{1,10}$/;
var regProductImageAlt = /^[A-z0-9\s]{3,127}$/;

var regQuestion = /^[\w\?\s\'\,\.]{3,254}$/;
var regAnswer = /^[\w\s\'\.\,\!\d]{1,127}$/;

function adduser(){
  var err = 0;
  if(!regFirstName.test(document.getElementById("firstname").value)){err++;}
  if(!regLastName.test(document.getElementById("lastname").value)){err++;}
  if(!regEmail.test(document.getElementById("email").value)){err++;}
  if(!regPassword.test(document.getElementById("password").value)){err++;}

  if(!err){
    return true;
  }
  return false;
}

function manageuser(){
        var err = 0;
        if(!regFirstName.test(document.getElementById("firstname").value)){err++;}
        if(!regLastName.test(document.getElementById("lastname").value)){err++;}
        if(!regEmail.test(document.getElementById("email").value)){err++;}
        if(!regTimeOfReg.test(document.getElementById("timeofreg").value)){err++;}
        if(!regVerificationCode.test(document.getElementById("verificationcode").value)){err++;}

        if(!err){
            return true;
        }
        return false;
    
    return false;
}

function managesale(){
    if(regSalePercent.test(document.getElementById("saleprocent").value)){return true;}
    return false;
}

function addproduct(){
    var err = 0;
    if(!regProductName.test(document.getElementById("productname").value)){err++;}
    if(!regProductPrice.test(document.getElementById("productprice").value)){err++;}
    if(!regProductDescription.test(document.getElementById("productdescription").value)){err++;}
    if(!regProductQuantity.test(document.getElementById("productquantity").value)){err++;}
    if(!regProductImageAlt.test(document.getElementById("productimagealt").value)){err++;}

    if(!err){
        return true;
    }
    return false;
}

function manageproduct(){
    if(addproduct()){
        if(regSalePercent.test(document.getElementById("productsaleprocent").value)){return true;}
        return false;
    }
    return false;
}

function addpoll(){
    var err = 0;
    if(!regQuestion.test(document.getElementById("question").value)){err++;}
    var two= 0;
    for(var i = 0; i< document.getElementsByName("answers[]").length;i++){
        if(!regAnswer.test(document.getElementsByName("answers[]")[i].value)){
            if(two<2){
                err++;
            }
        }else{
            two++;
        }
    }
    if(!err){
        return true;
    }
    return false;
}

function managepoll(){
    if(addpoll()){
        return true;
    }
    return false;
}

function addfaq(){
    var err = 0;
    if(!regQuestion.test(document.getElementById("question").value)){err++;}
    if(!regAnswer.test(document.getElementById("answer").value)){err++;}
    if(!err){
        return true;
    }
    return false;
}