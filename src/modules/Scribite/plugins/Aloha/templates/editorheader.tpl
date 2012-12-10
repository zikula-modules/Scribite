<!-- start Scribite with Aloha for {$modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="stylesheet" value="http://cdn.aloha-editor.org/latest/css/aloha.css"}
{pageaddvar name="javascript" value="http://cdn.aloha-editor.org/latest/lib/require.js"}


<!-- load the Aloha Editor core and some plugins -->
<script src="http://cdn.aloha-editor.org/latest/lib/aloha.js"
                    data-aloha-plugins="common/ui,
                                         common/format,
                                         common/list,
                                         common/link,
                                         common/highlighteditables">
</script>


<!-- make all elements with class="editable" editable with Aloha Editor -->
<script type="text/javascript">
      Aloha.ready( function() {
             var $ = Aloha.jQuery;
                          
             {{if $modareas eq "all"}}
             $('textarea').aloha();
             {{else}}
             {{foreach from=$modareas item=area}}
             $('#{{$area}}').aloha();
             {{/foreach}}
             {{/if}}
      });
</script>

<!-- end Scribite with Aloha -->