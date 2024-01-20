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
$PAGE->set_context(context_system::instance());

// Each page should have a unique URL.
$PAGE->set_url(new moodle_url('/local/greetings/index.php'));

// Once the current page's URL is set, we can access it via the $PAGE->url property.
$baseurl = $PAGE->url;

// This function checks that the current user is logged in.
// If they are not logged in, then it redirects them to the site login.
require_login();

// The following code is used to set the page layout.
$PAGE->set_pagelayout('standard');

// The following code is used to set the page title.
$PAGE->set_title(get_string('pluginname', 'local_greetings'));

// To define the text that should be displayed as the main heading on the page, define the heading.
$PAGE->set_heading(get_string('pluginname', 'local_greetings'));

echo $OUTPUT->header();

// Displaying the output using localised strings!
if (isloggedin()) {
    echo local_greetings_get_greeting($USER);
} else {
    echo get_string('greetingnotloggedinuser', 'local_greetings');
}

echo $OUTPUT->footer();
