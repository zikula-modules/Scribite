<!-- start Scribite with Xinha for {$modname} -->
<script type="text/javascript">
/* <![CDATA[ */
  _editor_url = '{{$zBaseUrl}}/modules/Scribite/plugins/Xinha/javascript/xinha/';
  _editor_lang = '{{$zlang}}';
  _editor_skin = '{{$skin}}';
  _editor_icons = 'Classic';
/* ]]> */
</script>
{pageaddvar name="javascript" value="modules/Scribite/plugins/Xinha/javascript/xinha/XinhaLoader.js"}


<script type="text/javascript">
/* <![CDATA[ */
    xinha_editors = null;
    xinha_init    = null;
    xinha_config  = null;
    xinha_plugins = null;

    xinha_init = xinha_init ? xinha_init : function()
    {
{{if $modareas eq 'all'}}
    xinha_editors = xinha_editors ? xinha_editors :
    document.getElementsByTagName('textarea');
{{elseif $modareas eq "PagEd"}}
    textareas = document.getElementsByTagName('textarea');
    xinha_editors = new Array();
    for(var i in textareas) {
       if(textareas[i].id && textareas[i].id != 'newingress' && textareas[i].id != 'newrelatedlinks') {
          xinha_editors.push(textareas[i].id);
       }
    }
{{else}}
      xinha_editors = xinha_editors ? xinha_editors :
       [ '{{"','"|implode:$modareas}}' ];
      // Added line for news ajax edit:
      xinha_editorsarray = [ '{{"','"|implode:$modareas}}' ];
{{/if}}

      xinha_plugins = xinha_plugins ? xinha_plugins :
      [ '{{"','"|implode:$activeplugins}}' ];

      if (!Xinha.loadPlugins(xinha_plugins, xinha_init)) {
        return;
      }

      xinha_config = xinha_config ? xinha_config() : new Xinha.Config();
      xinha_config.width  = '{{$width}}{{if $width ne 'auto'}}px{{/if}}';
      xinha_config.height = '{{$height}}{{if $height ne 'auto'}}px{{/if}}';
      xinha_config.charSet = '{{charset}}';
      xinha_config.baseURL = '{{$zBaseUrl}}/';
      xinha_config.browserQuirksMode = false;
      xinha_config.stripBaseHref = true;
      xinha_config.killWordOnPaste = true;
      xinha_config.flowToolbars = true;
      xinha_config.stripSelfNamedAnchors = false;
      xinha_config.stripScripts = true;
      xinha_config.sizeIncludesBars = true;
      xinha_config.pageStyleSheets = ['{{$zBaseUrl}}/{{$style}}'];
      xinha_config.statusBar = {{if $statusbar}}true;{{else}}false;{{/if}}
      xinha_config.showLoading = {{if $showloading}}true;{{else}}false;{{/if}}
      xinha_config.convertUrlsToLinks = {{if $converturls}}true;{{else}}false;{{/if}}
      xinha_config.pageStyle = '';

      if(typeof DynamicCSS != 'undefined') {
          xinha_config.pageStyle = xinha_config.pageStyle + "\n" + "@import url('{{$zBaseUrl}}/{{$style_dynamiccss}}');";
      }
      if(typeof Stylist != 'undefined') {
          xinha_config.stylistLoadStylesheet('{{$zBaseUrl}}/{{$style_stylist}}');
      }

{{* atm false but left in code for future use *}}
{{* if $EFMConfig}}
      xinha_config.ExtendedFileManager.use_linker = true;
      if (xinha_config.ExtendedFileManager) {
        with (xinha_config.ExtendedFileManager) {
{{modapifunc modname='Scribite' type='user' func='getEFMConfig'}}
        }
      }
{{/if *}}

{{if $barmode eq "reduced"}}
{{include file="editorheaders/xinha/toolbar_reduced.tpl"}}
{{/if}}
{{if $barmode eq "mini"}}
{{include file="editorheaders/xinha/toolbar_mini.tpl"}}
{{/if}}

{{if $modname eq "News"}}
      xinha_config.registerButton({
        id        : "pagebreak_news",
        tooltip   : "Insert pagebreak for News module",
        image     : "modules/Scribite/images/pagebreak.gif",
        textMode  : false,
        action:
          function(editor, id)
          {
            editor.insertHTML("<div class=\"pagebreak\"><\/div><!--pagebreak-->");
          }
      });
      xinha_config.toolbar[xinha_config.toolbar.length-1].push("pagebreak_news");
      xinha_config.pageStyle = xinha_config.pageStyle + "\n" + "@import url('{{$zBaseUrl}}/modules/Scribite/plugins/Xinha/style/pagebreak.css');";
{{/if}}

{{if $modname eq "Pages"}}
      xinha_config.registerButton({
        id        : "pagebreak_pages",
        tooltip   : "Insert pagebreak for Pages module",
        image     : "modules/Scribite/images/pagebreak.gif",
        textMode  : false,
        action:
          function(editor, id)
          {
        editor.insertHTML("<div class=\"pagebreak\"><\/div><!--pagebreak-->");
          }
      });
      xinha_config.toolbar[xinha_config.toolbar.length-1].push("pagebreak_pages");
      xinha_config.pageStyle = xinha_config.pageStyle + "\n" + "@import url('{{$zBaseUrl}}/modules/Scribite/plugins/Xinha/style/pagebreak.css');";
{{/if}}

      xinha_editors   = Xinha.makeEditors(xinha_editors, xinha_config, xinha_plugins);
      Xinha.startEditors(xinha_editors);
    }

Event.observe(window, 'load', xinha_init);

/* ]]> */
</script>
<!-- end Scribite with Xinha -->