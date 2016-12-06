(function() {
	CKEDITOR.dialog.add("lightbox", function(g) {
		var l = CKEDITOR.plugins.link,
			h = function(a) {
				a.advanced && this.setValue(a.advanced[this.id] || "")
			},
			j = function(a) {
				a.advanced || (a.advanced = {});
				a.advanced[this.id] = this.getValue() || ""
			},
            rand = function()
            {
                var r = "";
                var ch = "abcdefghijklmnopqrstuvwxyz0123456789";
                for(var i=0; i<10; i++)r += ch.charAt(Math.floor(Math.random() * ch.length));
                return r;
            },
    		getGal = function(a) {
    		    this.setValue(gal || "");
    		},
    		setGal = function(a) {
                gal = this.getValue() || "";
    		},
            gal_id = function(a){
                return gal!="" ? gal : rand();
            },
            e = false,
            imageExists = function(url){
                icon = CKEDITOR.getUrl(CKEDITOR.plugins.get("lightbox").path + "images/loading.gif");
                document.getElementById('cke_lightbox_image_preview').style.backgroundSize = "auto auto";
                document.getElementById('cke_lightbox_image_preview').style.backgroundImage = "url('"+icon+"')";
                var img = new Image();
                img.onload = function(){
                    e=true;
                    document.getElementById('cke_lightbox_image_preview').style.backgroundSize = "contain";
                    document.getElementById('cke_lightbox_image_preview').style.backgroundImage = "url('"+url+"')";
                };
                img.onerror = function(){e=false;};
                img.src = url;
            },
			c = g.lang.common,
			b = g.lang.link,
            d;
		return {
			title: 'Lightbox',
			minWidth: 350,
			minHeight: 230,
			contents: [{
				id: "info",
				label: b.info,
				title: b.info,
				elements: [{
					type: "vbox",
					id: "urlOptions",
					children: [{
						type: "hbox",
						widths: ["25%", "75%"],
						children: [{
							type: "text",
							id: "url",
							label: g.lang.lightbox.url,
							required: !0,
							onLoad: function() {
								this.allowOnChange = !0
							},
							onKeyUp: function() {
								this.allowOnChange = !1;
								var b = this.getValue(),
									k = /^((javascript:)|[#\/\.\?])/i;
                                k.test(b);
                                document.getElementById('cke_lightbox_image_preview').style.backgroundImage = "url('"+b+"')";
                                imageExists(b);
                                this.allowOnChange = !0
							},
							onChange: function() {
								if (this.allowOnChange) this.onKeyUp()
							},
							validate: function() {
                                var a = this.getDialog();
                                return !e ? (alert(c.invalidValue), !1) : !g.config.linkJavaScriptLinksAllowed && /javascript\:/.test(this.getValue()) ? (alert(c.invalidValue), !1) : this.getDialog().fakeObj ? !0 : CKEDITOR.dialog.validate.notEmpty(b.noUrl).apply(this);
                            },
							setup: function(a) {
								this.allowOnChange = !1;
								a.url && this.setValue(a.url.url);
								this.allowOnChange = !0
							},
							commit: function(a) {
								this.onChange();
                                a.type = "url";
                                a.url || (a.url = {});
                                a.url.protocol = "";
                                a.url.url = this.getValue();
								this.allowOnChange = !1
							}
						}],
						setup: function() {
							this.getDialog().getContentElement("info", "linkType") || this.getElement().show()
						}
					},
					{
						type: "button",
						id: "browse",
						hidden: "true",
						filebrowser: "info:url",
						label: c.browseServer
					}]
				},
    			{
                    id: "prev",
                    type: "html",
                    html : g.lang.lightbox.preview+'<div id="cke_lightbox_image_preview" class="ImagePreview" style="border:2px solid #000; height:100px; text-align:center; background-size:contain; background-position:center center; background-repeat:no-repeat;"></div>'
                },
                {
					type: "text",
					label: g.lang.lightbox.title,
					"a[title]": "",
					id: "advTitle",
					setup: h,
					commit: j
                },
                {
					type: "text",
					label: g.lang.lightbox.gallery,
					"default": "",
					id: "advRel",
					setup: getGal,
					commit: setGal
                }]
			}],
			onShow: function() {
                document.getElementById('cke_lightbox_image_preview').style.backgroundSize = "auto auto";
			    document.getElementById('cke_lightbox_image_preview').style.backgroundImage = "url('"+CKEDITOR.getUrl(CKEDITOR.plugins.get("lightbox").path + "images/noimage.png")+"')";

                var a =
				this.getParentEditor(),
					b = a.getSelection(),
					c = null;
				(c = l.getSelectedLink(a)) && c.hasAttribute("href") ? b.getSelectedElement() || b.selectElement(c) : c = null;
				a = l.parseLinkAttributes(a, c);
				this._.selectedElement = c;

                p = (typeof a.url['protocol'] !== 'undefined') ? a.url.protocol : "";
                document.getElementById('cke_lightbox_image_preview').style.backgroundSize = "contain";
                document.getElementById('cke_lightbox_image_preview').style.backgroundImage = "url('"+p+a.url.url+"')";
				a.url.url = p+a.url.url;
                e = true;
                gal = c.getAttribute('data-lightbox-saved');

                this.setupContent(a)
			},
			onOk: function() {
				var a = {};
				this.commitContent(a);
				var b = g.getSelection(),
					c = l.getLinkAttributes(g, a);
                    c.set['data-lightbox-saved'] = gal;
                    c.set['data-lightbox'] = gal_id();
                    typeof c.set['title'] !== 'undefined' ? c.set['data-title'] = c.set['title'] : c.removed.push('data-title');
				if (this._.selectedElement) {
					var e = this._.selectedElement,
						d = e.data("cke-saved-href"),
						f = e.getHtml();
					e.setAttributes(c.set);
					e.removeAttributes(c.removed);
					if (d == f) e.setHtml(c.set["data-cke-saved-href"]), b.selectElement(e);
					delete this._.selectedElement
				} else b = b.getRanges()[0], b.collapsed && (a = new CKEDITOR.dom.text(c.set["data-cke-saved-href"], g.document), b.insertNode(a), b.selectNodeContents(a)), c = new CKEDITOR.style({
					element: "a",
					attributes: c.set
				}), c.type = CKEDITOR.STYLE_INLINE, c.applyToRange(b, g), b.select()
			}
		}
	})
})();
