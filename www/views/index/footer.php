<?php

echo makeFooter();

function makeFooter() {
    global $currentYear;
    return "<footer>© 2020 - " . $currentYear . "</footer>";
}