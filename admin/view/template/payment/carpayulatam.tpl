<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location='<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    <table class="form">
      <tr>
        <td width="25%"><span class="required">*</span> <?php echo $entry_merchantId; ?></td>
        <td><input type="text" name="carpayulatam_merchantId" value="<?php echo $carpayulatam_merchantId; ?>" /></td>
      </tr>
	  
      <tr>
        <td><span class="required">*</span> <?php echo $entry_apiKey; ?></td>
        <td><input type="text" name="carpayulatam_apiKey" value="<?php echo $carpayulatam_apiKey; ?>" /></td>
      </tr>
      <tr>
        <td><span class="required">*</span> <?php echo $entry_apiLogin; ?></td>
        <td><input type="text" name="carpayulatam_apiLogin" value="<?php echo $carpayulatam_apiLogin; ?>" /></td>
      </tr>
      <tr>
        <td><span class="required">*</span> <?php echo $entry_publicKey; ?></td>
        <td><input type="text" name="carpayulatam_publicKey" value="<?php echo $carpayulatam_publicKey; ?>" /></td>
      </tr>
      <tr>
        <td><span class="required">*</span> <?php echo $entry_accountId; ?></td>
        <td><input type="text" name="carpayulatam_accountId" value="<?php echo $carpayulatam_accountId; ?>" /></td>
      </tr>

	  
	  <tr>
        <td><?php echo $entry_status; ?></td>
        <td><select name="carpayulatam_status">
            <?php if ($carpayulatam_status) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } ?>
          </select></td>
      </tr>
	  
	  
	  <tr>
        <td><?php echo $entry_order_status; ?></td>
        <td><select name="carpayulatam_order_status_id">
            <?php foreach ($order_statuses as $order_status) { ?>
            <?php if ($order_status['order_status_id'] == $carpayulatam_order_status_id) { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></td>
      </tr>  
	  <tr>
        <td><?php echo $entry_sort_order; ?></td>
        <td><input type="text" name="carpayulatam_sort_order" value="<?php echo $carpayulatam_sort_order; ?>" size="1" /></td>
      </tr>
	  
	  <tr>
        <td><?php echo $entry_prueba; ?></td>
        <td>
		<label>Si<input type="radio" name="carpayulatam_prueba" value="1" <?php echo $carpayulatam_prueba=="1"?"checked":"" ?>/></label>
		<label>No<input type="radio" name="carpayulatam_prueba" value="0" <?php echo $carpayulatam_prueba!="1"?"checked":"" ?> /></label>
		</td>
      </tr>
    </table>
  </div>
</form>
</div>
<?php echo $footer; ?>