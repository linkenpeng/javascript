function domReady(f) {
	
	if (domReady.done) return f();
	
	if (domReady.timer) {
		domReady.ready.push(f);
	} else {
		addEvent(window, "load", isDOMReady);		
		domReady.ready = [f];
		domReady.timer = setInterval(isDOMReady, 13);
		
	}
}

function isDOMReady() {	
	if (domReady.done) return false;
	if (document && document.getElementsByTagName && document.getElementById && document.body) {
		clearInterval(domReady.timer);
		domReady.timer = null;
		
		for (var i = 0; i < domReady.ready.length; i++) 
			domReady.ready[i]();
			
		domReady.ready = null;
		domReady.done = true;
	}
}