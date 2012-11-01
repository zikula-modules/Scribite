{ajaxheader ui=true}
{adminheader}

{pageaddvarblock}
<script type="text/javascript">
    document.observe("dom:loaded", function() {
        Zikula.UI.Tooltips($$('.tooltips'));
    });
</script>
{/pageaddvarblock}

<div class="z-admin-content-pagetitle">
    {icon type="view" size="small"}
    <h3>{gt text='Editor list'}</h3>
</div>

<table class="z-admintable">
    <thead>
        <tr>
            <th>{gt text="Availble editors"}</th>
        </tr>
    </thead>
    <tbody>
        {foreach item="editor" key="key" from=$editors}
        <tr class="{cycle values="z-odd,z-even"}">
            <td><a href="{modurl modname='Scribite' type='admin' func='modifyeditor' editor=$key}">{$editor}</a> {if $editor eq $defaulteditor}({gt text="default editor"}){/if}</td>
        </tr>
        {/foreach}
    </tbody>
</table>
{adminfooter}