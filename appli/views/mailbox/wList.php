<table class="results" align="center">
    <?php if (empty($this->userMessages)) : ?>
        <tr>
            <td style='text-align:center;padding-top:20px;' colspan='4'>Aucun message</td>
        </tr>
    <?php else : ?>
        <?php $this->render('mailbox/wItems'); ?>
    <?php endif; ?>
    <tr>
        <td>
            <img class="loading" src="planski/images/icones/loading.gif" style="display:none;" data-show="false" data-offset="0" data-href="mailbox" data-end="false" />
        </td>
    </tr>
</table>
