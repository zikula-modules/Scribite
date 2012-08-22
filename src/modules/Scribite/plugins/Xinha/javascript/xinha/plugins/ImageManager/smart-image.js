
/** The ImageManager plugin has the capability to also select other things and represent them as images.
 *  For example, it can select YouTube videos, and the image it returns will be the "large size thumbnail"
 *  of the video which YouTube provides, along with some "meta information" which is stored as a query string
 *  on the end of the image URL.
 *
 *  For example, a YouTube video url returned by ImageManager may look like this (I've inserted newlines here):
 *   http://img.youtube.com/vi/_ctBsZJmPv8/0.jpg
 *     ?x-shockwave-flash=http%3A%2F%2Fwww.youtube.com%2Fv%2F_ctBsZJmPv8
 *     &x-thumbnail=http%3A%2F%2Fimg.youtube.com%2Fvi%2F_ctBsZJmPv8%2F3.jpg
 *     &f_alt=CAW%20Sportcruiser%20ZK-JBZ%20does%20a%20touch%20and%20go%20at%20Tirohia
 *     &f_width=320
 *     &f_height=240
 *
 *  It should be clear what the meta information all means.
 *
 *  The job of SmartImages is to look through the page where you OUTPUT (use) the stuff you edited with
 *  Xinha/ImageManager/ImagePicker find images with the appropriate meta information, and replace them 
 *  with something other than an image (in this case, it would replace it with the YouTube video of course).
 *
 *  REPEAT: You need to use SmartImages (or make your own alternative) on the page(s) where you OUTPUT (use) 
 *  the content you edited with Xinha/ImageManager/ImagePicker.  If you don't, well, you just get to see a 
 *  static image, instead of the video (as will anybody with JS turned off etc, which is quite the bonus really!)
 *
 *  Example Usage:
 *    <head>
 *      <script type="text/javascript" src="/xinha/plugins/ImageManager/smart-image.js"></script>      
 *    </head>
 *    <body onload="SmartImages.replace_all();">
 * 
 *  If you want to do something fancy with youtube/flash smart images, check out the SmartImages.replace_flash
 *  method below where you can specify dimensions, background colour, pass data to the flash, and set attributes
 *  on the resulting object/embed.
 *
 * @author $Author: gogo $
 * @version $Id: image-manager.js 856 2007-06-13 18:34:34Z wymsy $
 * @package ImageManager 
 */  

var SmartImages = 
{
  _flash_meta_re:  new RegExp(/\?.*(x-shockwave-flash)=([^&]+)/),
  _flickr_meta_re: new RegExp(/\?.*(x-flickr-photo)=([^&]+)/),
  /** Replace an image which has exta meta information on the query string 
   *  (from selecting a video from youtube with the image manager/picker)
   *  with the flash video referenced in that data.
   *
   *  @param Element|null Image element, or null to replace all images
   *     which have the meta data.
   *  @param Object|null  An object of parameters, or null for the default
       {
         width:   '100%',    // null for "same as image"
         height:  '100%',    // null for "same as image"
         bgcolor: '#000000', // null for transparent?
         
         embed_params: {
            wmode: 'transparent'
         },
         
         embed_attributes: {
         
         }
         
         flash_params: {
           my_variable: 'something'
         }
       }
   *
   */
  
  replace_flash:
    function (img, params)
    {
      if(!img)
      {
        var images = document.getElementsByTagName('img');
              
        for(var x = 0; x < images.length; x++)
        {
          if(images[x].src.match(SmartImages._flash_meta_re))
          {
            SmartImages.replace_flash(images[x], params);
          }
        }
      }
      else
      {
        var i = img;
        if(!i.src.match(SmartImages._flash_meta_re))
          return;
        var swf = decodeURIComponent(RegExp.$2);
        
        if(!i.id)
        {
          i.id = 'ximg'+Math.floor(Math.random() * 100000);
        }
        
        if(!params) params = { };
        if(!params.embed_params) 
          params.embed_params = { 'wmode':'transparent' };
        if(!params.flash_params)
          params.flash_params = { }
        if(!params.embed_attributes)
          params.embed_attributes = { }
        if(!params.width)  params.width   = i.offsetWidth;
        if(!params.height) params.height = i.offsetHeight;                
        if(params.bgcolor) params.embed_params.bgcolor = params.bgcolor;
        
        swfobject.embedSWF(swf, i.id, params.width, params.height, '7.0.0', null, params.flash_params, params.embed_params, params.embed_attributes);          
      }
    },
    
  /** Add an overlay over flickr images which shows the copyright owner, and a link to the 
   *  photo at flickr.  Flickr requires attribution of all images, this should I believe satisfy  
   *  that requirement.
   *
   *  Note However that flickr expressly forbids any commercial use of thier API without 
   *   a commercial API key, which they need you to apply for.
   *
   */
   
  attribute_flickr: 
    function(img, params)
    {
      if(!img)
      {
        var images = document.getElementsByTagName('img');
              
        for(var x = 0; x < images.length; x++)
        {
          if(images[x].src.match(SmartImages._flickr_meta_re))
          {
            SmartImages.attribute_flickr(images[x], params);
          }
        }
      }
      else
      {
        var i = img;
        if(!i.src.match(SmartImages._flickr_meta_re))
          return;
        
        var meta = SmartImages.get_meta(i.src);
        var inf = document.createElement('a');
        inf.appendChild(document.createTextNode('© ' + meta['x-by']));
        inf.appendChild(document.createTextNode(' - flickr.com '));
        
        inf.href = 'http://www.flickr.com/photos/'+meta['x-uid']+'/'+meta['x-flickr-photo']+'/';
        inf.target = '_blank';
        
        inf.style.position   = 'absolute';
        inf.style.display    = 'block';
        inf.style.visibility = 'hidden';        
        inf.className        = 'xinha-flickr-info';        
        inf.style.backgroundColor = '#CCC';
        inf.style.opacity    = '0.6';
        inf.style.padding    = '2px';
        inf.style.color      = 'black';
        
        i.xFlickrInfo = inf;
                
        // Need to append it before we position it
        document.body.appendChild(i.xFlickrInfo);
        i.xFlickrShow = function()
          {
            var p = SmartImages.get_position(this);
            this.xFlickrInfo.style.top    = p.y + (this.offsetHeight - this.xFlickrInfo.offsetHeight) + 'px';                        
            this.xFlickrInfo.style.left   = p.x + ((this.offsetWidth / 2) - (this.xFlickrInfo.offsetWidth / 2)) + 'px';
            this.xFlickrInfo.style.visibility = 'visible';
            
            var im = this;
            window.setTimeout(function() { im.xFlickrInfo.style.visibility = 'hidden'; }, 4000);
          }
          
        
        SmartImages.add_event(i, 'mouseover', function() { i.xFlickrShow(); });
        SmartImages.add_event(window,'resize',function() { if(i.xFlickrInfo.style.visibility == 'visible') i.xFlickrShow(); });                
      }
  },
  
  get_meta: 
    function(url)
    {      
      var outparam = { };
      while(url.match(/[?&](([fx][_-][a-z0-9_-]+)=([^&#]+))/i))
      {
        try
        {
          outparam[RegExp.$2] = decodeURIComponent(RegExp.$3);
        }
        catch(e)
        {
          // Truncated component probably
        }
        url = url.replace(RegExp.$1, '');
      }
      
      return outparam;
    },
        
   /** Get the X/Y position of an element */
   
   get_position: function(obj) {
        var x = 0;
        var y = 0;
        if (obj.offsetParent) {
            x = obj.offsetLeft
            y = obj.offsetTop
            while (obj = obj.offsetParent) {
                x += obj.offsetLeft
                y += obj.offsetTop
            }
        }
        return { 'x': x, 'y': y };
    },
    
  /** Add event */
  add_event: function(el, evname, func)
  {
    if(document.addEventListener)
    {
      el.addEventListener(evname, func, true);
    }
    else
    {
      el.attachEvent("on" + evname, func);
    }
  },
  
  /** Replace all the images that have appropriate meta information with
   *  something more interesting.
   */
   
  replace_all:
    function()
    {
      SmartImages.replace_flash();
      SmartImages.attribute_flickr();
    }

}


// Below is the source for SWFObject, including it here rather than trying to do an include just to make it easier.
if(typeof swfobject == 'undefined')
{
/*	SWFObject v2.0 rc2 <http://code.google.com/p/swfobject/>
	Copyright (c) 2007 Geoff Stearns, Michael Williams, and Bobby van der Sluis
	This software is released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

var swfobject = function() {
	
	var domLoadFnArr = [];
	var regObjArr = [];
	var timer = null;
	var storedAltContent = null;
	var isDomLoaded = false;
	var isExpressInstallActive = false;
	
	/* Centralized function for browser feature detection
		- Proprietary feature detection (conditional compiling) is used to detect Internet Explorer's features
		- User agent string detection is only used when no alternative is possible
		- Is executed directly for optimal performance
	*/	
	var ua = function() {
		var w3cdom = typeof document.getElementById != "undefined" 	&& typeof document.getElementsByTagName != "undefined" && typeof document.createElement != "undefined" && typeof document.appendChild != "undefined" && typeof document.replaceChild != "undefined" && typeof document.removeChild != "undefined" && typeof document.cloneNode != "undefined";
		var playerVersion = [0,0,0];
		var d = null;
		if (typeof navigator.plugins != "undefined" && typeof navigator.plugins["Shockwave Flash"] == "object") {
			d = navigator.plugins["Shockwave Flash"].description;
			if (d) {
				d = d.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
				playerVersion[0] = parseInt(d.replace(/^(.*)\..*$/, "$1"), 10);
				playerVersion[1] = parseInt(d.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
				playerVersion[2] = /r/.test(d) ? parseInt(d.replace(/^.*r(.*)$/, "$1"), 10) : 0;
			}
		}
		else if (typeof window.ActiveXObject != "undefined") {
			var a = null;
			var fp6Crash = false;
			try {
				a = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
			}
			catch(e) {
				try { 
					a = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
					playerVersion = [6,0,21];
					a.AllowScriptAccess = "always";  // Introduced in fp6.0.47
				}
				catch(e) {
					if (playerVersion[0] == 6) {
						fp6Crash = true;
					}
				}
				if (!fp6Crash) {
					try {
						a = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
					}
					catch(e) {}
				}
			}
			if (!fp6Crash && a) { // a will return null when ActiveX is disabled
				try {
					d = a.GetVariable("$version");  // Will crash fp6.0.21/23/29
					if (d) {
						d = d.split(" ")[1].split(",");
						playerVersion = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
					}
				}
				catch(e) {}
			}
		}
		var u = navigator.userAgent.toLowerCase();
		var p = navigator.platform.toLowerCase();
		var webkit = /webkit/.test(u);
		var webkitVersion = webkit ? parseFloat(u.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : 0;
		var ie = false;
		var win = p ? /win/.test(p) : /win/.test(u);
		var mac = p ? /mac/.test(p) : /mac/.test(u);
		/*@cc_on
			ie = true;
			@if (@_win32)
				win = true;
			@elif (@_mac)
				mac = true;
			@end
		@*/
		return { w3cdom:w3cdom, playerVersion:playerVersion, webkit:webkit, webkitVersion:webkitVersion, ie:ie, win:win, mac:mac };
	}();
		
	/* Cross-browser onDomLoad
		- Based on Dean Edwards' solution: http://dean.edwards.name/weblog/2006/06/again/
		- Will fire an event as soon as the DOM of a page is loaded (supported by Gecko based browsers - like Firefox -, IE, Opera9+, Safari)
	*/ 
	var onDomLoad = function() {
		if (!ua.w3cdom) {
			return;
		}
		addDomLoadEvent(main);
		if (ua.ie && ua.win) {
			try {  // Avoid a possible Operation Aborted error
				document.write("<scr" + "ipt id=__ie_ondomload defer=true src=//:></scr" + "ipt>"); // String is split into pieces to avoid Norton AV to add code that can cause errors 
				var s = document.getElementById("__ie_ondomload");
				if (s) {
					s.onreadystatechange = function() {
						if (this.readyState == "complete") {
							this.parentNode.removeChild(this);
							callDomLoadFunctions();
						}
					};
				}
			}
			catch(e) {}
		}
		if (ua.webkit && typeof document.readyState != "undefined") {
			timer = setInterval(function() { if (/loaded|complete/.test(document.readyState)) { callDomLoadFunctions(); }}, 10);
		}
		if (typeof document.addEventListener != "undefined") {
			document.addEventListener("DOMContentLoaded", callDomLoadFunctions, null);
		}
		addLoadEvent(callDomLoadFunctions);
	}();
	
	function callDomLoadFunctions() {
		if (isDomLoaded) {
			return;
		}
		if (ua.ie && ua.win) { // Test if we can really add elements to the DOM; we don't want to fire it too early
			var s = document.createElement("span");
			try { // Avoid a possible Operation Aborted error
				var t = document.getElementsByTagName("body")[0].appendChild(s);
				t.parentNode.removeChild(t);
			}
			catch (e) {
				return;
			}
		}
		isDomLoaded = true;
		if (timer) {
			clearInterval(timer);
			timer = null;
		}
		var dl = domLoadFnArr.length;
		for (var i = 0; i < dl; i++) {
			domLoadFnArr[i]();
		}
	}
	
	function addDomLoadEvent(fn) {
		if (isDomLoaded) {
			fn();
		}
		else { 
			domLoadFnArr[domLoadFnArr.length] = fn; // Array.push() is only available in IE5.5+
		}
	}
	
	/* Cross-browser onload
		- Based on James Edwards' solution: http://brothercake.com/site/resources/scripts/onload/
		- Will fire an event as soon as a web page including all of its assets are loaded 
	 */
	function addLoadEvent(fn) {
		if (typeof window.addEventListener != "undefined") {
			window.addEventListener("load", fn, false);
		}
		else if (typeof document.addEventListener != "undefined") {
			document.addEventListener("load", fn, false);
		}
		else if (typeof window.attachEvent != "undefined") {
			window.attachEvent("onload", fn);
		}
		else if (typeof window.onload == "function") {
			var fnOld = window.onload;
			window.onload = function() {
				fnOld();
				fn();
			};
		}
		else {
			window.onload = fn;
		}
	}
	
	/* Main function
		- Will preferably execute onDomLoad, otherwise onload (as a fallback)
	*/
	function main() { // Static publishing only
		var rl = regObjArr.length;
		for (var i = 0; i < rl; i++) { // For each registered object element
			var id = regObjArr[i].id;
			if (ua.playerVersion[0] > 0) { // If no fp is installed, we let the object element do its job (show alternative content)
				var obj = document.getElementById(id);
				if (obj) {
					regObjArr[i].width = obj.getAttribute("width") ? obj.getAttribute("width") : "0";
					regObjArr[i].height = obj.getAttribute("height") ? obj.getAttribute("height") : "0";
					if (hasPlayerVersion(regObjArr[i].swfVersion)) { // Flash plug-in version >= Flash content version: Houston, we have a match!
						if (ua.webkit && ua.webkitVersion < 312) { // Older webkit engines ignore the object element's nested param elements
							fixParams(obj);
						}
					}
					else if (regObjArr[i].expressInstall && !isExpressInstallActive && hasPlayerVersion([6,0,65]) && (ua.win || ua.mac)) { // Show the Adobe Express Install dialog if set by the web page author and if supported (fp6.0.65+ on Win/Mac OS only)
						showExpressInstall(regObjArr[i]);
					}
					else { // Flash plug-in and Flash content version mismatch: display alternative content instead of Flash content
						displayAltContent(obj);
					}
				}
			}
			createCSS("#" + id, "visibility:visible");
		}
	}
	
	/* Fix nested param elements, which are ignored by older webkit engines
		- This includes Safari up to and including version 1.2.2 on Mac OS 10.3
		- Fall back to the proprietary embed element
	*/
	function fixParams(obj) {
		var nestedObj = obj.getElementsByTagName("object")[0];
		if (nestedObj) {
			var e = document.createElement("embed");	
			var a = nestedObj.attributes;
			if (a) {
				var al = a.length;
				for (var i = 0; i < al; i++) {
					if (a[i].nodeName.toLowerCase() == "data") {
						e.setAttribute("src", a[i].nodeValue);
					}
					else {
						e.setAttribute(a[i].nodeName, a[i].nodeValue);
					}
				}
			}
			var c = nestedObj.childNodes;
			if (c) {
				var cl = c.length;
				for (var j = 0; j < cl; j++) {
					if (c[j].nodeType == 1 && c[j].nodeName.toLowerCase() == "param") {
						e.setAttribute(c[j].getAttribute("name"), c[j].getAttribute("value"));
					}
				}
			}
			obj.parentNode.replaceChild(e, obj);
		}
	}
	
	/* Fix hanging audio/video threads and force open sockets and NetConnections to disconnect
		- Occurs when unloading a web page in IE using fp8+ and innerHTML/outerHTML
		- Dynamic publishing only
	*/
	function fixObjectLeaks(id) {
		if (ua.ie && ua.win && hasPlayerVersion([8,0,0])) {
			window.attachEvent("onunload", function () {
				var obj = document.getElementById(id);
				for (var i in obj) {
					if (typeof obj[i] == "function") {
						obj[i] = function() {};
					}
				}
				obj.parentNode.removeChild(obj);
			});
		}
	}
	
	/* Show the Adobe Express Install dialog
		- Reference: http://www.adobe.com/cfusion/knowledgebase/index.cfm?id=6a253b75
	*/
	function showExpressInstall(regObj) {
		isExpressInstallActive = true;
		var obj = document.getElementById(regObj.id);
		if (obj) {
			if (regObj.altContentId) {
				var ac = document.getElementById(regObj.altContentId);
				if (ac) {
					storedAltContent = ac;
				}
			}
			else {
				storedAltContent = abstractAltContent(obj);
			}
			if (!(/%$/.test(regObj.width)) && parseInt(regObj.width, 10) < 310) {
				regObj.width = "310";
			}
			if (!(/%$/.test(regObj.height)) && parseInt(regObj.height, 10) < 137) {
				regObj.height = "137";
			}
			var pt = ua.ie && ua.win ? "ActiveX" : "PlugIn";
			document.title = document.title.slice(0, 47) + " - Flash Player Installation";
			var dt = document.title;
			var fv = "MMredirectURL=" + window.location + "&MMplayerType=" + pt + "&MMdoctitle=" + dt;
			var replaceId = regObj.id;
			// For IE when a SWF is loading (AND: not available in cache) wait for the onload event to fire to remove the original object element
			// In IE you cannot properly cancel a loading SWF file without breaking browser load references, also obj.onreadystatechange doesn't work
			if (ua.ie && ua.win && obj.readyState != 4) {
				var newObj = document.createElement("div");
				replaceId += "SWFObjectNew";
				newObj.setAttribute("id", replaceId);
				obj.parentNode.insertBefore(newObj, obj); // Insert placeholder div that will be replaced by the object element that loads expressinstall.swf
				obj.style.display = "none";
				window.attachEvent("onload", function() { obj.parentNode.removeChild(obj); });
			}
			createSWF({ data:regObj.expressInstall, id:"SWFObjectExprInst", width:regObj.width, height:regObj.height }, { flashvars:fv }, replaceId);
		}
	}
	
	/* Functions to abstract and display alternative content
	*/
	function displayAltContent(obj) {
		if (ua.ie && ua.win && obj.readyState != 4) {
			// For IE when a SWF is loading (AND: not available in cache) wait for the onload event to fire to remove the original object element
			// In IE you cannot properly cancel a loading SWF file without breaking browser load references, also obj.onreadystatechange doesn't work
			var el = document.createElement("div");
			obj.parentNode.insertBefore(el, obj); // Insert placeholder div that will be replaced by the alternative content
			el.parentNode.replaceChild(abstractAltContent(obj), el);
			obj.style.display = "none";
			window.attachEvent("onload", function() { obj.parentNode.removeChild(obj); });
		}
		else {
			obj.parentNode.replaceChild(abstractAltContent(obj), obj);
		}
	}	

	function abstractAltContent(obj) {
		var ac = document.createElement("div");
		if (ua.win && ua.ie) {
			ac.innerHTML = obj.innerHTML;
		}
		else {
			var nestedObj = obj.getElementsByTagName("object")[0];
			if (nestedObj) {
				var c = nestedObj.childNodes;
				if (c) {
					var cl = c.length;
					for (var i = 0; i < cl; i++) {
						if (!(c[i].nodeType == 1 && c[i].nodeName.toLowerCase() == "param") && !(c[i].nodeType == 8)) {
							ac.appendChild(c[i].cloneNode(true));
						}
					}
				}
			}
		}
		return ac;
	}
	
	/* Cross-browser dynamic SWF creation
	*/
	function createSWF(attObj, parObj, id) {
		var r;
		var el = document.getElementById(id);
		if (typeof attObj.id == "undefined") { // if no 'id' is defined for the object element, it will inherit the 'id' from the alternative content
			attObj.id = id;
		}
		if (ua.ie && ua.win) { // IE, the object element and W3C DOM methods do not combine: fall back to outerHTML
			var att = "";
			for (var i in attObj) {
				if (attObj[i] != Object.prototype[i]) { // Filter out prototype additions from other potential libraries, like Object.prototype.toJSONString = function() {}
					if (i == "data") {
						parObj.movie = attObj[i];
					}
					else if (i.toLowerCase() == "styleclass") { // 'class' is an ECMA4 reserved keyword
						att += ' class="' + attObj[i] + '"';
					}
					else if (i != "classid") {
						att += ' ' + i + '="' + attObj[i] + '"';
					}
				}
			}
			var par = "";
			for (var j in parObj) {
				if (parObj[j] != Object.prototype[j]) { // Filter out prototype additions from other potential libraries
					par += '<param name="' + j + '" value="' + parObj[j] + '" />';
				}
			}
			el.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + att + '>' + par + '</object>';
			fixObjectLeaks(attObj.id); // This bug affects dynamic publishing only
			r = document.getElementById(attObj.id);	
		}
		else if (ua.webkit && ua.webkitVersion < 312) { // Older webkit engines ignore the object element's nested param elements: fall back to the proprietary embed element
			var e = document.createElement("embed");
			e.setAttribute("type", "application/x-shockwave-flash");
			for (var k in attObj) {
				if (attObj[k] != Object.prototype[k]) { // Filter out prototype additions from other potential libraries
					if (k == "data") {
						e.setAttribute("src", attObj[k]);
					}
					else if (k.toLowerCase() == "styleclass") { // 'class' is an ECMA4 reserved keyword
						e.setAttribute("class", attObj[k]);
					}
					else if (k != "classid") { // Filter out IE specific attribute
						e.setAttribute(k, attObj[k]);
					}
				}
			}
			for (var l in parObj) {
				if (parObj[l] != Object.prototype[l]) { // Filter out prototype additions from other potential libraries
					if (l != "movie") { // Filter out IE specific param element
						e.setAttribute(l, parObj[l]);
					}
				}
			}
			el.parentNode.replaceChild(e, el);
			r = e;
		}
		else { // Well-behaving browsers
			var o = document.createElement("object");
			o.setAttribute("type", "application/x-shockwave-flash");
			for (var m in attObj) {
				if (attObj[m] != Object.prototype[m]) { // Filter out prototype additions from other potential libraries
					if (m.toLowerCase() == "styleclass") { // 'class' is an ECMA4 reserved keyword
						o.setAttribute("class", attObj[m]);
					}
					else if (m != "classid") { // Filter out IE specific attribute
						o.setAttribute(m, attObj[m]);
					}
				}
			}
			for (var n in parObj) {
				if (parObj[n] != Object.prototype[n] && n != "movie") { // Filter out prototype additions from other potential libraries and IE specific param element
					createObjParam(o, n, parObj[n]);
				}
			}
			el.parentNode.replaceChild(o, el);
			r = o;
		}
		return r;
	}

	function createObjParam(el, pName, pValue) {
		var p = document.createElement("param");
		p.setAttribute("name", pName);	
		p.setAttribute("value", pValue);
		el.appendChild(p);
	}
	
	function hasPlayerVersion(rv) {
		return (ua.playerVersion[0] > rv[0] || (ua.playerVersion[0] == rv[0] && ua.playerVersion[1] > rv[1]) || (ua.playerVersion[0] == rv[0] && ua.playerVersion[1] == rv[1] && ua.playerVersion[2] >= rv[2])) ? true : false;
	}
	
	/* Cross-browser dynamic CSS creation
		- Based on Bobby van der Sluis' solution: http://www.bobbyvandersluis.com/articles/dynamicCSS.php
	*/	
	function createCSS(sel, decl) {
		if (ua.ie && ua.mac) {
			return;
		}
		var h = document.getElementsByTagName("head")[0]; 
		var s = document.createElement("style");
		s.setAttribute("type", "text/css");
		s.setAttribute("media", "screen");
		if (!(ua.ie && ua.win) && typeof document.createTextNode != "undefined") {
			s.appendChild(document.createTextNode(sel + " {" + decl + "}"));
		}
		h.appendChild(s);
		if (ua.ie && ua.win && typeof document.styleSheets != "undefined" && document.styleSheets.length > 0) {
			var ls = document.styleSheets[document.styleSheets.length - 1];
			if (typeof ls.addRule == "object") {
				ls.addRule(sel, decl);
			}
		}
	}
	
	return {
		/* Public API
			- Reference: http://code.google.com/p/swfobject/wiki/SWFObject_2_0_documentation
		*/ 
		registerObject: function(objectIdStr, swfVersionStr, xiSwfUrlStr) {
			if (!ua.w3cdom || !objectIdStr || !swfVersionStr) {
				return;
			}
			var regObj = {};
			regObj.id = objectIdStr;
			var v = swfVersionStr.split(".");
			regObj.swfVersion = [parseInt(v[0], 10), parseInt(v[1], 10), parseInt(v[2], 10)];
			regObj.expressInstall = xiSwfUrlStr ? xiSwfUrlStr : false;
			regObjArr[regObjArr.length] = regObj;
			createCSS("#" + objectIdStr, "visibility:hidden");
		},
		
		getObjectById: function(objectIdStr) {
			var r = null;
			if (ua.w3cdom && isDomLoaded) {
				var o = document.getElementById(objectIdStr);
				if (o) {
					var n = o.getElementsByTagName("object")[0];
					if (!n || (n && typeof o.SetVariable != "undefined")) {
				    	r = o;
					}
					else if (typeof n.SetVariable != "undefined") {
						r = n;
					}
				}
			}
			return r;
		},
		
		embedSWF: function(swfUrlStr, replaceElemIdStr, widthStr, heightStr, swfVersionStr, xiSwfUrlStr, flashvarsObj, parObj, attObj) {
			if (!ua.w3cdom || !swfUrlStr || !replaceElemIdStr || !widthStr || !heightStr || !swfVersionStr) {
				return;
			}
			widthStr += ""; // Auto-convert to string to make it idiot proof
			heightStr += "";
			if (hasPlayerVersion(swfVersionStr.split("."))) {
				createCSS("#" + replaceElemIdStr, "visibility:hidden");
				var att = (typeof attObj == "object") ? attObj : {};
				att.data = swfUrlStr;
				att.width = widthStr;
				att.height = heightStr;
				var par = (typeof parObj == "object") ? parObj : {};
				if (typeof flashvarsObj == "object") {
					for (var i in flashvarsObj) {
						if (flashvarsObj[i] != Object.prototype[i]) { // Filter out prototype additions from other potential libraries
							if (typeof par.flashvars != "undefined") {
								par.flashvars += "&" + i + "=" + flashvarsObj[i];
							}
							else {
								par.flashvars = i + "=" + flashvarsObj[i];
							}
						}
					}
				}
				addDomLoadEvent(function() {
					createSWF(att, par, replaceElemIdStr);
					createCSS("#" + replaceElemIdStr, "visibility:visible");
				});
			}
			else if (xiSwfUrlStr && !isExpressInstallActive && hasPlayerVersion([6,0,65]) && (ua.win || ua.mac)) {
				createCSS("#" + replaceElemIdStr, "visibility:hidden");
				addDomLoadEvent(function() {
					var regObj = {};
					regObj.id = regObj.altContentId = replaceElemIdStr;
					regObj.width = widthStr;
					regObj.height = heightStr;
					regObj.expressInstall = xiSwfUrlStr;
					showExpressInstall(regObj);
					createCSS("#" + replaceElemIdStr, "visibility:visible");
				});
			}
		},
		
		getFlashPlayerVersion: function() {
			return { major:ua.playerVersion[0], minor:ua.playerVersion[1], release:ua.playerVersion[2] };
		},
		
		hasFlashPlayerVersion: function(versionStr) {
			return hasPlayerVersion(versionStr.split("."));
		},
		
		createSWF: function(attObj, parObj, replaceElemIdStr) {
			if (ua.w3cdom && isDomLoaded) {
				return createSWF(attObj, parObj, replaceElemIdStr);
			}
			else {
				return undefined;
			}
		},
		
		createCSS: function(sel, decl) {
			if (ua.w3cdom) {
				createCSS(sel, decl);
			}
		},
		
		addDomLoadEvent:addDomLoadEvent,
		
		addLoadEvent:addLoadEvent,
		
		getQueryParamValue: function(param) {
			var q = document.location.search || document.location.hash;
			if (param == null) {
				return q;
			}
		 	if(q) {
				var pairs = q.substring(1).split("&");
				for (var i = 0; i < pairs.length; i++) {
					if (pairs[i].substring(0, pairs[i].indexOf("=")) == param) {
						return pairs[i].substring((pairs[i].indexOf("=") + 1));
					}
				}
			}
			return "";
		},
		
		// For internal usage only
		expressInstallCallback: function() {
			if (isExpressInstallActive && storedAltContent) {
				var obj = document.getElementById("SWFObjectExprInst");
				if (obj) {
					obj.parentNode.replaceChild(storedAltContent, obj);
					storedAltContent = null;
					isExpressInstallActive = false;
				}
			} 
		}
		
	};

}();
}