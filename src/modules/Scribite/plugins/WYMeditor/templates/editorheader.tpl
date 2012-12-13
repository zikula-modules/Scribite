<!-- start Scribite with wymeditor for {$Scribite.modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/WYMeditor/vendor/wymeditor/jquery.wymeditor.min.js"}

<!-- make all elements with class="editable" editable wymeditor Aloha Editor -->
<script type="text/javascript">
    jQuery(function() {
        {{if $Scribite.modareas eq "all"}}
        jQuery('textarea').wymeditor();
        {{else}}
        {{foreach from=$Scribite.modareas item=area}}
        jQuery('#{{$area}}').wymeditor({
            lang: '{{$lang}}'   
        });
        {{/foreach}}
        {{/if}}
    });
</script>
<!-- end Scribite with wymeditor -->