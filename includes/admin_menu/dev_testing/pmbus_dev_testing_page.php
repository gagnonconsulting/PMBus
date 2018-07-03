<?php

function pmbus_dev_testing_page_build() {
  $status = 'Active';
  ?>
  <div style='padding-top: 10%; padding-right: 6%; padding-left: 3%;'>
    <div class="toggle">
    <label>
      <input id="checkValue" name="checkbox" type="checkbox" />
      <span class="slider"></span>
    </label>
    <p><?= $status ?></p>
  </div>
  </div>
  <?php

}
