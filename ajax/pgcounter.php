<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = '../../../includes.php';

if(file_exists($path)){
    include('../../../includes.php');
    include('../helper.php');
}else{
    die();
}

$count = new modPGCounterHelper();
$countObj = $count->getCount();
echo $countObj->value;