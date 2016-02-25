<meta charset='utf-8'>
<?php
require_once('example-5-04.php');
require_once('example-5-05.php');
require_once('example-5-06.php');
require_once('example-5-08.php');

function page_header() {
    print '<html><head><title>Welcome to my site</title></head>';
    print '<body bgcolor="#ffffff">';
}

//page_header();
//page_header2();
//page_header3('cc00cc');
//page_header4('66cc66');
//page_header5('66cc99','my wonderful page'); // uses default $header
//page_header5('66cc99'); // no defaults
//page_header6('66cc99'); // uses default $title and $header
//page_header6('66cc99','Yamauhi\'s Page!!!'); // uses default $header
//page_header6(); // no defaults
page_header7(); // uses all defaults
//page_header7('66cc99'); // uses default $title and $header
//page_header7('66cc99','my wonderful page'); // uses default $header
//page_header7('66cc99','my wonderful page','This page is great!'); // no defaults

$user = 'Yamauchi';
print "Welcome, $user";
page_footer();

function page_footer() {
    print '<hr>Thanks for visiting.';
    print '</body></html>';
}
