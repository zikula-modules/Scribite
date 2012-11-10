<!-- start Scribite with TinyMCE for {$modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="javascript" value="jquery-ui"}
{pageaddvar name="stylesheet" value="modules/Scribite/style/Aristo/Aristo.css"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/TinyMCE/javascript/tinymce/tiny_mce.js"}
{pageaddvar name="stylesheet" value="modules/Scribite/javascript/DataTable/css/demo_page.css"}
{pageaddvar name="stylesheet" value="modules/Scribite/javascript/DataTable/css/demo_table.css"}
{pageaddvar name="javascript" value="modules/Scribite/javascript/DataTable/js/jquery.dataTables.js"}

{if in_array('zlink', $activeplugins)}
<div id="dialog-form" title="{gt text='Insert/edit link'}" style="text-align:left">
    Enter the destination URL<br />
    <label style="width:40px;display:inline-block;" for="url">URL</label>
    <input style="width:250px"  type="text" name="url" id="scribite-url" class="text ui-widget-content ui-corner-all" /><br />
    <label style="width:40px;display:inline-block;" for="title"">Title</label>
    <input style="width:250px" type="text" name="title" id="scribite-title" value="" class="text ui-widget-content ui-corner-all" /><br /><br />
    <a href="javascript:showExisting()">{gt text="Or link to existing content"}</a>

    <table class="display" id="example">
        <thead>
        <tr>
            <th>{gt text="Text"}</th>
            <th>{gt text="Module"}</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$links item="item"}
        <tr>
            <td><a href="javascript:returnUrl('{$item.url}', '{$item.title}')">{$item.title}</a></td>
            <td>{$item.modname}</td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>
{/if}

<script type="text/javascript">
/* <![CDATA[ */

   tinyMCE.init({
        mode : "textareas",
        theme : "{{$theme}}",
        language : "{{$language}}",
{{if isset($activeplugins) && $activeplugins != ''}}
        plugins : "{{','|implode:$activeplugins}}",
{{/if}}
        content_css : "{{$zBaseUrl}}/{{$style}}",
        cleanup : true,

{{if $theme eq "advanced"}}
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Default buttons available in the advanced theme
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,outdent,indent,cut,copy,paste,undo,redo,link,unlink,image,cleanup",
        theme_advanced_buttons2 : "code,anchor,fontselect,fontsizeselect,sub,sup,forecolor,backcolor,charmap,visualaid,blockquote,hr,removeformat,help",

        // Individual buttons configured in the module's settings
        theme_advanced_buttons3 : "{{$buttons}}",

        // TODO: I really would like to split this into multiple row, but I do not know how
        //theme_advanced_buttons3 : "{{foreach from=$buttons key=k item=tinymce_button}}{{$button}},{{/foreach}}",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
        

        plugin_insertdate_dateFormat : "{{$dateformat}}",
        plugin_insertdate_timeFormat : "{{$timeformat}}",

        paste_auto_cleanup_on_paste : true,
        paste_convert_middot_lists : true,
        paste_strip_class_attributes : "all",
        paste_remove_spans : false,
        paste_remove_styles_if_webkit : true,
{{/if}}

        valid_elements : "*[*]",
{{if isset($disallowedhtml)}}invalid_elements : "{{','|implode:$disallowedhtml}}",{{/if}}
        height : "{{$height}}",
        width : "{{$width}}",
{{if $modvars.Scribite.image_upload}}        
        file_browser_callback: "filebrowser",
        convert_urls : false
{{/if}}
        

    });

{{if $modvars.Scribite.image_upload}}
	function filebrowser(field_name, url, type, win) {
			window.SetUrl = function(fileUrl){
				win.document.forms[0].elements[field_name].value = fileUrl;
			}
			var type = type.toLowerCase();
			var filebrowser = Zikula.Config.baseURL+"index.php?module=Scribite&type=user&func=browseImages&editor=tinymc&t="+type;
			tinyMCE.activeEditor.windowManager.open({
				file : filebrowser,
				width : 600,
				height : 400,
				resizable : "yes",
				close_previous : "no"
			});
			return false;
	}
{{/if}}

    // init zlink
    var oTable = jQuery('#example').dataTable( {
        "iDisplayLength": 10,
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns": [
            /* 0. Aktionen */   null,
            null
        ],
        "oLanguage": { "sSearch": "Search" }
    } );

    jQuery(".dataTables_filter").css("text-align", "left");
    jQuery(".dataTables_filter").css("width", "100%");
    jQuery('.dataTables_length').hide();
    jQuery('#dialog-form').hide();

    function showExisting() {
        jQuery("#example_wrapper").toggle();
        if (jQuery("#example_wrapper").is(':visible')) {
            jQuery("#dialog-form").height("460px");
        } else {
            jQuery("#dialog-form").height("110px");
        }
    }

    function returnUrl(url, title)
    {
        jQuery("#scribite-url").val(url);
        jQuery("#scribite-title").val(title);
    }

/* ]]> */
</script>
<!-- End Scribite with TinyMCE for {$modname} -->