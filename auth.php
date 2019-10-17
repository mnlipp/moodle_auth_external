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
 * Authenticate user (re-)using a program written for Apache2
 * auth_external (https://github.com/phokz/mod-auth-external/tree/master/mod_authnz_external).
 *
 * @package auth_external
 * @author Michael N. Lipp
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

/**
 * Plugin for external authentication.
 */
class auth_plugin_external extends auth_plugin_base {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->authtype = 'external';
        $this->config = get_config('auth_external');
    }

    /**
     * Returns true if the invoked program exits with 0.
     * Username and password are passed to the program
     * as two lines of input.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
    function user_login ($username, $password) {
        global $CFG, $DB;
	$program = $this->config->program;
	$handle = popen($program, 'w');
	fwrite($handle, "$username\n$password\n");
	fflush($handle);
	$result = pclose($handle);
        return $result == 0;
    }

    /**
     * This plugin is intended only to authenticate users.
     * User synchronization must be done by external service,
     * using Moodle's webservices.
     *
     * @param progress_trace $trace
     * @param bool $doupdates  Optional: set to true to force an update of existing accounts
     * @return int 0 means success, 1 means failure
     */
    public function sync_users(progress_trace $trace, $doupdates = false) {
        return true;
    }

    public function get_userinfo($username) {
        return array();
    }

    function prevent_local_passwords() {
        return true;
    }

    /**
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return bool
     */
    function is_internal() {
        return false;
    }

    /**
     * Indicates if moodle should automatically update internal user
     * records with data from external sources using the information
     * from auth_plugin_base::get_userinfo().
     * The external service is responsible to update user records.
     *
     * @return bool true means automatically copy data from ext to user table
     */
    public function is_synchronised_with_external() {
        return false;
    }

}


