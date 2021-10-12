<?php

session_start();
session_unset();
session_destroy();

$text = ["session"=>"logged out"];