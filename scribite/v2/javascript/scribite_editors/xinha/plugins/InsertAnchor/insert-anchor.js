/* This compressed file is part of Xinha. For uncompressed sources, forum, and bug reports, go to xinha.org */
/* The URL of the most recent version of this file is http://svn.xinha.webfactional.com/trunk/plugins/InsertAnchor/insert-anchor.js */
function InsertAnchor(_1){
this.editor=_1;
var _2=_1.config;
var _3=this;
_2.registerButton({id:"insert-anchor",tooltip:this._lc("Insert Anchor"),image:_1.imgURL("insert-anchor.gif","InsertAnchor"),textMode:false,action:function(_4){
_3.buttonPress(_4);
}});
_2.addToolbarElement("insert-anchor","createlink",1);
}
InsertAnchor._pluginInfo={name:"InsertAnchor",origin:"version: 1.0, by Andre Rabold, MR Printware GmbH, http://www.mr-printware.de",version:"2.0",developer:"Udo Schmal",developer_url:"http://www.schaffrath-neuemedien.de",c_owner:"Udo Schmal",sponsor:"L.N.Schaffrath NeueMedien",sponsor_url:"http://www.schaffrath-neuemedien.de",license:"htmlArea"};
InsertAnchor.prototype._lc=function(_5){
return Xinha._lc(_5,"InsertAnchor");
};
InsertAnchor.prototype.onGenerate=function(){
this.editor.addEditorStylesheet(_editor_url+"plugins/InsertAnchor/insert-anchor.css");
};
InsertAnchor.prototype.buttonPress=function(_6){
var _7=null;
var _8=_6.getSelectedHTML();
var _9=_6._getSelection();
var _a=_6._createRange(_9);
var a=_6._activeElement(_9);
if(!(a!=null&&a.tagName.toLowerCase()=="a")){
a=_6._getFirstAncestor(_9,"a");
}
if(a!=null&&a.tagName.toLowerCase()=="a"){
_7={name:a.id};
}else{
_7={name:""};
}
_6._popupDialog("plugin://InsertAnchor/insert_anchor",function(_c){
if(_c){
var _d=_c["name"];
if(_d==""||_d==null){
if(a){
var _e=a.innerHTML;
a.parentNode.removeChild(a);
_6.insertHTML(_e);
}
return;
}
try{
var _f=_6._doc;
if(!a){
a=_f.createElement("a");
a.id=_d;
a.name=_d;
a.title=_d;
a.className="anchor";
a.innerHTML=_8;
if(Xinha.is_ie){
_a.pasteHTML(a.outerHTML);
}else{
_6.insertNodeAtSelection(a);
}
}else{
a.id=_d;
a.name=_d;
a.title=_d;
a.className="anchor";
}
}
catch(e){
}
}
},_7);
};

