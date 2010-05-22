<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: donation.html 479 2009-03-15 11:19:27Z kevin74 $ //-->
<?php echo (isset($this->_tpldata['DEFINE']['.']['C_BLOCK_H_L'])) ? $this->_tpldata['DEFINE']['.']['C_BLOCK_H_L'] : ''; ?><dl><dt><?php echo ((isset($this->_rootref['L_DONATION'])) ? $this->_rootref['L_DONATION'] : ((isset($user->lang['DONATION'])) ? $user->lang['DONATION'] : '{ DONATION }')); ?></dt></dl><?php echo (isset($this->_tpldata['DEFINE']['.']['C_BLOCK_H_R'])) ? $this->_tpldata['DEFINE']['.']['C_BLOCK_H_R'] : ''; ?>
	<ul class="topiclist forums">
		<li><dl>
			<dd style="border-left: 0px">
				<div style="text-align: left; margin: 5px 5px 5px 5px">
                   <strong><?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?></strong> <?php echo ((isset($this->_rootref['L_DONATION_TEXT'])) ? $this->_rootref['L_DONATION_TEXT'] : ((isset($user->lang['DONATION_TEXT'])) ? $user->lang['DONATION_TEXT'] : '{ DONATION_TEXT }')); ?>
                   <br />
                   <div style="float: left; padding: 5px 5px 5px 5px"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/portal/paypal.gif" alt="" /></div>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="padding-top:15px">
                <div>
                   <input type="hidden" name="cmd" value="_xclick" />
                   <input type="hidden" name="business" value="<?php echo (isset($this->_rootref['PAY_ACC'])) ? $this->_rootref['PAY_ACC'] : ''; ?>" />
                   <input type="hidden" name="item_name" value="<?php echo ((isset($this->_rootref['L_PAY_ITEM'])) ? $this->_rootref['L_PAY_ITEM'] : ((isset($user->lang['PAY_ITEM'])) ? $user->lang['PAY_ITEM'] : '{ PAY_ITEM }')); ?>" />
                   <input type="hidden" name="no_note" value="1" />
                   <input type="hidden" name="no_shipping" value="2" />
                   <input type="hidden" name="bn" value="PP-DonationsBF" />
                   <input type="hidden" name="tax" value="0" />
                   <input type="text" tabindex="11" name="amount" size="10" maxlength="6" value="" class="inputbox autowidth" title="<?php echo ((isset($this->_rootref['L_PAY_MSG'])) ? $this->_rootref['L_PAY_MSG'] : ((isset($user->lang['PAY_MSG'])) ? $user->lang['PAY_MSG'] : '{ PAY_MSG }')); ?>" />
                   <select name="currency_code" class="autowidth">
                        <option value="USD"><?php echo ((isset($this->_rootref['L_USD'])) ? $this->_rootref['L_USD'] : ((isset($user->lang['USD'])) ? $user->lang['USD'] : '{ USD }')); ?></option>
                      <option value="AUD"><?php echo ((isset($this->_rootref['L_AUD'])) ? $this->_rootref['L_AUD'] : ((isset($user->lang['AUD'])) ? $user->lang['AUD'] : '{ AUD }')); ?></option>
                      <option value="CAD"><?php echo ((isset($this->_rootref['L_CAD'])) ? $this->_rootref['L_CAD'] : ((isset($user->lang['CAD'])) ? $user->lang['CAD'] : '{ CAD }')); ?></option>
                      <option value="CZK"><?php echo ((isset($this->_rootref['L_CZK'])) ? $this->_rootref['L_CZK'] : ((isset($user->lang['CZK'])) ? $user->lang['CZK'] : '{ CZK }')); ?></option>
                      <option value="DKK"><?php echo ((isset($this->_rootref['L_DKK'])) ? $this->_rootref['L_DKK'] : ((isset($user->lang['DKK'])) ? $user->lang['DKK'] : '{ DKK }')); ?></option>
                      <option value="EUR" selected="selected"><?php echo ((isset($this->_rootref['L_EUR'])) ? $this->_rootref['L_EUR'] : ((isset($user->lang['EUR'])) ? $user->lang['EUR'] : '{ EUR }')); ?></option>
                      <option value="HKD"><?php echo ((isset($this->_rootref['L_HKD'])) ? $this->_rootref['L_HKD'] : ((isset($user->lang['HKD'])) ? $user->lang['HKD'] : '{ HKD }')); ?></option>
                      <option value="HUF"><?php echo ((isset($this->_rootref['L_HUF'])) ? $this->_rootref['L_HUF'] : ((isset($user->lang['HUF'])) ? $user->lang['HUF'] : '{ HUF }')); ?></option>
                      <option value="NZD"><?php echo ((isset($this->_rootref['L_NZD'])) ? $this->_rootref['L_NZD'] : ((isset($user->lang['NZD'])) ? $user->lang['NZD'] : '{ NZD }')); ?></option>
                      <option value="NOK"><?php echo ((isset($this->_rootref['L_NOK'])) ? $this->_rootref['L_NOK'] : ((isset($user->lang['NOK'])) ? $user->lang['NOK'] : '{ NOK }')); ?></option>
                      <option value="PLN"><?php echo ((isset($this->_rootref['L_PLN'])) ? $this->_rootref['L_PLN'] : ((isset($user->lang['PLN'])) ? $user->lang['PLN'] : '{ PLN }')); ?></option>
                      <option value="GBP"><?php echo ((isset($this->_rootref['L_GBP'])) ? $this->_rootref['L_GBP'] : ((isset($user->lang['GBP'])) ? $user->lang['GBP'] : '{ GBP }')); ?></option>
                      <option value="SGD"><?php echo ((isset($this->_rootref['L_SGD'])) ? $this->_rootref['L_SGD'] : ((isset($user->lang['SGD'])) ? $user->lang['SGD'] : '{ SGD }')); ?></option>
                      <option value="SEK"><?php echo ((isset($this->_rootref['L_SEK'])) ? $this->_rootref['L_SEK'] : ((isset($user->lang['SEK'])) ? $user->lang['SEK'] : '{ SEK }')); ?></option>
                      <option value="CHF"><?php echo ((isset($this->_rootref['L_CHF'])) ? $this->_rootref['L_CHF'] : ((isset($user->lang['CHF'])) ? $user->lang['CHF'] : '{ CHF }')); ?></option>
                      <option value="JPY"><?php echo ((isset($this->_rootref['L_JPY'])) ? $this->_rootref['L_JPY'] : ((isset($user->lang['JPY'])) ? $user->lang['JPY'] : '{ JPY }')); ?></option>
                      <option value="MXN"><?php echo ((isset($this->_rootref['L_MXN'])) ? $this->_rootref['L_MXN'] : ((isset($user->lang['MXN'])) ? $user->lang['MXN'] : '{ MXN }')); ?></option>
                      <option value="ILS"><?php echo ((isset($this->_rootref['L_ILS'])) ? $this->_rootref['L_ILS'] : ((isset($user->lang['ILS'])) ? $user->lang['ILS'] : '{ ILS }')); ?></option>
                   </select>
                   <input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_DONATION'])) ? $this->_rootref['L_DONATION'] : ((isset($user->lang['DONATION'])) ? $user->lang['DONATION'] : '{ DONATION }')); ?>" class="button1" />
                </div>
                </form>
                   <br />
                   <strong><?php echo ((isset($this->_rootref['L_PAY_MSG'])) ? $this->_rootref['L_PAY_MSG'] : ((isset($user->lang['PAY_MSG'])) ? $user->lang['PAY_MSG'] : '{ PAY_MSG }')); ?></strong>
                </div>
			</dd>
		</dl></li>
	</ul>
<?php echo (isset($this->_tpldata['DEFINE']['.']['C_BLOCK_F_L'])) ? $this->_tpldata['DEFINE']['.']['C_BLOCK_F_L'] : ''; echo (isset($this->_tpldata['DEFINE']['.']['C_BLOCK_F_R'])) ? $this->_tpldata['DEFINE']['.']['C_BLOCK_F_R'] : ''; ?>