<?php

/*
 * This file is part of the IOTA PHP package.
 *
 * (c) Benjamin Ansbach <benjaminansbach@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IOTA\Apps\Explorer;

error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(0);
require_once __DIR__.'/vendor/autoload.php';

use IOTA\DI\IOTAContainer;
use IOTA\Client;
use IOTA\Node;

$nodes = [
    new Node('http://service.iotasupport.com:14265'),
];

$options = [
    'keccak384-nodejs' => 'http://127.0.0.1:8081',
    'ccurlPath' => __DIR__.'/../../ccurl',
];

return new Client(new IOTAContainer($options), $nodes);
