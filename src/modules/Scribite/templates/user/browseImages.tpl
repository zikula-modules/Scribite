<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{lang}" dir="{langdirection}">
<html>
    <head>
        {gt text="Upload manager" assign=templatetitle}
        <title>{$templatetitle}</title>
        <meta http-equiv="Content-Type" content="text/html; charset={charset}" />
        <meta http-equiv="X-UA-Compatible" content="chrome=1" />
        {$jcssConfig}
        <script type="text/javascript" src="{$baseurl}javascript/ajax/proto_scriptaculous.combined.min.js"></script>
        <script type="text/javascript" src="{$baseurl}javascript/helpers/Zikula.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            function param(name){
                var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
                return (results && results[1]) || 0;
            }
        
            function returnUrl(url)
            {
                if( param('editor') == 'tinymc') {
                    window.top.opener.SetUrl( encodeURI( url ) ) ;
                    window.top.close() ;
                } else if ( param('editor') == 'ckeditor' ) {
                    window.opener.CKEDITOR.tools.callFunction(param('CKEditorFuncNum'), url);
                    window.close();
                }
            }
            
            function updateImages() {
         
                 pars = '';
                 var myAjax = new Zikula.Ajax.Request(
                     Zikula.Config.baseURL + "ajax.php?module=Scribite&func=showImages",
                     {
                         method: 'post',
                         parameters: pars,
                         onComplete: function(req) {
                 
                             // show error if necessary
                             if (!req.isSuccess()) {
                                 Zikula.showajaxerror(req.getMessage());
                                 return;
                             }
                 
                             var msg = req.getData();
                             $('images').replace(msg.data);
                         }.bind(this)
                     }   
                 ); 
            }

        </script>
        
        <h2>{$templatetitle}</h2>
        
        {insert name='getstatusmsg'}
        
        <p>
            <em>
                {gt text="Click to an image to include it!"}
            </em>
        </p>
        
        <div id="images"></div>
        
        
        {if $allowToUpload}
        <br /><br />
        <form class="z-gap z-form" id="file_upload_form" enctype="multipart/form-data" action="{modurl modname='Scribite' func='uploadImage' type='User'}" method="post" target="upload_target" onsubmit="updateImages();">
            <fieldset>
                <legend>{gt text='Upload'}</legend>
                <div class="z-formrow">
                    <label for="file">{gt text='Upload image:'}</label>
                    <input id='file' name="file" type="file" />
                </div>
        
                <div class="z-formbuttons z-buttons">
                {button src='button_ok.png' set='icons/extrasmall' __alt='Upload' __title='Upload' __text='Upload'}
                </div>
                       
            </fieldset>
        
            <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;" onload="updateImages()"></iframe>
        </form>
        {else}
        <script type="text/javascript">
            updateImages();
        </script>
        {/if}

    
    </body>

</html>