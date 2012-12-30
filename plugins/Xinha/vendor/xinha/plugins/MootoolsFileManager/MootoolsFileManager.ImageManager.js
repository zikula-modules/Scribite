/**
  = Mootools File Manager =
  == Image Manager ==
  
  The functions in this file extend the MootoolsFileManager plugin with support
  for managing images.  This file is loaded automatically.
     
 * @author $Author$
 * @version $Id$
 * @package MootoolsFileManager
 */


/** Open the Image Manager version of the plugin.
 *
 *  Called from the _insertImage method of the editor (see the hookup in MootoolsFileManager.js)
 *  Optional image for future external use.
 */
 
MootoolsFileManager.prototype.OpenImageManager = function(image)
{
  var editor = this.editor;  // for nested functions
  var self   = this;
  var outparam = null;
  
  if (typeof image == "undefined") 
  {
    image = editor.getParentElement();
    if (image && !/^img$/i.test(image.tagName))
    {
      image = null;
    }
  }

  if ( image )
  {
    outparam =
      {
        f_url    : Xinha.is_ie ? image.src : image.src,
        f_alt    : image.alt,
        f_border : image.style.borderWidth ? image.style.borderWidth : image.border,
        f_align  : image.hasAttribute('align') ? image.align : null,
        f_padding: image.style.padding,
        f_margin : image.style.margin,
        f_width  :  image.hasAttribute('width') ? image.width : null,
        f_height  : image.hasAttribute('height') ? image.height : null,
        f_backgroundColor: image.style.backgroundColor,
        f_borderColor: image.style.borderColor,
        f_hspace:  image.hspace && image.hspace != '-1' ? parseInt(image.hspace) : null,
        f_vspace: image.vspace && image.vspace != '-1' ? parseInt(image.vspace) : null
      };

    outparam.f_border  = this.shortSize(outparam.f_border);
    outparam.f_padding = this.shortSize(outparam.f_padding);
    outparam.f_margin  = this.shortSize(outparam.f_margin);
        
    outparam.f_backgroundColor = this.convertToHex(outparam.f_backgroundColor);
    outparam.f_borderColor = this.convertToHex(outparam.f_borderColor);
  }
   
  this.current_image        = image;
  this.current_attributes   = outparam;
  
  if(!this.ImageManagerWidget)
  {
    this.ImageManagerWidget = new FileManager({
      url:            this.editor.config.MootoolsFileManager.backend+'__function=image-manager&',
      assetBasePath:  Xinha.getPluginDir('MootoolsFileManager')+'/mootools-filemanager/Assets',
      language:       _editor_lang,
      selectable:     true,
      upload:         this.phpcfg.allow_images_upload,
      uploadAuthData: this.editor.config.MootoolsFileManager.backend_data,
      onComplete:     function(path, file) { self.ImageManagerReturn(path,file); },
      onHide:         function() { if(this.swf && this.swf.box) this.swf.box.style.display = 'none'; },
      onShow:         function() { if(this.swf && this.swf.box) this.swf.box.style.display = ''; },
      onDetails:      function(details) 
                      {                                                 
                        this.info.adopt(self.ImageManagerAttributes(details)); 
                        return true;
                      },
      onHidePreview:  function()
                      {                        
                        $(self.ImageManagerAttributes().table).dispose();
                        return true;
                      }
    });        
  }
  
  this.ImageManagerWidget.show();    
};

/** Return a DOM fragment which has all the fields needed to set the
 *  attributes for an image given a structure of initial values.
 * 
 *  OR return a structure of values taken from the currently table.
 */
 
MootoolsFileManager.prototype.ImageManagerAttributes = function (details)
{

  var self = this;
  self._LastImageDetails = details;
  
  function f(name)
  {
    var e = self._ImageManagerAttributesTable.getElementsByTagName('input');
    for(var i = 0; i < e.length; i++)
    {
      if(e[i].name == name) return e[i];
    }
    
    var e = self._ImageManagerAttributesTable.getElementsByTagName('select');
    for(var i = 0; i < e.length; i++)
    {
      if(e[i].name == name) return e[i];
    }
    
    return null;    
  }
  
  function s(name, value)
  {
    for(var i = 0; i < f(name).options.length; i++)
    {
      if(f(name).options[i].value == value) 
      {
       // f(name).options[i].selected = true;
        f(name).selectedIndex = i;
      }
    }
  }
  
  if(!this._ImageManagerAttributesTable)
  {
    this._ImageManagerAttributesTable = (function() {
      var table = document.createElement('table');
      table.className = 'filemanager-extended-options';
      var tbody = table.appendChild(document.createElement('tbody'));
      
      { // Description
        var tr    = tbody.appendChild(document.createElement('tr'));
        var th    = tr.appendChild(document.createElement('th'));
        var label = th.appendChild(document.createTextNode('Description:'));
        
        var td    = tr.appendChild(document.createElement('td'));
        var input = td.appendChild(document.createElement('input'));
        
        td.colSpan   = 6;
        input.name   = 'f_alt';
        input.type = 'text';
        th.className = td.className = 'filemanager-f_alt';      
      }
      
      { // Width, Constrain, Margin, 
        var tr    = tbody.appendChild(document.createElement('tr'));
        
        { // Width        
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Width:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          
          input.name   = 'f_width';
          input.size = 4;    
          input.type = 'text';
          // @TODO Constrain Ratio
          th.className = td.className = 'filemanager-f_width';      
        }
        
        { // Constrain        
          
          var td    = tr.appendChild(document.createElement('td'));
          td.rowSpan = 2;
          
          var div   = td.appendChild(document.createElement('div'));
          div.style.position = 'relative';
          
          var img   = div.appendChild(document.createElement('img'));
          img.src   = '/plugins/ImageManager/img/locked.gif';
          img.width = 25;
          img.height = 32;
          img.alt = 'Constrain Proportions';
          img.style.verticalAlign = 'middle';
                  
          var input = document.createElement('input');
          input.type = 'checkbox';
          input.name = 'f_constrain';                  
          input.style.position = 'absolute';
          input.style.top = '8px';
          input.style.left = '0px';
          input.value = 'on';        
          input.checked = true;
          div.appendChild(input);        
          
          td.className = 'filemanager-f_constrain';      
          
        }
        
        if(self.phpcfg.UseHSpaceVSpace)      
        { // HSPACE/VSPACE        
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Margin:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          input.name   = 'f_hspace';
          input.size = 3;    
          input.type = 'text';
          
          td.appendChild(document.createTextNode(' x '));        
          var input = td.appendChild(document.createElement('input'));
          input.name   = 'f_vspace';
          input.size = 3;    
          input.type = 'text';
          td.appendChild(document.createTextNode(' px '));               
          th.className = td.className = 'filemanager-f_hspace filemanager-f_vspace';      
        }
        else
        {
          // Margin      
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Margin:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          input.name   = 'f_margin';
          input.size = 3;    
          input.type = 'text';
          td.appendChild(document.createTextNode(' px '));        
          th.className = td.className = 'filemanager-f_margin';    
        }
      }
      
      { // Height, Padding, Colour  
        var tr    = tbody.appendChild(document.createElement('tr'));
        
        { // Height
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Height:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          
          input.name   = 'f_height';
          input.size = 4;    
          input.type = 'text';
          // @TODO Constrain Ratio
          th.className = td.className = 'filemanager-f_width';      
        }
              
        { // Padding      
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Padding:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          input.name   = 'f_padding';
          input.size = 3;    
          input.type = 'text';
          td.appendChild(document.createTextNode(' px '));        
          th.className = td.className = 'filemanager-f_padding';    
        }
        
        { // Padding Colour (Background) 
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Colour:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          input.name   = 'f_backgroundColor';
          input.size = 7;    
          input.type = 'text';        
          new Xinha.colorPicker.InputBinding(input);
          th.className = td.className = 'filemanager-f_backgroundColor';    
        }
      }
      
      { // Alignment, Border, Colour  
        var tr    = tbody.appendChild(document.createElement('tr'));
        
        { // Alignment
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Alignment:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          td.colSpan = 2;
          var input = td.appendChild(document.createElement('select'));
          
          input.name   = 'f_align';
          input.title = 'Positioning of this image';
          input.options[0] = new Option('', true, true);
          input.options[1] = new Option('Left');
          input.options[2] = new Option('Right');
          input.options[3] = new Option('Top');
          input.options[4] = new Option('Middle');
          input.options[5] = new Option('Bottom');
          
          // @TODO Constrain Ratio
          th.className = td.className = 'filemanager-f_align';              
        }
              
        { // Border      
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Border:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          input.name   = 'f_border';
          input.size = 3;    
          input.type = 'text';
          td.appendChild(document.createTextNode(' px '));        
          th.className = td.className = 'filemanager-f_border';    
        }
        
        { // Border Colour
          var th    = tr.appendChild(document.createElement('th'));
          var label = th.appendChild(document.createTextNode('Colour:'));
          
          var td    = tr.appendChild(document.createElement('td'));
          var input = td.appendChild(document.createElement('input'));
          input.name   = 'f_borderColor';
          input.size = 7;    
          input.type = 'text';               
          new Xinha.colorPicker.InputBinding(input);
          th.className = td.className = 'filemanager-f_borderColor';    
        }
      }
      
      var div = document.createElement('div');
      var h2 = document.createElement('h2');
      h2.appendChild(document.createTextNode('Image Attributes'));
      div.appendChild(h2);
      div.appendChild(table);
      return div;
    })();
    
    
    f('f_width').onkeyup = function()
    {
      if(!f('f_constrain').checked) return true;
      if(!f('f_width').value) 
      {
        f('f_width').value = '';
        f('f_height').value = '';
      }
      else if(f('f_height').value && self._LastImageDetails)
      {
        f('f_height').value = self.ScaleImage(self._LastImageDetails, { width: f('f_width').value, height: null }).height;
      }                
      else if(!self._LastImageDetails)
      {
        f('f_height').value = '';
      }
      return true;
    }
    
    f('f_height').onkeyup = function()
    {
      if(!f('f_constrain').checked) return true;
      if(!f('f_height').value) 
      {
        f('f_width').value = '';
        f('f_height').value = '';
      }
      else if(f('f_width').value && self._LastImageDetails)
      {
        f('f_width').value = self.ScaleImage(self._LastImageDetails, { width: null, height: f('f_height').value }).width;
      }                
      else if(!self._LastImageDetails)
      {
        f('f_width').value = '';
      }
      return true;
    }
    
    f('f_constrain').onclick = function()
    {
      if(this.checked && f('f_width').value && f('f_height').value)
      {
        var new_dim = self.ScaleImage(self._LastImageDetails, { width:f('f_width').value, height:f('f_height').value });
        f('f_width').value = new_dim.width;
        f('f_height').value = new_dim.height;
      }        
    }
  }
  
  if(this.current_attributes)
  {
    f('f_alt').value    = this.current_attributes.f_alt;
    f('f_border').value = this.current_attributes.f_border;
    s('f_align', this.current_attributes.f_align);
    f('f_padding').value = this.current_attributes.f_padding;
    if(f('f_margin')) f('f_margin').value = this.current_attributes.f_margin;
    f('f_backgroundColor').value = this.current_attributes.f_backgroundColor;
    f('f_borderColor').value = this.current_attributes.f_borderColor;    
    if(f('f_hspace')) f('f_hspace').value  = this.current_attributes.f_hspace;
    if(f('f_vspace')) f('f_vspace').value = this.current_attributes.f_vspace;    
    f('f_width').value  = this.current_attributes.f_width ? this.current_attributes.f_width : '';
    f('f_height').value = this.current_attributes.f_height ? this.current_attributes.f_height : '';
    
    this.current_attributes = null;
  }
  
  // If no details were supplied, we return the current ones
  if(!details) 
  {
    var details = {
      f_alt:    f('f_alt').value,
      f_border: f('f_border').value,
      f_align:  f('f_align').options[f('f_align').selectedIndex].value,
      f_padding: f('f_padding').value,
      f_margin:  f('f_margin') ? f('f_margin').value : null,
      f_backgroundColor: f('f_backgroundColor').value,
      f_borderColor: f('f_borderColor').value,
      f_hspace: f('f_hspace') ? f('f_hspace').value : null,
      f_vspace: f('f_vspace') ? f('f_vspace').value : null,
      f_width:  f('f_width').value,
      f_height: f('f_height').value,
      
      table: this._ImageManagerAttributesTable
    }
    
    return details;
  }
  
  // If details were supplied, we set the appropriate ones.  
  if(
      (f('f_width').value  && f('f_width').value  != details.width)   
   || (f('f_height').value && f('f_height').value != details.height)   
  )
  {
    new Dialog('This image is a different size, would you like to use the new size?', {
      language: {        
        confirm: 'Shrink/Grow To Fit',        
        decline: 'Fullsize'
      },
        
      buttons: [
        'confirm',
        'decline'
      ],
      
      onConfirm: function(){
        if(f('f_constrain').checked)
        {
          var new_size = self.ScaleImage(details, {width: f('f_width').value, height: f('f_height').value});
          
          f('f_width').value = f('f_width').value   ? new_size.width : '';
          f('f_height').value = f('f_height').value ? new_size.height : '';
        }
      },
      
      onDecline: function(){
        f('f_width').value = '';
        f('f_height').value = '';
      }
    });
  }
  
  f('f_align').style.visibility = ''; // Ensure that the select hasn't been hidden by an overlay and not put back
  
  return this._ImageManagerAttributesTable;
};

/** Handle the "Select" return from the File Manager, inserting or updating an 
 * image as appropriate.  Calles ImageManagerAttributes() with  no arguments
 * to find out the attributes to set.
 */
 
MootoolsFileManager.prototype.ImageManagerReturn = function(path, file)
{
  var editor = this.editor;
  var self   = this;
  var image  = this.current_image;
  
  var param = self.ImageManagerAttributes();  
  param.f_url = path;
  
  var img = image;
  if (!img) {
    if (Xinha.is_ie) {
      var sel = editor._getSelection();
      var range = editor._createRange(sel);
      editor._doc.execCommand("insertimage", false, param.f_url);
      img = range.parentElement();
      // wonder if this works...
      if (img.tagName.toLowerCase() != "img") {
        img = img.previousSibling;
      }
    } else {
      img = document.createElement('img');
      img.src = param.f_url;
      editor.insertNodeAtSelection(img);
    }
  } else {      
    img.src = param.f_url;
  }

  for (field in param) {
    var value = param[field];
    // @TODO: Add ability to mfm for this to be possible.
    switch (field) {
        case "f_alt"    : img.alt  = value; break;
        case "f_border" :
        if(value.length)
        {           
          img.style.borderWidth = /[^0-9]/.test(value) ? value :  (parseInt(value) + 'px');
          if(img.style.borderWidth && !img.style.borderStyle)
          {
            img.style.borderStyle = 'solid';
          }
        }
        else
        {
          img.style.borderWidth = '';
          img.style.borderStyle = '';
        }
        break;
        
        case "f_borderColor": img.style.borderColor = value; break;
        case "f_backgroundColor": img.style.backgroundColor = value; break;
          
        case "f_padding": 
        {
          if(value.length)
          {
            img.style.padding = /[^0-9]/.test(value) ? value :  (parseInt(value) + 'px'); 
          }
          else
          {
            img.style.padding = '';
          }
        }
        break;
        
        case "f_margin": 
        {
          if(value.length)
          {
            img.style.margin = /[^0-9]/.test(value) ? value :  (parseInt(value) + 'px'); 
          }
          else
          {
            img.style.margin = '';
          }
        }
        break;
        
        case "f_align"  : if(img.align && img.align !== true) { img.align  = value; } else { img.removeAttribute('align'); } break;
          
        case "f_width" : 
        {
          if(!isNaN(parseInt(value))) { img.width  = parseInt(value); } else { img.removeAttribute('width'); }
        }
        break;
        
        case "f_height":
        {
          if(!isNaN(parseInt(value))) { img.height = parseInt(value); } else { img.removeAttribute('height'); }
        }
        break;
        
        case "f_hspace" : 
        {
          if(!isNaN(parseInt(value))) { img.hspace  = parseInt(value); } else { img.removeAttribute('hspace'); }
        }
        break;
        
        case "f_vspace" : 
        {
          if(!isNaN(parseInt(value))) { img.vspace  = parseInt(value); } else { img.removeAttribute('vspace'); }
        }
        break;
    }
  }
};

