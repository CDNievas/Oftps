<?php
	
	include "../FTPClient.php";
	session_start();
	include "../debug.php";
	include "../auxiliar.php";

	detect_session(false,"ftp","../index.php");
	$ftp = $_SESSION["ftp"];

	$actualPath = $ftp->getActualPath();

	function show_files(){

		$ftp = $_SESSION["ftp"];

		try{
			$filesInfo = $ftp->getFiles();
		} catch (ExceptionFTP $e){
			set_message($e->getMessage(), $e->getType());
			header("location:./index.php");
		}

		$filesKeys = array_keys($filesInfo);
		$i = 0;

		for($i=0;$i<count($filesKeys);$i++){
			$array = $filesInfo[$filesKeys[$i]];
			
			if($array["type"] == "directory"){
				print_directory($array);
			} else {
				print_file($array);
			}

		}

	}

	function print_directory($array_folder){

		echo '<tr class="unselected">
			<td class="check"><input type="checkbox"></td>
			<td onclick="window.location=\'goToPath.php?path='.$array_folder["name"].'\';"><img src="./images/folder.png"></td>
			<td onclick="window.location=\'goToPath.php?path='.$array_folder["name"].'\';">'.$array_folder["name"].'</td>
			<td onclick="window.location=\'goToPath.php?path='.$array_folder["name"].'\';">'.$array_folder["permissions"].'</td>
			<td onclick="window.location=\'goToPath.php?path='.$array_folder["name"].'\';">'.$array_folder["month"].'/'.$array_folder["day"].' '.$array_folder["time"].'</td>
		</tr></a>';

	}

	function print_file($array_file){
		
		echo '<tr class="unselected">
			<td class="check"><input type="checkbox"></td>
			<td><img src="./images/file.png"></td>
			<td>'.$array_file["name"].'</td>
			<td>'.$array_file["permissions"].'</td>
			<td>'.$array_file["month"].'/'.$array_file["day"].' '.$array_file["time"].'</td>
		</tr>';

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>Oftps</title>
		
		<!--<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
		<link href="../css/web.css" rel="stylesheet">
	</head>
	<body>
		
		<div class="container">
			
			<div class="header">
				<div class="path"><p class="path">Dir: <?php echo $actualPath; ?></p></div>
				<div class="logout"><a class="logout" href="logout.php">Logout</a></div>
			</div>	
			<div class="menu">
				<a onClick="openPopup('#newFolder')"><img src="./images/icons/new_folder.png"></a>
				<a><img src="./images/icons/new_document.png"></a>
				<a><img src="./images/icons/exec.png"></a>
				<a><img src="./images/icons/users.png"></a>
				<a><img src="./images/icons/refresh.png"></a>
			</div>
			
				<!-- Download
				Permissions
				Move
				Delete
				Copy
				Paste
				Create Folder
				Create File
				Zip
				Unzip -->
			
			<div class="table">
				<center><table class="files files-horizontal">
					<thead>
						<tr>
							<th><input type="checkbox" id="select_all"></th>
							<th></th>
							<th>Name</th>
							<th>Permissions</th>
							<th>Last edit</th>
						</tr>
					</thead>
					<tbody>
						<?php
							show_files();
						?>
					</tbody>
				</table></center>
			</div>

		</div>

		<div id="newFolder" class="wrapPopup">
			<div class="popup">
				<div class="title">
					<p>Create new folder</p>
				</div>
				<div class="box">
					<p>Write a name for the new folder.</p>
					<input type="text" placeholder="Folder's name">
					<center>
						<button class="accept" onClick="">Create Folder</button>
						<button class="cancel" onClick="">xd</button>
						<button class="normal" onClick="closePopup('#newFolder')">Close Popup</button>
					</center>
				</div>
			</div>
		</div>

	<!-- Placed at the end of the document so the pages load faster -->
	<script src="../js/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../js/popup.js"></script>

	</body>
</html>
	