function chkonsubmit(){
    return chkPassport() && chkTel() && chkusername() && chkname() && chkpasswd() && chkemail();
}


function chkPassport(){
    var dom_passport = document.getElementById("reg_passport");
    var PassportRegx = /^(\d){5,20}$/;
    if(!PassportRegx.test(dom_passport.value)){
        document.getElementById("reg_passport_msg").innerHTML = "Passport id should be within 5-20 numbers.";
        return false;
    }
    else{
        document.getElementById("reg_passport_msg").innerHTML = "";
        return true;
    }
    
}

function chkTel(){
    var dom_Telnum = document.getElementById("reg_telnum");
    var TelRegx = /^(\d){5,20}$/;

    if(!TelRegx.test(dom_Telnum.value)){
        document.getElementById("reg_telnum_msg").innerHTML = "Telphone number should be within 5-20 numbers.";
        return false;
    }
    else{
        document.getElementById("reg_telnum_msg").innerHTML = "";
        return true;
    }
    
}

function chkusername(){
    var dom_username = document.getElementById("reg_username");
    var nameRegx = /^[A-z]{3,20}$/;
    if(!nameRegx.test(dom_username.value)){
        document.getElementById("reg_username_msg").innerHTML = "User name should be within 3-20 chars, please try again.";
        return false;
    }
    else{
        document.getElementById("reg_username_msg").innerHTML = "";
        return true;
    }
}

function chkname(){
    var dom_fname = document.getElementById("reg_fname");
    var dom_lname = document.getElementById("reg_lname");
    var nameRegx = /^[A-z]{2,25}$/;
    var flag = true;
    var flag2 = true;
    if(!nameRegx.test(dom_fname.value)){
        document.getElementById("reg_fname_msg").innerText = "First name should be within 2-25 chars, please try again.";
        flag = false;
    }else{
        document.getElementById("reg_fname_msg").innerText = "";
        flag = true;
    }

    if(!nameRegx.test(dom_lname.value)){
        document.getElementById("reg_lname_msg").innerText = "Last name should be within 2-25 chars, please try again.";
        flag2 = false;
    }else{
        document.getElementById("reg_lname_msg").innerText = "";
        flag2 = true;
    }
    return (flag && flag2);
}

function chkpasswd(){

    var dom_passwd = document.getElementById("reg_password");
    var dom_passwd2 = document.getElementById("reg_password2");
    var flag = true;
    var flag2 = true;
    if(dom_passwd.value.length > 25 || dom_passwd.value.length < 6){
        document.getElementById("reg_passwd_msg").innerText = "Password should be within 6-20 chars, please try again.";
        flag = false;
    }else{
        document.getElementById("reg_passwd_msg").innerText = "";
        flag = true;
    }

    if(dom_passwd.value != dom_passwd2.value){
        document.getElementById("reg_passwd2_msg").innerText = "Your passwords do not match, please try again.";
        flag2 = false;
    }
    else{
        document.getElementById("reg_passwd2_msg").innerText = "";
        flag2 = true;
    }
    return (flag && flag2);
}





/* chkemail is to check whether this user's input is correct email format or not.
 * and also check whether the two input emails are the same or not.
 * Correct email should be at least 1 alpha or num or underline @ (alpha or num) . (alpha) . [alpha(optional)]
 */
function chkemail(){
    var email1 = document.getElementById("reg_email");
    var email2 = document.getElementById("reg_email2");
    var flag = true;
    var flag2 = true;
    // Note: Use email should be use email1.value

    // \w{3,} (\.\w+)* @ [A-z0-9]+ (\.[A-z]{2,5}){1,2}$/
    var emRegx = /^\w{1,}(\.\w+)*@[A-z0-9]+(\.[A-z]{2,5}){1,2}$/;
    var ErrorStr1 = "";
    var ErrorStr2 = "";

    if(emRegx.test(email1.value)){
        ErrorStr1 = "";
        flag = true;
    }
    else{
        ErrorStr1 = "Please re-enter email in correct format, such as @yahoo.com[.cn]";
        flag = false;
    }

    if(email1.value != email2.value){
        ErrorStr2 = "Your emails do not match. Please try again.";
        flag2 = false;
    }
    else{
        ErrorStr2 = "";
        flag2 = true;
    }

    document.getElementById("reg_em2_msg").innerText = ErrorStr1;
    document.getElementById("reg_em1_msg").innerText = ErrorStr2;
    return (flag && flag2);
}


var XHR; // define a global object
function createXHR(){
    XHR = new XMLHttpRequest();
}

function reg_chkExistUname(){
    var username = document.register_form.reg_username.value;
    createXHR();
    XHR.open("GET", "../../Project/src/includes/form_handlers/reg_username_ajax.php?id="+username, true);
    XHR.onreadystatechange = reg_username_PutMsg;
    XHR.send(null);
}

function reg_username_PutMsg(){
    if(XHR.readyState == 4){
        if(XHR.status == 200){
            var textHTML = XHR.responseText;
            if(document.getElementById('reg_username_msg').innerHTML){
                document.getElementById('reg_username_msg2').innerHTML = "";
            }
            else{
                document.getElementById('reg_username_msg2').innerHTML = textHTML;
            }
        }
    }
}

function log_chkExistUname(){
    var username = document.log_form.log_username.value;
    createXHR();
    XHR.open("GET", "../../Project/src/includes/form_handlers/login_username_ajax.php?id="+username, true);
    XHR.onreadystatechange = log_username_PutMsg;
    XHR.send(null);
}


function log_username_PutMsg(){
    if(XHR.readyState == 4){
        if(XHR.status == 200){
            var textHTML = XHR.responseText;
            document.getElementById('log_username_msg').innerHTML = textHTML;
        }
    }
}


function log_chkonsubmit(){
    if(document.getElementById('log_username_msg').innerText != ""){
        return false;
    }
    else{
        return true;
    }
}