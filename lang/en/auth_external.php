<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'auth_external', language 'en'.
 *
 * @package   auth_external
 * @copyright 2019 Michael N. Lipp
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['auth_externaldescription'] = 'This plugiun uses an external program for authentication.';
$string['pluginname'] = 'External Authentication';
$string['privacy:metadata'] = 'The external authentication plugin does not store any personal data.';
$string['program'] = 'Authenticating program';
$string['programdesc'] = <<<EOT
  The program to invoke for authentication. The program receives the user name and the
  password as two lines on its stdin. If the exit value is 0, the user is authenticated.
EOT;

