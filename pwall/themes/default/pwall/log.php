<?php
/*-------------------------------------
// PaymentWall addon Created by kenik
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
if (!defined('FLUX_ROOT')) exit; ?>
<h2><?=Flux::message('PWall_DonationsLog')?></h2>

<p class="toggler"><a href="javascript:toggleSearchForm()"><?=Flux::message('PWall_Filter')?></a></p>
<form class="search-form" method="get" action="">
    <?php echo $this->moduleActionFormInputs($params->get('module'), $params->get('action')) ?>
    <p>
        <label for="perPage">Per page:</label>
        <select name="perPage">
            <option value="10"<?php if ($params->get('perPage') === '10') echo ' selected="selected"' ?>>
                10
            </option>
            <option value="25"<?php if ($params->get('perPage') === '25') echo ' selected="selected"' ?>>
                25
            </option>
            <option value="50"<?php if ($params->get('perPage') === '50') echo ' selected="selected"' ?>>
                50
            </option>
            <option value="100"<?php if ($params->get('perPage') === '100') echo ' selected="selected"' ?>>
                100
            </option>
        </select>
        <label for="account_id"><?=Flux::message('PWall_LabelAccount')?>:</label>
        <input type="text" name="account_id" value="<?=$params->get('account_id')?>" />
        <input type="submit" value="<?=Flux::message('PWall_Filter')?>" />
        <input type="button" value="<?=Flux::message('PWall_Reset')?>" onclick="reload()" />
    </p>
</form>

<?php if ($logs): ?>
    <?php echo $paginator->infoText() ?>
    <table class="horizontal-table">
        <tr>
            <th>ID</th>
            <th><?=Flux::message('PWall_LabelDate')?></th>
            <th colspan="2"><?=Flux::message('PWall_LabelAccount')?></th>
            <th><?=Flux::message('PWall_LabelOrder')?></th>
            <th><?=Flux::message('PWall_LabelAmount')?></th>
            <th><?=Flux::message('PWall_LabelCredits')?></th>
            <th><?=Flux::message('PWall_LabelType')?></th>
        </tr>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td align="right">
                    <?php echo htmlspecialchars($log->id) ?>
                </td>
                <td><?php echo htmlspecialchars($log->date); ?></td>
                <td><a href="/?module=pwall&action=log&account_id=<?=htmlspecialchars($log->account_id)?>" title="Show this account donations" >
                    <?php echo htmlspecialchars($log->account_id); ?>
                </a></td>
                <td><a href="/?module=account&action=view&id=<?=htmlspecialchars($log->account_id)?>" title="Show account info" >
                    <?php echo htmlspecialchars($log->userid); ?>
                </a></td>
                <td><?php echo htmlspecialchars($log->order); ?></td>
                <td align="right"><?php echo htmlspecialchars($log->amount); ?> <?=Flux::config('PWallCurrency')?></td>
                <td align="right"><?php echo htmlspecialchars($log->credits); ?></td>
                <td><?php echo htmlspecialchars($log->type); ?></td>
            </tr>
        <?php endforeach ?>
    </table>

    <?php echo $paginator->getHTML() ?>
<?php else: ?>
    <?=Flux::message('PWall_NoLogs')?>
<?php endif;?>
