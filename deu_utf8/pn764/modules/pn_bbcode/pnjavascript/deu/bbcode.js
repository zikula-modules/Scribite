/*
 * new bbcode javascript
 */
function AddBBCode(textfieldname, action, optdata)
{
    var textfieldname, action, optdata, textfield, bbcode;

    if(action=="" || action==null) {
        alert('internal error: action not set');
        return;
    }
    textfield = document.getElementById(textfieldname);
    if(textfield==null) {
        alert('internal error: unknown textfieldname supplied');
        return;
    }
    switch(action) {
        case "code":
            bbcode = "[code" + check_optdata(optdata, "=") + "][/code]";
            break;
        case "size":
            bbcode = "[size" + check_optdata(optdata, "=") + "][/size]";
            break;
        case "color":
            bbcode = "[color" + check_optdata(optdata, "=") + "][/color]";
            break;
        case "url":
            bbcode = "[url" + check_optdata(prompt("URL der gewünschten Seite angeben", "http://"), "=") + "]"
                            + check_optdata(prompt("Titel der Seite angeben", "Seitentitel")) + "[/url]";
            break;
        case "email":
            bbcode = "[email]" + check_optdata(prompt("gewünschte E-Mail-Adresse angeben", "")) + "[/email]";
            break;
        case "italic":
            bbcode = "[i]" + check_optdata(prompt("den kursiven Text angeben", "")) + "[/i]";
            break;
        case "bold":
            bbcode = "[b]" + check_optdata(prompt("den fetten Text angeben", "")) + "[/b]";
            break;
        case "underline":
            bbcode = "[u]" + check_optdata(prompt("den unterstrichenenen Text angeben", "")) + "[/u]";
            break;
        case "image":
            bbcode = "[img]" + check_optdata(prompt("URL für das anzuzeigende Bild angeben", "http://")) + "[/img]";
            break;
        case "quote":
            bbcode = "[quote][/quote]";
            break;
        case "listopen":
            bbcode = "[list]"
            break;
        case "listclose":
            bbcode = "[/list]";
            break;
        case "listitem":
            bbcode = "[*]" + check_optdata(prompt("Listen-Eintrag angeben. Bitte beachten, dass Listen geöffnet und geschlossen werden müssen", ""));
            break;
        default:
            bbcode = "";
    }

    textfield.value = textfield.value + bbcode;
    textfield.focus();
    return;


}

/*
 * checks if optional data is set and prepends and/or appends strings
 */
function check_optdata(optdata, prepend, append)
{
    if(prepend==null) {
        prepend = "";
    }
    if(append==null) {
        append = "";
    }
    if(optdata==null) {
        optdata = "";
    }
    if(optdata != "") {
        optdata = prepend + optdata + append;
    }
    return optdata;
}

/* backwards ompatibility */
function DoSize (font_size) {
    AddBBCode('post', 'size', font_size);
    return;
}

function DoColor (font_color) {
    AddBBCode('post', 'color', font_color);
    return;
}

function DoCode (code) {
    AddBBCode('post', 'code', code);
    return;
}

function DoPrompt(action) {
    AddBBCode('post', 'action');
    return;
}
