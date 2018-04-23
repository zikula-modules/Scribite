'use strict';

(function (CKEDITOR) {
    var align = {left: 'left', center: 'center', right: 'right'};
    var attr = ['src', 'width', 'height', 'alt'];
    var editables = {
        caption: {
            selector: 'figcaption',
            allowedContent: 'br em strong sub sup u s; a[!href]'
        }
    };
    var types = ['audio', 'iframe', 'img', 'video'];

    CKEDITOR.plugins.add('media', {
        requires: 'dialog,widget',
        icons: 'media',
        hidpi: true,
        lang: 'bg,de,en,ru',
        init: function (editor) {
            editor.widgets.add('media', {
                button: editor.lang.media.title,
                dialog: 'media',
                template: '<figure class="media"><img /><figcaption></figcaption></figure>',
                editables: editables,
                allowedContent: 'figure(!media, left, center, right); a[!href]; ' + types.join(' ') + '[!src, width, height, alt, controls, allowfullscreen]; figcaption',
                requiredContent: 'figure(media); ' + types.join(' ') + '[src]; figcaption',
                defaults: {
                    align: '',
                    alt: '',
                    caption: false,
                    height: '',
                    link: '',
                    mediatype: '',
                    src: '',
                    width: ''
                },
                upcast: function (el) {
                    var crit = function (e) {
                        return e.name === 'figure' && e.hasClass('media');
                    };
                    var med = function (e) {
                        return types.indexOf(e.name) >= 0;
                    };
                    var link = function (e) {
                        return e.name === 'a' && e.children.length === 1 && med(e.children[0]);
                    };

                    // Add missing caption
                    if (crit(el) && el.children.length === 1) {
                        el.add(new CKEDITOR.htmlParser.element('figcaption', {}));
                    }

                    return crit(el) && el.children.length === 2  && (med(el.children[0]) || link(el.children[0])) && el.children[1].name === 'figcaption'
                        || !crit(el) && med(el) && !el.getAscendant(crit);
                },
                downcast: function (el) {
                    if (el.name === 'figure') {
                        if (this.data.link && el.children[0].name === 'img') {
                            el.children[0].wrapWith(new CKEDITOR.htmlParser.element('a', {'href': this.data.link}));
                        }

                        if (!el.children[1].getHtml().trim()) {
                            el.children[1].remove();
                        } else {
                            el.children[1].attributes = [];
                        }
                    }
                },
                init: function () {
                    var el = this.element;
                    var media = el;
                    var a;

                    // Figure with caption + link
                    if (el.getName() === 'figure') {
                        this.setData('caption', true);
                        media = el.getFirst();

                        if (media.getName() === 'a') {
                            this.setData('link', media.getAttribute('href'));
                            media.getChild(0).move(el, true);
                            media.remove();
                            media = el.getFirst();
                        }
                    } else {
                        if (a = el.getAscendant('a')) {
                            this.setData('link', a.getAttribute('href'));
                        }

                        this.inline = true;
                    }

                    // Media type
                    this.setData('mediatype', media.getName());

                    // Media attributes
                    for (var i = 0; i < attr.length; i++) {
                        if (media.hasAttribute(attr[i])) {
                            this.setData(attr[i], media.getAttribute(attr[i]));
                        }
                    }

                    // Align
                    if (el.hasClass(align.left)) {
                        this.setData('align', 'left');
                    } else if (el.hasClass(align.center)) {
                        this.setData('align', 'center');
                    } else if (el.hasClass(align.right)) {
                        this.setData('align', 'right');
                    }
                },
                data: function () {
                    if (!this.data.src || !this.data.mediatype) {
                        return;
                    }

                    var el = this.element;
                    var i;

                    el.removeClass('media');
                    el.removeClass(align.left);
                    el.removeClass(align.center);
                    el.removeClass(align.right);

                    for (i = 0; i < types.length; i++) {
                        el.removeClass(types[i]);
                    }

                    var type = this.data.mediatype;
                    var media = el.getName() === 'figure' ? el.getChild(0) : el;
                    var caption = el.getName() === 'figure' ? el.getChild(1) : null;

                    this.inline = !this.data.caption;

                    if (this.data.caption && el.getName() !== 'figure') {
                        el.renameNode('figure');

                        for (i = 0; i < attr.length; i++) {
                            el.removeAttribute(attr[i]);
                        }

                        media = new CKEDITOR.dom.element(type);
                        el.append(media, true);
                        caption = new CKEDITOR.dom.element('figcaption');
                        el.append(caption);
                        this.initEditable('caption', editables.caption);
                        el.addClass('media');
                        el.addClass(type);
                        this.wrapper.renameNode('div');
                        this.wrapper.removeClass('cke_widget_inline');
                        this.wrapper.addClass('cke_widget_block');
                    } else if (!this.data.caption && el.getName() === 'figure') {
                        el.renameNode(type);
                        media.remove();
                        media = el;
                        caption.remove();
                        caption = null;
                        this.wrapper.renameNode('span');
                        this.wrapper.removeClass('cke_widget_block');
                        this.wrapper.addClass('cke_widget_inline');
                    }

                    if (media.getName() !== type) {
                        media.renameNode(type);
                    }

                    // Media attributes
                    media.setAttribute('src', this.data.src);

                    if (this.data.width) {
                        media.setAttribute('width', this.data.width);
                    } else {
                        media.removeAttribute('width');
                    }

                    if (this.data.height) {
                        media.setAttribute('height', this.data.height);
                    } else {
                        media.removeAttribute('height');
                    }

                    if (type === 'img') {
                        media.removeAttribute('allowfullscreen');
                        media.setAttribute('alt', this.data.alt);
                        media.removeAttribute('controls');
                    } else if (['audio', 'video'].indexOf(type) >= 0) {
                        media.removeAttribute('allowfullscreen');
                        media.removeAttribute('alt');
                        media.setAttribute('controls', 'controls');
                    } else if (type === 'iframe') {
                        media.setAttribute('allowfullscreen', 'allowfullscreen');
                        media.removeAttribute('alt');
                        media.removeAttribute('controls');
                    }

                    // Align
                    if (this.data.align && align.hasOwnProperty(this.data.align)) {
                        el.addClass(align[this.data.align]);
                    }
                }
            });

            CKEDITOR.dialog.add('media', this.path + 'dialogs/media.js');
        }
    });
})(CKEDITOR);
