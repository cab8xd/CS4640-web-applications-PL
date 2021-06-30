<?php
function computeAvg($p1,$p2,$p3,$p4,$p5,$p6, $drop_opt)
{
    $p1 = ($p1 / 30) * 100;
    $p5  = ($p5 / 50) * 100;
    
    $total = $p1 + $p2 + $p3 + $p4 + $p5 + $p6;

    $t = $p1;
    if ($t > $p2)
        $t = $p2;
    if ($t > $p3)
        $t = $p3;
    if ($t > $p4)
        $t = $p4;
    if ($t > $p5)
        $t = $p5;
    if ($t > $p6)
        $t = $p6;
    if ($drop_opt == true)
        return ($total - $t) / 5;
    else
        return $total / 6;
}

echo "computeAvg(15, 55, 55, 55, 25, 55, true) : you got " . computeAvg(15, 55, 55, 55, 25, 55, true) . " : expected 54 <br/>";      
echo "computeAvg(15, 55, 55, 55, 25, 55, false) : you got " . computeAvg(15, 55, 55, 55, 25, 55, false) . " : expected 53.33 <br/>";  
echo "computeAvg(15, 55, 55, 55, 27.5, 50, true) : you got " . computeAvg(15, 55, 55, 55, 27.5, 50, true) . " : expected 54 <br/>";    
echo "computeAvg(15, 55, 55, 55, 27.5, 50, false) : you got " . computeAvg(15, 55, 55, 55, 27.5, 50, false) . " : expected 53.33 <br/>"; 


?> 