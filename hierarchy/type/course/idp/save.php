<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/hierarchy/course/idp/save.php');

$str_remove = get_string('remove');

///
/// Add competencies
///

// Parse input
$add = explode(',', $add);
$time = time();

foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // Load course
    if (!$course = get_record('course', 'id', (int)$addition)) {
        error('Could not load course');
    }

    // Load category
    if (!$category = get_record('course_categories', 'id', $course->category)) {
        error('Could not load category');
    }

    // Add idp course
    $idpcourse = new Object();
    $idpcourse->revision = $id;
    $idpcourse->course = $course->id;
    $idpcourse->ctime = time();

    insert_record('idp_revision_course', $idpcourse);


    // Return html
    echo '<tr>';
    echo "<td><a href=\"{$CFG->wwwroot}/course/category.php?id={$course->category}\">".format_string($category->name)."</a></td>";
    echo "<td><a href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">".format_string($course->fullname)."</a></td>";

    echo "<td style=\"text-align: center;\">";

    echo "<a href=\"{$CFG->wwwroot}/course/idp/remove.php?id={$course->id}\" title=\"$str_remove\">".
         "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

    echo "</td>";

    echo '</tr>'.PHP_EOL;
}