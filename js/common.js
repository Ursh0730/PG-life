window.addEventListener("load", function() {
    var signup_form = this.document.getElementById("signup-form");
    signup_form.addEventListener("submit", function (event) {
        var XHR = new XMLHttpRequest();

        XHR.addEventListener("load", signup_success);

        XHR.addEventListener("error", on_error);

        XHR.open("POST", "api/sign_submit.php");

        XHR.send(from_data);

        document.getElementById("loading").style.display = 'block';
        event.preventDefault();
    });

var login_from = document.getElementById("login-form");
 login_from.addEventListener("submit", function (event) {
    var XHR = new XMLHttpRequest();
    var from_data = new FormData(login_from);

    XHR.addEventListener("load", login_success);

    XHR.addEventListener("error", on_error);

    XHR.open("POST", "api/login_submit.php");

    XHR.send(from_data);

    document.getElementById("loading").style.display = 'block';
    event.preventDefault();

 });
}); 

var signup_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if (response.success) {
        alert(response.massage);
        window.location.href = "index.php";
    } else {
        alert(response.massage);
    }
};

var login_success = function  (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if(response.success) {
        location.reload();
    } else {
        alert(response.massage);
    }
};

var on_error = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if (response.success) {
        location.reload();
    } else {
        alert(response.massage);
    }
};
    
var on_error = function (event) {
    document.getElementById("loading").style.display = 'none';

    alert('Oops! something went wrong.');
};