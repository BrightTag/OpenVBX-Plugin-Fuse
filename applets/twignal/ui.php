<?php 
$keys = AppletInstance::getValue('keys[]', array('1','2'));

if (!function_exists("printBuiltIns")) {
  function printBuiltIns($i) {
    $points = array(
      # https://www.twilio.com/docs/api/twiml/twilio_request#synchronous-request-parameters
      "CallSid"       => array(0, "Unique call identifier."),
      "From"          => array(1, "Phone number or client identifier that initiated the call."),
      "To"            => array(2, "Phone number or client identifier of the called party."),
      "CallStatus"    => array(3, "Descriptive status for the call."),
      "Direction"     => array(4, "Direction of the call (<code>inbound</code>, <code>outbount-api</code>, <code>outbound-dial</code>)."),
      "ForwardedFrom" => array(5, "Forwarded phone number or client identifier (optional)."),
      "CallerName"    => array(6, "Caller name from <a href=\"https://www.twilio.com/docs/api/rest/incoming-phone-numbers#instance-properties\">VoiceCallerIdLookup</a>."),
      "FromCity"      => array(7, "The city of the caller (optional)."),
      "FromState"     => array(8, "The state or province of the caller (optional)."),
      "FromZip"       => array(9, "The postal code of the caller (optional)."),
      "FromCountry"   => array(10, "The country of the caller (optional)."),
      "ToCity"        => array(11, "The city of the called party (optional)."),
      "ToState"       => array(12, "The state or province of the called party (optional)."),
      "ToZip"         => array(13, "The postal code of the called party (optional)."),
      "ToCountry"     => array(14, "The country of the called party (optional).")
    );

    echo "<select name=\"keys[]\">";
    foreach($points as $key => $val) {
      $selected = ($i == $val[0]) ? 'selected="selected" ' : '';
      echo "<option " . $selected . "value=" . $key . ">" . $key . ": " . $val[1] . "</option>";
    }
    echo "</select>";
  }
}
?>

<div class="vbx-applet signal-applet">
	<div class="vbx-full-pane">
		<h3>Signal Fuse Account</h3>
		<fieldset class="vbx-input-container">
			<input type="text" name="account" class="medium" value="<?php echo AppletInstance::getValue('account','abc123'); ?>" />
		</fieldset>
		<h3>Tracking Event</h3>
		<p>Use %caller% to substitute the caller's number or %number% for the number called.</p>
		<fieldset class="vbx-input-container">
			<input type="text" name="event" class="medium" value="<?php echo AppletInstance::getValue('event','some-event'); ?>" />
		</fieldset>
	</div>

  <table class="vbx-menu-grid options-table">
      <thead>
          <tr>
              <td>Data Element</td>
              <td>Add &amp; Remove</td>
          </tr>
      </thead>
      <tbody>
      <?php foreach($keys as $i=>$key): ?>
          <tr>
              <td>
                  <fieldset class="vbx-input-container">
                    <?php printBuiltIns($i); ?>
                  </fieldset>
              </td>
              <td>
                  <a href="" class="add action">
                      <span class="replace">Add</span></a> <a href="" class="remove action"><span class="replace">Remove</span>
                  </a>
              </td>
          </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
          <tr class="hide">
              <td>
                  <fieldset class="vbx-input-container">
                    <?php printBuiltIns(); ?>
                  </fieldset>
              </td>
              <td>
                  <a class="add action" href="">
                      <span class="replace">Add</span>
                  </a>
                  <a class="remove action" href="">
                      <span class="replace">Remove</span>
                  </a>
              </td>
          </tr>
      </tfoot>
      </table>

	<h2>Next</h2>
	<p>After this applet is tracked, continue to the next applet</p>
	<div class="vbx-full-pane">
		<?php echo AppletUI::DropZone('next'); ?>
	</div>

</div>