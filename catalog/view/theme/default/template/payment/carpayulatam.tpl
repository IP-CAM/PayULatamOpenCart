<form method="post" action="<?php echo $action; ?>" id="payment">

<input name="merchantId"  type="hidden" value="<?php echo $merchantId; ?>">
<input name="referenceCode" type="hidden" value="<?php echo $referenceCode; ?>">
<input name="extra1" type="hidden" value="<?php foreach ($extra1 as $ext)echo $ext."\n"; ?>">
<input name="extra2" type="hidden" value="<?php echo $extra2; ?>">
<input name="test" type="hidden" value="<?php echo $test; ?>">
<input name="description" type="hidden" value="<?php echo $description; ?>">
<input name="amount" id="valor" type="hidden" value="<?php echo $amount; ?>">
<input name="taxReturnBase" type="hidden" value="<?php echo $taxReturnBase; ?>">
<input name="tax" type="hidden" value="<?php echo $tax; ?>">
<input name="currency" id="moneda" type="hidden" value="<?php echo $currency; ?>">
<input name="signature" type="hidden" value="<?php echo $signature; ?>">
<input name="responseUrl" type="hidden" value="<?php echo $responseUrl; ?>">
<input name="confirmationUrl" type="hidden" value="<?php echo $confirmationUrl; ?>">
<input name="buyerEmail" type="hidden" value="<?php echo  $buyerEmail;?>">
<input name="accountId" type="hidden" value="<?php echo  $accountId;?>">

</form>

<div class="buttons">
  <table>
    <tr>
      <td align="right"><a onclick="$('#payment').submit();" class="button"><span><?php echo $button_confirm; ?></span></a></td>
    </tr>
  </table>
</div>