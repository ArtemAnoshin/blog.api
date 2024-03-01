<?php

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;

require 'vendor/autoload.php';

require 'config/routes.php';
require 'helpers/router-helpers.php';

SimpleRouter::start();