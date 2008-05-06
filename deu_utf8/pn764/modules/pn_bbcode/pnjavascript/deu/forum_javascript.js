function x () {
    return;
}

function DoSize (fontsize) {
    var revisedMessage;
    var post = document.getElementById("post");
    var currentMessage = post.message.value;
    var sizeBBCode = "[size="+fontsize+"][/size]";
    revisedMessage = currentMessage+sizeBBCode;
    post.message.value=revisedMessage;
    post.message.focus();
    return;
}

function DoColor (fontcolor) {
    var revisedMessage;
    var post = document.getElementById("post");
    var currentMessage = post.message.value;
    var colorBBCode = "[color="+fontcolor+"][/color]";
    revisedMessage = currentMessage+colorBBCode;
    post.message.value=revisedMessage;
    post.message.focus();
    return;
}

function DoCode (code) {
    var revisedMessage;
    var post = document.getElementById("post");
    var currentMessage = post.message.value;
    var codeBBCode;
    if(code != "") {
        code = "="+code;
    }
    codeBBCode= "[code"+code+"][/code]";
    revisedMessage = currentMessage+codeBBCode;
    post.message.value=revisedMessage;
    post.message.focus();
    return;
}

function DoPrompt(action) {
    var revisedMessage;
    var post = document.getElementById("post");
    var currentMessage = post.message.value;

    if (action == "url") {
        var thisURL = prompt("URL der gewünschten Seite angeben", "http://");
        var thisTitle = prompt("Titel der Seite angeben", "Seitentitel");
        var urlBBCode = "[URL="+thisURL+"]"+thisTitle+"[/URL]";
        revisedMessage = currentMessage+urlBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }

    if (action == "email") {
        var thisEmail = prompt("gewünschte E-Mail-Adresse angeben", "");
        var emailBBCode = "[EMAIL]"+thisEmail+"[/EMAIL]";
        revisedMessage = currentMessage+emailBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }

    if (action == "bold") {
        var thisBold = prompt("den fetten Text angeben", "");
        var boldBBCode = "[B]"+thisBold+"[/B]";
        revisedMessage = currentMessage+boldBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }
    
    if (action == "italic") {
        var thisItal = prompt("den kursiven Text angeben", "");
        var italBBCode = "[I]"+thisItal+"[/I]";
        revisedMessage = currentMessage+italBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }
    
    if (action == "underline") {
        var thisUL = prompt("den unterstrichenenen Text angeben", "");
        var ulBBCode = "[u]"+thisUL+"[/u]";
        revisedMessage = currentMessage+ulBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }
    
    if (action == "image") {
        var thisImage = prompt("URL für das anzuzeigende Bild angeben", "http://");
        var imageBBCode = "[IMG]"+thisImage+"[/IMG]";
        revisedMessage = currentMessage+imageBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }
    
    if (action == "quote") {
        var quoteBBCode = "[QUOTE]  [/QUOTE]";
        revisedMessage = currentMessage+quoteBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }
    
    if (action == "listopen") {
        var liststartBBCode = "[LIST]";
        revisedMessage = currentMessage+liststartBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }
    
    if (action == "listclose") {
        var listendBBCode = "[/LIST]";
        revisedMessage = currentMessage+listendBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }
    
    if (action == "listitem") {
        var thisItem = prompt("Listen-Eintrag angeben. Bitte beachten, dass Listen geöffnet und geschlossen werden müssen", "");
        var itemBBCode = "[*]"+thisItem;
        revisedMessage = currentMessage+itemBBCode;
        post.message.value=revisedMessage;
        post.message.focus();
        return;
    }

}
