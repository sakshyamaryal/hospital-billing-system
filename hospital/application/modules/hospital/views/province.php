<option>-- Province No --</option>
<?php
if (!empty($province)) {
    foreach ($province as $provinces) {
        echo '<option value=" ' . $provinces['id'] . ' " >' . $provinces['name'] . '</option>';
    }
}
//fetch data
?>