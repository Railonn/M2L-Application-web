function ajoutLicence(nbL) 
{		
	var compteur = document.getElementById("lastNbL").value
	if(compteur != 0)
	{
		for (var i = 0; i < compteur; i++) 
		{
			var element = document.getElementById('licence'+i);
			element.parentNode.removeChild(element);
		}
	}
	for (var i = 0; i < nbL; i++) 
	{
		var bloc = document.getElementById("bloc_licences");
		var x = document.createElement("input");
		x.setAttribute("class","form-control mt-2");
		x.setAttribute("type", "text");
		x.setAttribute("required", "required");
		x.setAttribute("placeholder", "Numéro licence");
		x.setAttribute("id", "licence"+i);
		x.setAttribute("name", "licence"+i);
		bloc.appendChild(x);
	}
	document.getElementById("lastNbL").value = nbL; 
}
