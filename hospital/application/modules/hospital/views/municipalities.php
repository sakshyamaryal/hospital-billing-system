<option>-- Municipality --</option>
<?php
if (!empty($mun)) {
    foreach ($mun as $municple) {
        echo '<option value="'. $municple['id'].'" >' . $municple['name'] . '</option>';
    }
}
//fetch data
?>