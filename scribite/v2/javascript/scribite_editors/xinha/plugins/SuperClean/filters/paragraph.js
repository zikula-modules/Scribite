/* This compressed file is part of Xinha. For uncompressed sources, forum, and bug reports, go to xinha.org */
/* The URL of the most recent version of this file is http://svn.xinha.webfactional.com/trunk/plugins/SuperClean/filters/paragraph.js */
function(_1){
_1=_1.replace(/<\s*p[^>]*>/gi,"");
_1=_1.replace(/<\/\s*p\s*>/gi,"");
_1=_1.trim();
return _1;
}

