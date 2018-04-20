﻿/*
 Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license

 If you find an error please let me know (helmoe {AT} gmail {DOTCOM}
*/
CKEDITOR.plugins.add("symbol", {
    availableLangs: {
        en: 1,
        bg: 1
    },
    lang: "en",
    requires: "dialog",
    icons: "symbol",
    init: function(a) {
        var c = this;
        CKEDITOR.dialog.add("symbol", this.path + "dialogs/symbol.js");
        a.addCommand("symbol", {
            exec: function() {
                if (a.config.removeSymbolRanges && 0 < a.config.removeSymbolRanges.length)
                    for (var d = a.config.removeSymbolRanges.length - 1; 0 <= d; d--) {
                        var e = a.config.removeSymbolRanges[d];
                        e < a.config.symbolRanges.length && a.config.symbolRanges.splice(e, 1)
                    }
                var b = a.langCode,
                    b = c.availableLangs[b] ? b : c.availableLangs[b.replace(/-.*/,
                        "")] ? b.replace(/-.*/, "") : "en";
                CKEDITOR.scriptLoader.load(CKEDITOR.getUrl(c.path + "dialogs/lang/" + b + ".js"), function() {
                    CKEDITOR.tools.extend(a.lang.symbol, c.langEntries[b]);
                    a.openDialog("symbol")
                })
            },
            modes: {
                wysiwyg: 1
            },
            canUndo: !1
        });
        a.ui.addButton && a.ui.addButton("Symbol", {
            label: "Insert symbol",
            command: "symbol",
            toolbar: "insert"
        })
    }
});
CKEDITOR.config.symbolRanges = [
    ["Basic Latin", "0020-007E"],
    ["Latin-1 Supplement", "00A0-00B0,00B1,00B2-00FF"],
    ["Latin Extended-A", "0100-017F"],
    ["Latin Extended-B", "0180-024F"],
    ["IPA Extensions", "0250-02AF"],
    ["Spacing Modifier Letters", "02B0-02FF"],
    ["Combining Diacritical Marks", "0300-036F*"],
    ["Greek and Coptic", "0370-03FF"],
    ["Cyrillic", "0400-04FF"],
    ["Cyrillic Supplementary", "0500-052F"],
    ["Armenian", "0530-058F"],
    ["Hebrew", "0590-05FF"],
    ["Arabic", "0600-06FF"],
    ["Syriac", "0700-074F"],
    ["Thaana", "0780-07BF"],
    ["Devanagari", "0900-097F"],
    ["Bengali", "0980-09FF"],
    ["Gurmukhi", "0A00-0A7F"],
    ["Gujarati", "0A80-0AFF"],
    ["Oriya", "0B00-0B7F"],
    ["Tamil", "0B80-0BFF"],
    ["Telugu", "0C00-0C7F"],
    ["Kannada", "0C80-0CFF"],
    ["Malayalam", "0D00-0D7F"],
    ["Sinhala", "0D80-0DFF"],
    ["Thai", "0E00-0E7F"],
    ["Lao", "0E80-0EFF"],
    ["Tibetan", "0F00-0FFF"],
    ["Myanmar", "1000-109F"],
    ["Georgian", "10A0-10FF"],
    ["Hangul Jamo", "1100-11FF"],
    ["Ethiopic", "1200-137F"],
    ["Cherokee", "13A0-13FF"],
    ["Unified Canadian Aboriginal Syllabics", "1400-167F"],
    ["Ogham", "1680-169F"],
    ["Runic", "16A0-16FF"],
    ["Tagalog", "1700-171F"],
    ["Hanunoo", "1720-173F"],
    ["Buhid", "1740-175F"],
    ["Tagbanwa", "1760-177F"],
    ["Khmer", "1780-17FF"],
    ["Mongolian", "1800-18AF"],
    ["Limbu", "1900-194F"],
    ["Tai Le", "1950-197F"],
    ["Khmer Symbols", "19E0-19FF"],
    ["Phonetic Extensions", "1D00-1D7F"],
    ["Latin Extended Additional", "1E00-1EFF"],
    ["Greek Extended", "1F00-1FFF"],
    ["General Punctuation", "2000-206F"],
    ["Superscripts and Subscripts", "2070-209F"],
    ["Currency Symbols", "20A0-20CF"],
    ["Combining Diacritical Marks for Symbols",
        "20D0-20FF"
    ],
    ["Letterlike Symbols", "2100-214F"],
    ["Number Forms", "2150-218F"],
    ["Arrows", "2190-21FF"],
    ["Mathematical Operators", "2200-22FF"],
    ["Miscellaneous Technical", "2300-23FF"],
    ["Control Pictures", "2400-243F"],
    ["Optical Character Recognition", "2440-245F"],
    ["Enclosed Alphanumerics", "2460-24FF"],
    ["Box Drawing", "2500-257F"],
    ["Block Elements", "2580-259F"],
    ["Geometric Shapes", "25A0-25FF"],
    ["Miscellaneous Symbols", "2600-26FF"],
    ["Dingbats", "2700-27BF"],
    ["Miscellaneous Mathematical Symbols-A", "27C0-27EF"],
    ["Supplemental Arrows-A", "27F0-27FF"],
    ["Braille Patterns", "2800-28FF"],
    ["Supplemental Arrows-B", "2900-297F"],
    ["Miscellaneous Mathematical Symbols-B", "2980-29FF"],
    ["Supplemental Mathematical Operators", "2A00-2AFF"],
    ["Miscellaneous Symbols and Arrows", "2B00-2BFF"],
    ["CJK Radicals Supplement", "2E80-2EFF"],
    ["Kangxi Radicals", "2F00-2FDF"],
    ["Ideographic Description Characters", "2FF0-2FFF"],
    ["CJK Symbols and Punctuation", "3000-303F"],
    ["Hiragana", "3040-309F"],
    ["Katakana", "30A0-30FF"],
    ["Bopomofo", "3100-312F"],
    ["Hangul Compatibility Jamo", "3130-318F"],
    ["Kanbun", "3190-319F"],
    ["Bopomofo Extended", "31A0-31BF"],
    ["Katakana Phonetic Extensions", "31F0-31FF"],
    ["Enclosed CJK Letters and Months", "3200-32FF"],
    ["CJK Compatibility", "3300-33FF"],
    ["CJK Unified Ideographs Extension A", "3400-4DBF"],
    ["Yijing Hexagram Symbols", "4DC0-4DFF"],
    ["CJK Unified Ideographs", "4E00-9FFF"],
    ["Yi Syllables", "A000-A48F"],
    ["Yi Radicals", "A490-A4CF"],
    ["Hangul Syllables", "AC00-D7AF"],
    ["High Surrogates", "D800-DB7F"],
    ["High Private Use Surrogates",
        "DB80-DBFF"
    ],
    ["Low Surrogates", "DC00-DFFF"],
    ["Private Use Area", "E000-F8FF"],
    ["CJK Compatibility Ideographs", "F900-FAFF"],
    ["Alphabetic Presentation Forms", "FB00-FB4F"],
    ["Arabic Presentation Forms-A", "FB50-FDFF"],
    ["Variation Selectors", "FE00-FE0F"],
    ["Combining Half Marks", "FE20-FE2F"],
    ["CJK Compatibility Forms", "FE30-FE4F"],
    ["Small Form Variants", "FE50-FE6F"],
    ["Arabic Presentation Forms-B", "FE70-FEFF"],
    ["Halfwidth and Fullwidth Forms", "FF00-FFEF"],
    ["Specials", "FFF0-FFFF"]
];
