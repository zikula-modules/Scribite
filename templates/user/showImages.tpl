<div id="images">
{foreach from=$images item="image" key='thumb'}
    <a href="javascript:returnUrl('{$baseUrl}{$modvars.Scribite.upload_path}/{$image}')"><img src="{$baseUrl}{$thumb}"></a>
{foreachelse}
    {gt text='No images available'}
{/foreach}
</div>