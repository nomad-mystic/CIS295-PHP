<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/25/2016
 * Time: 11:30 PM
 */

header('Content-Type: text/javascript');
?>

var loadContent = (function()
{
    var loaded = [];

    // Local Functions
    function addHTML(html, where)
    {
        if (where) {
            $(where).append(html);
        } else {
            $('body').append(html);
        }

    }
    function addJS(js, callback)
    {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'data:text/javascript;base64,' + btoa(js);
        script.addEventListener('load', callback);
        document.head.appendChild(script);
    }
    function addCSS(css)
    {
        $('<style>')
            .text(css)
            .appendTo('head');
    }

    return function(path, callback, where)
    {
        if (loaded.indexOf(path) > -1) {
            callback();
        } else {
            loaded.push(path);
            $.get(path, function(data) {
                if (data.html) {
                    addHTML(data.html, where);
                }
                if (data.css) {
                    addCSS(data.css);
                }
                if (data.js) {
                    addJS(data.js, callback);
                } else {
                    callback();
                }
            }); // end get
        }
    }; // end return
})(); // closure
