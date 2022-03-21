<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta content="text/html" charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>LiveDemo EKS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="assets/css/Social-Icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    pre {
    overflow-x: auto;
	max-width: 60vw;
}

pre code {
    word-wrap: normal;
    white-space: pre;
}
</head>

<body>
    <!-- Start: Highlight Clean -->
    <section class="highlight-clean">
        <div class="container">
            <!-- Start: Intro -->
            <div class="intro">
                <h2 class="text-center">Status of each node is:&nbsp;</h2>
            </div><!-- End: Intro -->
        </div><!-- Start: Buttons -->
        <div class="buttons"><a class="btn btn-primary" role="button" href="NodeStatus.php">Refresh</a><a class="btn btn-light" role="button" href="index.html">return home</a></div><!-- End: Buttons -->
    </section><!-- End: Highlight Clean -->
    <!-- Start: Article List -->
    <section class="article-list">
        <div class="container">
            <!-- Start: Intro -->
            <div class="intro">
                <h2 class="text-center">Status of each nodes:</h2>
            </div><!-- End: Intro -->
            <!-- Start: Articles -->
            <div class="row articles">
                <div class="col-sm-6 col-md-4 item"><a href="#"></a><i class="fa fa-server" style="font-size: 44px;"></i>
                    <h3 class="name" style="font-size: 34px;">Node 1</h3>
                    <p class="description" style="font-size: 19px;"><?php echo 'Server name: '.$_SERVER['SERVER_NAME'].'<br>'; ?></p><a class="action" href="#"></a>
                </div>
                <div class="col-sm-6 col-md-4 item"><a href="#"></a><i class="fa fa-server" style="font-size: 44px;"></i>
                    <h3 class="name" style="font-size: 34px;">Node 2</h3>
                    <p class="description" style="font-size: 19px;"><?php echo 'Server name: '.$_SERVER['SERVER_NAME'].'<br>'; ?></p><a class="action" href="#"></a>
                </div>
                <div class="col-sm-6 col-md-4 item"><a href="#"></a><i class="fa fa-server" style="font-size: 44px;"></i>
                    <h3 class="name" style="font-size: 34px;">Node 3</h3>
                    <p class="description" style="font-size: 19px;"><?php echo 'Server name: '.$_SERVER['SERVER_NAME'].'<br>';
                     ?></p><a class="action" href="#"></a>
                </div>
            </div><!-- End: Articles -->
        </div>
       <?php
        $data = "";
$data .= '
<div class="card my-2">
  <h4 class="card-header text-center">
    Service status
  </h4>
  <div class="card-body pb-0">
';


//configure script
$timeout = "1";

//set service checks
/* 
The script will open a socket to the following service to test for connection.
Does not test the fucntionality, just the ability to connect
Each service can have a name, port and the Unix domain it run on (default to localhost)
*/
$services = array();


$services[] = array("port" => "8080",       "service" => "Web server",                  "ip" => $_SERVER['REMOTE_ADDR']);
// $services[] = array("port" => "3000",     "service" => "Mastodon web",                   "ip" => "") ;
// $services[] = array("port" => "4000",     "service" => "Mastodon streaming",                   "ip" => "") ;
$services[] = array("port" => "22",       "service" => "Open SSH",				"ip" => $_SERVER['REMOTE_ADDR']);
$services[] = array("port" => "80",       "service" => "Internet Connection",     "ip" => "google.com") ;


//begin table for status
$data .= "<small><table  class='table table-striped table-sm '><thead><tr><th>Service</th><th>Port</th><th>Status</th></tr></thead>";
foreach ($services  as $service) {
	if($service['ip']==""){
	   $service['ip'] = "localhost";
	}
	$data .= "<tr><td>" . $service['service'] . "</td><td>". $service['port'];

	$fp = @fsockopen($service['ip'], $service['port'], $errno, $errstr, $timeout);
	if (!$fp) {
		$data .= "</td><td class='table-danger'>Offline </td></tr>";
	  //fclose($fp);
	} else {
		$data .= "</td><td class='table-success'>Online</td></tr>";
		fclose($fp);
	}

}  
//close table
$data .= "</table></small>";
$data .= '
  </div>
</div>
';
echo $data;


/* =====================================================================
//
// ////////////////// SERVER INFORMATION  /////////////////////////////////
//
//
* =======================================================================/*/

$data1 = "";
$data1 .= '
<div class="card mb-2">
  <h4 class="card-header text-center">
    Server information
  </h4>
  <div class="card-body">
';

$data1 .= "<table  class='table table-sm mb-0'>";
// $data1 .= "<div class='table-responsive'><table  class='table table-sm mb-0'>";

//GET SERVER LOADS
$loadresult = @exec('uptime');  
preg_match("/averages?: ([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/",$loadresult,$avgs);


//GET SERVER UPTIME
$uptime = explode(' up ', $loadresult);
$uptime = explode(',', $uptime[1]);
$uptime = $uptime[0].', '.$uptime[1];

//Get the disk space
function getSymbolByQuantity($bytes) {
	$symbol = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
	$exp = floor(log($bytes)/log(1024));
	
	return sprintf('%.2f<small>'.$symbol[$exp].'</small>', ($bytes/pow(1024, floor($exp))));
}
function percent_to_color($p){
	if($p < 30) return 'success';
	if($p < 45) return 'info';
	if($p < 60) return 'primary';
	if($p < 75) return 'warning';
	return 'danger';
}
function format_storage_info($disk_space, $disk_free, $disk_name){
	$str = "";
	$disk_free_precent = 100 - round($disk_free*1.0 / $disk_space*100, 2);
		$str .= '<div class="col p-0 d-inline-flex">';
		$str .= "<span class='mr-2'>" . badge($disk_name,'secondary') .' '. getSymbolByQuantity($disk_free) . '/'. getSymbolByQuantity($disk_space) ."</span>";
		$str .= '
<div class="progress flex-grow-1 align-self-center">
  <div class="progress-bar progress-bar-striped progress-bar-animated ';
		$str .= 'bg-' . percent_to_color($disk_free_precent) .'
  " role="progressbar" style="width: '.$disk_free_precent.'%;" aria-valuenow="'.$disk_free_precent.'" aria-valuemin="0" aria-valuemax="100">'.$disk_free_precent.'%</div>
</div>
</div>		';

	return $str;

}

function get_disk_free_status($disks){
	$str="";
	$max = 5;
	foreach($disks as $disk){
		if(strlen($disk["name"]) > $max) 
			$max = strlen($disk["name"]);
	}
	
	foreach($disks as $disk){
		$disk_space = disk_total_space($disk["path"]);
		$disk_free = disk_free_space($disk["path"]);

		$str .= format_storage_info($disk_space, $disk_free, $disk['name']);

	}
	return $str;
}
function badge($str, $type){
	return "<span class='badge badge-" . $type . " ' >$str</span>";
}

//Get ram usage
$total_mem = preg_split('/ +/', @exec('grep MemTotal /proc/meminfo'));
$total_mem = $total_mem[1];
$free_mem = preg_split('/ +/', @exec('grep MemFree /proc/meminfo'));
$cache_mem = preg_split('/ +/', @exec('grep ^Cached /proc/meminfo'));

$free_mem = $free_mem[1] + $cache_mem[1];


//Get top mem usage
$tom_mem_arr = array();
$top_cpu_use = array();

//-- The number of processes to display in Top RAM user
$i = 5;


/* ps command:
-e to display process from all user
-k to specify sorting order: - is desc order follow by column name
-o to specify output format, it's a list of column name. = suppress the display of column name
head to get only the first few lines 
*/
exec("ps -e k-rss -o rss,args | head -n $i", $tom_mem_arr, $status);
exec("ps -e k-pcpu -o pcpu,args | head -n $i", $top_cpu_use, $status);


$top_mem = implode('<br/>', $tom_mem_arr );
$top_mem = "<pre class='mb-0 '><code>" . $top_mem . "</code></pre>";

$top_cpu = implode('<br/>', $top_cpu_use );
$top_cpu = "<pre class='mb-0 '><code>" . $top_cpu. "</code></pre>";

$data1 .= "<tr><td>Average load</td><td><h5>". badge($avgs[1],'secondary'). ' ' .badge($avgs[2], 'secondary') . ' ' . badge( $avgs[3], 'secondary') . " </h5></td>\n";
$data1 .= "<tr><td>Uptime</td><td>$uptime                     </td></tr>";


$disks = array();

/*
* The disks array list all mountpoint you wan to check freespace
* Display name and path to the moutpoint have to be provide, you can 
*/
$disks[] = array("name" => "local" , "path" => getcwd()) ;
// $disks[] = array("name" => "Your disk name" , "path" => '/mount/point/to/that/disk') ;


$data1 .= "<tr><td>Disk free        </td><td>" . get_disk_free_status($disks) . "</td></tr>";

$data1 .= "<tr><td>RAM free        </td><td>". format_storage_info($total_mem *1024, $free_mem *1024, '') ."</td></tr>";
$data1 .= "<tr><td>Top RAM user    </td><td><small>$top_mem</small></td></tr>";
$data1 .= "<tr><td>Top CPU user    </td><td><small>$top_cpu</small></td></tr>";

$data1 .= "</table>";
// $data1 .= '  </div></div>';
$data1 .= '  </div>';
echo $data1
?>
    </section><!-- End: Article List -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>