<?php

require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=hackton',
        'root', 'root' );
// работает на сессиях
session_start();