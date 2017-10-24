	function toutCocher(pref)
	{
	  var item = document.getElementsByName("pref");
		console.log("bonsoir");
		if (monFormulaire.tout.checked == true) {
			for (i=0;i<item.length;i++)
		  {
				item[i].checked = true;
		  }
		} else {
			for (i=0;i<item.length;i++)
		  {
				item[i].checked = false;
		  }
		}
	}

	function testerValid()
	{
		if (monFormulaire.nom.value == "")
		  return false;
		else
		  return true;
	}

	function readURL(input) {
		var img =  document.getElementById("image");
		img.src = input.value;
        img.style.display = "block";
	}

	function particulier(){
		var field = document.getElementsByName("CA");
		var ca = field[0];
		ca.disabled = true;
		ca.value = "";
	}
	function autreQuePart(){
		var field = document.getElementsByName("CA");
		var ca = field[0];
		ca.disabled = false;
	}
