<?php

namespace IOTA\Apps\Explorer;

use IOTA\Client;
use IOTA\RemoteApi\Commands\FindTransactions;
use IOTA\RemoteApi\Commands\GetBalances;
use IOTA\Type\Address;

/** @var Client $iota */
$iota = include __DIR__.'/bootstrap.php';

/** @var GetBalances\Response $balanceInfos */
$balanceInfos = $iota->getRemoteApi()->getBalances([new Address($_GET['a'])]);
if ($balanceInfos->isError()) {
    die(print_r($balanceInfos));
}

// better mapping will follow later on
$balance = array_combine([$_GET['a']], $balanceInfos->getBalances())[$_GET['a']];

/** @var FindTransactions\Response $transactions */
$transactions = $api->findTransactions([], [new Address($_GET['a'])]);

?>

<h2>Address info</h2>
<h3>Address</h3>
<p><?php echo $_GET['a']; ?></p>
<h3>Balance</h3>
<p><?php echo $balance; ?></p>
<h3>Latest confirmed milestone</h3>
<p><?php echo $balanceInfos->getMilestone(); ?> (<?php echo $balanceInfos->getMilestone()->getIndex(); ?>)</p>
<h3>Transactions</h3>
<?php foreach ($transactions->getTransactionHashes() as $transaction) : ?>
<p><a href="transaction.php?t=<?php echo $transaction; ?>"><?php echo $transaction; ?></a></p>
<?php endforeach; ?>
