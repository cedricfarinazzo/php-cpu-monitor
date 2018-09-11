<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <title>Hardware Monitor</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" type="text/javascript"></script>
        <script src="js/cpufunctions.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="tabs" class="tabbg" style="border: 1px solid grey">
            <ul>
                <li><a href="#tabs-3">Overview</a></li >
                <li><a href="#tabs-1">CPU Monitor</a></li>
                <li><a href="#tabs-2">RAM Monitor</a></li>
                <li><a href="#tabs-4">GPU Monitor</a></li>
            </ul>

            <div id="tabs-1">
                <div class="grid half">&nbsp;
                    <div class="left">
                        <b>&nbsp;CPU Usage:</b>&nbsp;
                    </div>
                    <div id="cpu" class="left">&nbsp;</div>
                    <div class="left">%</div>
                    <?php
                        $width = 5;
                        for($i = 0; $i < 40; $i++){
                            print("<div id='cpu$i' class='big bar' style='left: ".$width."px;'>&nbsp;</div>  ");
                            $width = $width + 17;
                        }
                        ?>
                </div>

                <div style="height:18px;">&nbsp;</div>

                <div class="grid half">&nbsp;
                    <div class="left">
                        <b>&nbsp;CPU Temperature:</b>&nbsp;
                    </div>
                    <div id="cputemp" class="left">&nbsp;</div>
                    <div class="left">°C</div>
                    <?php
                    $width = 5;
                    for($i = 0; $i < 40; $i++){
                        print("<div id='cputemp$i' class='big bar' style='left: ".$width."px;'>&nbsp;</div>  ");
                        $width = $width + 17;
                    }
                    ?>
                </div>
            </div>

            <div id="tabs-2">
                <div class="grid full">&nbsp;
                    <div class="left">
                        <b>&nbsp;RAM Usage:</b>&nbsp;
                    </div>
                    <div id="ram" class="left">&nbsp;
                    </div><div class="left">%</div>
                    <?php
                        $width = 5;
                        for($i = 0; $i < 40; $i++){
                            print("<div id='ram$i'  class='big bar' style = 'left: ".$width."px;'>&nbsp;</div> ");
                            $width = $width + 17;
                        }
                    ?>
                </div>
            </div>

            <div id="tabs-3">
                <div class="grid half">&nbsp;
                    <div class="left">
                        <b>&nbsp;CPU Usage:</b>&nbsp;
                    </div>
                    <div id="cpuO" class="left">&nbsp;
                    </div><div class="left">%</div>
                    <?php
                        $width = 5;
                        for($i = 0; $i < 40; $i++){
                            print("<div id='cpuO$i' class='small bar' style = 'left: ".$width."px;'>&nbsp;</div>  ");
                            $width = $width + 17;
                        }
                    ?>
                </div>

                <div style="height:18px;">&nbsp;</div>

                <div class="grid half">&nbsp;
                    <div class="left"><b>&nbsp;RAM Usage:</b>&nbsp;</div><div id="ramO" class="left">&nbsp;</div><div class="left">%</div>
                    <?php
                        $width = 5;
                        for($i = 0; $i < 40; $i++){
                            print("<div id='ramO$i' class='small bar' style = 'left: ".$width."px;'>&nbsp;</div> ");
                            $width = $width + 17;
                        }
                    ?>
                </div>
            </div>

            <div id="tabs-4">
                <div class="grid full">&nbsp;
                    <div class="left">
                        <b>&nbsp;GPU Temperatur:</b>&nbsp;
                    </div>
                    <div id="gputemp" class="left">&nbsp;
                    </div><div class="left">°C</div>
                    <?php
                    $width = 5;
                    for($i = 0; $i < 40; $i++){
                        print("<div id='gputemp$i'  class='big bar' style = 'left: ".$width."px;'>&nbsp;</div> ");
                        $width = $width + 17;
                    }
                    ?>
                </div>
            </div>
	  </div>
     </body>
</html>

