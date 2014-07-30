<?php

/* Pass in by reference! */
function graph_gpu_power_usage_report ( &$rrdtool_graph ) {

    global $context,
           $hostname,
           $mem_shared_color,
           $mem_cached_color,
           $mem_buffered_color,
           $mem_swapped_color,
           $mem_used_color,
           $cpu_num_color,
           $range,
           $rrd_dir,
           $size,
           $strip_domainname;

    if ($strip_domainname) {
       $hostname = strip_domainname($hostname);
    }
    $dIndex = $rrdtool_graph["arguments"]["dindex"];
    $title = 'GPU'.$dIndex.' Power Usage';
    $rrdtool_graph['title'] = $title;
    $rrdtool_graph['lower-limit']    = '0';
    $rrdtool_graph['vertical-label'] = 'Watts';
    $rrdtool_graph['extras']         = '--rigid --base 1024';
 
    $series = "DEF:'gpu_power_usage'='${rrd_dir}/gpu".$dIndex."_power_usage_report.rrd':'sum':AVERAGE "
             ."LINE2:gpu_power_usage#555555:'GPU".$dIndex."  Power Usage' ";

    $rrdtool_graph['series'] = $series;

    return $rrdtool_graph;

}
