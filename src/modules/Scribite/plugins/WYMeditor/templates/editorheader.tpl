<!-- start Scribite with wymeditor for {$modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/WYMeditor/vendor/wymeditor/jquery.wymeditor.min.js"}

<!-- make all elements with class="editable" editable wymeditor Aloha Editor -->
<script type="text/javascript">

    jQuery(function() {
        {{if $modareas eq "all"}}
        jQuery('textarea').wymeditor();
        {{else}}
        {{foreach from=$modareas item=area}}
        jQuery('#{{$area}}').wymeditor({
            lang: '{{lang}}'   
        });
        {{/foreach}}
        {{/if}}
       
    });

</script>

<!-- end Scribite with wymeditor -->