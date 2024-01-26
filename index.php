<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_greetings
 * @copyright   2024 Adriano Ruseler <adrianoruseler@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Basic Moodle page structure.
require_once('../../config.php');
require_once($CFG->dirroot. '/local/greetings/lib.php');

// We must specify the Moodle context to which the current page belongs.
$context = context_system::instance();
$PAGE->set_context($context);

// Each page should have a unique URL.
$PAGE->set_url(new moodle_url('/local/greetings/index.php'));

// Once the current page's URL is set, we can access it via the $PAGE->url property.
$baseurl = $PAGE->url;

// The following code is used to set the page layout.
$PAGE->set_pagelayout('standard');

// The following code is used to set the page title.
$PAGE->set_title(get_string('pluginname', 'local_greetings'));

// To define the text that should be displayed as the main heading on the page, define the heading.
$PAGE->set_heading(get_string('pluginname', 'local_greetings'));

// This function checks that the current user is logged in.
// If they are not logged in, then it redirects them to the site login.
require_login();

// Do not allow guest user!
if (isguestuser()) {
    throw new moodle_exception('noguest');
}

// Check local/greetings:postmessages and local/greetings:viewmessages capability.
$allowpost = has_capability('local/greetings:postmessages', $context);
$allowview = has_capability('local/greetings:viewmessages', $context);
$deleteanypost = has_capability('local/greetings:deleteanymessage', $context);
$deletemypost = has_capability('local/greetings:deletemymessage', $context);

$action = optional_param('action', '', PARAM_TEXT);

if ($action == 'del') {
    $id = required_param('id', PARAM_TEXT);
    if ($deleteanypost || deletemypost) {
        $params = ['id' => $id];
        // Users without permission should only delete their own post.
        if (!$deleteanypost) {
            $params += ['userid' => $USER->id];
        }
        $DB->delete_records('local_greetings_messages',  $params);
        redirect($PAGE->url); // Reload this page to remove visible sesskey.
    }
}

// This creates an instance of our form.
$messageform = new \local_greetings\form\message_form();

echo $OUTPUT->header();

// Displaying the output using localised strings!
if (isloggedin()) {
    echo local_greetings_get_greeting($USER);
} else {
    echo get_string('greetingnotloggedinuser', 'local_greetings');
}

// This will display the form on the page.
if ($allowpost) {
    $messageform->display();
}

// Display data from the database.
// Fetches all the greeting messages from the table local_greetings_message.
if ($allowview) {
    $userfields = \core_user\fields::for_name()->with_identity($context);
    $userfieldssql = $userfields->get_sql('u');

    $sql = "SELECT m.id, m.message, m.timecreated, m.userid {$userfieldssql->selects}
            FROM {local_greetings_messages} m
        LEFT JOIN {user} u ON u.id = m.userid
        ORDER BY timecreated DESC";

    $messages = $DB->get_records_sql($sql);

    // Display data from the database.
    echo $OUTPUT->box_start('card-columns');

    foreach ($messages as $m) {
        echo html_writer::start_tag('div', ['class' => 'card']);
        echo html_writer::start_tag('div', ['class' => 'card-body']);
        echo html_writer::tag('p', format_text($m->message, FORMAT_PLAIN), ['class' => 'card-text']);
        echo html_writer::tag('p', get_string('postedby', 'local_greetings', $m->firstname), ['class' => 'card-text']);
        echo html_writer::start_tag('p', ['class' => 'card-text']);
        echo html_writer::tag('small', userdate($m->timecreated), ['class' => 'text-muted']);
        if ($deleteanypost || ($deletemypost && $m->userid == $USER->id)) {
            echo html_writer::start_tag('p', ['class' => 'card-footer text-center']);
            echo html_writer::link(
                new moodle_url(
                    '/local/greetings/index.php',
                    ['action' => 'del', 'id' => $m->id]
                ),
                $OUTPUT->pix_icon('t/delete', '') . get_string('delete')
            );
            echo html_writer::end_tag('p');
        }
        echo html_writer::end_tag('p');
        echo html_writer::end_tag('div');
        echo html_writer::end_tag('div');
    }
    echo $OUTPUT->box_end();
}

// When the user types a message and clicks the submit button, we will simply output the message on the screen.
if ($data = $messageform->get_data()) {

    require_capability('local/greetings:postmessages', $context);
    // This retrieves the submitted message from the form and displays it on the page.
    $message = required_param('message', PARAM_TEXT);
        // Handy way to check what data has been submitted by the form.
    var_dump($data);

    if (!empty($message)) {
        $record = new stdClass;
        $record->message = $message;
        $record->timecreated = time();
        $record->userid = $USER->id;

        $DB->insert_record('local_greetings_messages', $record);
        redirect($PAGE->url); // Reload this page to remove visible sesskey.
    }
}

echo $OUTPUT->footer();
