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

	function parseRow(row) {
		var ligne = document.getElementById('client').rows[row];
		document.getElementsByName('nomBase').value = ligne.cells[0].innerHTML;
		document.getElementsByName('prenomBase').value = ligne.cells[1].innerHTML;
		document.getElementsByName('localiteBase').value = ligne.cells[3].innerHTML;
		document.getElementsByName('nom').value = ligne.cells[0].innerHTML;
		document.getElementsByName('prenom').value = ligne.cells[1].innerHTML;
		document.getElementsByName('localite').value = ligne.cells[3].innerHTML;
	}
