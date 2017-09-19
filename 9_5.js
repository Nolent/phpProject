	function toutCocher2(pref)
	{
	  var item = document.getElementsByName("preference[]");
	  for (i=0;i<item.length;i++)
	  {
		item[i].checked = monFormulaire.getElementsByName("tout").checked;
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
