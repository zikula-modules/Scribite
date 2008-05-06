<?php
if (($useraccessto["pages"]=="noaccess") and ($useraccessto["all"]!="fullaccess")){
	include (_PAGEDINCLUDE."/noaccess.php");
}
else{
	$accesstothistitle = "yes";
	$sourcefolder = "pictures";
	$resultfolder = "editorpics";
	$editorimagesmaxsize = 100;
	$iconname = "newpage";
	
	if ($setpagecontentitem == "newpage"){
		$headertext = _createpagecontentheader;
		$showhelpvariable = "_createpagecontentheader";
		$panelrequester = "create_newpagelayout";
		$returnopvalue = "submit_pagecontent";
		$isnewsswitch = 0;
		$unixtimestamp = 0;
		$getnumsections_result = mysql_query("select num_sections, topic_id, language from ".$prefix."_paged_titles where page_id=".$page_id);
		list($numsections, $pagetopic_id, $pagelanguage) = mysql_fetch_row($getnumsections_result);
	}
	else{
		$getheader_result = mysql_query("select isnews_switch, topic_id, language, title, archive_identifier, ingress, num_sections, page_author, pageauthor_name, unix_timestamp, related_links from ".$prefix."_paged_titles where page_id=".$page_id);
		list($isnewsswitch, $pagetopic_id, $pagelanguage, $title, $archiveidentifier, $ingress, $numsections, $pageauthor, $pageauthorname, $unixtimestamp, $relatedlinks) = mysql_fetch_row($getheader_result);
		$headertext = _editpagecontentheader.":&nbsp;\"".$title."\"";
		$showhelpvariable = "_editpagecontentheader";
		$panelrequester = "page_manager";
		$returnopvalue = "update_pagecontent";
		$accesstothistitle = &PagEd_check_pagepermission($useraccessto, $pagetopic_id, $pageauthor, "yes");
	}
	
	// NEW PAGE PERMISSIONS CODE
	if ($accesstothistitle == ("yes")){
		// DETERMINE WHETHER TO SHOW LANGUAGE SELECTOR: IF NO TOPIC SET, OR TOPIC SET IS MULTILINGUAL 
		$showlanguageselector = "yes";
		if ($pagetopic_id>0){
			$gettopiclanguage_result = mysql_query("select topic_language from ".$prefix."_paged_topics where topic_id = ".$pagetopic_id);
			list($topiclanguage) = mysql_fetch_row($gettopiclanguage_result);
			if ($topiclanguage!="all"){
				$showlanguageselector = "no";
			}
		}
		
		$linefeedswitch = 1;
		PagEd_panel_header($ModName, $prefix, $subpanelcount, $pagedcolorandimagejs, $showhelp, $showhelplanguage, $panelrequester, $showhelpvariable, $pagedmainurls, $panelrequester, $useraccessto, $iconswitch, $iconname, $smallpanelswitch, $modulebackgroundcolor, $modulefontcolor, $headertext, $paddingvalue, $linefeedswitch, $setstringfamily);
		// DISPLAY AS NEWS ON FRONTPAGE?	
		if (($useraccessto["news"]!="noaccess") or ($useraccessto["all"]=="fullaccess")){
			PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_newstoggle", $pagedmainurls, _newstoggle, $modulefontcolor, $setstringfamily);
			PagEd_start_colspancells(4);
			PagEd_simplenarrowtable_start(0);
			PagEd_rowcell_top("left");
			PagEd_input_checkbox($modulebackgroundcolor, "newisnewsswitch", $isnewsswitch, 0);
			PagEd_cellendstart_top($modulebackgroundcolor);
			PagEd_stringdisplay(_setasnewsprompt, 12, $modulefontcolor, $setstringfamily);
			PagEd_cellrowtableend();
			PagEd_cellrowend();
		}
		
		if ($setpagecontentitem == "oldpage"){
			$dateselectrequester = "articleupdatedtime";
			PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_pagedupdatetimestamp", $pagedmainurls, _pagedupdatetimestamp, $modulefontcolor, $setstringfamily);
			PagEd_start_colspancells(4);
			PagEd_simplenarrowtable_start(0);
			echo "<tr><td width=\"150\" valign=\"top\" align=\"left\">";
			PagEd_select_date($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, $showhelpvariable, $pagedmainurls, "newupdated", $unixtimestamp, $dateselectrequester);
			PagEd_cellendstart_top($modulebackgroundcolor);
			PagEd_stringdisplay(_pagednewenteredtimestampinfo."&nbsp;", 12, $modulefontcolor, $setstringfamily);
			PagEd_cellend_tablereturn();
			PagEd_start_colspancells(2);
			PagEd_input_checkbox($modulebackgroundcolor, "newupdatetimestamp", 0, 0);
			PagEd_stringdisplay(_pagedupdatetimestampinfo."&nbsp;", 12, $modulefontcolor, $setstringfamily);
			PagEd_cellrowtableend();
			PagEd_cellrowend();
		}
		else{
			PagEd_input_hidden("newupdatetimestamp", 1);}
		
		// PAGE AUTHOR
		echo "<tr>";
		PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_pagedpageauthorname", $pagedmainurls, _pagedpageauthorname, $modulefontcolor, $setstringfamily);
		PagEd_start_colspancells(2);
		echo "<input type=\"text\" name=\"newpageauthorname\" maxlength=\"255\" size=\"60\" ";
		 if ($setpagecontentitem != "newpage"){
			$oldpageauthorname = pnVarPrepHTMLDisplay(stripslashes($pageauthorname));
			echo "value=\"".$oldpageauthorname."\"";
		 }
		echo ">";
		PagEd_cellendspanstart_top(2);
		PagEd_stringdisplay(_pagedpageauthorname, 12, $modulefontcolor, $setstringfamily);
		PagEd_stringdisplay(_pagedpageauthornameinfo."&nbsp;", 10, $modulefontcolor, $setstringfamily);
		PagEd_cellrowend();
		
		// TOGGLE ORIGINAL AUTHOR
		if (($setpagecontentitem == "oldpage") and ($pageauthor != $useraccessto["requester"]) and ($pageauthor) and ($pageauthor!="")){
			PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_pagedauthoroverride", $pagedmainurls, _pagedauthoroverride, $modulefontcolor, $setstringfamily);
			PagEd_start_colspancells(4);
			PagEd_simplenarrowtable_start(0);
			PagEd_rowcell_top("left");
			PagEd_input_checkbox($modulebackgroundcolor, "newchangeuserswitch", 0, 0);
			PagEd_cellendstart_top($modulebackgroundcolor);
			PagEd_stringdisplay(_pagedauthoroverrideinfo1.$pageauthor._pagedauthoroverrideinfo2.$useraccessto["requester"]._pagedauthoroverrideinfo3, 12, $modulefontcolor, $setstringfamily);
			PagEd_cellrowtableend();
			PagEd_cellrowend();
		}
		
		// PAGE LANGUAGE
		if ($showlanguageselector =="yes"){
			echo "<tr>";
			PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_topiclanguage", $pagedmainurls, _topiclanguage, $modulefontcolor, $setstringfamily);
			PagEd_start_colspancells(4);
			PagEd_select_language($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_topiclanguage", $pagedmainurls, "newpagelanguage", $pagelanguage, _allanguages);
			PagEd_cellendstart_top($modulebackgroundcolor);
			PagEd_cellrowend();
		}
		
		PagEd_inputrow_divider(6, $modulefontcolor, $modulebackgroundcolor);
		
		// INPUT TITLE
		echo "<tr>";
		PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_edtitle", $pagedmainurls, _edtitle, $modulefontcolor, $setstringfamily);
		PagEd_start_colspancells(4);
		echo "<input type=\"text\" name=\"newtitle\" maxlength=\"255\" size=\"60\" ";
		if ($setpagecontentitem != "newpage"){
			$oldtitle = pnVarPrepHTMLDisplay(stripslashes($title));
			echo "value=\"".$oldtitle."\"";
		}
		echo ">";
		PagEd_cellend_tablereturn();
		
		// INPUT ARCHIVE IDENTIFIER 
		PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_archiveidentifier", $pagedmainurls, _archiveidentifier, $modulefontcolor, $setstringfamily);
		PagEd_start_colspancells(2);
		echo "<input type=\"text\" name=\"newarchiveidentifier\" maxlength=\"255\" size=\"60\" ";
		if ($setpagecontentitem != "newpage"){
			$oldarchiveidentifier = pnVarPrepHTMLDisplay(stripslashes($archiveidentifier));	
			echo "value=\"".$oldarchiveidentifier."\"";
		}
		echo "></td><td valign=\"bottom\" colspan=\"2\">";
		PagEd_stringdisplay(_pagedrelatedlinks."<br>", 12, $modulefontcolor, $setstringfamily);
		PagEd_cellend_tablereturn();
		
		// INPUT INGRESS
		PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_ingress", $pagedmainurls, _ingress, $modulefontcolor, $setstringfamily);
		PagEd_start_colspancells(2);
		echo "<textarea class=\"newingress\" name=\"newingress\" cols=\"45\" rows=\"5\" wrap=\"virtual\">";
		if ($setpagecontentitem != "newpage"){
			$ingress = trim($ingress);
			$oldingress = pnVarPrepHTMLDisplay(stripslashes($ingress));
			echo $oldingress;
		}
		echo"</textarea>";
		PagEd_cellendspanstart_top(2);
		
		// RELATED LINKS
		echo "<textarea class=\"newrelatedlinks\" name=\"newrelatedlinks\" cols=\"30\" rows=\"5\" wrap=\"virtual\">";
		if ($setpagecontentitem != "newpage"){
			$relatedlinks = trim($relatedlinks);
			$oldrelatedlinks = pnVarPrepHTMLDisplay(stripslashes($relatedlinks));	
			echo $oldrelatedlinks;
		}
		echo "</textarea>";
		PagEd_cellrowend();
		
		// START SECTION LOOP 
		$paginatepart = 1;
		for ($sectioncounter=1; $sectioncounter <= $numsections; $sectioncounter++){
			// GET CURRENT MAIN CONTENT
			$image = "none";
			if ($setpagecontentitem != "newpage"){
				$getcontent_result = mysql_query("select subtitle, text, image, imagetext, paginate_part from ".$prefix."_paged_content where page_id=".$page_id." and section=".$sectioncounter);
				$contentrows = mysql_num_rows($getcontent_result);
				if($contentrows==0){
					mysql_query("insert into ".$prefix."_paged_content (page_id, section, paginate_part) values (".$page_id.", ".$sectioncounter.", ".$paginatepart.")");
					$subtitle = "";
					$text  = "";
					$image  = "";
					$imagetext  = "";
					$newpaginatepart = $paginatepart;
				}
				else{
					list($subtitle, $text, $image, $imagetext, $newpaginatepart) = mysql_fetch_row($getcontent_result);}
			}
			$arraycounter = $sectioncounter-1;
			PagEd_inputrow_divider(6, $modulefontcolor, $modulebackgroundcolor);
			
			// NEW PAGINATION POINT CODE
			PagEd_rowcell_top("right");
			if($sectioncounter>1){
				$paginationpointvalue = 0;
				if($newpaginatepart>$paginatepart){
					$paginationpointvalue = 1;
					$paginatepart = $newpaginatepart;
				}
				PagEd_input_checkbox($modulebackgroundcolor, "paginationpoint[".$arraycounter."]", $paginationpointvalue, 0);
				PagEd_cellendstart_top($modulebackgroundcolor);
				PagEd_stringdisplay(_pagedpaginationpoint, 12, $modulefontcolor, $setstringfamily);
			}
			else{
				PagEd_cellendstart_top($modulebackgroundcolor);}	
			PagEd_cellendspanstart_top(4);
			
			if ($setpagecontentitem == "oldpage"){
				PagEd_input_button2($setstringfamily, $modulebackgroundcolor, $modulefontcolor, 0, 12, "normal", "insertsection[".$sectioncounter."]", _insertnewpagesection);}
			PagEd_cellrowend();
			PagEd_inputrow_divider(6, $modulefontcolor, $modulebackgroundcolor);
			
			// INPUT SUBTITLE
			echo "<tr>";
			PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_subtitle", $pagedmainurls, _subtitle, $modulefontcolor, $setstringfamily);
			PagEd_start_colspancells(3);
			echo "<input type=\"text\" name=\"newsubtitle".$arraycounter."\" maxlength=\"255\" size=\"60\" ";
			if ($setpagecontentitem != "newpage"){
				$oldsubtitle = pnVarPrepHTMLDisplay(stripslashes($subtitle));	
				echo "value=\"".$oldsubtitle."\"";
			}
			echo "></td>";
			if (($image) and ($image!="none") and ($imagelib!="none")){
				$blocktitle = &PagEd_checkif_block($image);
				if($blocktitle=="none"){
					echo "<td rowspan=\"5\" align=\"center\" valign=\"top\">";
					$workingimages = &PagEd_resize_image($ModName, $triple7data, $friendsdata, $imagelib, $imagelibpath, $image, $sourcefolder, $resultfolder, $editorimagesmaxsize);
					if($workingimages["gifwasconverted"]==1){
						$image = $workingimages["resultimagename"];
						mysql_query("update ".$prefix."_paged_content set image = \"".$image."\" where page_id=".$page_id." and section=".$sectioncounter);
					}
					$sourceimage = $workingimages["sourceimage"];
					$resultimageurl = $workingimages["resultimageurl"];
					PagEd_image_html($ModName, $triple7data, $pagedmainurls, "", $resultfolder, $workingimages, "imgsrc", 5, 5, 0, "", "");
				}
				else{
					echo "<td rowspan=\"5\" align=\"center\" valign=\"middle\">";
					PagEd_boldstringdisplay($image, 12, $modulefontcolor, $setstringfamily);
				}
				echo "<br>";
				PagEd_input_checkbox($modulebackgroundcolor, "deleteimage", 0, 5);
				PagEd_stringdisplay(_removeimage, 12, $modulefontcolor, $setstringfamily);
			}
			PagEd_cellend_tablereturn();
			
			// INPUT IMAGE AND IMAGETEXT
			PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_image", $pagedmainurls, _image."...", $modulefontcolor, $setstringfamily);
			PagEd_start_colspancells(3);
			PagEd_cellend_tablereturn();
			
			if (($useraccessto["pagedimgs"]=="fullaccess") or ($useraccessto["all"]=="fullaccess")){
				PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_uploadimage", $pagedmainurls, _uploadimage."...", $modulefontcolor, $setstringfamily);
				PagEd_start_colspancells(3);
				echo "<input type=\"file\" name=\"newuploadedimage".$arraycounter."\" maxlength=\"255\" size=\"40\">";
			}
			else{
				PagEd_start_colspancells(6);	
			}
			PagEd_cellend_tablereturn();
			
			$oldimage = "";
			if ($setpagecontentitem != "newpage"){
				$oldimage = htmlspecialchars(stripslashes($image));
			}
			$browseitem = "newbrowsedimage".$arraycounter;
			$spanname = "imagespan".$arraycounter;
			PagEd_select_media($ModName, $prefix, $pagedmainurls, $triple7data, $friendsdata, $useraccessto, $showhelp, $showhelplanguage, $panelrequester, "_pagedarchivedorlinkedimage", $browseitem, $spanname, $oldimage, _pagedarchivedorlinkedimage, $modulefontcolor, $modulebackgroundcolor, $setstringfamily, 3);
			PagEd_cellend_tablereturn();
			
			PagEd_prompt_leftcells($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_imagetext", $pagedmainurls, _imagetext, $modulefontcolor, $setstringfamily);
			PagEd_start_colspancells(3);
			echo "<input type=\"text\" name=\"newimagetext".$arraycounter."\" maxlength=\"255\" size=\"60\" ";
			if ($setpagecontentitem != "newpage"){
				$oldimagetext = pnVarPrepHTMLDisplay(stripslashes($imagetext));
				echo "value=\"".$oldimagetext."\"";	
			}
			echo ">";
			PagEd_cellend_tablereturn();
			
			// INPUT TEXT 
			PagEd_singlecell();
			PagEd_start_onecell("right");
			PagEd_stringdisplay(_text, 12, $modulefontcolor, $setstringfamily);
			echo "<div align=\"center\">";
			PagEd_stringdisplay("<br>&nbsp;".$sectioncounter, 36, $modulefontcolor, $setstringfamily);
			if ($setpagecontentitem == "oldpage"){
				echo "<br>";
				if ($sectioncounter>1){
					PagEd_input_button2($setstringfamily, $modulebackgroundcolor, $modulefontcolor, 100, 12, "normal", "movesectionup[".$sectioncounter."]", _moveup);
				echo "<br>";
				}
				if ($sectioncounter<$numsections){
					PagEd_input_button2($setstringfamily, $modulebackgroundcolor, $modulefontcolor, 100, 12, "normal", "movesectiondown[".$sectioncounter."]", _movedown);
					echo "<br>";
				}
				PagEd_input_button2($setstringfamily, $modulebackgroundcolor, $modulefontcolor, 100, 12, "normal", "deletesection[".$sectioncounter."]", _deletepage);
				echo "<br>";
			}
			// NEW MEDIA BROWSE CODE. NOT CONNECTED TO TEXT FIELD YET.
			if (($mediafolderpath!="") and (($useraccessto["mediafiles"]!="noaccess") or ($useraccessto["all"]=="fullaccess"))){
				PagEd_select_media($ModName, $prefix, $pagedmainurls, $triple7data, $friendsdata, $useraccessto, $showhelp, $showhelplanguage, $panelrequester, "_pagedbrowsemedia", "newbrowsedmediafile", "mediaspan", "", "", $modulefontcolor, $modulebackgroundcolor, $setstringfamily, 1);
			}
			// NEW MEDIA BROWSE CODE END.
			
			echo "</div>";
			PagEd_cellendspanstart_top(4);
			echo "<textarea id=\"newtext".$arraycounter."\" name=\"newtext".$arraycounter."\" cols=\"80\" rows=\"15\" wrap=\"virtual\">";
			if ($setpagecontentitem != "newpage"){
				$text = rtrim($text);
				if (strpos($text, "\r\n")==0){
					$text = "\r\n".$text;
				}
				$oldtext = stripslashes($text);
				echo $oldtext;	
			}
			echo "</textarea>";
			PagEd_cellrowend();
		}  // END SECTION LOOP
		
		// LAST INSERTSECTION BUTTON
		$numsectionsvalue = 0;
		$lowestnumsectionoption = 0;
		$highestnumsectionoption = 31;
		echo "<tr>";
		PagEd_select_numsections($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, "_numsectionstoadd", $pagedmainurls, "newnumsections", $numsectionsvalue, $lowestnumsectionoption, $highestnumsectionoption, "", "", $modulefontcolor, $setstringfamily);
		PagEd_table_return();
		PagEd_doublecell();
		PagEd_start_colspancells(4);
		PagEd_input_button2($setstringfamily, $modulebackgroundcolor, $modulefontcolor, 0, 12, "normal", "addnewsections", _numsectionstoadd);
		PagEd_cellrowend();
		
		// SUBMIT FOOTER	
		$hiddencount = 3;
		$hiddennames = array("page_id", "oldpageauthor", "newunixdatestamp");
		$hiddenvalues = array($page_id, $pageauthor, $unixdatestamp);
		
		if (($useraccessto["news"]!="noaccess") or ($useraccessto["all"]=="fullaccess")){
			$buttons = 6;
			$submitnames = array("paged_preview", "paged_editpagelayout", "paged_editnewstiming", "paged_saveandend", "paged_saveandaddnewpage", "paged_cancelandend");
			$textvalues = array(_previewpage, _editpagelayout, _pagedsetnewstiming, _saveandend, _pagedsaveandaddnewpage,_cancelandend);
		}
		else{
			$buttons = 5;
			$submitnames = array("paged_preview", "paged_editpagelayout", "paged_saveandend", "paged_saveandaddnewpage", "paged_cancelandend");
			$textvalues = array(_previewpage, _editpagelayout, _saveandend, _pagedsaveandaddnewpage, _cancelandend);
		}
		
		if (isset($permittedpages)){session_register("permittedpages");}
		if (isset($sortedpermittedpages)){session_register("sortedpermittedpages");}
		if (isset($firstlisteditem)){session_register("firstlisteditem");}
		if (isset($sortcriterium)){session_register("sortcriterium");}
		if (isset($viewtopic_id)){session_register("viewtopic_id");}
		
		
		PagEd_panel_footer($ModName, $prefix, $showhelp, $showhelplanguage, $panelrequester, $showhelpvariable, $pagedmainurls, $panelrequester, $useraccessto, $pagedversion, $smallpanelswitch, $returnopvalue, $hiddencount, $hiddennames, $hiddenvalues, $buttons, $submitnames, $textvalues, $modulebackgroundcolor, $modulefontcolor, $setstringfamily);
		
	}
	else{
		include (_PAGEDINCLUDE."/noaccess.php");
	}
}
?>
