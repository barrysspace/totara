<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/download_form.php');

$id = required_param('id',PARAM_INT);
$format = optional_param('format',null,PARAM_TEXT);

$download = new download_form();

if($fromform = $download->get_data()) {
    // print download links instead of table
    $pagetitle = format_string(get_string('download','local'));
    $navlinks[] = array('name' => get_string('reportbuilder','local'), 'link'=> '', 'type'=>'title');

    $navigation = build_navigation($navlinks);
    print_header_simple($pagetitle, '', $navigation, '', '', true);

    // display heading including filtering stats
    print_heading(get_string('export','local'));
    print_box_start();

    echo '<ul>';
    echo '<li><a href="download.php?id='.$id.'&amp;format=csv">'.get_string('exportcsv','local').'</a></li>';
    echo '<li><a href="download.php?id='.$id.'&amp;format=ods">'.get_string('exportods','local').'</a></li>';
    echo '<li><a href="download.php?id='.$id.'&amp;format=xls">'.get_string('exportxls','local').'</a></li>';
    echo '</ul>';

    print_box_end();
    print_footer();

    die;


}

if ($format) {
    // send export data instead of table
    $shortname = get_field('report_builder','shortname','id',$id);
    $report = new reportbuilder($shortname);
    if(!$report->is_capable()) {
        error(get_string('nopermission','local'));
    }
    $report->export_data($format);
    die;
}

error(get_string('exportproblem','local'));