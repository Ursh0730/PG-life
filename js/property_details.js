window.addEventListener("load", function () {
    const search = window.location.search;
    const params = new URLSearchParams(search);
    const property_id = params.get('property_id');
    var is_intrested_image = document.getElementsByClassName("is-interested-img")[0];
    is_intrested_image.addEventListener("click", function (event) {
        var XHR = new XMLHttpRequest();

        XHR.addEventListener("load", toggle_intrest_success);

        XHR.addEventListener("error", on_error);

        XHR.open("GET", "api/toggle_intrested.php?property_id" + property_id);

        XHR.send();

        document.getElementsById("loading").style.display = 'block';
        event.preventDefault();


    });
});

var toggle_intrest_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if(response.success) {
        var is_intrested_image = document.getElementsByClassName("is-intrested-img")[0];
        var intrested_user_count = document.getElementByClassName("intrested-user-count")[0];

        if(response.is_intrested) {
            is_intrested_image.classList.add("fas");
            is_intrested_image.classList.remove("far");
            intrested_user_count.innerHTML = parseFloat(intrested_user_count.innerHTML) + 1;
        } else (response.is_intrested) {
            is_intrested_image.classList.add("far");
            is_intrested_image.classList.remove("fas");
            intrested_user_count.innerHTML = parseFloat(intrested_user_count.innerHTML) - 1;
        }
    } else if (!response.success && !response.is_logged_in) {
        window.$("#login.modal").modal("show");
    }
};