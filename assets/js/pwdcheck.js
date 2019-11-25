/**************************************************************
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                                                       \\
      **       ******  **      *       **       ******  \\
     *  *      *     * * *     *      *  *      *    **  \\
    *    *     *     * *  *    *     *    *     *    **   \\
   ********    ******  *   *   *    ********    ******     **
  *        *   *  *    *    *  *   *        *   *    **   //
 *          *  *   *   *     * *  *          *  *    **  //
*            * *    *  *      ** *            * ******  //
                                                       //
////////////////////////////////////////////////////////
**************************************************************/

/********** CHECK PASSWORD STRENGTH **********/
var myInput = document.getElementById("p");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var special = document.getElementById("special");
var flag = false;

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
        flag = true;
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
        flag = false;
    }
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
        flag = false;
    }
    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
        flag = false;
    }
    // Validate Special Characters
    var specialChars = /[!@#$%^&*(),.?":{}|<>]/g;
    if(myInput.value.match(specialChars)) {  
        special.classList.remove("invalid");
        special.classList.add("valid");
    } else {
        special.classList.remove("valid");
        special.classList.add("invalid");
        flag = false;
    }
    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
        flag = false;
    }
    if (flag) {
        $('#updt').prop('disabled',false);
    } else {
        $('#updt').prop('disabled',true);
    }
}


/********** CHECK PASSWORD MATCH **********/
$('#rp').keyup(function(){
    var password = $("#p").val();
    var confirmPassword = $("#rp").val();

    if (password != confirmPassword){
        $('#msg').removeClass();
        $('#msg').addClass('text-danger');
        $("#msg").html("Password Do Not Match!");
        $('#updt').prop('disabled',true);
    }
    else{
        $('#msg').removeClass();
        $('#msg').addClass('text-success');
        $("#msg").html("Password Match!");
        $('#updt').prop('disabled',false);
    }
});
