<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

define("LOGIN_SUCCESSFUL", 1);
define("LOGIN_UNSUCCESSFUL", 2);
define("QUESTION_FOUND", 1);
define("QUESTION_SAVED", 2);
define("QUESTION_NOT_FOUND", 3);
define("QUESTION_SAVE_FAILED", 4);
define("UPLOAD_CSV_FAILED", 1);
define("UPLOAD_CSV_SUCCESSFUL", 2);