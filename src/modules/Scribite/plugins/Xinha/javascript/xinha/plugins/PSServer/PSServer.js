/**
 * PSServer PSServer.js file.
 * This plugin is a server based persistent storage backend.
 */
(function() {
var PSServer = window.PSServer = function PSServer(editor) {
  this.editor = editor;
}

PSServer._pluginInfo = {
    name          : "PSServer",
    version       : "2.0",
    developer     : "Douglas Mayle",
    developer_url : "http://xinha.org",
    license       : "MIT"
};

PSServer.prototype.onGenerateOnce = function () {
  // We use _loadConfig to asynchronously load the config and then register the
  // backend.
  this._loadConfig();
};

PSServer.prototype._loadConfig = function() {
  var self = this;
  if (!this._serverConfig) {
    Xinha._getback(Xinha.getPluginDir("PSServer") + "/config.inc.php",
                   function(config) { 
                     self._serverConfig = eval('(' + config + ')');
                     self._serverConfig.user_affinity = 20;
                     self._serverConfig.displayName = 'Server';
                     self._loadConfig();
                   });
    return;
  }

  this._registerBackend();
}

PSServer.prototype._registerBackend = function(timeWaited) {
  var editor = this.editor;
  var self = this;

  if (!timeWaited) {
    timeWaited = 0;
  }

  // Retry over a period of ten seconds to register.  We back off exponentially
  // to limit resouce usage in the case of misconfiguration.
  var registerTimeout = 10000;

  if (timeWaited > registerTimeout) {
    // This is most likely a configuration error.  We're loaded and
    // PersistentStorage is not.
    return;
  }

  if (!editor.plugins['PersistentStorage'] ||
      !editor.plugins['PersistentStorage'].instance ||
      !editor.plugins['PersistentStorage'].instance.ready) {

    window.setTimeout(function() {self._registerBackend(timeWaited ? timeWaited*2 : 50);}, timeWaited ? timeWaited : 50);
    return;
  }
  editor.plugins['PersistentStorage'].instance.registerBackend('PSServer', this, this._serverConfig);
}

PSServer.prototype.loadData = function (asyncCallback) {
  var self = this;
  Xinha._getback(Xinha.getPluginDir("PSServer") + "/backend.php?directory&listing",
                 function(json) { 
                   self.dirTree = eval('(' + json + ')');
                   asyncCallback(self.dirTree);
                 });
}

var treeRecurse = function treeRecurse(tree, callback, root) {
  if (typeof root == 'undefined') {
    root = '/';
    callback('/', '', tree);
  }

  for (var key in tree) {
    callback(root, key, tree[key]);

    if (tree[key].$type == 'folder') {
      treeRecurse(tree[key], callback, root + key + '/');
    }
  }
};

PSServer.prototype.getFilters = function(dirTree) {
  // Clear out the previous directory listing.
  var filters = [];

  treeRecurse(dirTree, function(path, key, value) {
      if (value.$type != 'folder') {
        return;
      }

      var filePath = key.length ? path + key + '/' : path;
      var filePathDisplay = key.length ? path + key + '/' : path;
      if (filePathDisplay.length > 1) {
        filePathDisplay = filePathDisplay.substring(0, filePathDisplay.length-1);
      }
      filters.push({
        value: filePath,
        display: filePathDisplay
      });
  });

  return filters;
}

PSServer.prototype.loadDocument = function(entry, asyncCallback) {

  Xinha._getback(entry.URL,
                 function(documentSource) { 
                   asyncCallback(documentSource);
                 });
}
PSServer.prototype.getMetadata = function(dirTree, pathFilter, typeFilter) {
  var editor = this.editor;
  var self = this;

  var metadata = [];

  var typeKeys = {};
  for (var index=0; index<typeFilter.length; ++index) {
    typeKeys[typeFilter[index]] = true;
  }

  treeRecurse(dirTree, function(path, key, value) {
    if (!value.$type || !key) {
      // This is a builtin property of objects, not one returned by the
      // backend.
      return;
    }

    if (path != pathFilter) {
      return;
    }

    if (!(value.$type in typeKeys)) {
      return;
    }

    if ((value.$type == 'folder') || (value.$type == 'html') || 
        (value.$type == 'text') || (value.$type == 'document')) {
      metadata.push({
        name: key,
        key: path + key,
        $type: value.$type
      });
    } else {
      metadata.push({
        URL: Xinha.getPluginDir("PSServer") + '/demo_images' + path + key,
        name: key,
        key: path + key,
        $type: value.$type
      });
    }
  });

  return metadata;
}

PSServer.prototype.loadDocument = function(entry, asyncCallback) {
  var self = this;
  Xinha._getback(Xinha.getPluginDir("PSServer") + '/demo_images' + entry.key,
                 function(documentSource) { 
                   asyncCallback(documentSource);
                 });
}

PSServer.prototype.buildImportUI = function(dialog, element) {
  // We receive an HTML element and are expected to build an HTML UI.  We'll
  // model it off of this HTML fragment:
  //  <form target="importFrame" action="../plugins/PSServer/backend.php?upload&amp;replace=false&amp;" id="importForm" method="post" enctype="multipart/form-data">
  //    File: <input type="file" name="filedata" /><input type="submit" value="_(Import)" />
  //  </form>
  //  <iframe id="importFrame" name="importFrame" src="#" style="display:none;"></iframe>
  var iframeID = dialog.createId('importFrame');

  var form = document.createElement('form');
  form.setAttribute('enctype', 'multipart/form-data');
  form.setAttribute('method', 'post');
  form.setAttribute('action', Xinha.getPluginDir("PSServer") + "/backend.php?upload&replace=true&");

  var fileentry = document.createElement('input');
  fileentry.setAttribute('type', 'file');
  fileentry.setAttribute('name', 'filedata');

  var submitbutton = document.createElement('input');
  submitbutton.setAttribute('type', 'submit');
  submitbutton.setAttribute('value',Xinha._lc('Import', 'PSServer'));

  var filetext = document.createTextNode(Xinha._lc('File: ', 'PSServer'));
  filetext = form.appendChild(filetext);

  fileentry = form.appendChild(fileentry);

  submitbutton = form.appendChild(submitbutton);

  form = element.appendChild(form);
  form.setAttribute('target', iframeID);

  // The iframe must be added to the document after the form has been, or the targeting fails.
  var iframe = document.createElement('iframe');
  iframe.setAttribute('src', 'about:blank');
  iframe.style.display = 'none';
  iframe.id = iframe.name = iframeID;
  iframe.onload = function() {
    var docCheck = iframe.contentDocument || iframe.contentWindow;
    if (docCheck.location.href == 'about:blank') {
        return;
    }
    // What to do on import?  Add an entry to the UI, I guess...
    alert('Add entry here');
  }
  iframe = element.appendChild(iframe);

}

PSServer.prototype.saveDocument = function(path, filename, documentSource, asyncCallback) {
  Xinha._postback(Xinha.getPluginDir("PSServer") + "/backend.php?upload&replace=true&filedata=" + escape(documentSource)+"&filename="+escape(path + filename),
                  null,
                  function(response) { 
                    asyncCallback(true);
                  },
                  function(response) { 
                    asyncCallback(false);
                  });
}

PSServer.prototype.makeFolder = function(currentPath, folderName, asyncCallback) {
  Xinha._postback(Xinha.getPluginDir("PSServer") + "/backend.php?directory&create&dirname="+escape(currentPath + '/' + folderName),
                  null,
                  function(response) { 
                    asyncCallback(true);
                  },
                  function(response) { 
                    asyncCallback(false);
                  });
}

PSServer.prototype.deleteEntry = function(entry, asyncCallback) {
  Xinha._postback(Xinha.getPluginDir("PSServer") + "/backend.php?file&delete&filename="+escape(entry.key),
                  null,
                  function(response) { 
                    asyncCallback(true);
                  },
                  function(response) { 
                    asyncCallback(false);
                  });
}

PSServer.prototype.moveEntry = function(entry, container, asyncCallback) {
  Xinha._postback(Xinha.getPluginDir("PSServer") + "/backend.php?file&rename&filename="+escape(entry.key)+'&newname='+escape(container.key + '/' + entry.name),
                  null,
                  function(json) { 
                    asyncCallback(true);
                  },
                  function(json) { 
                    asyncCallback(false);
                  });
}

PSServer.prototype.copyEntry = function(entry, asyncCallback) {
  Xinha._postback(Xinha.getPluginDir("PSServer") + "/backend.php?file&copy&filename="+escape(entry.key),
                  null,
                  function(json) { 
                    var newentry = eval('(' + json + ')');
                    asyncCallback(true, newentry);
                  },
                  function(json) { 
                    var newentry = eval('(' + json + ')');
                    asyncCallback(false, newentry);
                  });
}

})();
