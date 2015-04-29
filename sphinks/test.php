<?php
$s = new SphinxClient();
$s->setServer("localhost", 9312);
$s->setMatchMode(SPH_MATCH_ANY);
$s->setMaxQueryTime(3);

$result = $s->status();
print_r($result);
//$id_list = implode(',', $ids);



?>
