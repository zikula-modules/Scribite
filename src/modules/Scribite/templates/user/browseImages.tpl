{gt text="Upload manager" assign=templatetitle}
{pagesetvar name='title' value=$templatetitle}

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
</script>

<h2>{$templatetitle}</h2>

{insert name='getstatusmsg'}

<p>
    <em>
        {gt text="Click to an image to include it!"}
    </em>
</p>

{foreach from=$images item="image" key='thumb'}
    <a href="javascript:returnUrl('{$baseUrl}{$modvars.Scribite.uploads_path}/{$image}')"><img src="{$baseUrl}{$thumb}"></a>
{foreachelse}
    {gt text='No images available'}
{/foreach}

{uploadImage}