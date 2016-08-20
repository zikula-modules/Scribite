{ajaxheader ui=true}
{adminheader}
{gt text='Editor list' assign='templateTitle'}
{pagesetvar name='title' value=$templateTitle}
<div class="z-admin-content-pagetitle">
    {icon type='view' size='small'}
    <h3>{$templateTitle}</h3>
</div>
<table class="z-admintable">
    <colgroup>
        <col id="cEditor" />
    </colgroup>
    <thead>
        <tr>
            <th id="hEditor" scope="col">{gt text='Installed editors'}</th>
        </tr>
    </thead>
    <tbody>
        {foreach key='key' item='editor' from=$editors}
        <tr class="{cycle values='z-odd,z-even'}">
            <td headers="hEditor">{$editor}{if $editor eq $defaulteditor} ({gt text='default editor'}){/if}</td>
        </tr>
        {/foreach}
    </tbody>
</table>
<p class="z-formnote"><em>
    <a href="{modurl modname='Extensions' type='admin' func='viewPlugins' bymodule='Scribite'}">{gt text='Manage and configure editors via module plugin list'}</a>
</em></p>
{adminfooter}
