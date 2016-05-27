<?php
/*-------------------------------------
// PaymentWall addon created by kenik
// This addon allows you to get
// donations for your server through
// PaymentWall system:
//     https://www.paymentwall.com/
---------------------------------------
// Contact:
// Email: kenik2006@gmail.com
// Hercules: http://herc.ws/board/user/9024-kenik/
// Skype: kenik2006
-------------------------------------*/
if (!defined('FLUX_ROOT')) exit;

try {
    $pplimit = array(10, 25, 50, 100);
    $fromTable = "{$server->loginDatabase}.".Flux::config('FluxTables.PWallLogTable');
    // Parameters
    $page        = $params->get('p');
    $perPage     = (int)$params->get('perPage');
    $accid       = (int)$params->get('account_id');
    if(!$page) $page = 0; else $page -= 1;
    if(!$perPage || !in_array($perPage, $pplimit))
        $perPage = 10;

    $where = "WHERE 1=1 ";
    if($accid) {
        $where .= "AND tlog.`account_id`=".$accid." ";
    }
    $order = "ORDER BY tlog.`date` DESC, tlog.`id` DESC ";
    $limit = "LIMIT ".$page * $perPage.", ".$perPage;

    // Get total count and feed back to the paginator.
    $sql = "SELECT COUNT(`id`) AS total FROM ".$fromTable." as tlog ".$where;
    $sth = $server->connection->getStatement($sql);
    $sth->execute();

    $paginator = $this->getPaginator($sth->fetch()->total);

    // Statement parameters, joins and conditions.
    $cols = "tlog.`id`, tlog.`account_id`, tlog.`order`, tlog.`amount`, tlog.`credits`, tlog.`type`, tlog.`date`, login.userid";
    $sql = "SELECT ".$cols." FROM ".$fromTable." as tlog";
    $sql .= " LEFT JOIN `login` ON `login`.account_id = tlog.`account_id` ";
    $sql .= $where;
    $sql .= $order;
    $sql .= $limit;

    $sth = $server->connection->getStatement($sql);
    $sth->execute();
    $logs = $sth->fetchAll();

}
catch (Exception $e) {
    // Raise the original exception.
    $class = get_class($e);
    throw new $class($e->getMessage());
}
?>