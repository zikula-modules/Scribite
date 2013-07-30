CKEditor Image Browser plugin
=============================

**imagebrowser** is a `CKEditor <http://ckeditor.com/>`_ plugin that allows images on the server to be browsed and picked
for inclusion into the editor's contents.

This plugin integrates with the **image** plugin (part of CKEditor),
by making it provide a **Browse Server** button in the Image dialog window (`screenshot here <http://ckeditor.com/sites/default/files/styles/large/public/image/image_manager.png>`_).

The way you use it is very similar to `imageGetJson <http://imperavi.com/redactor/docs/settings/#set_imageGetJson>`_ in `Redactor <http://imperavi.com/redactor/>`_
- you only need to provide a list of images in a JSON format, and the image browser will take care of the rest.

In fact, it uses the same data format as Redactor, allowing for an easy transition between the two editors.

Installation
------------

Copy the whole contents of this repository into a new ``plugins/imagebrowser`` directory in your CKEditor install.


Usage
-----

Enable the plugin by adding it to `extraPlugins` and specify the `imageBrowser_listUrl` parameter::

	CKEditor.replace('textareaId', {
		"extraPlugins": "imagebrowser",
		"imageBrowser_listUrl": "/path/to/images_list.json"
	});

The **imageBrowser_listUrl** configuration parameter points to a URL that lists the server's images in a JSON format.

Example::

	[
		{
			"thumb": "/image1_thumb.jpg",
			"image": "/image1_200x150.jpg",
			"folder": "Small"
		},
		{
			"thumb": "/image2_thumb.jpg",
			"image": "/image2_200x150.jpg",
			"folder": "Small"
		},

		{
			"thumb": "/image1_thumb.jpg",
			"image": "/image1_full.jpg",
			"folder": "Large"
		},
		{
			"thumb": "/image2_thumb.jpg",
			"image": "/image2_full.jpg",
			"folder": "Large"
		}
	]

The above says that there are 2 image directories ("Small" and "Large") with 2 files in each of them.

The **thumb** field specifies the relative/absolute path to the image's thumbnail (for preview purposes).

The **image** field is the relative/absolute path being used when the image gets put into the editor's contents.

The **folder** field is *optional*. If omitted, the image list will not be split into categories.
