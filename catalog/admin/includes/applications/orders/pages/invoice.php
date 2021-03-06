<?php
/**
  @package    catalog::admin::applications
  @author     Loaded Commerce
  @copyright  Copyright 2003-2014 Loaded Commerce, LLC
  @copyright  Portions Copyright 2003 osCommerce
  @copyright  Template built on Developr theme by DisplayInline http://themeforest.net/user/displayinline under Extended license 
  @license    https://github.com/loadedcommerce/loaded7/blob/master/LICENSE.txt
  @version    $Id: invoice.php v1.0 2013-08-08 datazen $
*/
global $lC_Vqmod;

require_once($lC_Vqmod->modCheck('../includes/classes/currencies.php'));
$lC_Currencies = new lC_Currencies();
require_once($lC_Vqmod->modCheck('includes/classes/tax.php'));
$lC_Tax = new lC_Tax_Admin();
$lC_Order = new lC_Order($_GET['oid']);
?>
<!-- Main content -->
<section role="main" id="main">
  <noscript class="message black-gradient simpler"><?php echo $lC_Language->get('ms_error_javascript_not_enabled_warning'); ?></noscript>
  <hgroup id="main-title" class="thin">
    <h1><?php echo $lC_Template->getPageTitle(); ?></h1>
  </hgroup>
  <div class="with-padding-no-top">
    <table border="0" width="100%" cellspacing="0" cellpadding="2" class="table responsive-table">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo nl2br(STORE_NAME_ADDRESS); ?></td>
              <td class="pageHeading" align="right"><?php echo lc_image('../images/store_logo.jpg', STORE_NAME); ?></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><b><?php echo $lC_Language->get('subsection_billing_address'); ?></b></td>
                  </tr>
                  <tr>
                    <td><?php echo lC_Address::format($lC_Order->getBilling(), '<br />'); ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?php echo $lC_Order->getCustomer('telephone'); ?></td>
                  </tr>
                  <tr>
                    <td><?php echo '<a href="mailto:' . $lC_Order->getCustomer('email_address') . '"><u>' . $lC_Order->getCustomer('email_address') . '</u></a>'; ?></td>
                  </tr>
                </table></td>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><b><?php echo $lC_Language->get('subsection_shipping_address'); ?></b></td>
                  </tr>
                  <tr>
                    <td><?php echo lC_Address::format($lC_Order->getDelivery(), '<br />'); ?></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td><b><?php echo $lC_Language->get('subsection_payment_method'); ?></b></td>
              <td>&nbsp;<?php echo $lC_Order->getPaymentMethod(); ?></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable">
            <thead>
              <tr>
                <th align="left" colspan="2"><?php echo $lC_Language->get('table_heading_products'); ?></th>
                <th align="left"><?php echo $lC_Language->get('table_heading_product_model'); ?></th>
                <th align="right"><?php echo $lC_Language->get('table_heading_tax'); ?></th>
                <th align="right"><?php echo $lC_Language->get('table_heading_price_net'); ?></th>
                <th align="right"><?php echo $lC_Language->get('table_heading_price_gross'); ?></th>
                <th align="right"><?php echo $lC_Language->get('table_heading_total_net'); ?></th>
                <th align="right"><?php echo $lC_Language->get('table_heading_total_gross'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($lC_Order->getProducts() as $product) {
                  echo '<tr>' . "\n" .
                       '  <td colspan="2" align="left" valign="top">' . $product['quantity'] . '&nbsp;x&nbsp;' . "\n" . $product['name'];
                  if (isset($product['attributes']) && (sizeof($product['attributes']) > 0)) {
                    foreach ($product['attributes'] as $attribute) {
                      echo '<br /><nobr>&nbsp;&nbsp;- <span class="small"><i>' . $attribute['option'] . ': ' . $attribute['value'] . '</i></span></nobr>';
                    }
                  }
                  if ( isset($product['options']) && is_array($product['options']) && ( sizeof($product['options']) > 0 ) ) {
                    foreach ( $product['options'] as $key => $val ) {
                      echo '<br /><nobr>&nbsp;&nbsp;- <span class="small"><i>' . $val['group_title'] . ': ' . $val['value_title'] . '</i></span></nobr>';
                    }
                  }                  
                  echo '          </td>' . "\n" .
                  '          <td valign="top">' . $product['model'] . '</td>' . "\n";
                  echo '          <td align="right" valign="top">' . $lC_Tax->displayTaxRateValue($product['tax']) . '</td>' . "\n" .
                  '          <td align="right" valign="top"><b>' . $lC_Currencies->format($product['price'], true, $lC_Order->getCurrency(), $lC_Order->getCurrencyValue()) . '</b></td>' . "\n" .
                  '          <td align="right" valign="top"><b>' . $lC_Currencies->displayPriceWithTaxRate($product['price'], $product['tax'], 1, true, $lC_Order->getCurrency(), $lC_Order->getCurrencyValue()) . '</b></td>' . "\n" .
                  '          <td align="right" valign="top"><b>' . $lC_Currencies->format($product['price'] * $product['quantity'], true, $lC_Order->getCurrency(), $lC_Order->getCurrencyValue()) . '</b></td>' . "\n" .
                  '          <td align="right" valign="top"><b>' . $lC_Currencies->displayPriceWithTaxRate($product['price'], $product['tax'], $product['quantity'], true, $lC_Order->getCurrency(), $lC_Order->getCurrencyValue()) . '</b></td>' . "\n";
                  echo '        </tr>' . "\n";
                }
              ?>
            </tbody>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <?php
              foreach ($lC_Order->getTotals() as $total) {
                echo '      <tr>' . "\n" .
                '        <td align="right">' . $total['title'] . '</td>' . "\n" .
                '        <td align="right">' . $total['text'] . '</td>' . "\n" .
                '      </tr>' . "\n";
              }
            ?>
          </table></td>
      </tr>
    </table>
    <div class="clear-both"></div>
  </div>
</section>
<?php $lC_Template->loadModal($lC_Template->getModule()); ?>
<!-- End main content -->