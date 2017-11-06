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
		var field = document.monFormulaire.type.value;
		if(field=="Particulier")document.monFormulaire.CA.disabled=true;
		else document.monFormulaire.CA.disabled=false;
	}
	window.addEventListener("load",autreQuePart);

	function parseRow(row) {
		console.log("debut parse");
		var ligne = document.getElementById('client').rows[row];
		var selPays = document.getElementsByName('pays');
		var selType = document.getElementsByName('type');
		for (var i = 0; i < selPays[0].length; i++) {
			if (selPays[0][i].value == ligne.cells[2].innerHTML) {
				selPays[0][i].selected = true;
			}
		}
		var typeClient = ligne.cells[5].innerHTML;
		console.log("type client = " + typeClient);
		for (var i = 0; i < selType[0].length; i++) {
			console.log("type sel = " + selType[0][i].value);
			if (selType[0][i].value == typeClient) {
				selType[0][i].selected = true;
			}
		}
		if (ligne.cells[5].innerHTML == "Particulier") {
			particulier();
			document.getElementsByName('CA')[0].value = "";
		}
		else {
			autreQuePart();
			document.getElementsByName('CA')[0].value = ligne.cells[4].innerHTML;
		}
		document.getElementsByName('nomBase')[0].value = ligne.cells[0].innerHTML;
		document.getElementsByName('prenomBase')[0].value = ligne.cells[1].innerHTML;
		document.getElementsByName('localiteBase')[0].value = ligne.cells[3].innerHTML;
		document.getElementsByName('nom')[0].value = ligne.cells[0].innerHTML;
		document.getElementsByName('prenom')[0].value = ligne.cells[1].innerHTML;
		document.getElementsByName('localite')[0].value = ligne.cells[3].innerHTML;
	}
