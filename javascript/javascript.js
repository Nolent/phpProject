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
	function autreQuePart(){
		var field = document.monFormulaire.type.value;
		if(field=="Particulier")document.monFormulaire.CA.disabled=true;
		else document.monFormulaire.CA.disabled=false;
	}
	window.addEventListener("load",autreQuePart);

	function parseRow(row) {
		var ligne = document.getElementById('client').rows[row];
		document.getElementsByName('nomBase').value = ligne.cells[0].innerHTML;
		document.getElementsByName('prenomBase').value = ligne.cells[1].innerHTML;
		document.getElementsByName('localiteBase').value = ligne.cells[3].innerHTML;
		document.getElementsByName('nom').value = ligne.cells[0].innerHTML;
		document.getElementsByName('prenom').value = ligne.cells[1].innerHTML;
		document.getElementsByName('localite').value = ligne.cells[3].innerHTML;
	}
