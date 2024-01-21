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

 // Define the namespace for this class/file.
namespace local_greetings\form;

// Add the following code, since this file should not be accessed directly.
defined('MOODLE_INTERNAL') || die();

// Load the Forms library by adding this line.
require_once($CFG->libdir . '/formslib.php');

/**
 * Create a form and process user input.
 *
 * @param TODO
 */
class message_form extends \moodleform {
    /**
     * Define the form.
     */
    public function definition() {
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('textarea', 'message', get_string('yourmessage', 'local_greetings')); // Add elements to your form.
        $mform->setType('message', PARAM_TEXT); // Set type of element.

        $submitlabel = get_string('submit');
        $mform->addElement('submit', 'submitmessage', $submitlabel);
    }
}
