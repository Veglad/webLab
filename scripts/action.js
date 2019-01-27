function startAnimation(){
	var animate_delay = 5;
	var seconds = 0;
	var id = setInterval(animate, animate_delay);
	var seconds_id = setInterval(count, 1000);
	var box = document.getElementById("box");
	var text = document.getElementById("text_count");
	var pos = 0;
	box.style.left = pos + "px";
	const box_size = box.offsetWidth;
	const end_anim_pos = screen.width - box_size;
	var box_step = end_anim_pos/(3000/animate_delay);

	function animate(){
		if(pos >= end_anim_pos - 3)
			clearInterval(id);
		else{
			pos+= box_step;
			box.style.left = pos + "px";
		}
	}

	function count(){
		text.innerHTML = 3 - ++seconds;
		if(seconds == 3){
			clearInterval(seconds_id);
			window.location.href="index.php";
		}
	}
}

