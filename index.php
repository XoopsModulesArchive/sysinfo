<?php
// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <http://xoops.codigolivre.org.br>                             //
// ------------------------------------------------------------------------- //
//   System Info version 2.0                                                 //
//   Modularized by w4z004 (w4z004@hotmail.com)                              //
//   Xoops Spanish Support  (http://ar.xoops.org)                            //
// ------------------------------------------------------------------------- //
#
# The latest version is always availble at http://basmaaks.xs4all.nl
# Place the script anywhere on you're webserver
# You'll need php version 4.1.0 or above to get it all running.
# Mail me for any questions at the_gamblers@xs4all.nl or post a message in my forum
//###################################################################################
include 'header.php';
include '../../header.php';
require 'config.php';
$Version = '2.1';
$server = mb_substr($HTTP_SERVER_VARS[SERVER_SOFTWARE], 0, 6);
$ipconfig = `ipconfig -all`;
$connections = `netstat -n`;
$jump_var = $_GET['jump_var'];
if ('' == $jump_var) {
    $ver = php_uname();

    $name_days = [_SY_SUN, _SY_MON, _SY_TUE, _SY_WEB, _SY_THU, _SY_FRI, _SY_SAT];

    $name_months = [1 => _SY_JAN, _SY_FEB, _SY_MAR, _SY_APR, _SY_MAY, _SY_JUN, _SY_JUL, _SY_AUG, _SY_SEP, _SY_OCT, _SY_NOV, _SY_DEC];

    $date = $name_days[date('w')] . date(', d ') . $name_months[date('n')] . date(' Y H:i:s O');

    //Networkstatistics for windows

    $fn = 'tmp.txt';

    exec("netstat -e>$fn");

    $fcontents = file($fn);

    while (list($line_num, $line) = each($fcontents)) {
        if (mb_stristr($line, 'bytes')) {
            $line = explode(' ', $line);

            $cnt = 0;

            for ($i = 0, $iMax = count($line); $i < $iMax; $i++) {
                if ('' == $line[$i]) {
                    continue;
                }

                if (0 == $cnt) {
                    $text = ucfirst($line[$i]);
                } elseif (1 == $cnt) {
                    $rec = $line[$i];
                } elseif (2 == $cnt) {
                    $sent = $line[$i];
                }

                $cnt++;
            }
        }
    }

    $totalrecieve = round($rec / (1000000), 2);

    $totalsent = round($sent / (1000000), 2);

    unlink($fn);

    //uptime for windows

    $pagefile = 'c:\\pagefile.sys';

    $uptime = (time() - filemtime($pagefile));

    $days = floor($uptime / (24 * 3600));

    $uptime -= ($days * (24 * 3600));

    $hours = floor($uptime / (3600));

    $uptime -= ($hours * (3600));

    $minutes = floor($uptime / (60));

    $uptime -= ($minutes * 60);

    $seconds = $uptime;

    if (!eregi('[0-9]{2}', $seconds)) {
        $seconds = '0' . $seconds;
    }

    if (!eregi('[0-9]{2}', $minutes)) {
        $minutes = '0' . $minutes;
    }

    if (!eregi('[0-9]{2}', $hours)) {
        $hours = '0' . $hours;
    }

    if (1 == $days) {
        $days .= ' ' . _SY_DAY;
    } elseif (0 == $days) {
        $days = '';
    } else {
        $days .= ' ' . _SY_DAYS;
    }

    $theuptime = '' . $days . ' ' . $hours . ' ' . _SY_HOUR . ' ' . $minutes . ' ' . _SY_MIN . ' ' . $seconds . ' ' . _SY_SEC;

    //cpu information for windows

    $CPUINFO = "$NUMBER_OF_PROCESSORS Cpu(s) $PROCESSOR_IDENTIFIER";

    //disk statistics for windows

    if ('1' == $nohd) {
        $diskfree = round(disk_free_space('c:') / (1000000), 2);

        $disktotal = round(disk_total_space('c:') / (1000000), 2);

        $diskusage = round(($disktotal - $diskfree), 2);

        $diskusedprecent = round((($diskusage / $disktotal) * 100), 2);

        $diskfreeprecent = round((($diskfree / $disktotal) * 100), 2);
    }

    if ('2' == $nohd) {
        $diskfreec = round(disk_free_space('c:') / (1000000), 2);

        $diskfreed = round(disk_free_space('d:') / (1000000), 2);

        $disktotalc = round(disk_total_space('c:') / (1000000), 2);

        $disktotald = round(disk_total_space('d:') / (1000000), 2);

        $diskfree = $diskfreec + $diskfreed;

        $disktotal = $disktotalc + $disktotald;

        $diskusage = round(($disktotal - $diskfree), 2);

        $diskusedprecent = round((($diskusage / $disktotal) * 100), 2);

        $diskfreeprecent = round((($diskfree / $disktotal) * 100), 2);
    }

    if ('3' == $nohd) {
        $diskfreec = round(disk_free_space('c:') / (1000000), 2);

        $diskfreed = round(disk_free_space('d:') / (1000000), 2);

        $diskfreee = round(disk_free_space('e:') / (1000000), 2);

        $disktotalc = round(disk_total_space('c:') / (1000000), 2);

        $disktotald = round(disk_total_space('d:') / (1000000), 2);

        $disktotale = round(disk_total_space('e:') / (1000000), 2);

        $diskfree = $diskfreec + $diskfreed + $diskfreee;

        $disktotal = $disktotalc + $disktotald + $disktotale;

        $diskusage = round(($disktotal - $diskfree), 2);

        $diskusedprecent = round((($diskusage / $disktotal) * 100), 2);

        $diskfreeprecent = round((($diskfree / $disktotal) * 100), 2);
    }

    if ('4' == $nohd) {
        $diskfreec = round(disk_free_space('c:') / (1000000), 2);

        $diskfreed = round(disk_free_space('d:') / (1000000), 2);

        $diskfreee = round(disk_free_space('e:') / (1000000), 2);

        $diskfreef = round(disk_free_space('f:') / (1000000), 2);

        $disktotalc = round(disk_total_space('c:') / (1000000), 2);

        $disktotald = round(disk_total_space('d:') / (1000000), 2);

        $disktotale = round(disk_total_space('e:') / (1000000), 2);

        $disktotalf = round(disk_total_space('f:') / (1000000), 2);

        $diskfree = $diskfreec + $diskfreed + $diskfreee + $diskfreef;

        $disktotal = $disktotalc + $disktotald + $disktotale + $disktotalf;

        $diskusage = round(($disktotal - $diskfree), 2);

        $diskusedprecent = round((($diskusage / $disktotal) * 100), 2);

        $diskfreeprecent = round((($diskfree / $disktotal) * 100), 2);
    }

    //generate the html page and send it to the browser

    echo '<center><table border=1><tr><td class=bg3><center><b>'
         . _SY_GENERALINFO
         . '</b></center></td></tr>'
         . '<tr><td><table border=0><tr>'
         . '</td></tr><tr class=bg4><td> '
         . _SY_CURRTIME
         . '</td><td><span id=data>'
         . $date
         . ' gmt'
         . '</span><br></td></tr><tr class=bg4><td> '
         . _SY_UPTIME
         . '</td><td><span id=data>'
         . $theuptime
         . '</span><br></td></tr><tr class=bg4><td> '
         . _SY_ENVIR
         . '</td><td><span id=data>'
         . $HTTP_SERVER_VARS[SERVER_SOFTWARE]
         . '</span><br></td></tr><tr class=bg4><td> '
         . _SY_DOMAIN
         . '</font></td><td><span id=data>'
         . $HTTP_SERVER_VARS[SERVER_NAME]
         . '</span><br></td></tr><tr class=bg4><td> '
         . _SY_SERVERTYPE
         . '</font></td><td><span id=data>'
         . $HTTP_SERVER_VARS[SERVER_PROTOCOL]
         . $HTTP_SERVER_VARS[GATEWAY_INTERFACE]
         . '</span><br></td></tr><tr class=bg4><td> '
         . _SY_SERVEROS
         . '</td><td><span id=data>'
         . $ver
         . '</span><br></td></tr><tr class=bg4><td> '
         . _SY_CPU
         . '</td><td><span id=data>'
         . $CPUINFO
         . '</span><br></td></tr><tr class=bg4><td> '
         . _SY_ADMINMAIL
         . '</td><td><span id=data>'
         . $HTTP_SERVER_VARS[SERVER_ADMIN]
         . '</table>'
         . '</td></tr><br>'
         . '</td></tr></table><br>'
         . '<table border=1><tr><td class=bg3><center><b>'
         . _SY_TOTALHD
         . ' '
         . $disktotal
         . ' '
         . _SY_MB
         . '</b></center></td><td class=bg3>'
         . '<center><b>'
         . _SY_NETSTAT
         . '</b></center>'
         . '</td></tr><tr><td>'
         . '<center><table border=0>'
         . '<td class=bg4></td><td class=bg4>'
         . _SY_TOTAL
         . '</td><td class=bg4>'
         . _SY_VALUE
         . '</td><td class=bg4>%</td></tr>'
         . '</td></tr><tr><td class=bg4> '
         . _SY_FREEDISK
         . ' </td><td class=bg4><span id=data>'
         . $diskfree
         . '</span> '
         . _SY_MB
         . '</td><td class=bg4>'
         . "<img src=bar_pr.png height=13 width=$diskfreeprecent>"
         . '</td><td class=bg4>'
         . $diskfreeprecent
         . '<br></td></tr><tr><td class=bg4> '
         . _SY_USEDDISK
         . ' </td><td class=bg4><span id=data>'
         . $diskusage
         . '</span> '
         . _SY_MB
         . '</td><td class=bg4>'
         . "<img src=bar_pr.png height=13 width=$diskusedprecent>"
         . '</td><td class=bg4>'
         . $diskusedprecent
         . '</td></tr>'
         . '</table>'
         . '</td><td rowspan=2>'
         . '<table border=0 >'
         . '<table border=0><tr><td>'
         . '</td></tr><tr><td class=bg4>&nbsp</td><td class=bg4>'
         . '</td></tr><tr><td class=bg4> '
         . _SY_TOTREC
         . ' </td><td class=bg4><span id=data>'
         . $totalrecieve
         . '</span> '
         . _SY_MB
         . '</td></tr><tr><td class=bg4> '
         . _SY_TOTSEN
         . ' </td><td class=bg4><span id=data>'
         . $totalsent
         . '</span> '
         . _SY_MB
         . '</td></tr><tr><td class=bg4>&nbsp</td><td class=bg4>'
         . '</b></td></tr></table></td></tr></table><br>'
         . '<center><table border=1><tr><td class=bg3><center><b>'
         . _SY_HOSTINFO
         . '</b></center></td></tr>'
         . '<tr><td><table border=0><tr>'
         . '</td></tr><tr><td class=bg4> '
         . _SY_BROS
         . '</td><td class=bg4><span id=data>'
         . $HTTP_SERVER_VARS[HTTP_USER_AGENT];

    if ('true' == $dhnme) {
        echo '</span><br></td></tr><tr><td class=bg4> ' . _SY_NOSTNAME . '</td><td class=bg4><span id=data>' . $REMOTE_HOST;
    }

    echo '</span><br></td></tr><tr><td class=bg4> ' . _SY_IP . '</td><td class=bg4><span id=data>' . $HTTP_SERVER_VARS[REMOTE_ADDR] . '</span></b></td></tr></table></td></tr></table><center><br>';

    if ($xoopsUser) {
        if ($xoopsUser->isAdmin() || ($xoopsUser->uid() == $thisUser->uid())) {
            echo '' . _SY_DISPLAY . ' <a href="index.php?jump_var=1">' . _SY_PHPENV . ' </a> ' . _SY_OR . ' <a href="index.php?jump_var=2">' . _SY_NETENV . '</a><br><br>';
        }
    }
} elseif ('1' == $jump_var) {
    phpinfo();
} elseif ('2' == $jump_var) {
    echo "<html><head>$CSS<title>$SERVER_NAME</title></head></html>"
         . '<center><table border=1><tr><td class=bg3><center><b>'
         . _SY_NETENV
         . '</b></center></td></tr>'
         . '<tr><td><table border=0><tr>'
         . "<pre>$ipconfig</pre>"
         . '</b></td></tr></table></td></tr></table><br>'
         . '<center><table border=1><tr><td class=bg3><center><b>'
         . _SY_NETCON
         . '</b></center></td></tr>'
         . '<tr><td><table border=0><tr>'
         . "<pre>$connections</pre>"
         . '</b></td></tr></table></td></tr></table><br>';
}
include '../../footer.php';
