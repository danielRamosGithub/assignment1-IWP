/*
 * App.js
 * Author: Daniel Costa Ramos - 200354269
 * Web	site: Portfolio
 * Description: JavaScript file to inject and control the content from the pages.
 */
"use strict"; 

// IIFE
// (function() {
    // function to show what menu is active
    $('ul.nav > li').click(function () {
        // changing background from the links in the nav
        $('ul.nav > li').removeClass('active');
        $(this).addClass('active');
    });

    // function do alternate between the pages (ABOUT ME, PROJECTS, CONTACT)
    function show_Pages(show, hidden1, hidden2) {
        document.getElementById(show).style.display = "block";
        document.getElementById(hidden1).style.display = "none";
        document.getElementById(hidden2).style.display = "none";
        return false;
    }

// })();