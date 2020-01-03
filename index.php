<?php

include('config.php');
include('ipchecker_class.php');

$ip = array(
    '108.132.144.115',
    '72.90.67.140',
    @gethostbyname('speechpad.com'));

$obj = new IpChecker(APIKEY);

echo "<table border='1'>";

    echo "<tr>";

    echo "<td>Sr.</td>";
    echo "<td>IP Address</td>";    
    echo "<td>City</td>";
    echo "<td>State</td>";
    echo "<td>Country</td>";

    echo "</tr>";


foreach($ip as $key=>$val){

    $obj->setIp($val);
    
    echo "<tr>";
    echo "<td>".($key+1)."</td>";        
    echo "<td>".$obj->getIp()."</td>";
    echo "<td>".$obj->getCity()."</td>";
    echo "<td>".$obj->getState()."</td>";
    echo "<td>".$obj->getCountry()."</td>";
    echo "</tr>";
}

echo "</table>";

?>