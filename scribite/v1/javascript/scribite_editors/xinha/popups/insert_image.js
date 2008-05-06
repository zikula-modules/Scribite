// Called when the user clicks on "InsertImage" button.  If an image is already
// there, it will just modify it's properties.
Xinha.prototype._insertImage = function(image)
{
  var editor = this;	// for nested functions
  var outparam = null;
  if ( typeof image == "undefined" )
  {
    image = this.getParentElement();
    if ( image && image.tagName.toLowerCase() != 'img' )
    {
      image = null;
    }
  }
  if ( image )
  {
    outparam =
    {
      f_base   : editor.config.baseHref,
      f_url    : Xinha.is_ie ? editor.stripBaseURL(image.src) : image.getAttribute("src"),
      f_alt    : image.alt,
      f_border : image.border,
      f_align  : image.align,
      f_vert   : image.vspace,
      f_horiz  : image.hspace
    };
  }
  this._popupDialog(
    editor.config.URIs.insert_image,
    function(param)
    {
      // user must have pressed Cancel
      if ( !param )
      {
        return false;
      }
      var img = image;
      if ( !img )
      {
        if ( Xinha.is_ie )
        {
          var sel = editor._getSelection();
          var range = editor._createRange(sel);
          editor._doc.execCommand("insertimage", false, param.f_url);
          img = range.parentElement();
          // wonder if this works...
          if ( img.tagName.toLowerCase() != "img" )
          {
            img = img.previousSibling;
          }
        }
        else
        {
          img = document.createElement('img');
          img.src = param.f_url;
          editor.insertNodeAtSelection(img);
          if ( !img.tagName )
          {
            // if the cursor is at the beginning of the document
            img = range.startContainer.firstChild;
          }
        }
      }
      else
      {
        img.src = param.f_url;
      }

      for ( var field in param )
      {
        var value = param[field];
        switch (field)
        {
          case "f_alt":
            img.alt = value;
          break;
          case "f_border":
            img.border = parseInt(value || "0", 10);
          break;
          case "f_align":
            img.align = value;
          break;
          case "f_vert":
            img.vspace = parseInt(value || "0", 10);
          break;
          case "f_horiz":
            img.hspace = parseInt(value || "0", 10);
          break;
        }
      }
    },
    outparam);
};
