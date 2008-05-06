/* This compressed file is part of Xinha. For uncompressed sources, forum, and bug reports, go to xinha.org */
/* The URL of the most recent version of this file is http://svn.xinha.webfactional.com/trunk/XinhaCore.js */
  /*--------------------------------------------------------------------------
    --  Xinha (is not htmlArea) - http://xinha.org
    --
    --  Use of Xinha is granted by the terms of the htmlArea License (based on
    --  BSD license)  please read license.txt in this package for details.
    --
    --  Copyright (c) 2005-2008 Xinha Developer Team and contributors
    --  
    --  Xinha was originally based on work by Mihai Bazon which is:
    --      Copyright (c) 2003-2004 dynarch.com.
    --      Copyright (c) 2002-2003 interactivetools.com, inc.
    --      This copyright notice MUST stay intact for use.
    -------------------------------------------------------------------------*/

Xinha.version={"Release":"0.95 RC2","Head":"$HeadURL: http://svn.xinha.webfactional.com/branches/0.95_stable/XinhaCore.js $".replace(/^[^:]*: (.*) \$$/,"$1"),"Date":"$LastChangedDate: 2008-02-04 18:28:42 +0100 (Mo, 04 Feb 2008) $".replace(/^[^:]*: ([0-9-]*) ([0-9:]*) ([+0-9]*) \((.*)\) \$/,"$4 $2 $3"),"Revision":"$LastChangedRevision: 955M $".replace(/^[^:]*: (.*) \$$/,"$1"),"RevisionBy":"$LastChangedBy: (lokal) $".replace(/^[^:]*: (.*) \$$/,"$1")};
Xinha._resolveRelativeUrl=function(_1,_2){
if(_2.match(/^([^:]+\:)?\//)){
return _2;
}else{
var b=_1.split("/");
if(b[b.length-1]==""){
b.pop();
}
var p=_2.split("/");
if(p[0]=="."){
p.shift();
}
while(p[0]==".."){
b.pop();
p.shift();
}
return b.join("/")+"/"+p.join("/");
}
};
if(typeof _editor_url=="string"){
_editor_url=_editor_url.replace(/\x2f*$/,"/");
if(!_editor_url.match(/^([^:]+\:)?\//)){
var path=window.location.toString().split("/");
path.pop();
_editor_url=Xinha._resolveRelativeUrl(path.join("/"),_editor_url);
}
}else{
alert("WARNING: _editor_url is not set!  You should set this variable to the editor files path; it should preferably be an absolute path, like in '/htmlarea/', but it can be relative if you prefer.  Further we will try to load the editor files correctly but we'll probably fail.");
_editor_url="";
}
if(typeof _editor_lang=="string"){
_editor_lang=_editor_lang.toLowerCase();
}else{
_editor_lang="en";
}
if(typeof _editor_skin!=="string"){
_editor_skin="";
}
var __xinhas=[];
Xinha.agt=navigator.userAgent.toLowerCase();
Xinha.is_ie=((Xinha.agt.indexOf("msie")!=-1)&&(Xinha.agt.indexOf("opera")==-1));
Xinha.ie_version=parseFloat(Xinha.agt.substring(Xinha.agt.indexOf("msie")+5));
Xinha.is_opera=(Xinha.agt.indexOf("opera")!=-1);
Xinha.opera_version=navigator.appVersion.substring(0,navigator.appVersion.indexOf(" "))*1;
Xinha.is_khtml=(Xinha.agt.indexOf("khtml")!=-1);
Xinha.is_webkit=(Xinha.agt.indexOf("applewebkit")!=-1);
Xinha.is_safari=(Xinha.agt.indexOf("safari")!=-1);
Xinha.is_mac=(Xinha.agt.indexOf("mac")!=-1);
Xinha.is_mac_ie=(Xinha.is_ie&&Xinha.is_mac);
Xinha.is_win_ie=(Xinha.is_ie&&!Xinha.is_mac);
Xinha.is_gecko=(navigator.product=="Gecko");
Xinha.is_real_gecko=(navigator.product=="Gecko"&&!Xinha.is_webkit);
Xinha.isRunLocally=document.URL.toLowerCase().search(/^file:/)!=-1;
Xinha.is_designMode=(typeof document.designMode!="undefined"&&!Xinha.is_ie);
Xinha.checkSupportedBrowser=function(){
if(Xinha.is_opera){
return false;
}
return Xinha.is_gecko||(Xinha.is_opera&&0&&Xinha.opera_version>=9.1)||Xinha.ie_version>=5.5;
};
Xinha.isSupportedBrowser=Xinha.checkSupportedBrowser();
if(Xinha.isRunLocally&&Xinha.isSupportedBrowser){
alert("Xinha *must* be installed on a web server. Locally opened files (those that use the \"file://\" protocol) cannot properly function. Xinha will try to initialize but may not be correctly loaded.");
}
function Xinha(_5,_6){
if(!Xinha.isSupportedBrowser){
return;
}
if(!_5){
throw new Error("Tried to create Xinha without textarea specified.");
}
if(typeof _6=="undefined"){
this.config=new Xinha.Config();
}else{
this.config=_6;
}
if(typeof _5!="object"){
_5=Xinha.getElementById("textarea",_5);
}
this._textArea=_5;
this._textArea.spellcheck=false;
Xinha.freeLater(this,"_textArea");
this._initial_ta_size={w:_5.style.width?_5.style.width:(_5.offsetWidth?(_5.offsetWidth+"px"):(_5.cols+"em")),h:_5.style.height?_5.style.height:(_5.offsetHeight?(_5.offsetHeight+"px"):(_5.rows+"em"))};
if(document.getElementById("loading_"+_5.id)||this.config.showLoading){
if(!document.getElementById("loading_"+_5.id)){
Xinha.createLoadingMessage(_5);
}
this.setLoadingMessage(Xinha._lc("Constructing object"));
}
this._editMode="wysiwyg";
this.plugins={};
this._timerToolbar=null;
this._timerUndo=null;
this._undoQueue=[this.config.undoSteps];
this._undoPos=-1;
this._customUndo=true;
this._mdoc=document;
this.doctype="";
this.__htmlarea_id_num=__xinhas.length;
__xinhas[this.__htmlarea_id_num]=this;
this._notifyListeners={};
var _7={right:{on:true,container:document.createElement("td"),panels:[]},left:{on:true,container:document.createElement("td"),panels:[]},top:{on:true,container:document.createElement("td"),panels:[]},bottom:{on:true,container:document.createElement("td"),panels:[]}};
for(var i in _7){
if(!_7[i].container){
continue;
}
_7[i].div=_7[i].container;
_7[i].container.className="panels "+i;
Xinha.freeLater(_7[i],"container");
Xinha.freeLater(_7[i],"div");
}
this._panels=_7;
this._statusBar=null;
this._statusBarTree=null;
this._statusBarTextMode=null;
this._statusBarItems=[];
this._framework={};
this._htmlArea=null;
this._iframe=null;
this._doc=null;
this._toolBar=this._toolbar=null;
this._toolbarObjects={};
}
Xinha.onload=function(){
};
Xinha.init=function(){
Xinha.onload();
};
Xinha.RE_tagName=/(<\/|<)\s*([^ \t\n>]+)/ig;
Xinha.RE_doctype=/(<!doctype((.|\n)*?)>)\n?/i;
Xinha.RE_head=/<head>((.|\n)*?)<\/head>/i;
Xinha.RE_body=/<body[^>]*>((.|\n|\r|\t)*?)<\/body>/i;
Xinha.RE_Specials=/([\/\^$*+?.()|{}[\]])/g;
Xinha.escapeStringForRegExp=function(_9){
return _9.replace(Xinha.RE_Specials,"\\$1");
};
Xinha.RE_email=/^[_a-z\d\-\.]{3,}@[_a-z\d\-]{2,}(\.[_a-z\d\-]{2,})+$/i;
Xinha.RE_url=/(https?:\/\/)?(([a-z0-9_]+:[a-z0-9_]+@)?[a-z0-9_-]{2,}(\.[a-z0-9_-]{2,}){2,}(:[0-9]+)?(\/\S+)*)/i;
Xinha.Config=function(){
this.version=Xinha.version.Revision;
this.width="auto";
this.height="auto";
this.sizeIncludesBars=true;
this.sizeIncludesPanels=true;
this.panel_dimensions={left:"200px",right:"200px",top:"100px",bottom:"100px"};
this.iframeWidth=null;
this.statusBar=true;
this.htmlareaPaste=false;
this.mozParaHandler="best";
this.getHtmlMethod="DOMwalk";
this.undoSteps=20;
this.undoTimeout=500;
this.changeJustifyWithDirection=false;
this.fullPage=false;
this.pageStyle="";
this.pageStyleSheets=[];
this.baseHref=null;
this.expandRelativeUrl=true;
this.stripBaseHref=true;
this.stripSelfNamedAnchors=true;
this.only7BitPrintablesInURLs=true;
this.sevenBitClean=false;
this.specialReplacements={};
this.killWordOnPaste=true;
this.makeLinkShowsTarget=true;
this.charSet=(typeof document.characterSet!="undefined")?document.characterSet:document.charset;
this.browserQuirksMode=null;
this.imgURL="images/";
this.popupURL="popups/";
this.htmlRemoveTags=null;
this.flowToolbars=true;
this.toolbarAlign="left";
this.showLoading=false;
this.stripScripts=true;
this.convertUrlsToLinks=true;
this.colorPickerCellSize="6px";
this.colorPickerGranularity=18;
this.colorPickerPosition="bottom,right";
this.colorPickerWebSafe=false;
this.colorPickerSaveColors=20;
this.fullScreen=false;
this.fullScreenMargins=[0,0,0,0];
this.toolbar=[["popupeditor"],["separator","formatblock","fontname","fontsize","bold","italic","underline","strikethrough"],["separator","forecolor","hilitecolor","textindicator"],["separator","subscript","superscript"],["linebreak","separator","justifyleft","justifycenter","justifyright","justifyfull"],["separator","insertorderedlist","insertunorderedlist","outdent","indent"],["separator","inserthorizontalrule","createlink","insertimage","inserttable"],["linebreak","separator","undo","redo","selectall","print"],(Xinha.is_gecko?[]:["cut","copy","paste","overwrite","saveas"]),["separator","killword","clearfonts","removeformat","toggleborders","splitblock","lefttoright","righttoleft"],["separator","htmlmode","showhelp","about"]];
this.fontname={"&mdash; font &mdash;":"","Arial":"arial,helvetica,sans-serif","Courier New":"courier new,courier,monospace","Georgia":"georgia,times new roman,times,serif","Tahoma":"tahoma,arial,helvetica,sans-serif","Times New Roman":"times new roman,times,serif","Verdana":"verdana,arial,helvetica,sans-serif","impact":"impact","WingDings":"wingdings"};
this.fontsize={"&mdash; size &mdash;":"","1 (8 pt)":"1","2 (10 pt)":"2","3 (12 pt)":"3","4 (14 pt)":"4","5 (18 pt)":"5","6 (24 pt)":"6","7 (36 pt)":"7"};
this.formatblock={"&mdash; format &mdash;":"","Heading 1":"h1","Heading 2":"h2","Heading 3":"h3","Heading 4":"h4","Heading 5":"h5","Heading 6":"h6","Normal":"p","Address":"address","Formatted":"pre"};
this.customSelects={};
this.debug=true;
this.URIs={"blank":_editor_url+"popups/blank.html","link":_editor_url+"modules/CreateLink/link.html","insert_image":_editor_url+"modules/InsertImage/insert_image.html","insert_table":_editor_url+"modules/InsertTable/insert_table.html","select_color":_editor_url+"popups/select_color.html","about":_editor_url+"popups/about.html","help":_editor_url+"popups/editor_help.html"};
this.btnList={bold:["Bold",Xinha._lc({key:"button_bold",string:["ed_buttons_main.gif",3,2]},"Xinha"),false,function(e){
e.execCommand("bold");
}],italic:["Italic",Xinha._lc({key:"button_italic",string:["ed_buttons_main.gif",2,2]},"Xinha"),false,function(e){
e.execCommand("italic");
}],underline:["Underline",Xinha._lc({key:"button_underline",string:["ed_buttons_main.gif",2,0]},"Xinha"),false,function(e){
e.execCommand("underline");
}],strikethrough:["Strikethrough",Xinha._lc({key:"button_strikethrough",string:["ed_buttons_main.gif",3,0]},"Xinha"),false,function(e){
e.execCommand("strikethrough");
}],subscript:["Subscript",Xinha._lc({key:"button_subscript",string:["ed_buttons_main.gif",3,1]},"Xinha"),false,function(e){
e.execCommand("subscript");
}],superscript:["Superscript",Xinha._lc({key:"button_superscript",string:["ed_buttons_main.gif",2,1]},"Xinha"),false,function(e){
e.execCommand("superscript");
}],justifyleft:["Justify Left",["ed_buttons_main.gif",0,0],false,function(e){
e.execCommand("justifyleft");
}],justifycenter:["Justify Center",["ed_buttons_main.gif",1,1],false,function(e){
e.execCommand("justifycenter");
}],justifyright:["Justify Right",["ed_buttons_main.gif",1,0],false,function(e){
e.execCommand("justifyright");
}],justifyfull:["Justify Full",["ed_buttons_main.gif",0,1],false,function(e){
e.execCommand("justifyfull");
}],orderedlist:["Ordered List",["ed_buttons_main.gif",0,3],false,function(e){
e.execCommand("insertorderedlist");
}],unorderedlist:["Bulleted List",["ed_buttons_main.gif",1,3],false,function(e){
e.execCommand("insertunorderedlist");
}],insertorderedlist:["Ordered List",["ed_buttons_main.gif",0,3],false,function(e){
e.execCommand("insertorderedlist");
}],insertunorderedlist:["Bulleted List",["ed_buttons_main.gif",1,3],false,function(e){
e.execCommand("insertunorderedlist");
}],outdent:["Decrease Indent",["ed_buttons_main.gif",1,2],false,function(e){
e.execCommand("outdent");
}],indent:["Increase Indent",["ed_buttons_main.gif",0,2],false,function(e){
e.execCommand("indent");
}],forecolor:["Font Color",["ed_buttons_main.gif",3,3],false,function(e){
e.execCommand("forecolor");
}],hilitecolor:["Background Color",["ed_buttons_main.gif",2,3],false,function(e){
e.execCommand("hilitecolor");
}],undo:["Undoes your last action",["ed_buttons_main.gif",4,2],false,function(e){
e.execCommand("undo");
}],redo:["Redoes your last action",["ed_buttons_main.gif",5,2],false,function(e){
e.execCommand("redo");
}],cut:["Cut selection",["ed_buttons_main.gif",5,0],false,function(e,cmd){
e.execCommand(cmd);
}],copy:["Copy selection",["ed_buttons_main.gif",4,0],false,function(e,cmd){
e.execCommand(cmd);
}],paste:["Paste from clipboard",["ed_buttons_main.gif",4,1],false,function(e,cmd){
e.execCommand(cmd);
}],selectall:["Select all","ed_selectall.gif",false,function(e){
e.execCommand("selectall");
}],inserthorizontalrule:["Horizontal Rule",["ed_buttons_main.gif",6,0],false,function(e){
e.execCommand("inserthorizontalrule");
}],createlink:["Insert Web Link",["ed_buttons_main.gif",6,1],false,function(e){
e._createLink();
}],insertimage:["Insert/Modify Image",["ed_buttons_main.gif",6,3],false,function(e){
e.execCommand("insertimage");
}],inserttable:["Insert Table",["ed_buttons_main.gif",6,2],false,function(e){
e.execCommand("inserttable");
}],htmlmode:["Toggle HTML Source",["ed_buttons_main.gif",7,0],true,function(e){
e.execCommand("htmlmode");
}],toggleborders:["Toggle Borders",["ed_buttons_main.gif",7,2],false,function(e){
e._toggleBorders();
}],print:["Print document",["ed_buttons_main.gif",8,1],false,function(e){
if(Xinha.is_gecko){
e._iframe.contentWindow.print();
}else{
e.focusEditor();
print();
}
}],saveas:["Save as","ed_saveas.gif",false,function(e){
e.execCommand("saveas",false,"noname.htm");
}],about:["About this editor",["ed_buttons_main.gif",8,2],true,function(e){
e.execCommand("about");
}],showhelp:["Help using editor",["ed_buttons_main.gif",9,2],true,function(e){
e.execCommand("showhelp");
}],splitblock:["Split Block","ed_splitblock.gif",false,function(e){
e._splitBlock();
}],lefttoright:["Direction left to right",["ed_buttons_main.gif",0,4],false,function(e){
e.execCommand("lefttoright");
}],righttoleft:["Direction right to left",["ed_buttons_main.gif",1,4],false,function(e){
e.execCommand("righttoleft");
}],overwrite:["Insert/Overwrite","ed_overwrite.gif",false,function(e){
e.execCommand("overwrite");
}],wordclean:["MS Word Cleaner",["ed_buttons_main.gif",5,3],false,function(e){
e._wordClean();
}],clearfonts:["Clear Inline Font Specifications",["ed_buttons_main.gif",5,4],true,function(e){
e._clearFonts();
}],removeformat:["Remove formatting",["ed_buttons_main.gif",4,4],false,function(e){
e.execCommand("removeformat");
}],killword:["Clear MSOffice tags",["ed_buttons_main.gif",4,3],false,function(e){
e.execCommand("killword");
}]};
for(var i in this.btnList){
var btn=this.btnList[i];
if(typeof btn!="object"){
continue;
}
if(typeof btn[1]!="string"){
btn[1][0]=_editor_url+this.imgURL+btn[1][0];
}else{
btn[1]=_editor_url+this.imgURL+btn[1];
}
btn[0]=Xinha._lc(btn[0]);
}
};
Xinha.Config.prototype.registerButton=function(id,_3a,_3b,_3c,_3d,_3e){
var _3f;
if(typeof id=="string"){
_3f=id;
}else{
if(typeof id=="object"){
_3f=id.id;
}else{
alert("ERROR [Xinha.Config::registerButton]:\ninvalid arguments");
return false;
}
}
switch(typeof id){
case "string":
this.btnList[id]=[_3a,_3b,_3c,_3d,_3e];
break;
case "object":
this.btnList[id.id]=[id.tooltip,id.image,id.textMode,id.action,id.context];
break;
}
};
Xinha.prototype.registerPanel=function(_40,_41){
if(!_40){
_40="right";
}
this.setLoadingMessage("Register "+_40+" panel ");
var _42=this.addPanel(_40);
if(_41){
_41.drawPanelIn(_42);
}
};
Xinha.Config.prototype.registerDropdown=function(_43){
this.customSelects[_43.id]=_43;
};
Xinha.Config.prototype.hideSomeButtons=function(_44){
var _45=this.toolbar;
for(var i=_45.length;--i>=0;){
var _47=_45[i];
for(var j=_47.length;--j>=0;){
if(_44.indexOf(" "+_47[j]+" ")>=0){
var len=1;
if(/separator|space/.test(_47[j+1])){
len=2;
}
_47.splice(j,len);
}
}
}
};
Xinha.Config.prototype.addToolbarElement=function(id,_4b,_4c){
var _4d=this.toolbar;
var a,i,j,o,sid;
var _4f=false;
var _50=false;
var _51=0;
var _52=0;
var _53=0;
var _54=false;
var _55=false;
if((id&&typeof id=="object")&&(id.constructor==Array)){
_4f=true;
}
if((_4b&&typeof _4b=="object")&&(_4b.constructor==Array)){
_50=true;
_51=_4b.length;
}
if(_4f){
for(i=0;i<id.length;++i){
if((id[i]!="separator")&&(id[i].indexOf("T[")!==0)){
sid=id[i];
}
}
}else{
sid=id;
}
for(i=0;i<_4d.length;++i){
a=_4d[i];
for(j=0;j<a.length;++j){
if(a[j]==sid){
return;
}
}
}
for(i=0;!_55&&i<_4d.length;++i){
a=_4d[i];
for(j=0;!_55&&j<a.length;++j){
if(_50){
for(o=0;o<_51;++o){
if(a[j]==_4b[o]){
if(o===0){
_55=true;
j--;
break;
}else{
_53=i;
_52=j;
_51=o;
}
}
}
}else{
if(a[j]==_4b){
_55=true;
break;
}
}
}
}
if(!_55&&_50){
if(_4b.length!=_51){
j=_52;
a=_4d[_53];
_55=true;
}
}
if(_55){
if(_4c===0){
if(_4f){
a[j]=id[id.length-1];
for(i=id.length-1;--i>=0;){
a.splice(j,0,id[i]);
}
}else{
a[j]=id;
}
}else{
if(_4c<0){
j=j+_4c+1;
}else{
if(_4c>0){
j=j+_4c;
}
}
if(_4f){
for(i=id.length;--i>=0;){
a.splice(j,0,id[i]);
}
}else{
a.splice(j,0,id);
}
}
}else{
_4d[0].splice(0,0,"separator");
if(_4f){
for(i=id.length;--i>=0;){
_4d[0].splice(0,0,id[i]);
}
}else{
_4d[0].splice(0,0,id);
}
}
};
Xinha.Config.prototype.removeToolbarElement=Xinha.Config.prototype.hideSomeButtons;
Xinha.replaceAll=function(_56){
var tas=document.getElementsByTagName("textarea");
for(var i=tas.length;i>0;(new Xinha(tas[--i],_56)).generate()){
}
};
Xinha.replace=function(id,_5a){
var ta=Xinha.getElementById("textarea",id);
return ta?(new Xinha(ta,_5a)).generate():null;
};
Xinha.prototype._createToolbar=function(){
this.setLoadingMessage(Xinha._lc("Create Toolbar"));
var _5c=this;
var _5d=document.createElement("div");
this._toolBar=this._toolbar=_5d;
_5d.className="toolbar";
_5d.unselectable="1";
_5d.align=this.config.toolbarAlign;
Xinha.freeLater(this,"_toolBar");
Xinha.freeLater(this,"_toolbar");
var _5e=null;
var _5f={};
this._toolbarObjects=_5f;
this._createToolbar1(_5c,_5d,_5f);
this._htmlArea.appendChild(_5d);
return _5d;
};
Xinha.prototype._setConfig=function(_60){
this.config=_60;
};
Xinha.prototype._addToolbar=function(){
this._createToolbar1(this,this._toolbar,this._toolbarObjects);
};
Xinha._createToolbarBreakingElement=function(){
var brk=document.createElement("div");
brk.style.height="1px";
brk.style.width="1px";
brk.style.lineHeight="1px";
brk.style.fontSize="1px";
brk.style.clear="both";
return brk;
};
Xinha.prototype._createToolbar1=function(_62,_63,_64){
var _65;
if(_62.config.flowToolbars){
_63.appendChild(Xinha._createToolbarBreakingElement());
}
function newLine(){
if(typeof _65!="undefined"&&_65.childNodes.length===0){
return;
}
var _66=document.createElement("table");
_66.border="0px";
_66.cellSpacing="0px";
_66.cellPadding="0px";
if(_62.config.flowToolbars){
if(Xinha.is_ie){
_66.style.styleFloat="left";
}else{
_66.style.cssFloat="left";
}
}
_63.appendChild(_66);
var _67=document.createElement("tbody");
_66.appendChild(_67);
_65=document.createElement("tr");
_67.appendChild(_65);
_66.className="toolbarRow";
}
newLine();
function setButtonStatus(id,_69){
var _6a=this[id];
var el=this.element;
if(_6a!=_69){
switch(id){
case "enabled":
if(_69){
Xinha._removeClass(el,"buttonDisabled");
el.disabled=false;
}else{
Xinha._addClass(el,"buttonDisabled");
el.disabled=true;
}
break;
case "active":
if(_69){
Xinha._addClass(el,"buttonPressed");
}else{
Xinha._removeClass(el,"buttonPressed");
}
break;
}
this[id]=_69;
}
}
function createSelect(txt){
var _6d=null;
var el=null;
var cmd=null;
var _70=_62.config.customSelects;
var _71=null;
var _72="";
switch(txt){
case "fontsize":
case "fontname":
case "formatblock":
_6d=_62.config[txt];
cmd=txt;
break;
default:
cmd=txt;
var _73=_70[cmd];
if(typeof _73!="undefined"){
_6d=_73.options;
_71=_73.context;
if(typeof _73.tooltip!="undefined"){
_72=_73.tooltip;
}
}else{
alert("ERROR [createSelect]:\nCan't find the requested dropdown definition");
}
break;
}
if(_6d){
el=document.createElement("select");
el.title=_72;
var obj={name:txt,element:el,enabled:true,text:false,cmd:cmd,state:setButtonStatus,context:_71};
Xinha.freeLater(obj);
_64[txt]=obj;
for(var i in _6d){
if(typeof (_6d[i])!="string"){
continue;
}
var op=document.createElement("option");
op.innerHTML=Xinha._lc(i);
op.value=_6d[i];
el.appendChild(op);
}
Xinha._addEvent(el,"change",function(){
_62._comboSelected(el,txt);
});
}
return el;
}
function createButton(txt){
var el,btn,obj=null;
switch(txt){
case "separator":
if(_62.config.flowToolbars){
newLine();
}
el=document.createElement("div");
el.className="separator";
break;
case "space":
el=document.createElement("div");
el.className="space";
break;
case "linebreak":
newLine();
return false;
case "textindicator":
el=document.createElement("div");
el.appendChild(document.createTextNode("A"));
el.className="indicator";
el.title=Xinha._lc("Current style");
obj={name:txt,element:el,enabled:true,active:false,text:false,cmd:"textindicator",state:setButtonStatus};
Xinha.freeLater(obj);
_64[txt]=obj;
break;
default:
btn=_62.config.btnList[txt];
}
if(!el&&btn){
el=document.createElement("a");
el.style.display="block";
el.href="javascript:void(0)";
el.style.textDecoration="none";
el.title=btn[0];
el.className="button";
el.style.direction="ltr";
obj={name:txt,element:el,enabled:true,active:false,text:btn[2],cmd:btn[3],state:setButtonStatus,context:btn[4]||null};
Xinha.freeLater(el);
Xinha.freeLater(obj);
_64[txt]=obj;
el.ondrag=function(){
return false;
};
Xinha._addEvent(el,"mouseout",function(ev){
if(obj.enabled){
Xinha._removeClass(el,"buttonActive");
if(obj.active){
Xinha._addClass(el,"buttonPressed");
}
}
});
Xinha._addEvent(el,"mousedown",function(ev){
if(obj.enabled){
Xinha._addClass(el,"buttonActive");
Xinha._removeClass(el,"buttonPressed");
Xinha._stopEvent(Xinha.is_ie?window.event:ev);
}
});
Xinha._addEvent(el,"click",function(ev){
ev=Xinha.is_ie?window.event:ev;
_62.btnClickEvent=ev;
if(obj.enabled){
Xinha._removeClass(el,"buttonActive");
if(Xinha.is_gecko){
_62.activateEditor();
}
obj.cmd(_62,obj.name,obj);
Xinha._stopEvent(ev);
}
});
var _7c=Xinha.makeBtnImg(btn[1]);
var img=_7c.firstChild;
Xinha.freeLater(_7c);
Xinha.freeLater(img);
el.appendChild(_7c);
obj.imgel=img;
obj.swapImage=function(_7e){
if(typeof _7e!="string"){
img.src=_7e[0];
img.style.position="relative";
img.style.top=_7e[2]?("-"+(18*(_7e[2]+1))+"px"):"-18px";
img.style.left=_7e[1]?("-"+(18*(_7e[1]+1))+"px"):"-18px";
}else{
obj.imgel.src=_7e;
img.style.top="0px";
img.style.left="0px";
}
};
}else{
if(!el){
el=createSelect(txt);
}
}
return el;
}
var _7f=true;
for(var i=0;i<this.config.toolbar.length;++i){
if(!_7f){
}else{
_7f=false;
}
if(this.config.toolbar[i]===null){
this.config.toolbar[i]=["separator"];
}
var _81=this.config.toolbar[i];
for(var j=0;j<_81.length;++j){
var _83=_81[j];
var _84;
if(/^([IT])\[(.*?)\]/.test(_83)){
var _85=RegExp.$1=="I";
var _86=RegExp.$2;
if(_85){
_86=Xinha._lc(_86);
}
_84=document.createElement("td");
_65.appendChild(_84);
_84.className="label";
_84.innerHTML=_86;
}else{
if(typeof _83!="function"){
var _87=createButton(_83);
if(_87){
_84=document.createElement("td");
_84.className="toolbarElement";
_65.appendChild(_84);
_84.appendChild(_87);
}else{
if(_87===null){
alert("FIXME: Unknown toolbar item: "+_83);
}
}
}
}
}
}
if(_62.config.flowToolbars){
_63.appendChild(Xinha._createToolbarBreakingElement());
}
return _63;
};
var use_clone_img=false;
Xinha.makeBtnImg=function(_88,doc){
if(!doc){
doc=document;
}
if(!doc._xinhaImgCache){
doc._xinhaImgCache={};
Xinha.freeLater(doc._xinhaImgCache);
}
var _8a=null;
if(Xinha.is_ie&&((!doc.compatMode)||(doc.compatMode&&doc.compatMode=="BackCompat"))){
_8a=doc.createElement("span");
}else{
_8a=doc.createElement("div");
_8a.style.position="relative";
}
_8a.style.overflow="hidden";
_8a.style.width="18px";
_8a.style.height="18px";
_8a.className="buttonImageContainer";
var img=null;
if(typeof _88=="string"){
if(doc._xinhaImgCache[_88]){
img=doc._xinhaImgCache[_88].cloneNode();
}else{
img=doc.createElement("img");
img.src=_88;
img.style.width="18px";
img.style.height="18px";
if(use_clone_img){
doc._xinhaImgCache[_88]=img.cloneNode();
}
}
}else{
if(doc._xinhaImgCache[_88[0]]){
img=doc._xinhaImgCache[_88[0]].cloneNode();
}else{
img=doc.createElement("img");
img.src=_88[0];
img.style.position="relative";
if(use_clone_img){
doc._xinhaImgCache[_88[0]]=img.cloneNode();
}
}
img.style.top=_88[2]?("-"+(18*(_88[2]+1))+"px"):"-18px";
img.style.left=_88[1]?("-"+(18*(_88[1]+1))+"px"):"-18px";
}
_8a.appendChild(img);
return _8a;
};
Xinha.prototype._createStatusBar=function(){
this.setLoadingMessage(Xinha._lc("Create Statusbar"));
var _8c=document.createElement("div");
_8c.className="statusBar";
this._statusBar=_8c;
Xinha.freeLater(this,"_statusBar");
var div=document.createElement("span");
div.className="statusBarTree";
div.innerHTML=Xinha._lc("Path")+": ";
this._statusBarTree=div;
Xinha.freeLater(this,"_statusBarTree");
this._statusBar.appendChild(div);
div=document.createElement("span");
div.innerHTML=Xinha._lc("You are in TEXT MODE.  Use the [<>] button to switch back to WYSIWYG.");
div.style.display="none";
this._statusBarTextMode=div;
Xinha.freeLater(this,"_statusBarTextMode");
this._statusBar.appendChild(div);
if(!this.config.statusBar){
_8c.style.display="none";
}
return _8c;
};
Xinha.prototype.generate=function(){
if(!Xinha.isSupportedBrowser){
return;
}
var i;
var _8f=this;
var url;
var _91=false;
var _92=document.getElementsByTagName("link");
if(!document.getElementById("XinhaCoreDesign")){
_editor_css=(typeof _editor_css=="string")?_editor_css:"Xinha.css";
for(i=0;i<_92.length;i++){
if((_92[i].rel=="stylesheet")&&(_92[i].href==_editor_url+_editor_css)){
_91=true;
}
}
if(!_91){
Xinha.loadStyle(_editor_css,null,"XinhaCoreDesign",true);
}
}
if(_editor_skin!==""&&!document.getElementById("XinhaSkin")){
_91=false;
for(i=0;i<_92.length;i++){
if((_92[i].rel=="stylesheet")&&(_92[i].href==_editor_url+"skins/"+_editor_skin+"/skin.css")){
_91=true;
}
}
if(!_91){
Xinha.loadStyle("skins/"+_editor_skin+"/skin.css",null,"XinhaSkin");
}
}
if(Xinha.is_ie){
url=_editor_url+"modules/InternetExplorer/InternetExplorer.js";
if(!Xinha.loadPlugins(["InternetExplorer"],function(){
_8f.generate();
},url)){
return false;
}
_8f._browserSpecificPlugin=_8f.registerPlugin("InternetExplorer");
}else{
if(Xinha.is_webkit){
url=_editor_url+"modules/WebKit/WebKit.js";
if(!Xinha.loadPlugins(["WebKit"],function(){
_8f.generate();
},url)){
return false;
}
_8f._browserSpecificPlugin=_8f.registerPlugin("WebKit");
}else{
if(Xinha.is_gecko){
url=_editor_url+"modules/Gecko/Gecko.js";
if(!Xinha.loadPlugins(["Gecko"],function(){
_8f.generate();
},url)){
return false;
}
_8f._browserSpecificPlugin=_8f.registerPlugin("Gecko");
}
}
}
if(typeof Dialog=="undefined"&&!Xinha._loadback(_editor_url+"modules/Dialogs/dialog.js",this.generate,this)){
return false;
}
if(typeof Xinha.Dialog=="undefined"&&!Xinha._loadback(_editor_url+"modules/Dialogs/inline-dialog.js",this.generate,this)){
return false;
}
url=_editor_url+"modules/FullScreen/full-screen.js";
if(!Xinha.loadPlugins(["FullScreen"],function(){
_8f.generate();
},url)){
return false;
}
url=_editor_url+"modules/ColorPicker/ColorPicker.js";
if(!Xinha.loadPlugins(["ColorPicker"],function(){
_8f.generate();
},url)){
return false;
}else{
if(typeof ColorPicker!="undefined"){
_8f.registerPlugin("ColorPicker");
}
}
var _93=_8f.config.toolbar;
for(i=_93.length;--i>=0;){
for(var j=_93[i].length;--j>=0;){
switch(_93[i][j]){
case "popupeditor":
_8f.registerPlugin("FullScreen");
break;
case "insertimage":
url=_editor_url+"modules/InsertImage/insert_image.js";
if(typeof Xinha.prototype._insertImage=="undefined"&&!Xinha.loadPlugins(["InsertImage"],function(){
_8f.generate();
},url)){
return false;
}else{
if(typeof InsertImage!="undefined"){
_8f.registerPlugin("InsertImage");
}
}
break;
case "createlink":
url=_editor_url+"modules/CreateLink/link.js";
if(typeof Linker=="undefined"&&!Xinha.loadPlugins(["CreateLink"],function(){
_8f.generate();
},url)){
return false;
}else{
if(typeof CreateLink!="undefined"){
_8f.registerPlugin("CreateLink");
}
}
break;
case "inserttable":
url=_editor_url+"modules/InsertTable/insert_table.js";
if(!Xinha.loadPlugins(["InsertTable"],function(){
_8f.generate();
},url)){
return false;
}else{
if(typeof InsertTable!="undefined"){
_8f.registerPlugin("InsertTable");
}
}
break;
}
}
}
if(Xinha.is_gecko&&_8f.config.mozParaHandler!="built-in"){
if(!Xinha.loadPlugins(["EnterParagraphs"],function(){
_8f.generate();
},_editor_url+"modules/Gecko/paraHandlerBest.js")){
return false;
}
_8f.registerPlugin("EnterParagraphs");
}
switch(this.config.getHtmlMethod){
case "TransformInnerHTML":
var _95=_editor_url+"modules/GetHtml/TransformInnerHTML.js";
break;
default:
var _95=_editor_url+"modules/GetHtml/DOMwalk.js";
break;
}
if(!Xinha.loadPlugins(["GetHtmlImplementation"],function(){
_8f.generate();
},_95)){
return false;
}else{
_8f.registerPlugin("GetHtmlImplementation");
}
this.setLoadingMessage(Xinha._lc("Generate Xinha framework"));
this._framework={"table":document.createElement("table"),"tbody":document.createElement("tbody"),"tb_row":document.createElement("tr"),"tb_cell":document.createElement("td"),"tp_row":document.createElement("tr"),"tp_cell":this._panels.top.container,"ler_row":document.createElement("tr"),"lp_cell":this._panels.left.container,"ed_cell":document.createElement("td"),"rp_cell":this._panels.right.container,"bp_row":document.createElement("tr"),"bp_cell":this._panels.bottom.container,"sb_row":document.createElement("tr"),"sb_cell":document.createElement("td")};
Xinha.freeLater(this._framework);
var fw=this._framework;
fw.table.border="0";
fw.table.cellPadding="0";
fw.table.cellSpacing="0";
fw.tb_row.style.verticalAlign="top";
fw.tp_row.style.verticalAlign="top";
fw.ler_row.style.verticalAlign="top";
fw.bp_row.style.verticalAlign="top";
fw.sb_row.style.verticalAlign="top";
fw.ed_cell.style.position="relative";
fw.tb_row.appendChild(fw.tb_cell);
fw.tb_cell.colSpan=3;
fw.tp_row.appendChild(fw.tp_cell);
fw.tp_cell.colSpan=3;
fw.ler_row.appendChild(fw.lp_cell);
fw.ler_row.appendChild(fw.ed_cell);
fw.ler_row.appendChild(fw.rp_cell);
fw.bp_row.appendChild(fw.bp_cell);
fw.bp_cell.colSpan=3;
fw.sb_row.appendChild(fw.sb_cell);
fw.sb_cell.colSpan=3;
fw.tbody.appendChild(fw.tb_row);
fw.tbody.appendChild(fw.tp_row);
fw.tbody.appendChild(fw.ler_row);
fw.tbody.appendChild(fw.bp_row);
fw.tbody.appendChild(fw.sb_row);
fw.table.appendChild(fw.tbody);
var _97=this._framework.table;
this._htmlArea=_97;
Xinha.freeLater(this,"_htmlArea");
_97.className="htmlarea";
this._framework.tb_cell.appendChild(this._createToolbar());
var _98=document.createElement("iframe");
_98.src=this.popupURL(_8f.config.URIs.blank);
_98.id="XinhaIFrame_"+this._textArea.id;
this._framework.ed_cell.appendChild(_98);
this._iframe=_98;
this._iframe.className="xinha_iframe";
Xinha.freeLater(this,"_iframe");
var _99=this._createStatusBar();
this._framework.sb_cell.appendChild(_99);
var _9a=this._textArea;
_9a.parentNode.insertBefore(_97,_9a);
_9a.className="xinha_textarea";
Xinha.removeFromParent(_9a);
this._framework.ed_cell.appendChild(_9a);
Xinha.addDom0Event(this._textArea,"click",function(){
if(Xinha._currentlyActiveEditor!=this){
_8f.updateToolbar();
}
return true;
});
if(_9a.form){
Xinha.prependDom0Event(this._textArea.form,"submit",function(){
_8f.firePluginEvent("onBeforeSubmit");
_8f._textArea.value=_8f.outwardHtml(_8f.getHTML());
return true;
});
var _9b=_9a.value;
Xinha.prependDom0Event(this._textArea.form,"reset",function(){
_8f.setHTML(_8f.inwardHtml(_9b));
_8f.updateToolbar();
return true;
});
if(!_9a.form.xinha_submit){
try{
_9a.form.xinha_submit=_9a.form.submit;
_9a.form.submit=function(){
this.onsubmit();
this.xinha_submit();
};
}
catch(ex){
}
}
}
Xinha.prependDom0Event(window,"unload",function(){
_8f.firePluginEvent("onBeforeUnload");
_9a.value=_8f.outwardHtml(_8f.getHTML());
if(!Xinha.is_ie){
_97.parentNode.replaceChild(_9a,_97);
}
return true;
});
_9a.style.display="none";
_8f.initSize();
this.setLoadingMessage(Xinha._lc("Finishing"));
_8f._iframeLoadDone=false;
if(Xinha.is_opera){
Xinha._addEvent(this._iframe.contentWindow,"load",function(e){
if(!_8f._iframeLoadDone){
_8f._iframeLoadDone=true;
_8f.initIframe();
}
return true;
});
}else{
Xinha._addEvent(this._iframe,"load",function(e){
if(!_8f._iframeLoadDone){
_8f._iframeLoadDone=true;
_8f.initIframe();
}
return true;
});
}
};
Xinha.prototype.initSize=function(){
this.setLoadingMessage(Xinha._lc("Init editor size"));
var _9e=this;
var _9f=null;
var _a0=null;
switch(this.config.width){
case "auto":
_9f=this._initial_ta_size.w;
break;
case "toolbar":
_9f=this._toolBar.offsetWidth+"px";
break;
default:
_9f=/[^0-9]/.test(this.config.width)?this.config.width:this.config.width+"px";
break;
}
switch(this.config.height){
case "auto":
_a0=this._initial_ta_size.h;
break;
default:
_a0=/[^0-9]/.test(this.config.height)?this.config.height:this.config.height+"px";
break;
}
this.sizeEditor(_9f,_a0,this.config.sizeIncludesBars,this.config.sizeIncludesPanels);
this.notifyOn("panel_change",function(){
_9e.sizeEditor();
});
};
Xinha.prototype.sizeEditor=function(_a1,_a2,_a3,_a4){
if(this._risizing){
return;
}
this._risizing=true;
this.notifyOf("before_resize",{width:_a1,height:_a2});
this.firePluginEvent("onBeforeResize",_a1,_a2);
this._iframe.style.height="100%";
this._textArea.style.height="100%";
this._iframe.style.width="";
this._textArea.style.width="";
if(_a3!==null){
this._htmlArea.sizeIncludesToolbars=_a3;
}
if(_a4!==null){
this._htmlArea.sizeIncludesPanels=_a4;
}
if(_a1){
this._htmlArea.style.width=_a1;
if(!this._htmlArea.sizeIncludesPanels){
var _a5=this._panels.right;
if(_a5.on&&_a5.panels.length&&Xinha.hasDisplayedChildren(_a5.div)){
this._htmlArea.style.width=(this._htmlArea.offsetWidth+parseInt(this.config.panel_dimensions.right,10))+"px";
}
var _a6=this._panels.left;
if(_a6.on&&_a6.panels.length&&Xinha.hasDisplayedChildren(_a6.div)){
this._htmlArea.style.width=(this._htmlArea.offsetWidth+parseInt(this.config.panel_dimensions.left,10))+"px";
}
}
}
if(_a2){
this._htmlArea.style.height=_a2;
if(!this._htmlArea.sizeIncludesToolbars){
this._htmlArea.style.height=(this._htmlArea.offsetHeight+this._toolbar.offsetHeight+this._statusBar.offsetHeight)+"px";
}
if(!this._htmlArea.sizeIncludesPanels){
var _a7=this._panels.top;
if(_a7.on&&_a7.panels.length&&Xinha.hasDisplayedChildren(_a7.div)){
this._htmlArea.style.height=(this._htmlArea.offsetHeight+parseInt(this.config.panel_dimensions.top,10))+"px";
}
var _a8=this._panels.bottom;
if(_a8.on&&_a8.panels.length&&Xinha.hasDisplayedChildren(_a8.div)){
this._htmlArea.style.height=(this._htmlArea.offsetHeight+parseInt(this.config.panel_dimensions.bottom,10))+"px";
}
}
}
_a1=this._htmlArea.offsetWidth;
_a2=this._htmlArea.offsetHeight;
var _a9=this._panels;
var _aa=this;
var _ab=1;
function panel_is_alive(pan){
if(_a9[pan].on&&_a9[pan].panels.length&&Xinha.hasDisplayedChildren(_a9[pan].container)){
_a9[pan].container.style.display="";
return true;
}else{
_a9[pan].container.style.display="none";
return false;
}
}
if(panel_is_alive("left")){
_ab+=1;
}
if(panel_is_alive("right")){
_ab+=1;
}
this._framework.tb_cell.colSpan=_ab;
this._framework.tp_cell.colSpan=_ab;
this._framework.bp_cell.colSpan=_ab;
this._framework.sb_cell.colSpan=_ab;
if(!this._framework.tp_row.childNodes.length){
Xinha.removeFromParent(this._framework.tp_row);
}else{
if(!Xinha.hasParentNode(this._framework.tp_row)){
this._framework.tbody.insertBefore(this._framework.tp_row,this._framework.ler_row);
}
}
if(!this._framework.bp_row.childNodes.length){
Xinha.removeFromParent(this._framework.bp_row);
}else{
if(!Xinha.hasParentNode(this._framework.bp_row)){
this._framework.tbody.insertBefore(this._framework.bp_row,this._framework.ler_row.nextSibling);
}
}
if(!this.config.statusBar){
Xinha.removeFromParent(this._framework.sb_row);
}else{
if(!Xinha.hasParentNode(this._framework.sb_row)){
this._framework.table.appendChild(this._framework.sb_row);
}
}
this._framework.lp_cell.style.width=this.config.panel_dimensions.left;
this._framework.rp_cell.style.width=this.config.panel_dimensions.right;
this._framework.tp_cell.style.height=this.config.panel_dimensions.top;
this._framework.bp_cell.style.height=this.config.panel_dimensions.bottom;
this._framework.tb_cell.style.height=this._toolBar.offsetHeight+"px";
this._framework.sb_cell.style.height=this._statusBar.offsetHeight+"px";
var _ad=_a2-this._toolBar.offsetHeight-this._statusBar.offsetHeight;
if(panel_is_alive("top")){
_ad-=parseInt(this.config.panel_dimensions.top,10);
}
if(panel_is_alive("bottom")){
_ad-=parseInt(this.config.panel_dimensions.bottom,10);
}
this._iframe.style.height=_ad+"px";
var _ae=_a1;
if(panel_is_alive("left")){
_ae-=parseInt(this.config.panel_dimensions.left,10);
}
if(panel_is_alive("right")){
_ae-=parseInt(this.config.panel_dimensions.right,10);
}
var _af=(this.config.iframeWidth)?parseInt(this.config.iframeWidth,10):null;
this._iframe.style.width=(_af&&_af<_ae)?_af+"px":_ae+"px";
this._textArea.style.height=this._iframe.style.height;
this._textArea.style.width=this._iframe.style.width;
this.notifyOf("resize",{width:this._htmlArea.offsetWidth,height:this._htmlArea.offsetHeight});
this.firePluginEvent("onResize",this._htmlArea.offsetWidth,this._htmlArea.offsetWidth);
this._risizing=false;
};
Xinha.prototype.registerPanel=function(_b0,_b1){
if(!_b0){
_b0="right";
}
this.setLoadingMessage("Register "+_b0+" panel ");
var _b2=this.addPanel(_b0);
if(_b1){
_b1.drawPanelIn(_b2);
}
};
Xinha.prototype.addPanel=function(_b3){
var div=document.createElement("div");
div.side=_b3;
if(_b3=="left"||_b3=="right"){
div.style.width=this.config.panel_dimensions[_b3];
if(this._iframe){
div.style.height=this._iframe.style.height;
}
}
Xinha.addClasses(div,"panel");
this._panels[_b3].panels.push(div);
this._panels[_b3].div.appendChild(div);
this.notifyOf("panel_change",{"action":"add","panel":div});
this.firePluginEvent("onPanelChange","add",div);
return div;
};
Xinha.prototype.removePanel=function(_b5){
this._panels[_b5.side].div.removeChild(_b5);
var _b6=[];
for(var i=0;i<this._panels[_b5.side].panels.length;i++){
if(this._panels[_b5.side].panels[i]!=_b5){
_b6.push(this._panels[_b5.side].panels[i]);
}
}
this._panels[_b5.side].panels=_b6;
this.notifyOf("panel_change",{"action":"remove","panel":_b5});
this.firePluginEvent("onPanelChange","remove",_b5);
};
Xinha.prototype.hidePanel=function(_b8){
if(_b8&&_b8.style.display!="none"){
try{
var pos=this.scrollPos(this._iframe.contentWindow);
}
catch(e){
}
_b8.style.display="none";
this.notifyOf("panel_change",{"action":"hide","panel":_b8});
this.firePluginEvent("onPanelChange","hide",_b8);
try{
this._iframe.contentWindow.scrollTo(pos.x,pos.y);
}
catch(e){
}
}
};
Xinha.prototype.showPanel=function(_ba){
if(_ba&&_ba.style.display=="none"){
try{
var pos=this.scrollPos(this._iframe.contentWindow);
}
catch(e){
}
_ba.style.display="";
this.notifyOf("panel_change",{"action":"show","panel":_ba});
this.firePluginEvent("onPanelChange","show",_ba);
try{
this._iframe.contentWindow.scrollTo(pos.x,pos.y);
}
catch(e){
}
}
};
Xinha.prototype.hidePanels=function(_bc){
if(typeof _bc=="undefined"){
_bc=["left","right","top","bottom"];
}
var _bd=[];
for(var i=0;i<_bc.length;i++){
if(this._panels[_bc[i]].on){
_bd.push(_bc[i]);
this._panels[_bc[i]].on=false;
}
}
this.notifyOf("panel_change",{"action":"multi_hide","sides":_bc});
this.firePluginEvent("onPanelChange","multi_hide",_bc);
};
Xinha.prototype.showPanels=function(_bf){
if(typeof _bf=="undefined"){
_bf=["left","right","top","bottom"];
}
var _c0=[];
for(var i=0;i<_bf.length;i++){
if(!this._panels[_bf[i]].on){
_c0.push(_bf[i]);
this._panels[_bf[i]].on=true;
}
}
this.notifyOf("panel_change",{"action":"multi_show","sides":_bf});
this.firePluginEvent("onPanelChange","multi_show",_bf);
};
Xinha.objectProperties=function(obj){
var _c3=[];
for(var x in obj){
_c3[_c3.length]=x;
}
return _c3;
};
Xinha.prototype.editorIsActivated=function(){
try{
return Xinha.is_designMode?this._doc.designMode=="on":this._doc.body.contentEditable;
}
catch(ex){
return false;
}
};
Xinha._someEditorHasBeenActivated=false;
Xinha._currentlyActiveEditor=null;
Xinha.prototype.activateEditor=function(){
if(Xinha._currentlyActiveEditor){
if(Xinha._currentlyActiveEditor==this){
return true;
}
Xinha._currentlyActiveEditor.deactivateEditor();
}
if(Xinha.is_designMode&&this._doc.designMode!="on"){
try{
if(this._iframe.style.display=="none"){
this._iframe.style.display="";
this._doc.designMode="on";
this._iframe.style.display="none";
}else{
this._doc.designMode="on";
}
}
catch(ex){
}
}else{
if(Xinha.is_ie&&this._doc.body.contentEditable!==true){
this._doc.body.contentEditable=true;
}
}
Xinha._someEditorHasBeenActivated=true;
Xinha._currentlyActiveEditor=this;
var _c5=this;
this.enableToolbar();
};
Xinha.prototype.deactivateEditor=function(){
this.disableToolbar();
if(Xinha.is_designMode&&this._doc.designMode!="off"){
try{
this._doc.designMode="off";
}
catch(ex){
}
}else{
if(!Xinha.is_designMode&&this._doc.body.contentEditable!==false){
this._doc.body.contentEditable=false;
}
}
if(Xinha._currentlyActiveEditor!=this){
return;
}
Xinha._currentlyActiveEditor=false;
};
Xinha.prototype.initIframe=function(){
this.disableToolbar();
var doc=null;
var _c7=this;
try{
if(_c7._iframe.contentDocument){
this._doc=_c7._iframe.contentDocument;
}else{
this._doc=_c7._iframe.contentWindow.document;
}
doc=this._doc;
if(!doc){
if(Xinha.is_gecko){
setTimeout(function(){
_c7.initIframe();
},50);
return false;
}else{
alert("ERROR: IFRAME can't be initialized.");
}
}
}
catch(ex){
setTimeout(function(){
_c7.initIframe();
},50);
}
Xinha.freeLater(this,"_doc");
doc.open("text/html","replace");
var _c8="";
if(_c7.config.browserQuirksMode===false){
var _c9="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
}else{
if(_c7.config.browserQuirksMode===true){
var _c9="";
}else{
var _c9=Xinha.getDoctype(document);
}
}
if(!_c7.config.fullPage){
_c8+=_c9+"\n";
_c8+="<html>\n";
_c8+="<head>\n";
_c8+="<meta http-equiv=\"Content-Type\" content=\"text/html; charset="+_c7.config.charSet+"\">\n";
if(typeof _c7.config.baseHref!="undefined"&&_c7.config.baseHref!==null){
_c8+="<base href=\""+_c7.config.baseHref+"\"/>\n";
}
_c8+=Xinha.addCoreCSS();
if(typeof _c7.config.pageStyleSheets!=="undefined"){
for(var i=0;i<_c7.config.pageStyleSheets.length;i++){
if(_c7.config.pageStyleSheets[i].length>0){
_c8+="<link rel=\"stylesheet\" type=\"text/css\" href=\""+_c7.config.pageStyleSheets[i]+"\">";
}
}
}
if(_c7.config.pageStyle){
_c8+="<style type=\"text/css\">\n"+_c7.config.pageStyle+"\n</style>";
}
_c8+="</head>\n";
_c8+="<body"+(_c7.config.bodyID?(" id=\""+_c7.config.bodyID+"\""):"")+">\n";
_c8+=_c7.inwardHtml(_c7._textArea.value);
_c8+="</body>\n";
_c8+="</html>";
}else{
_c8=_c7.inwardHtml(_c7._textArea.value);
if(_c8.match(Xinha.RE_doctype)){
_c7.setDoctype(RegExp.$1);
}
var _cb=_c8.match(/<link\s+[\s\S]*?["']\s*\/?>/gi);
_c8=_c8.replace(/<link\s+[\s\S]*?["']\s*\/?>\s*/gi,"");
_cb?_c8=_c8.replace(/<\/head>/i,_cb.join("\n")+"\n</head>"):null;
}
doc.write(_c8);
doc.close();
if(this.config.fullScreen){
this._fullScreen();
}
this.setEditorEvents();
};
Xinha.prototype.whenDocReady=function(f){
var e=this;
if(this._doc&&this._doc.body){
f();
}else{
setTimeout(function(){
e.whenDocReady(f);
},50);
}
};
Xinha.prototype.setMode=function(_ce){
var _cf;
if(typeof _ce=="undefined"){
_ce=this._editMode=="textmode"?"wysiwyg":"textmode";
}
switch(_ce){
case "textmode":
this.firePluginEvent("onBeforeMode","textmode");
this.setCC("iframe");
_cf=this.outwardHtml(this.getHTML());
this.setHTML(_cf);
this.deactivateEditor();
this._iframe.style.display="none";
this._textArea.style.display="";
if(this.config.statusBar){
this._statusBarTree.style.display="none";
this._statusBarTextMode.style.display="";
}
this.findCC("textarea");
this.notifyOf("modechange",{"mode":"text"});
this.firePluginEvent("onMode","textmode");
break;
case "wysiwyg":
this.firePluginEvent("onBeforeMode","wysiwyg");
this.setCC("textarea");
_cf=this.inwardHtml(this.getHTML());
this.deactivateEditor();
this.setHTML(_cf);
this._iframe.style.display="";
this._textArea.style.display="none";
this.activateEditor();
if(this.config.statusBar){
this._statusBarTree.style.display="";
this._statusBarTextMode.style.display="none";
}
this.findCC("iframe");
this.notifyOf("modechange",{"mode":"wysiwyg"});
this.firePluginEvent("onMode","wysiwyg");
break;
default:
alert("Mode <"+_ce+"> not defined!");
return false;
}
this._editMode=_ce;
};
Xinha.prototype.setFullHTML=function(_d0){
var _d1=RegExp.multiline;
RegExp.multiline=true;
if(_d0.match(Xinha.RE_doctype)){
this.setDoctype(RegExp.$1);
}
RegExp.multiline=_d1;
if(0){
if(_d0.match(Xinha.RE_head)){
this._doc.getElementsByTagName("head")[0].innerHTML=RegExp.$1;
}
if(_d0.match(Xinha.RE_body)){
this._doc.getElementsByTagName("body")[0].innerHTML=RegExp.$1;
}
}else{
var _d2=this.editorIsActivated();
if(_d2){
this.deactivateEditor();
}
var _d3=/<html>((.|\n)*?)<\/html>/i;
_d0=_d0.replace(_d3,"$1");
this._doc.open("text/html","replace");
this._doc.write(_d0);
this._doc.close();
if(_d2){
this.activateEditor();
}
this.setEditorEvents();
return true;
}
};
Xinha.prototype.setEditorEvents=function(){
var _d4=this;
var doc=this._doc;
_d4.whenDocReady(function(){
Xinha._addEvents(doc,["mousedown"],function(){
_d4.activateEditor();
return true;
});
if(Xinha.is_ie){
Xinha._addEvent(_d4._doc.getElementsByTagName("html")[0],"click",function(){
if(_d4._iframe.contentWindow.event.srcElement.tagName.toLowerCase()=="html"){
var r=_d4._doc.body.createTextRange();
r.collapse();
r.select();
}
return true;
});
}
Xinha._addEvents(doc,["keydown","keypress","mousedown","mouseup","drag"],function(_d7){
return _d4._editorEvent(Xinha.is_ie?_d4._iframe.contentWindow.event:_d7);
});
for(var i in _d4.plugins){
var _d9=_d4.plugins[i].instance;
Xinha.refreshPlugin(_d9);
}
if(typeof _d4._onGenerate=="function"){
_d4._onGenerate();
}
Xinha.addDom0Event(window,"resize",function(e){
_d4.sizeEditor();
});
_d4.removeLoadingMessage();
});
};
Xinha.prototype.registerPlugin=function(){
if(!Xinha.isSupportedBrowser){
return;
}
var _db=arguments[0];
if(_db===null||typeof _db=="undefined"||(typeof _db=="string"&&typeof window[_db]=="undefined")){
return false;
}
var _dc=[];
for(var i=1;i<arguments.length;++i){
_dc.push(arguments[i]);
}
return this.registerPlugin2(_db,_dc);
};
Xinha.prototype.registerPlugin2=function(_de,_df){
if(typeof _de=="string"&&typeof window[_de]=="function"){
_de=window[_de];
}
if(typeof _de=="undefined"){
return false;
}
var obj=new _de(this,_df);
if(obj){
var _e1={};
var _e2=_de._pluginInfo;
for(var i in _e2){
_e1[i]=_e2[i];
}
_e1.instance=obj;
_e1.args=_df;
this.plugins[_de._pluginInfo.name]=_e1;
return obj;
}else{
alert("Can't register plugin "+_de.toString()+".");
}
};
Xinha.getPluginDir=function(_e4){
return _editor_url+"plugins/"+_e4;
};
Xinha.loadPlugin=function(_e5,_e6,_e7){
if(!Xinha.isSupportedBrowser){
return;
}
Xinha.setLoadingMessage(Xinha._lc("Loading plugin $plugin="+_e5+"$"));
if(typeof window["pluginName"]!="undefined"){
if(_e6){
_e6(_e5);
}
return true;
}
if(!_e7){
var dir=this.getPluginDir(_e5);
var _e9=_e5.replace(/([a-z])([A-Z])([a-z])/g,function(str,l1,l2,l3){
return l1+"-"+l2.toLowerCase()+l3;
}).toLowerCase()+".js";
_e7=dir+"/"+_e9;
}
Xinha._loadback(_e7,_e6?function(){
_e6(_e5);
}:null);
return false;
};
Xinha._pluginLoadStatus={};
Xinha.loadPlugins=function(_ee,_ef,url){
if(!Xinha.isSupportedBrowser){
return;
}
Xinha.setLoadingMessage(Xinha._lc("Loading plugins"));
var _f1=true;
var _f2=Xinha.cloneObject(_ee);
while(_f2.length){
var p=_f2.pop();
if(p=="FullScreen"&&!url){
continue;
}
if(typeof Xinha._pluginLoadStatus[p]=="undefined"){
Xinha._pluginLoadStatus[p]="loading";
Xinha.loadPlugin(p,function(_f4){
if(typeof window[_f4]!="undefined"){
Xinha._pluginLoadStatus[_f4]="ready";
}else{
Xinha._pluginLoadStatus[_f4]="failed";
}
},url);
_f1=false;
}else{
switch(Xinha._pluginLoadStatus[p]){
case "failed":
case "ready":
break;
default:
_f1=false;
break;
}
}
}
if(_f1){
return true;
}
if(_ef){
setTimeout(function(){
if(Xinha.loadPlugins(_ee,_ef)){
_ef();
}
},150);
}
return _f1;
};
Xinha.refreshPlugin=function(_f5){
if(_f5&&typeof _f5.onGenerate=="function"){
_f5.onGenerate();
}
if(_f5&&typeof _f5.onGenerateOnce=="function"){
_f5.onGenerateOnce();
_f5.onGenerateOnce=null;
}
};
Xinha.prototype.firePluginEvent=function(_f6){
var _f7=[];
for(var i=1;i<arguments.length;i++){
_f7[i-1]=arguments[i];
}
for(var i in this.plugins){
var _f9=this.plugins[i].instance;
if(_f9==this._browserSpecificPlugin){
continue;
}
if(_f9&&typeof _f9[_f6]=="function"){
if(_f9[_f6].apply(_f9,_f7)){
return true;
}
}
}
var _f9=this._browserSpecificPlugin;
if(_f9&&typeof _f9[_f6]=="function"){
if(_f9[_f6].apply(_f9,_f7)){
return true;
}
}
return false;
};
Xinha.loadStyle=function(_fa,_fb,id,_fd){
var url=_editor_url||"";
if(_fb){
url=Xinha.getPluginDir(_fb)+"/";
}
url+=_fa;
if(/^\//.test(_fa)){
url=_fa;
}
var _ff=document.getElementsByTagName("head")[0];
var link=document.createElement("link");
link.rel="stylesheet";
link.href=url;
link.type="text/css";
if(id){
link.id=id;
}
if(_fd&&_ff.getElementsByTagName("link")[0]){
_ff.insertBefore(link,_ff.getElementsByTagName("link")[0]);
}else{
_ff.appendChild(link);
}
};
Xinha.prototype.debugTree=function(){
var ta=document.createElement("textarea");
ta.style.width="100%";
ta.style.height="20em";
ta.value="";
function debug(_102,str){
for(;--_102>=0;){
ta.value+=" ";
}
ta.value+=str+"\n";
}
function _dt(root,_105){
var tag=root.tagName.toLowerCase(),i;
var ns=Xinha.is_ie?root.scopeName:root.prefix;
debug(_105,"- "+tag+" ["+ns+"]");
for(i=root.firstChild;i;i=i.nextSibling){
if(i.nodeType==1){
_dt(i,_105+2);
}
}
}
_dt(this._doc.body,0);
document.body.appendChild(ta);
};
Xinha.getInnerText=function(el){
var txt="",i;
for(i=el.firstChild;i;i=i.nextSibling){
if(i.nodeType==3){
txt+=i.data;
}else{
if(i.nodeType==1){
txt+=Xinha.getInnerText(i);
}
}
}
return txt;
};
Xinha.prototype._wordClean=function(){
var _10a=this;
var _10b={empty_tags:0,mso_class:0,mso_style:0,mso_xmlel:0,orig_len:this._doc.body.innerHTML.length,T:(new Date()).getTime()};
var _10c={empty_tags:"Empty tags removed: ",mso_class:"MSO class names removed: ",mso_style:"MSO inline style removed: ",mso_xmlel:"MSO XML elements stripped: "};
function showStats(){
var txt="Xinha word cleaner stats: \n\n";
for(var i in _10b){
if(_10c[i]){
txt+=_10c[i]+_10b[i]+"\n";
}
}
txt+="\nInitial document length: "+_10b.orig_len+"\n";
txt+="Final document length: "+_10a._doc.body.innerHTML.length+"\n";
txt+="Clean-up took "+(((new Date()).getTime()-_10b.T)/1000)+" seconds";
alert(txt);
}
function clearClass(node){
var newc=node.className.replace(/(^|\s)mso.*?(\s|$)/ig," ");
if(newc!=node.className){
node.className=newc;
if(!(/\S/.test(node.className))){
node.removeAttribute("className");
++_10b.mso_class;
}
}
}
function clearStyle(node){
var _112=node.style.cssText.split(/\s*;\s*/);
for(var i=_112.length;--i>=0;){
if((/^mso|^tab-stops/i.test(_112[i]))||(/^margin\s*:\s*0..\s+0..\s+0../i.test(_112[i]))){
++_10b.mso_style;
_112.splice(i,1);
}
}
node.style.cssText=_112.join("; ");
}
var _114=null;
if(Xinha.is_ie){
_114=function(el){
el.outerHTML=Xinha.htmlEncode(el.innerText);
++_10b.mso_xmlel;
};
}else{
_114=function(el){
var txt=document.createTextNode(Xinha.getInnerText(el));
el.parentNode.insertBefore(txt,el);
Xinha.removeFromParent(el);
++_10b.mso_xmlel;
};
}
function checkEmpty(el){
if(/^(span|b|strong|i|em|font|div|p)$/i.test(el.tagName)&&!el.firstChild){
Xinha.removeFromParent(el);
++_10b.empty_tags;
}
}
function parseTree(root){
var tag=root.tagName.toLowerCase(),i,next;
if((Xinha.is_ie&&root.scopeName!="HTML")||(!Xinha.is_ie&&(/:/.test(tag)))){
_114(root);
return false;
}else{
clearClass(root);
clearStyle(root);
for(i=root.firstChild;i;i=next){
next=i.nextSibling;
if(i.nodeType==1&&parseTree(i)){
checkEmpty(i);
}
}
}
return true;
}
parseTree(this._doc.body);
this.updateToolbar();
};
Xinha.prototype._clearFonts=function(){
var D=this.getInnerHTML();
if(confirm(Xinha._lc("Would you like to clear font typefaces?"))){
D=D.replace(/face="[^"]*"/gi,"");
D=D.replace(/font-family:[^;}"']+;?/gi,"");
}
if(confirm(Xinha._lc("Would you like to clear font sizes?"))){
D=D.replace(/size="[^"]*"/gi,"");
D=D.replace(/font-size:[^;}"']+;?/gi,"");
}
if(confirm(Xinha._lc("Would you like to clear font colours?"))){
D=D.replace(/color="[^"]*"/gi,"");
D=D.replace(/([^-])color:[^;}"']+;?/gi,"$1");
}
D=D.replace(/(style|class)="\s*"/gi,"");
D=D.replace(/<(font|span)\s*>/gi,"");
this.setHTML(D);
this.updateToolbar();
};
Xinha.prototype._splitBlock=function(){
this._doc.execCommand("formatblock",false,"div");
};
Xinha.prototype.forceRedraw=function(){
this._doc.body.style.visibility="hidden";
this._doc.body.style.visibility="";
};
Xinha.prototype.focusEditor=function(){
switch(this._editMode){
case "wysiwyg":
try{
if(Xinha._someEditorHasBeenActivated){
this.activateEditor();
this._iframe.contentWindow.focus();
}
}
catch(ex){
}
break;
case "textmode":
try{
this._textArea.focus();
}
catch(e){
}
break;
default:
alert("ERROR: mode "+this._editMode+" is not defined");
}
return this._doc;
};
Xinha.prototype._undoTakeSnapshot=function(){
++this._undoPos;
if(this._undoPos>=this.config.undoSteps){
this._undoQueue.shift();
--this._undoPos;
}
var take=true;
var txt=this.getInnerHTML();
if(this._undoPos>0){
take=(this._undoQueue[this._undoPos-1]!=txt);
}
if(take){
this._undoQueue[this._undoPos]=txt;
}else{
this._undoPos--;
}
};
Xinha.prototype.undo=function(){
if(this._undoPos>0){
var txt=this._undoQueue[--this._undoPos];
if(txt){
this.setHTML(txt);
}else{
++this._undoPos;
}
}
};
Xinha.prototype.redo=function(){
if(this._undoPos<this._undoQueue.length-1){
var txt=this._undoQueue[++this._undoPos];
if(txt){
this.setHTML(txt);
}else{
--this._undoPos;
}
}
};
Xinha.prototype.disableToolbar=function(_120){
if(this._timerToolbar){
clearTimeout(this._timerToolbar);
}
if(typeof _120=="undefined"){
_120=[];
}else{
if(typeof _120!="object"){
_120=[_120];
}
}
for(var i in this._toolbarObjects){
var btn=this._toolbarObjects[i];
if(_120.contains(i)){
continue;
}
if(typeof (btn.state)!="function"){
continue;
}
btn.state("enabled",false);
}
};
Xinha.prototype.enableToolbar=function(){
this.updateToolbar();
};
Xinha.prototype.updateToolbar=function(_123){
var doc=this._doc;
var text=(this._editMode=="textmode");
var _126=null;
if(!text){
_126=this.getAllAncestors();
if(this.config.statusBar&&!_123){
while(this._statusBarItems.length){
var item=this._statusBarItems.pop();
item.el=null;
item.editor=null;
item.onclick=null;
item.oncontextmenu=null;
item._xinha_dom0Events["click"]=null;
item._xinha_dom0Events["contextmenu"]=null;
item=null;
}
this._statusBarTree.innerHTML=Xinha._lc("Path")+": ";
for(var i=_126.length;--i>=0;){
var el=_126[i];
if(!el){
continue;
}
var a=document.createElement("a");
a.href="javascript:void(0)";
a.el=el;
a.editor=this;
this._statusBarItems.push(a);
Xinha.addDom0Event(a,"click",function(){
this.blur();
this.editor.selectNodeContents(this.el);
this.editor.updateToolbar(true);
return false;
});
Xinha.addDom0Event(a,"contextmenu",function(){
this.blur();
var info="Inline style:\n\n";
info+=this.el.style.cssText.split(/;\s*/).join(";\n");
alert(info);
return false;
});
var txt=el.tagName.toLowerCase();
if(typeof el.style!="undefined"){
a.title=el.style.cssText;
}
if(el.id){
txt+="#"+el.id;
}
if(el.className){
txt+="."+el.className;
}
a.appendChild(document.createTextNode(txt));
this._statusBarTree.appendChild(a);
if(i!==0){
this._statusBarTree.appendChild(document.createTextNode(String.fromCharCode(187)));
}
Xinha.freeLater(a);
}
}
}
for(var cmd in this._toolbarObjects){
var btn=this._toolbarObjects[cmd];
var _12f=true;
if(typeof (btn.state)!="function"){
continue;
}
if(btn.context&&!text){
_12f=false;
var _130=btn.context;
var _131=[];
if(/(.*)\[(.*?)\]/.test(_130)){
_130=RegExp.$1;
_131=RegExp.$2.split(",");
}
_130=_130.toLowerCase();
var _132=(_130=="*");
for(var k=0;k<_126.length;++k){
if(!_126[k]){
continue;
}
if(_132||(_126[k].tagName.toLowerCase()==_130)){
_12f=true;
var _134=null;
var att=null;
var comp=null;
var _137=null;
for(var ka=0;ka<_131.length;++ka){
_134=_131[ka].match(/(.*)(==|!=|===|!==|>|>=|<|<=)(.*)/);
att=_134[1];
comp=_134[2];
_137=_134[3];
if(!eval(_126[k][att]+comp+_137)){
_12f=false;
break;
}
}
if(_12f){
break;
}
}
}
}
btn.state("enabled",(!text||btn.text)&&_12f);
if(typeof cmd=="function"){
continue;
}
var _139=this.config.customSelects[cmd];
if((!text||btn.text)&&(typeof _139!="undefined")){
_139.refresh(this);
continue;
}
switch(cmd){
case "fontname":
case "fontsize":
if(!text){
try{
var _13a=(""+doc.queryCommandValue(cmd)).toLowerCase();
if(!_13a){
btn.element.selectedIndex=0;
break;
}
var _13b=this.config[cmd];
var _13c=0;
for(var j in _13b){
if((j.toLowerCase()==_13a)||(_13b[j].substr(0,_13a.length).toLowerCase()==_13a)){
btn.element.selectedIndex=_13c;
throw "ok";
}
++_13c;
}
btn.element.selectedIndex=0;
}
catch(ex){
}
}
break;
case "formatblock":
var _13e=[];
for(var _13f in this.config.formatblock){
if(typeof this.config.formatblock[_13f]=="string"){
_13e[_13e.length]=this.config.formatblock[_13f];
}
}
var _140=this._getFirstAncestor(this.getSelection(),_13e);
if(_140){
for(var x=0;x<_13e.length;x++){
if(_13e[x].toLowerCase()==_140.tagName.toLowerCase()){
btn.element.selectedIndex=x;
}
}
}else{
btn.element.selectedIndex=0;
}
break;
case "textindicator":
if(!text){
try{
var _142=btn.element.style;
_142.backgroundColor=Xinha._makeColor(doc.queryCommandValue(Xinha.is_ie?"backcolor":"hilitecolor"));
if(/transparent/i.test(_142.backgroundColor)){
_142.backgroundColor=Xinha._makeColor(doc.queryCommandValue("backcolor"));
}
_142.color=Xinha._makeColor(doc.queryCommandValue("forecolor"));
_142.fontFamily=doc.queryCommandValue("fontname");
_142.fontWeight=doc.queryCommandState("bold")?"bold":"normal";
_142.fontStyle=doc.queryCommandState("italic")?"italic":"normal";
}
catch(ex){
}
}
break;
case "htmlmode":
btn.state("active",text);
break;
case "lefttoright":
case "righttoleft":
var _143=this.getParentElement();
while(_143&&!Xinha.isBlockElement(_143)){
_143=_143.parentNode;
}
if(_143){
btn.state("active",(_143.style.direction==((cmd=="righttoleft")?"rtl":"ltr")));
}
break;
default:
cmd=cmd.replace(/(un)?orderedlist/i,"insert$1orderedlist");
try{
btn.state("active",(!text&&doc.queryCommandState(cmd)));
}
catch(ex){
}
break;
}
}
if(this._customUndo&&!this._timerUndo){
this._undoTakeSnapshot();
var _144=this;
this._timerUndo=setTimeout(function(){
_144._timerUndo=null;
},this.config.undoTimeout);
}
this.firePluginEvent("onUpdateToolbar");
};
Xinha.getEditor=function(ref){
for(var i=__xinhas.length;i--;){
var _147=__xinhas[i];
if(_147&&(_147._textArea.id==ref||_147._textArea.name==ref||_147._textArea==ref)){
return _147;
}
}
return null;
};
Xinha.prototype.getPluginInstance=function(_148){
if(this.plugins[_148]){
return this.plugins[_148].instance;
}else{
return null;
}
};
Xinha.prototype.getAllAncestors=function(){
var p=this.getParentElement();
var a=[];
while(p&&(p.nodeType==1)&&(p.tagName.toLowerCase()!="body")){
a.push(p);
p=p.parentNode;
}
a.push(this._doc.body);
return a;
};
Xinha.prototype._getFirstAncestor=function(sel,_14c){
var prnt=this.activeElement(sel);
if(prnt===null){
try{
prnt=(Xinha.is_ie?this.createRange(sel).parentElement():this.createRange(sel).commonAncestorContainer);
}
catch(ex){
return null;
}
}
if(typeof _14c=="string"){
_14c=[_14c];
}
while(prnt){
if(prnt.nodeType==1){
if(_14c===null){
return prnt;
}
if(_14c.contains(prnt.tagName.toLowerCase())){
return prnt;
}
if(prnt.tagName.toLowerCase()=="body"){
break;
}
if(prnt.tagName.toLowerCase()=="table"){
break;
}
}
prnt=prnt.parentNode;
}
return null;
};
Xinha.prototype._getAncestorBlock=function(sel){
var prnt=(Xinha.is_ie?this.createRange(sel).parentElement:this.createRange(sel).commonAncestorContainer);
while(prnt&&(prnt.nodeType==1)){
switch(prnt.tagName.toLowerCase()){
case "div":
case "p":
case "address":
case "blockquote":
case "center":
case "del":
case "ins":
case "pre":
case "h1":
case "h2":
case "h3":
case "h4":
case "h5":
case "h6":
case "h7":
return prnt;
case "body":
case "noframes":
case "dd":
case "li":
case "th":
case "td":
case "noscript":
return null;
default:
break;
}
}
return null;
};
Xinha.prototype._createImplicitBlock=function(type){
var sel=this.getSelection();
if(Xinha.is_ie){
sel.empty();
}else{
sel.collapseToStart();
}
var rng=this.createRange(sel);
};
Xinha.prototype.surroundHTML=function(_153,_154){
var html=this.getSelectedHTML();
this.insertHTML(_153+html+_154);
};
Xinha.prototype.hasSelectedText=function(){
return this.getSelectedHTML()!=="";
};
Xinha.prototype._comboSelected=function(el,txt){
this.focusEditor();
var _158=el.options[el.selectedIndex].value;
switch(txt){
case "fontname":
case "fontsize":
this.execCommand(txt,false,_158);
break;
case "formatblock":
if(!_158){
this.updateToolbar();
break;
}
if(!Xinha.is_gecko||_158!=="blockquote"){
_158="<"+_158+">";
}
this.execCommand(txt,false,_158);
break;
default:
var _159=this.config.customSelects[txt];
if(typeof _159!="undefined"){
_159.action(this);
}else{
alert("FIXME: combo box "+txt+" not implemented");
}
break;
}
};
Xinha.prototype._colorSelector=function(_15a){
var _15b=this;
if(Xinha.is_gecko){
try{
_15b._doc.execCommand("useCSS",false,false);
_15b._doc.execCommand("styleWithCSS",false,true);
}
catch(ex){
}
}
var btn=_15b._toolbarObjects[_15a].element;
var _15d;
if(_15a=="hilitecolor"){
if(Xinha.is_ie){
_15a="backcolor";
_15d=Xinha._colorToRgb(_15b._doc.queryCommandValue("backcolor"));
}else{
_15d=Xinha._colorToRgb(_15b._doc.queryCommandValue("hilitecolor"));
}
}else{
_15d=Xinha._colorToRgb(_15b._doc.queryCommandValue("forecolor"));
}
var _15e=function(_15f){
_15b._doc.execCommand(_15a,false,_15f);
};
if(Xinha.is_ie){
var _160=_15b.createRange(_15b.getSelection());
_15e=function(_161){
_160.select();
_15b._doc.execCommand(_15a,false,_161);
};
}
var _162=new Xinha.colorPicker({cellsize:_15b.config.colorPickerCellSize,callback:_15e,granularity:_15b.config.colorPickerGranularity,websafe:_15b.config.colorPickerWebSafe,savecolors:_15b.config.colorPickerSaveColors});
_162.open(_15b.config.colorPickerPosition,btn,_15d);
};
Xinha.prototype.execCommand=function(_163,UI,_165){
var _166=this;
this.focusEditor();
_163=_163.toLowerCase();
if(this.firePluginEvent("onExecCommand",_163,UI,_165)){
this.updateToolbar();
return false;
}
switch(_163){
case "htmlmode":
this.setMode();
break;
case "hilitecolor":
case "forecolor":
this._colorSelector(_163);
break;
case "createlink":
this._createLink();
break;
case "undo":
case "redo":
if(this._customUndo){
this[_163]();
}else{
this._doc.execCommand(_163,UI,_165);
}
break;
case "inserttable":
this._insertTable();
break;
case "insertimage":
this._insertImage();
break;
case "about":
this._popupDialog(_166.config.URIs.about,null,this);
break;
case "showhelp":
this._popupDialog(_166.config.URIs.help,null,this);
break;
case "killword":
this._wordClean();
break;
case "cut":
case "copy":
case "paste":
this._doc.execCommand(_163,UI,_165);
if(this.config.killWordOnPaste){
this._wordClean();
}
break;
case "lefttoright":
case "righttoleft":
if(this.config.changeJustifyWithDirection){
this._doc.execCommand((_163=="righttoleft")?"justifyright":"justifyleft",UI,_165);
}
var dir=(_163=="righttoleft")?"rtl":"ltr";
var el=this.getParentElement();
while(el&&!Xinha.isBlockElement(el)){
el=el.parentNode;
}
if(el){
if(el.style.direction==dir){
el.style.direction="";
}else{
el.style.direction=dir;
}
}
break;
case "justifyleft":
case "justifyright":
_163.match(/^justify(.*)$/);
var ae=this.activeElement(this.getSelection());
if(ae&&ae.tagName.toLowerCase()=="img"){
ae.align=ae.align==RegExp.$1?"":RegExp.$1;
}else{
this._doc.execCommand(_163,UI,_165);
}
break;
default:
try{
this._doc.execCommand(_163,UI,_165);
}
catch(ex){
if(this.config.debug){
alert(ex+"\n\nby execCommand("+_163+");");
}
}
break;
}
this.updateToolbar();
return false;
};
Xinha.prototype._editorEvent=function(ev){
var _16b=this;
if(typeof _16b._textArea["on"+ev.type]=="function"){
_16b._textArea["on"+ev.type]();
}
if(this.isKeyEvent(ev)){
if(_16b.firePluginEvent("onKeyPress",ev)){
return false;
}
if(this.isShortCut(ev)){
this._shortCuts(ev);
}
}
if(ev.type=="mousedown"){
if(_16b.firePluginEvent("onMouseDown",ev)){
return false;
}
}
if(_16b._timerToolbar){
clearTimeout(_16b._timerToolbar);
}
_16b._timerToolbar=setTimeout(function(){
_16b.updateToolbar();
_16b._timerToolbar=null;
},250);
};
Xinha.prototype._shortCuts=function(ev){
var key=this.getKey(ev).toLowerCase();
var cmd=null;
var _16f=null;
switch(key){
case "b":
cmd="bold";
break;
case "i":
cmd="italic";
break;
case "u":
cmd="underline";
break;
case "s":
cmd="strikethrough";
break;
case "l":
cmd="justifyleft";
break;
case "e":
cmd="justifycenter";
break;
case "r":
cmd="justifyright";
break;
case "j":
cmd="justifyfull";
break;
case "z":
cmd="undo";
break;
case "y":
cmd="redo";
break;
case "v":
cmd="paste";
break;
case "n":
cmd="formatblock";
_16f="p";
break;
case "0":
cmd="killword";
break;
case "1":
case "2":
case "3":
case "4":
case "5":
case "6":
cmd="formatblock";
_16f="h"+key;
break;
}
if(cmd){
this.execCommand(cmd,false,_16f);
Xinha._stopEvent(ev);
}
};
Xinha.prototype.convertNode=function(el,_171){
var _172=this._doc.createElement(_171);
while(el.firstChild){
_172.appendChild(el.firstChild);
}
return _172;
};
Xinha.prototype.scrollToElement=function(e){
if(!e){
e=this.getParentElement();
if(!e){
return;
}
}
var _174=Xinha.getElementTopLeft(e);
this._iframe.contentWindow.scrollTo(_174.left,_174.top);
};
Xinha.prototype.getEditorContent=function(){
return this.outwardHtml(this.getHTML());
};
Xinha.prototype.setEditorContent=function(html){
this.setHTML(this.inwardHtml(html));
};
Xinha.prototype.getHTML=function(){
var html="";
switch(this._editMode){
case "wysiwyg":
if(!this.config.fullPage){
html=Xinha.getHTML(this._doc.body,false,this).trim();
}else{
html=this.doctype+"\n"+Xinha.getHTML(this._doc.documentElement,true,this);
}
break;
case "textmode":
html=this._textArea.value;
break;
default:
alert("Mode <"+this._editMode+"> not defined!");
return false;
}
return html;
};
Xinha.prototype.outwardHtml=function(html){
for(var i in this.plugins){
var _179=this.plugins[i].instance;
if(_179&&typeof _179.outwardHtml=="function"){
html=_179.outwardHtml(html);
}
}
html=html.replace(/<(\/?)b(\s|>|\/)/ig,"<$1strong$2");
html=html.replace(/<(\/?)i(\s|>|\/)/ig,"<$1em$2");
html=html.replace(/<(\/?)strike(\s|>|\/)/ig,"<$1del$2");
html=html.replace(/(<[^>]*on(click|mouse(over|out|up|down))=['"])if\(window\.parent &amp;&amp; window\.parent\.Xinha\)\{return false\}/gi,"$1");
var _17a=location.href.replace(/(https?:\/\/[^\/]*)\/.*/,"$1")+"/";
html=html.replace(/https?:\/\/null\//g,_17a);
html=html.replace(/((href|src|background)=[\'\"])\/+/ig,"$1"+_17a);
html=this.outwardSpecialReplacements(html);
html=this.fixRelativeLinks(html);
if(this.config.sevenBitClean){
html=html.replace(/[^ -~\r\n\t]/g,function(c){
return "&#"+c.charCodeAt(0)+";";
});
}
html=html.replace(/(<script[^>]*((type=[\"\']text\/)|(language=[\"\'])))(freezescript)/gi,"$1javascript");
if(this.config.fullPage){
html=Xinha.stripCoreCSS(html);
}
return html;
};
Xinha.prototype.inwardHtml=function(html){
for(var i in this.plugins){
var _17e=this.plugins[i].instance;
if(_17e&&typeof _17e.inwardHtml=="function"){
html=_17e.inwardHtml(html);
}
}
html=html.replace(/<(\/?)del(\s|>|\/)/ig,"<$1strike$2");
html=html.replace(/(<[^>]*on(click|mouse(over|out|up|down))=["'])/gi,"$1if(window.parent &amp;&amp; window.parent.Xinha){return false}");
html=this.inwardSpecialReplacements(html);
html=html.replace(/(<script[^>]*((type=[\"\']text\/)|(language=[\"\'])))(javascript)/gi,"$1freezescript");
var _17f=new RegExp("((href|src|background)=['\"])/+","gi");
html=html.replace(_17f,"$1"+location.href.replace(/(https?:\/\/[^\/]*)\/.*/,"$1")+"/");
html=this.fixRelativeLinks(html);
if(this.config.fullPage){
html=Xinha.addCoreCSS(html);
}
return html;
};
Xinha.prototype.outwardSpecialReplacements=function(html){
for(var i in this.config.specialReplacements){
var from=this.config.specialReplacements[i];
var to=i;
if(typeof from.replace!="function"||typeof to.replace!="function"){
continue;
}
var reg=new RegExp(Xinha.escapeStringForRegExp(from),"g");
html=html.replace(reg,to.replace(/\$/g,"$$$$"));
}
return html;
};
Xinha.prototype.inwardSpecialReplacements=function(html){
for(var i in this.config.specialReplacements){
var from=i;
var to=this.config.specialReplacements[i];
if(typeof from.replace!="function"||typeof to.replace!="function"){
continue;
}
var reg=new RegExp(Xinha.escapeStringForRegExp(from),"g");
html=html.replace(reg,to.replace(/\$/g,"$$$$"));
}
return html;
};
Xinha.prototype.fixRelativeLinks=function(html){
if(typeof this.config.expandRelativeUrl!="undefined"&&this.config.expandRelativeUrl){
var src=html.match(/(src|href)="([^"]*)"/gi);
}
var b=document.location.href;
if(src){
var url,url_m,relPath,base_m,absPath;
for(var i=0;i<src.length;++i){
url=src[i].match(/(src|href)="([^"]*)"/i);
url_m=url[2].match(/\.\.\//g);
if(url_m){
relPath=new RegExp("(.*?)(([^/]*/){"+url_m.length+"})[^/]*$");
base_m=b.match(relPath);
absPath=url[2].replace(/(\.\.\/)*/,base_m[1]);
html=html.replace(new RegExp(Xinha.escapeStringForRegExp(url[2])),absPath);
}
}
}
if(typeof this.config.stripSelfNamedAnchors!="undefined"&&this.config.stripSelfNamedAnchors){
var _18f=new RegExp("((href|src|background)=\")("+Xinha.escapeStringForRegExp(unescape(document.location.href.replace(/&/g,"&amp;")))+")([#?][^'\" ]*)","g");
html=html.replace(_18f,"$1$4");
}
if(typeof this.config.stripBaseHref!="undefined"&&this.config.stripBaseHref){
var _190=null;
if(typeof this.config.baseHref!="undefined"&&this.config.baseHref!==null){
_190=new RegExp("((href|src|background)=\")("+Xinha.escapeStringForRegExp(this.config.baseHref.replace(/([^\/]\/)(?=.+\.)[^\/]*$/,"$1"))+")","g");
}else{
_190=new RegExp("((href|src|background)=\")("+Xinha.escapeStringForRegExp(document.location.href.replace(/^(https?:\/\/[^\/]*)(.*)/,"$1"))+")","g");
}
html=html.replace(_190,"$1");
}
return html;
};
Xinha.prototype.getInnerHTML=function(){
if(!this._doc.body){
return "";
}
var html="";
switch(this._editMode){
case "wysiwyg":
if(!this.config.fullPage){
html=this._doc.body.innerHTML;
}else{
html=this.doctype+"\n"+this._doc.documentElement.innerHTML;
}
break;
case "textmode":
html=this._textArea.value;
break;
default:
alert("Mode <"+this._editMode+"> not defined!");
return false;
}
return html;
};
Xinha.prototype.setHTML=function(html){
if(!this.config.fullPage){
this._doc.body.innerHTML=html;
}else{
this.setFullHTML(html);
}
this._textArea.value=html;
};
Xinha.prototype.setDoctype=function(_193){
this.doctype=_193;
};
Xinha._object=null;
Array.prototype.isArray=true;
RegExp.prototype.isRegExp=true;
Xinha.cloneObject=function(obj){
if(!obj){
return null;
}
var _195=(obj.isArray)?[]:{};
if(obj.constructor.toString().match(/\s*function Function\(/)||typeof obj=="function"){
_195=obj;
}else{
if(obj.isRegExp){
_195=eval(obj.toString());
}else{
for(var n in obj){
var node=obj[n];
if(typeof node=="object"){
_195[n]=Xinha.cloneObject(node);
}else{
_195[n]=node;
}
}
}
}
return _195;
};
Xinha.flushEvents=function(){
var x=0;
var e=Xinha._eventFlushers.pop();
while(e){
try{
if(e.length==3){
Xinha._removeEvent(e[0],e[1],e[2]);
x++;
}else{
if(e.length==2){
e[0]["on"+e[1]]=null;
e[0]._xinha_dom0Events[e[1]]=null;
x++;
}
}
}
catch(ex){
}
e=Xinha._eventFlushers.pop();
}
};
Xinha._eventFlushers=[];
if(document.addEventListener){
Xinha._addEvent=function(el,_19b,func){
el.addEventListener(_19b,func,true);
Xinha._eventFlushers.push([el,_19b,func]);
};
Xinha._removeEvent=function(el,_19e,func){
el.removeEventListener(_19e,func,true);
};
Xinha._stopEvent=function(ev){
ev.preventDefault();
ev.stopPropagation();
};
}else{
if(document.attachEvent){
Xinha._addEvent=function(el,_1a2,func){
el.attachEvent("on"+_1a2,func);
Xinha._eventFlushers.push([el,_1a2,func]);
};
Xinha._removeEvent=function(el,_1a5,func){
el.detachEvent("on"+_1a5,func);
};
Xinha._stopEvent=function(ev){
try{
ev.cancelBubble=true;
ev.returnValue=false;
}
catch(ex){
}
};
}else{
Xinha._addEvent=function(el,_1a9,func){
alert("_addEvent is not supported");
};
Xinha._removeEvent=function(el,_1ac,func){
alert("_removeEvent is not supported");
};
Xinha._stopEvent=function(ev){
alert("_stopEvent is not supported");
};
}
}
Xinha._addEvents=function(el,evs,func){
for(var i=evs.length;--i>=0;){
Xinha._addEvent(el,evs[i],func);
}
};
Xinha._removeEvents=function(el,evs,func){
for(var i=evs.length;--i>=0;){
Xinha._removeEvent(el,evs[i],func);
}
};
Xinha.addOnloadHandler=function(func,_1b8){
_1b8=_1b8?_1b8:window;
var init=function(){
if(arguments.callee.done){
return;
}
arguments.callee.done=true;
if(Xinha.onloadTimer){
clearInterval(Xinha.onloadTimer);
}
func();
};
if(Xinha.is_ie){
_1b8.document.write("<sc"+"ript id=__ie_onload defer src=javascript:void(0)></script>");
var _1ba=_1b8.document.getElementById("__ie_onload");
_1ba.onreadystatechange=function(){
if(this.readyState=="loaded"){
this.parentNode.removeChild(_1ba);
init();
}
};
}else{
if(/applewebkit|KHTML/i.test(navigator.userAgent)){
Xinha.onloadTimer=_1b8.setInterval(function(){
if(/loaded|complete/.test(_1b8.document.readyState)){
init();
}
},10);
}else{
_1b8.document.addEventListener("DOMContentLoaded",init,false);
}
}
Xinha._addEvent(_1b8,"load",init);
};
Xinha.addDom0Event=function(el,ev,fn){
Xinha._prepareForDom0Events(el,ev);
el._xinha_dom0Events[ev].unshift(fn);
};
Xinha.prependDom0Event=function(el,ev,fn){
Xinha._prepareForDom0Events(el,ev);
el._xinha_dom0Events[ev].push(fn);
};
Xinha._prepareForDom0Events=function(el,ev){
if(typeof el._xinha_dom0Events=="undefined"){
el._xinha_dom0Events={};
Xinha.freeLater(el,"_xinha_dom0Events");
}
if(typeof el._xinha_dom0Events[ev]=="undefined"){
el._xinha_dom0Events[ev]=[];
if(typeof el["on"+ev]=="function"){
el._xinha_dom0Events[ev].push(el["on"+ev]);
}
el["on"+ev]=function(_1c3){
var a=el._xinha_dom0Events[ev];
var _1c5=true;
for(var i=a.length;--i>=0;){
el._xinha_tempEventHandler=a[i];
if(el._xinha_tempEventHandler(_1c3)===false){
el._xinha_tempEventHandler=null;
_1c5=false;
break;
}
el._xinha_tempEventHandler=null;
}
return _1c5;
};
Xinha._eventFlushers.push([el,ev]);
}
};
Xinha.prototype.notifyOn=function(ev,fn){
if(typeof this._notifyListeners[ev]=="undefined"){
this._notifyListeners[ev]=[];
Xinha.freeLater(this,"_notifyListeners");
}
this._notifyListeners[ev].push(fn);
};
Xinha.prototype.notifyOf=function(ev,args){
if(this._notifyListeners[ev]){
for(var i=0;i<this._notifyListeners[ev].length;i++){
this._notifyListeners[ev][i](ev,args);
}
}
};
Xinha._blockTags=" body form textarea fieldset ul ol dl li div "+"p h1 h2 h3 h4 h5 h6 quote pre table thead "+"tbody tfoot tr td th iframe address blockquote ";
Xinha.isBlockElement=function(el){
return el&&el.nodeType==1&&(Xinha._blockTags.indexOf(" "+el.tagName.toLowerCase()+" ")!=-1);
};
Xinha._paraContainerTags=" body td th caption fieldset div";
Xinha.isParaContainer=function(el){
return el&&el.nodeType==1&&(Xinha._paraContainerTags.indexOf(" "+el.tagName.toLowerCase()+" ")!=-1);
};
Xinha._closingTags=" a abbr acronym address applet b bdo big blockquote button caption center cite code del dfn dir div dl em fieldset font form frameset h1 h2 h3 h4 h5 h6 i iframe ins kbd label legend map menu noframes noscript object ol optgroup pre q s samp script select small span strike strong style sub sup table textarea title tt u ul var ";
Xinha.needsClosingTag=function(el){
return el&&el.nodeType==1&&(Xinha._closingTags.indexOf(" "+el.tagName.toLowerCase()+" ")!=-1);
};
Xinha.htmlEncode=function(str){
if(typeof str.replace=="undefined"){
str=str.toString();
}
str=str.replace(/&/ig,"&amp;");
str=str.replace(/</ig,"&lt;");
str=str.replace(/>/ig,"&gt;");
str=str.replace(/\xA0/g,"&nbsp;");
str=str.replace(/\x22/g,"&quot;");
return str;
};
Xinha.prototype.stripBaseURL=function(_1d0){
if(this.config.baseHref===null||!this.config.stripBaseHref){
return _1d0;
}
var _1d1=this.config.baseHref.replace(/^(https?:\/\/[^\/]+)(.*)$/,"$1");
var _1d2=new RegExp(_1d1);
return _1d0.replace(_1d2,"");
};
String.prototype.trim=function(){
return this.replace(/^\s+/,"").replace(/\s+$/,"");
};
Xinha._makeColor=function(v){
if(typeof v!="number"){
return v;
}
var r=v&255;
var g=(v>>8)&255;
var b=(v>>16)&255;
return "rgb("+r+","+g+","+b+")";
};
Xinha._colorToRgb=function(v){
if(!v){
return "";
}
var r,g,b;
function hex(d){
return (d<16)?("0"+d.toString(16)):d.toString(16);
}
if(typeof v=="number"){
r=v&255;
g=(v>>8)&255;
b=(v>>16)&255;
return "#"+hex(r)+hex(g)+hex(b);
}
if(v.substr(0,3)=="rgb"){
var re=/rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/;
if(v.match(re)){
r=parseInt(RegExp.$1,10);
g=parseInt(RegExp.$2,10);
b=parseInt(RegExp.$3,10);
return "#"+hex(r)+hex(g)+hex(b);
}
return null;
}
if(v.substr(0,1)=="#"){
return v;
}
return null;
};
Xinha.prototype._popupDialog=function(url,_1dc,init){
Dialog(this.popupURL(url),_1dc,init);
};
Xinha.prototype.imgURL=function(file,_1df){
if(typeof _1df=="undefined"){
return _editor_url+file;
}else{
return _editor_url+"plugins/"+_1df+"/img/"+file;
}
};
Xinha.prototype.popupURL=function(file){
var url="";
if(file.match(/^plugin:\/\/(.*?)\/(.*)/)){
var _1e2=RegExp.$1;
var _1e3=RegExp.$2;
if(!(/\.html$/.test(_1e3))){
_1e3+=".html";
}
url=_editor_url+"plugins/"+_1e2+"/popups/"+_1e3;
}else{
if(file.match(/^\/.*?/)||file.match(/^https?:\/\//)){
url=file;
}else{
url=_editor_url+this.config.popupURL+file;
}
}
return url;
};
Xinha.getElementById=function(tag,id){
var el,i,objs=document.getElementsByTagName(tag);
for(i=objs.length;--i>=0&&(el=objs[i]);){
if(el.id==id){
return el;
}
}
return null;
};
Xinha.prototype._toggleBorders=function(){
var _1e7=this._doc.getElementsByTagName("TABLE");
if(_1e7.length!==0){
if(!this.borders){
this.borders=true;
}else{
this.borders=false;
}
for(var i=0;i<_1e7.length;i++){
if(this.borders){
Xinha._addClass(_1e7[i],"htmtableborders");
}else{
Xinha._removeClass(_1e7[i],"htmtableborders");
}
}
}
return true;
};
Xinha.addCoreCSS=function(html){
var _1ea="<style title=\"XinhaInternalCSS\" type=\"text/css\">"+".htmtableborders, .htmtableborders td, .htmtableborders th {border : 1px dashed lightgrey ! important;}\n"+"html, body { border: 0px; } \n"+"body { background-color: #ffffff; } \n"+"img, hr { cursor: default } \n"+"</style>\n";
if(html&&/<head>/i.test(html)){
return html.replace(/<head>/i,"<head>"+_1ea);
}else{
if(html){
return _1ea+html;
}else{
return _1ea;
}
}
};
Xinha.prototype.addEditorStylesheet=function(_1eb){
var _1ec=this._doc.createElement("link");
_1ec.rel="stylesheet";
_1ec.type="text/css";
_1ec.title="XinhaInternalCSS";
_1ec.href=_1eb;
this._doc.getElementsByTagName("HEAD")[0].appendChild(_1ec);
};
Xinha.stripCoreCSS=function(html){
return html.replace(/<style[^>]+title="XinhaInternalCSS"(.|\n)*?<\/style>/ig,"").replace(/<link[^>]+title="XinhaInternalCSS"(.|\n)*?>/ig,"");
};
Xinha._removeClass=function(el,_1ef){
if(!(el&&el.className)){
return;
}
var cls=el.className.split(" ");
var ar=[];
for(var i=cls.length;i>0;){
if(cls[--i]!=_1ef){
ar[ar.length]=cls[i];
}
}
el.className=ar.join(" ");
};
Xinha._addClass=function(el,_1f4){
Xinha._removeClass(el,_1f4);
el.className+=" "+_1f4;
};
Xinha.addClasses=function(el,_1f6){
if(el!==null){
var _1f7=el.className.trim().split(" ");
var ours=_1f6.split(" ");
for(var x=0;x<ours.length;x++){
var _1fa=false;
for(var i=0;_1fa===false&&i<_1f7.length;i++){
if(_1f7[i]==ours[x]){
_1fa=true;
}
}
if(_1fa===false){
_1f7[_1f7.length]=ours[x];
}
}
el.className=_1f7.join(" ").trim();
}
};
Xinha.removeClasses=function(el,_1fd){
var _1fe=el.className.trim().split();
var _1ff=[];
var _200=_1fd.trim().split();
for(var i=0;i<_1fe.length;i++){
var _202=false;
for(var x=0;x<_200.length&&!_202;x++){
if(_1fe[i]==_200[x]){
_202=true;
}
}
if(!_202){
_1ff[_1ff.length]=_1fe[i];
}
}
return _1ff.join(" ");
};
Xinha.addClass=Xinha._addClass;
Xinha.removeClass=Xinha._removeClass;
Xinha._addClasses=Xinha.addClasses;
Xinha._removeClasses=Xinha.removeClasses;
Xinha._hasClass=function(el,_205){
if(!(el&&el.className)){
return false;
}
var cls=el.className.split(" ");
for(var i=cls.length;i>0;){
if(cls[--i]==_205){
return true;
}
}
return false;
};
Xinha._postback_send_charset=true;
Xinha._postback=function(url,data,_20a){
var req=null;
req=Xinha.getXMLHTTPRequestObject();
var _20c="";
if(typeof data=="string"){
_20c=data;
}else{
if(typeof data=="object"){
for(var i in data){
_20c+=(_20c.length?"&":"")+i+"="+encodeURIComponent(data[i]);
}
}
}
function callBack(){
if(req.readyState==4){
if(req.status==200||Xinha.isRunLocally&&req.status==0){
if(typeof _20a=="function"){
_20a(req.responseText,req);
}
}else{
if(Xinha._postback_send_charset){
Xinha._postback_send_charset=false;
Xinha._postback(url,data,_20a);
}else{
alert("An error has occurred: "+req.statusText+"\nURL: "+url);
}
}
}
}
req.onreadystatechange=callBack;
req.open("POST",url,true);
req.setRequestHeader("Content-Type","application/x-www-form-urlencoded"+(Xinha._postback_send_charset?"; charset=UTF-8":""));
req.send(_20c);
};
Xinha._getback=function(url,_20f){
var req=null;
req=Xinha.getXMLHTTPRequestObject();
function callBack(){
if(req.readyState==4){
if(req.status==200||Xinha.isRunLocally&&req.status==0){
_20f(req.responseText,req);
}else{
alert("An error has occurred: "+req.statusText+"\nURL: "+url);
}
}
}
req.onreadystatechange=callBack;
req.open("GET",url,true);
req.send(null);
};
Xinha._geturlcontent=function(url){
var req=null;
req=Xinha.getXMLHTTPRequestObject();
req.open("GET",url,false);
req.send(null);
if(req.status==200||Xinha.isRunLocally&&req.status==0){
return req.responseText;
}else{
return "";
}
};
if(typeof dumpValues=="undefined"){
function dumpValues(o){
var s="";
for(var prop in o){
if(window.console&&typeof window.console.log=="function"){
if(typeof console.firebug!="undefined"){
console.log(o);
}else{
console.log(prop+" = "+o[prop]+"\n");
}
}else{
s+=prop+" = "+o[prop]+"\n";
}
}
if(s){
var x=window.open("","debugger");
x.document.write("<pre>"+s+"</pre>");
}
}
}
if(!Array.prototype.contains){
Array.prototype.contains=function(_217){
var _218=this;
for(var i=0;i<_218.length;i++){
if(_217==_218[i]){
return true;
}
}
return false;
};
}
if(!Array.prototype.indexOf){
Array.prototype.indexOf=function(_21a){
var _21b=this;
for(var i=0;i<_21b.length;i++){
if(_21a==_21b[i]){
return i;
}
}
return null;
};
}
if(!Array.prototype.append){
Array.prototype.append=function(a){
for(var i=0;i<a.length;i++){
this.push(a[i]);
}
return this;
};
}
Xinha.arrayContainsArray=function(a1,a2){
var _221=true;
for(var x=0;x<a2.length;x++){
var _223=false;
for(var i=0;i<a1.length;i++){
if(a1[i]==a2[x]){
_223=true;
break;
}
}
if(!_223){
_221=false;
break;
}
}
return _221;
};
Xinha.arrayFilter=function(a1,_226){
var _227=[];
for(var x=0;x<a1.length;x++){
if(_226(a1[x])){
_227[_227.length]=a1[x];
}
}
return _227;
};
Xinha.collectionToArray=function(_229){
var _22a=[];
for(var i=0;i<_229.length;i++){
_22a.push(_229.item(i));
}
return _22a;
};
Xinha.uniq_count=0;
Xinha.uniq=function(_22c){
return _22c+Xinha.uniq_count++;
};
Xinha._loadlang=function(_22d,url){
var lang;
if(typeof _editor_lcbackend=="string"){
url=_editor_lcbackend;
url=url.replace(/%lang%/,_editor_lang);
url=url.replace(/%context%/,_22d);
}else{
if(!url){
if(_22d!="Xinha"){
url=_editor_url+"plugins/"+_22d+"/lang/"+_editor_lang+".js";
}else{
Xinha.setLoadingMessage("Loading language");
url=_editor_url+"lang/"+_editor_lang+".js";
}
}
}
var _230=Xinha._geturlcontent(url);
if(_230!==""){
try{
eval("lang = "+_230);
}
catch(ex){
alert("Error reading Language-File ("+url+"):\n"+Error.toString());
lang={};
}
}else{
lang={};
}
return lang;
};
Xinha._lc=function(_231,_232,_233){
var url,ret;
if(typeof _232=="object"&&_232.url&&_232.context){
url=_232.url+_editor_lang+".js";
_232=_232.context;
}
var m=null;
if(typeof _231=="string"){
m=_231.match(/\$(.*?)=(.*?)\$/g);
}
if(m){
if(!_233){
_233={};
}
for(var i=0;i<m.length;i++){
var n=m[i].match(/\$(.*?)=(.*?)\$/);
_233[n[1]]=n[2];
_231=_231.replace(n[0],"$"+n[1]);
}
}
if(_editor_lang=="en"){
if(typeof _231=="object"&&_231.string){
ret=_231.string;
}else{
ret=_231;
}
}else{
if(typeof Xinha._lc_catalog=="undefined"){
Xinha._lc_catalog=[];
}
if(typeof _232=="undefined"){
_232="Xinha";
}
if(typeof Xinha._lc_catalog[_232]=="undefined"){
Xinha._lc_catalog[_232]=Xinha._loadlang(_232,url);
}
var key;
if(typeof _231=="object"&&_231.key){
key=_231.key;
}else{
if(typeof _231=="object"&&_231.string){
key=_231.string;
}else{
key=_231;
}
}
if(typeof Xinha._lc_catalog[_232][key]=="undefined"){
if(_232=="Xinha"){
if(typeof _231=="object"&&_231.string){
ret=_231.string;
}else{
ret=_231;
}
}else{
return Xinha._lc(_231,"Xinha",_233);
}
}else{
ret=Xinha._lc_catalog[_232][key];
}
}
if(typeof _231=="object"&&_231.replace){
_233=_231.replace;
}
if(typeof _233!="undefined"){
for(var i in _233){
ret=ret.replace("$"+i,_233[i]);
}
}
return ret;
};
Xinha.hasDisplayedChildren=function(el){
var _23a=el.childNodes;
for(var i=0;i<_23a.length;i++){
if(_23a[i].tagName){
if(_23a[i].style.display!="none"){
return true;
}
}
}
return false;
};
Xinha._loadback=function(url,_23d,_23e,_23f){
if(document.getElementById(url)){
return true;
}
var t=!Xinha.is_ie?"onload":"onreadystatechange";
var s=document.createElement("script");
s.type="text/javascript";
s.src=url;
s.id=url;
if(_23d){
s[t]=function(){
if(Xinha.is_ie&&(!(/loaded|complete/.test(window.event.srcElement.readyState)))){
return;
}
_23d.call(_23e?_23e:this,_23f);
s[t]=null;
};
}
document.getElementsByTagName("head")[0].appendChild(s);
return false;
};
Xinha.makeEditors=function(_242,_243,_244){
if(!Xinha.isSupportedBrowser){
return;
}
if(typeof _243=="function"){
_243=_243();
}
var _245={};
var _246;
for(var x=0;x<_242.length;x++){
if(typeof _242[x]=="string"){
_246=Xinha.getElementById("textarea",_242[x]);
if(!_246){
_242[x]=null;
continue;
}
}else{
if(typeof _242[x]=="object"&&_242[x].tagName&&_242[x].tagName.toLowerCase()=="textarea"){
_246=_242[x];
if(!_246.id){
_246.id="xinha_id_"+x;
}
}
}
var _248=new Xinha(_246,Xinha.cloneObject(_243));
_248.registerPlugins(_244);
_245[_246.id]=_248;
}
return _245;
};
Xinha.startEditors=function(_249){
if(!Xinha.isSupportedBrowser){
return;
}
for(var i in _249){
if(_249[i].generate){
_249[i].generate();
}
}
};
Xinha.prototype.registerPlugins=function(_24b){
if(!Xinha.isSupportedBrowser){
return;
}
if(_24b){
for(var i=0;i<_24b.length;i++){
this.setLoadingMessage(Xinha._lc("Register plugin $plugin","Xinha",{"plugin":_24b[i]}));
this.registerPlugin(_24b[i]);
}
}
};
Xinha.base64_encode=function(_24d){
var _24e="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
var _24f="";
var chr1,chr2,chr3;
var enc1,enc2,enc3,enc4;
var i=0;
do{
chr1=_24d.charCodeAt(i++);
chr2=_24d.charCodeAt(i++);
chr3=_24d.charCodeAt(i++);
enc1=chr1>>2;
enc2=((chr1&3)<<4)|(chr2>>4);
enc3=((chr2&15)<<2)|(chr3>>6);
enc4=chr3&63;
if(isNaN(chr2)){
enc3=enc4=64;
}else{
if(isNaN(chr3)){
enc4=64;
}
}
_24f=_24f+_24e.charAt(enc1)+_24e.charAt(enc2)+_24e.charAt(enc3)+_24e.charAt(enc4);
}while(i<_24d.length);
return _24f;
};
Xinha.base64_decode=function(_253){
var _254="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
var _255="";
var chr1,chr2,chr3;
var enc1,enc2,enc3,enc4;
var i=0;
_253=_253.replace(/[^A-Za-z0-9\+\/\=]/g,"");
do{
enc1=_254.indexOf(_253.charAt(i++));
enc2=_254.indexOf(_253.charAt(i++));
enc3=_254.indexOf(_253.charAt(i++));
enc4=_254.indexOf(_253.charAt(i++));
chr1=(enc1<<2)|(enc2>>4);
chr2=((enc2&15)<<4)|(enc3>>2);
chr3=((enc3&3)<<6)|enc4;
_255=_255+String.fromCharCode(chr1);
if(enc3!=64){
_255=_255+String.fromCharCode(chr2);
}
if(enc4!=64){
_255=_255+String.fromCharCode(chr3);
}
}while(i<_253.length);
return _255;
};
Xinha.removeFromParent=function(el){
if(!el.parentNode){
return;
}
var pN=el.parentNode;
pN.removeChild(el);
return el;
};
Xinha.hasParentNode=function(el){
if(el.parentNode){
if(el.parentNode.nodeType==11){
return false;
}
return true;
}
return false;
};
Xinha.viewportSize=function(_25c){
_25c=(_25c)?_25c:window;
var x,y;
if(_25c.innerHeight){
x=_25c.innerWidth;
y=_25c.innerHeight;
}else{
if(_25c.document.documentElement&&_25c.document.documentElement.clientHeight){
x=_25c.document.documentElement.clientWidth;
y=_25c.document.documentElement.clientHeight;
}else{
if(_25c.document.body){
x=_25c.document.body.clientWidth;
y=_25c.document.body.clientHeight;
}
}
}
return {"x":x,"y":y};
};
Xinha.pageSize=function(_25e){
_25e=(_25e)?_25e:window;
var x,y;
var _260=_25e.document.body.scrollHeight;
var _261=_25e.document.documentElement.scrollHeight;
if(_260>_261){
x=_25e.document.body.scrollWidth;
y=_25e.document.body.scrollHeight;
}else{
x=_25e.document.documentElement.scrollWidth;
y=_25e.document.documentElement.scrollHeight;
}
return {"x":x,"y":y};
};
Xinha.prototype.scrollPos=function(_262){
_262=(_262)?_262:window;
var x,y;
if(_262.pageYOffset){
x=_262.pageXOffset;
y=_262.pageYOffset;
}else{
if(_262.document.documentElement&&document.documentElement.scrollTop){
x=_262.document.documentElement.scrollLeft;
y=_262.document.documentElement.scrollTop;
}else{
if(_262.document.body){
x=_262.document.body.scrollLeft;
y=_262.document.body.scrollTop;
}
}
}
return {"x":x,"y":y};
};
Xinha.getElementTopLeft=function(_264){
var _265=curtop=0;
if(_264.offsetParent){
_265=_264.offsetLeft;
curtop=_264.offsetTop;
while(_264=_264.offsetParent){
_265+=_264.offsetLeft;
curtop+=_264.offsetTop;
}
}
return {top:curtop,left:_265};
};
Xinha.findPosX=function(obj){
var _267=0;
if(obj.offsetParent){
return Xinha.getElementTopLeft(obj).left;
}else{
if(obj.x){
_267+=obj.x;
}
}
return _267;
};
Xinha.findPosY=function(obj){
var _269=0;
if(obj.offsetParent){
return Xinha.getElementTopLeft(obj).top;
}else{
if(obj.y){
_269+=obj.y;
}
}
return _269;
};
Xinha.createLoadingMessages=function(_26a){
if(Xinha.loadingMessages||!Xinha.isSupportedBrowser){
return;
}
Xinha.loadingMessages=[];
for(var i=0;i<_26a.length;i++){
if(!document.getElementById(_26a[i])){
continue;
}
Xinha.loadingMessages.push(Xinha.createLoadingMessage(Xinha.getElementById("textarea",_26a[i])));
}
};
Xinha.createLoadingMessage=function(_26c,text){
if(document.getElementById("loading_"+_26c.id)||!Xinha.isSupportedBrowser){
return;
}
var _26e=document.createElement("div");
_26e.id="loading_"+_26c.id;
_26e.className="loading";
_26e.style.left=(Xinha.findPosX(_26c)+_26c.offsetWidth/2)-106+"px";
_26e.style.top=(Xinha.findPosY(_26c)+_26c.offsetHeight/2)-50+"px";
var _26f=document.createElement("div");
_26f.className="loading_main";
_26f.id="loading_main_"+_26c.id;
_26f.appendChild(document.createTextNode(Xinha._lc("Loading in progress. Please wait!")));
var _270=document.createElement("div");
_270.className="loading_sub";
_270.id="loading_sub_"+_26c.id;
text=text?text:Xinha._lc("Loading Core");
_270.appendChild(document.createTextNode(text));
_26e.appendChild(_26f);
_26e.appendChild(_270);
document.body.appendChild(_26e);
Xinha.freeLater(_26e);
Xinha.freeLater(_26f);
Xinha.freeLater(_270);
return _270;
};
Xinha.prototype.setLoadingMessage=function(_271,_272){
if(!document.getElementById("loading_sub_"+this._textArea.id)){
return;
}
document.getElementById("loading_main_"+this._textArea.id).innerHTML=_272?_272:Xinha._lc("Loading in progress. Please wait!");
document.getElementById("loading_sub_"+this._textArea.id).innerHTML=_271;
};
Xinha.setLoadingMessage=function(_273){
if(!Xinha.loadingMessages){
return;
}
for(var i=0;i<Xinha.loadingMessages.length;i++){
Xinha.loadingMessages[i].innerHTML=_273;
}
};
Xinha.prototype.removeLoadingMessage=function(){
if(document.getElementById("loading_"+this._textArea.id)){
document.body.removeChild(document.getElementById("loading_"+this._textArea.id));
}
};
Xinha.removeLoadingMessages=function(_275){
for(var i=0;i<_275.length;i++){
if(!document.getElementById(_275[i])){
continue;
}
var main=document.getElementById("loading_"+document.getElementById(_275[i]).id);
main.parentNode.removeChild(main);
}
Xinha.loadingMessages=null;
};
Xinha.toFree=[];
Xinha.freeLater=function(obj,prop){
Xinha.toFree.push({o:obj,p:prop});
};
Xinha.free=function(obj,prop){
if(obj&&!prop){
for(var p in obj){
Xinha.free(obj,p);
}
}else{
if(obj){
if(prop.indexOf("src")==-1){
try{
obj[prop]=null;
}
catch(x){
}
}
}
}
};
Xinha.collectGarbageForIE=function(){
Xinha.flushEvents();
for(var x=0;x<Xinha.toFree.length;x++){
Xinha.free(Xinha.toFree[x].o,Xinha.toFree[x].p);
Xinha.toFree[x].o=null;
}
};
Xinha.prototype.insertNodeAtSelection=function(_27e){
Xinha.notImplemented("insertNodeAtSelection");
};
Xinha.prototype.getParentElement=function(sel){
Xinha.notImplemented("getParentElement");
};
Xinha.prototype.activeElement=function(sel){
Xinha.notImplemented("activeElement");
};
Xinha.prototype.selectionEmpty=function(sel){
Xinha.notImplemented("selectionEmpty");
};
Xinha.prototype.saveSelection=function(){
Xinha.notImplemented("saveSelection");
};
Xinha.prototype.restoreSelection=function(_282){
Xinha.notImplemented("restoreSelection");
};
Xinha.prototype.selectNodeContents=function(node,pos){
Xinha.notImplemented("selectNodeContents");
};
Xinha.prototype.insertHTML=function(html){
Xinha.notImplemented("insertHTML");
};
Xinha.prototype.getSelectedHTML=function(){
Xinha.notImplemented("getSelectedHTML");
};
Xinha.prototype.getSelection=function(){
Xinha.notImplemented("getSelection");
};
Xinha.prototype.createRange=function(sel){
Xinha.notImplemented("createRange");
};
Xinha.prototype.isKeyEvent=function(_287){
Xinha.notImplemented("isKeyEvent");
};
Xinha.prototype.isShortCut=function(_288){
if(_288.ctrlKey&&!_288.altKey){
return true;
}
return false;
};
Xinha.prototype.getKey=function(_289){
Xinha.notImplemented("getKey");
};
Xinha.getOuterHTML=function(_28a){
Xinha.notImplemented("getOuterHTML");
};
Xinha.getXMLHTTPRequestObject=function(){
try{
if(typeof XMLHttpRequest!="undefined"&&typeof XMLHttpRequest.constructor=="function"){
return new XMLHttpRequest();
}else{
if(typeof ActiveXObject=="function"){
return new ActiveXObject("Microsoft.XMLHTTP");
}
}
}
catch(e){
Xinha.notImplemented("getXMLHTTPRequestObject");
}
};
Xinha.prototype._activeElement=function(sel){
return this.activeElement(sel);
};
Xinha.prototype._selectionEmpty=function(sel){
return this.selectionEmpty(sel);
};
Xinha.prototype._getSelection=function(){
return this.getSelection();
};
Xinha.prototype._createRange=function(sel){
return this.createRange(sel);
};
HTMLArea=Xinha;
Xinha.init();
if(Xinha.is_ie){
Xinha.addDom0Event(window,"unload",Xinha.collectGarbageForIE);
}
Xinha.notImplemented=function(_28e){
throw new Error("Method Not Implemented","Part of Xinha has tried to call the "+_28e+" method which has not been implemented.");
};

