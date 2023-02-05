<?php

$color_create  = \App\Models\Setting::where('key','color_create')->first();
$color_edit  = \App\Models\Setting::where('key','color_edit')->first();
$color_delete  = \App\Models\Setting::where('key','color_delete')->first();
$color_main  = \App\Models\Setting::where('key','color_main')->first();
$color_second  = \App\Models\Setting::where('key','color_second')->first();


?>

<style>
    :root {
    --Main: <?php echo $color_main->value;?>;
    --Second: <?php echo $color_second->value;?>;
    --Create: <?php echo $color_create->value;?>;
    --Edit: <?php echo $color_edit->value;?>;
    --Delete: <?php echo $color_delete->value;?>;
    
  }
body{
    text-align:initial !important;

    
}
.btn-success{
    background-color:var(--Create) !important;
    /* color: #fff; */
}
a.edit{
    color:var(--Edit) !important;
    font-size: 25px;
}
a.delete{
    color:var(--Delete) !important;
    font-size: 25px;
}
a:hover{
    color:var(--Second) !important;
}
.modal-title{
    color:var(--Main) !important;

}
.navbar-custom {
    background-color:var(--Main) !important;
}
table.dataTable thead th{
    text-align:initial !important;
}
.form-check .form-check-input{
    float: initial !important;
     margin-left: initial !important;
}

#page-tage{
    color:var(--Main) !important;
}
.active>.page-link{
    background-color:var(--Main) !important;
    border-color:var(--Main) !important;
}
.nav-pills .nav-link.active{
    background-color:var(--Main) !important;

}
.form-check-input:checked{
    background-color:var(--Main) !important;
    border-color:var(--Main) !important;
}
.text-start{
    text-align: initial !important;
}
body.authentication-bg {
    background-color: var(--Main);
}
div.dt-buttons{
    padding-top: 10px;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled){
    background-color: var(--Main);
    color: white;
    border: none;
}

div.dataTables_wrapper div.dataTables_filter {
    text-align: initial !important;
    padding: 10px;

}

button.delete{
    background-color: var(--Delete) !important;
}
.none{
       display: none;
   }

.dropdown-menu{
    text-align: initial !important;
}   
.info-child{
    text-align: initial !important;
}
.father{
    z-index:9;
}
</style>