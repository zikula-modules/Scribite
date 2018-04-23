'use strict';

(function (document, CKEDITOR) {
    CKEDITOR.dialog.add('media', function (editor) {
        var lang = editor.lang.media;
        var common = editor.lang.common;

        return {
            title: lang.title,
            resizable: CKEDITOR.DIALOG_RESIZE_BOTH,
            minWidth: 250,
            minHeight: 100,
            contents: [
                {
                    id: 'info',
                    label: lang.info,
                    elements: [
                        {

                            type: 'hbox',
                            children: [
                                {
                                    id: 'src',
                                    type: 'text',
                                    label: common.url,
                                    setup: function (widget) {
                                        this.setValue(widget.data.src);
                                    },
                                    commit: function (widget) {
                                        widget.setData('src', this.getValue());
                                    },
                                    validate: CKEDITOR.dialog.validate.notEmpty(lang.validateRequired)
                                },
                                {
                                    id: 'browse',
                                    type: 'button',
                                    label: common.browseServer,
                                    hidden: true,
                                    filebrowser: 'info:src'
                                }
                            ]
                        },
                        {
                            id: 'mediatype',
                            type: 'select',
                            label: lang.mediatype,
                            items: [
                                [common.notSet, ''],
                                [lang.image, 'img'],
                                [lang.audio, 'audio'],
                                [lang.video, 'video'],
                                [lang.iframe, 'iframe']
                            ],
                            setup: function (widget) {
                                this.setValue(widget.data.mediatype);
                            },
                            commit: function (widget) {
                                widget.setData('mediatype', this.getValue());
                            },
                            validate: CKEDITOR.dialog.validate.notEmpty(lang.validateRequired)
                        },
                        {
                            type: 'hbox',
                            children: [
                                {
                                    id: 'width',
                                    type: 'text',
                                    label: common.width,
                                    setup: function (widget) {
                                        this.setValue(widget.data.width);
                                    },
                                    commit: function (widget) {
                                        widget.setData('width', this.getValue());
                                    }
                                },
                                {
                                    id: 'height',
                                    type: 'text',
                                    label: common.height,
                                    setup: function (widget) {
                                        this.setValue(widget.data.height);
                                    },
                                    commit: function (widget) {
                                        widget.setData('height', this.getValue());
                                    }
                                }
                            ]
                        },
                        {
                            id: 'alt',
                            type: 'text',
                            label: lang.alt,
                            setup: function (widget) {
                                this.setValue(widget.data.alt);
                            },
                            commit: function (widget) {
                                widget.setData('alt', this.getValue());
                            }
                        },
                        {
                            id: 'link',
                            type: 'text',
                            label: lang.link,
                            setup: function (widget) {
                                this.setValue(widget.data.link);
                            },
                            commit: function (widget) {
                                widget.setData('link', this.getValue());
                            }
                        },
                        {
                            id: 'align',
                            type: 'radio',
                            label: common.align,
                            items: [
                                [common.alignNone, ''],
                                [common.left, 'left'],
                                [common.center, 'center'],
                                [common.right, 'right']
                            ],
                            setup: function (widget) {
                                this.setValue(widget.data.align);
                            },
                            commit: function (widget) {
                                widget.setData('align', this.getValue());
                            }
                        },
                        {
                            id: 'caption',
                            type: 'checkbox',
                            label: lang.caption,
                            setup: function (widget) {
                                this.setValue(widget.data.caption);
                            },
                            commit: function (widget) {
                                widget.setData('caption', this.getValue());
                            }
                        }
                    ]
                }
            ]
        };
    });
})(document, CKEDITOR);
