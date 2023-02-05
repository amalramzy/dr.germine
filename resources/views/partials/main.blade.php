<?php
$language = str_replace('_', '-', app()->getLocale());
if ($language == 'ar') {
    $textdir = 'rtl';
} else {
    $textdir = 'ltr';
}
?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="<?php echo $textdir; ?>">