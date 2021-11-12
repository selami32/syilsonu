
var sonuc=document.location.href.search("localhost");

if (sonuc>0) {

	window.onerror = function (msg, url, line) {
	   alert("Message : " + msg );
	   alert("url : " + url );
	   alert("Line number : " + line );
	}

}


