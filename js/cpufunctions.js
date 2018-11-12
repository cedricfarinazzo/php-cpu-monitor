//php-cpu-monitor was developed by Steve Stone - zyk0tik@gmail.com
//If you find this useful then please share it about to people who you think may also find use for it.
//This program comes with absolutely no warranty and under no license. 
//If you think you can contribute to the codebase then please contact me!

//Enables Tooltips using JQueryUI.
$(function() {
     $( document ).tooltip({
          track: true,
          show: false,
          hide: false
     });
});
//Enables Tabs using JQueryUI.
$(function() {
     $( "#tabs" ).tabs();
});

var cpuUsage = new Array, ramUsage = new Array, cpuTemp = new Array, gpuTemp = new Array, cpuWidth = new Array, ramWidth = new Array, cpuTempWidth = new Array, gpuTempWidth = new Array;


function update(json)
{
    data = JSON.parse(json);
    for (i=0; i<39; i++){
        //Sets all values in an array with previous CPU and RAM information. This is done on a sliding scale so previous value for array[10] becomes the new value for array[9] and so on.
        cpuUsage[i] = cpuUsage[i + 1];
        cpuWidth[i] = cpuWidth[i + 1];
        ramUsage[i] = ramUsage[i + 1];
        ramWidth[i] = ramWidth[i + 1];
        cpuTemp[i] = cpuTemp[i + 1];
        gpuTemp[i] = gpuTemp[i + 1];
        cpuTempWidth[i] = cpuTempWidth[i + 1];
        gpuTempWidth[i] = gpuTempWidth[i + 1];
    }
    //Sets the values of the highest number in the array to the current value. Also sets the titles of things to current value and also tells it what height the bars in the graph should be.
    $("#cpu").html(data["CpuUsage"]);
    $("#cpuO").html(data["CpuUsage"]);
    cpuUsage[39] = $("#cpu").html();
    $("#ram").html(data["RamUsage"]);
    if (cpuUsage[39] > 100)
    {
        cpuWidth[39] = 100 * 2.3 + 5, 10;
    }
    else
    {
        cpuWidth[39] = cpuUsage[39] * 2.3 + 5, 10;
    }
    ramUsage[39] = $("#ram").html();
    $("#ramO").html(ramUsage[39]);
    ramWidth[39] = ramUsage[39] * 2.3 + 5, 10;
    $("#cputemp").html(data["CpuTemp"]);
    $("#gputemp").html(data["GpuTemp"]);
    cpuTemp[39] = $("#cputemp").html();
    gpuTemp[39] = $("#gputemp").html();
    cpuTempWidth[39] = cpuTemp[39] * 2.3 + 5, 10;
    gpuTempWidth[39] = gpuTemp[39] * 2.3 + 5, 10;
    for(i=0; i<40; i++){
        //Does all the changes of bar heights in the graph. the ,0 at the end means do it in 0 miliseconds. This can be changed if you want to see the bars slide up and down.
        $("#cpu" + i).animate({
            height: cpuWidth[i] * 2.2,
        },0);
        $("#ram" + i).animate({
            height: ramWidth[i] * 2.2,
        },0);
        $("#cpuO" + i).animate({
            height: cpuWidth[i],
        },0);
        $("#ramO" + i).animate({
            height: ramWidth[i],
        },0);
        $("#cputemp" + i).animate({
            height: cpuTempWidth[i],
        },0);
        $("#gputemp" + i).animate({
            height: gpuTempWidth[i],
        },0);
        //Sets all of the tooltips for the bars so when you highlight them it shows you what percentage was in use at that time.
        $("#cpu" + i).attr('title', cpuUsage[i] + '%');
        $("#ram" + i).attr('title', ramUsage[i] + '%');
        $("#cpuO" + i).attr('title', cpuUsage[i] + '%');
        $("#ramO" + i).attr('title', ramUsage[i] + '%');
        $("#cputemp" + i).attr('title', cpuTemp[i] + '°C');
        $("#gputemp" + i).attr('title', gpuTemp[i] + '°C');
    }
}


//Function to process data and draw the graph in the browser
$(function replay(){
    $.get(
        'hardware.php',
        '',
        update,
        'text'
    );
    setTimeout(replay, 1000);
});


