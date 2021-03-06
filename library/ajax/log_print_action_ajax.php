<?php
/**
 * AJAX handler for logging a printing action.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once("../../interface/globals.php");
require_once("$srcdir/log.inc");

if (!verifyCsrfToken($_POST["csrf_token_form"])) {
    csrfNotVerified();
}

$instance = new html2text($_POST['comments']);
$h2t = &$instance;
$h2t->width = 0;
$h2t->_convert(false);

newEvent("print", $_SESSION['authUser'], $_SESSION['authProvider'], 1, $h2t->get_text());
