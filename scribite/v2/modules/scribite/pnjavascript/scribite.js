function showInfo(location) {
	var win = new Window({className: "alphacube",
			      title: "scribite! info browser", 
			      top:100, left:100, width:500, height:400, 
			      url: location,
			      showEffectOptions: {duration:1.5}})
	win.show(); 
}


