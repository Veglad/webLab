function onFormSubmit() {
    var form = document.forms["main_form"];
	var name = form.elements["name"].value;
	var second_name = form.elements["second_name"].value;
	var patronimic = form.elements["patronimic"].value;

	var result = true;

	if(name.length == 0){
		document.getElementById("error_name").style.visibility = "visible";
		form.elements["name"].classList.add("red_border");
		result = false;
	}
	if(second_name.length == 0){
		document.getElementById("error_sec_name").style.visibility = "visible";
		form.elements["second_name"].classList.add("red_border");
		result = false;
	}
	if(patronimic.length == 0){
		document.getElementById("error_patronimic").style.visibility = "visible";
		form.elements["patronimic"].classList.add("red_border");
		result = false;
	}

	var numberOfChecked = document.querySelectorAll('input[type="checkbox"]:checked').length
	if(numberOfChecked > 3){
		document.getElementById("error_checkboxes").style.visibility = "visible";
		result = false;
	}

	if(result){
		setInterval(goHome, 20);
	}

	return result;
}

function keyPressed(input_name, error_message_id){
    var form = document.forms["main_form"];
	form[input_name].classList.remove("red_border");
	document.getElementById(error_message_id).style.visibility = "hidden";
}

function goHome(){
    window.location.href="index.php";
}

function checkboxChanged(checkbox){
    if(document.querySelectorAll('input[type="checkbox"]:checked').length <= 3)
		document.getElementById("error_checkboxes").style.visibility = "hidden";
}