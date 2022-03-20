
<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	session_start();
	//echo session_id();
?>
<!DOCTYPE html>
<?php

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	// Create a connection to the web service
	$ws_username = "4kingdoms";
	$ws_password = "sdfsdiF@%@dIAS82729FBX_322";
	$ws_url = "https://4kingdoms.fusemetrix.com/ws/soap/";

	//remoteFolders
	$remoteFolderA = "X22/hQDo6TUAuImqWENYQjdjMHhdKeiFYqsvMKhMPNBgM7oXUCNkXB4rtBH7i3tYubYh";
	$remoteFolderC = "X22/uzmQIAHBSH6kusMp9tNpbSvEn5IGJKaB5ESX3WUWmPeMVNRnBFxudnt4ubtaAfbJ";
	$remoteFolderF = "X22/3hbQnlLEQA870bKszQg8dIWQ5cLzZm2wOCJj5zym0eFKZwgBn2T0ZS9i03fit53q";
	$password = "TFI4gOfiMnABxa4UG9BuJAh4fUjayi5ySGHVB0XeT3qrgdFh8gj27ArwUUH8pBFZ";
	$limit = 500000;

	$client = new FuseMetrixWebService_SOAP($ws_username, $ws_password, $ws_url);
	//echo $client->getItWorks(); // Returns 'FMX web service successfully called' if successful

	//Data from other form
	$formname = basename($_SERVER['PHP_SELF']);
	$name = "none";
	$opt="";
	$type="";
	$value="";
	if (isset($_GET['opt']))
		{
			$opt = $_GET['opt'];
		}
	if (isset($_GET['name']))
		{
			$name = $_GET['name'];
		}
	if (isset($_GET['type']))
		{
			$type = $_GET['type'];
		}
		
	//$orderId = "64962";
	
	$method = 'aes-256-cbc';
	
	if (isset($_REQUEST['ref_entered']))
		{
			$orderId= trim(strtoupper($_REQUEST['ref_entered']),' ');
		}
	if (isset($_REQUEST['value_entered']))
		{
			$value = $_REQUEST['value_entered'];
		}
	if (isset(	$_REQUEST['name_entered']))
		{
			$nName = $_REQUEST['name_entered'];
		}
		
	if (isset($_GET['id']))
		{
			$orderId = $_GET['id'];
		}
		
	$pc=1;
	?>

<html>
			<head>
				<title>Personalise</title>
				<link rel="stylesheet" href="css/menu.css">
				<link rel="stylesheet" href="css/formM1.css">
				<link rel="stylesheet" href="css/formM2.css">
				<link rel="stylesheet" href="css/logo.css">
				<link rel="stylesheet" href="css/vMenu.css">
				<link rel="stylesheet" href="css/formVideo1.css">
				<link rel="stylesheet" href="css/formVideo2.css">
				<link rel="stylesheet" href="css/Login.css">
				
				<style>
					.center {
						display: block;
						margin-left: auto;
						margin-right: auto;
						width: 50%;
					}
				</style>
						 
				<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<?php


if ($pc == 1)
	{
		?>


		

				<div class="content">
					<ul class="exo-menu">
						<li><a href=<?php echo "test.php?opt=children&id=".$orderId; ?> ><id = "a" class="fa fa-child"></i> Children</a></li>	
						<li><a href=<?php echo "test.php?opt=adults&id=".$orderId; ?>><i class="fa fa-users"></i> Adults</a></li>
						<li><a href=<?php echo "test.php?opt=family&id=".$orderId; ?>><i class="fa fa-home"></i> Family</a></li>
						<li><a href=<?php echo "test.php?opt=why&id=".$orderId; ?>><i class="fa fa-question"></i> Why we do this</a></li>
						<li><a href=<?php echo "test.php?opt=contact&id=".$orderId; ?>><i class="fa fa-envelope"></i> Contact</a>
							<div class="contact">
						
							</div>
						</li>
						<li><a href="LogOut.php"><i class="fa fa-power-off"></i> Log Out</a></li>
						
						<a href="#" class="toggle-menu visible-xs-block">|||</a>		
					</ul>
				 </div>
			</head>

			<p class="alignleft">
				<img class="img" src="The Magical Christmas Adventure Logo.png" alt="centered image" width="100" height="100"/>
			</p>

			<?php

				// Create a connection to the web service
				$ws_username = "4kingdoms";
				$ws_password = "sdfsdiF@%@dIAS82729FBX_322";
				$ws_url = "https://4kingdoms.fusemetrix.com/ws/soap/";

				$client = new FuseMetrixWebService_SOAP($ws_username, $ws_password, $ws_url);
				//echo $client->getItWorks(); // Returns 'FMX web service successfully called' if successful
				$response = $client->getChristmasBooking($orderId);
				//count the amount of adults and children
				$adultCount=0;
				$adultName = array();
				$adultHref = array();
				$childCount=0;
				$childName = array();
				$childHref = array();
				$place = array();
				$i=0;
				$count = count($response['booking']);
				while ($i<$count+1)
				{
					if(isset($response['booking'][$i]['25']['answer']))
					{
						$childCount=$childCount+1;
						$childName[]=$response['booking'][$i]['25']['answer'];
						$childHref[]= "test.php?opt=children&name=".$response['booking'][$i]['25']['answer']."&id=".$orderId;
						$place[] = $i;
					}
					if(isset($response['booking'][$i]['37']['answer']))
					{
						$adultCount = $adultCount+1;
						$adultName[]=$response['booking'][$i]['37']['answer'];
						$adultHref[]= "test.php?opt=adults&name=".$response['booking'][$i]['37']['answer']."&id=".$orderId;
						$place[] = $i;
					}
					$i=$i+1;
				}
				
						
				
				
				$method = 'aes-256-cbc';
				$password = "TFI4gOfiMnABxa4UG9BuJAh4fUjayi5ySGHVB0XeT3qrgdFh8gj27ArwUUH8pBFZ";
				$key = substr(hash('sha256', $password, true), 0, 32);
				// IV must be exact 16 chars (128 bit)
				$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

				echo $value;
				
				$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
				
				if($host == '4k-photos.co.uk/test.php')
					{
						?>
						<div class="login-boxM1">
							<h2>Personalise Your Christmas Experience</h2>
								<form action="test.php" method=post enctype='multipart/form-data'>
									<div class="user-box">
										<label>This website is designed around you personalising your christmas booking for your tour around The Magical Christmas Adventure</label>
										<br><br><br>
									</div>
									<div class="user-box">
										<label>Please use the menu above and buttons below to enter details and pictures about the children, adults and whole family who are comign to 4 Kingdoms</label>
									<br><br><br>
									</div>
									<a href=<?php echo "test.php?opt=children&id=".$orderId; ?>>Personalise your child information</a>
									<a href=<?php echo "test.php?opt=adult&id=".$orderId; ?>>Personalise your adult information</a>
									<a href=<?php echo "test.php?opt=family&id=".$orderId; ?>>Personalise your family information</a>
								</form>
						<?php
					}
				

				
				if ($value == "ci")
					{
						$DOB="";
						$Present = "";
						$Special = "";
						$Pets = "";
						$Best = "";
						$School="";
						$TV="";
						$Sports = "";
						$Club="";
						$Achievements="";
						$Gender="";
						$Lockdown="";
						$LastYearPre="";
						$SpecialMess="";
						if (isset($_REQUEST['dob_entered'])) {$DOB = $_REQUEST['dob_entered'];}
						if (isset($_REQUEST['present_entered'])) {$Present = str_replace(',',':',$_REQUEST['present_entered']);}
						if (isset($_REQUEST['people_entered'])) {$Special = str_replace(',',':',$_REQUEST['people_entered']);}
						if (isset($_REQUEST['pets_entered'])) {$Pets = str_replace(',',':',$_REQUEST['pets_entered']);}
						if (isset($_REQUEST['best_entered'])) {$Best = str_replace(',',':',$_REQUEST['best_entered']);}
						if (isset($_REQUEST['school_entered'])) {$School = str_replace(',',':',$_REQUEST['school_entered']);}
						if (isset($_REQUEST['tv_entered'])) {$TV = str_replace(',',':',$_REQUEST['tv_entered']);}
						if (isset($_REQUEST['sports_entered'])) {$Sports = str_replace(',',':',$_REQUEST['sports_entered']);}
						if (isset($_REQUEST['clubs_entered'])) {$Club = str_replace(',',':',$_REQUEST['clubs_entered']);}
						if (isset($_REQUEST['achievements_entered'])) {$Achievements = str_replace(',',':',$_REQUEST['achievements_entered']);}
						if (isset($_REQUEST['gender_entered'])) {$Gender = str_replace(',',':',$_REQUEST['gender_entered']);}
						if (isset($_REQUEST['lockdown_entered'])) {$Lockdown = str_replace(',',':',$_REQUEST['lockdown_entered']);}
						if (isset($_REQUEST['last_entered'])) {$LastYearPre = str_replace(',',':',$_REQUEST['last_entered']);}
						if (isset($_REQUEST['special_entered'])) {$SpecialMess = str_replace(',',':',$_REQUEST['special_entered']);}
						
						$nName="";
						$orderID="";
						if (isset($_REQUEST['name_entered'])) {$nName = $_REQUEST['name_entered'];}
						if (isset($_REQUEST['ref_entered'])) {$orderID = $_REQUEST['ref_entered'];}
						if($nName == "")
							{
							}
						else
							{
								$ToSave = $nName.",".$DOB.",".$Present.",".$Special.",".$Pets.",".$Best.",".$School.",".$TV.",".$Sports.",".$Club.",".$Achievements.",".$Lockdown.",".$LastYearPre.",".$SpecialMess.",".$Gender;
								
								$encrypted_message =base64_encode(openssl_encrypt($ToSave, $method, $key, OPENSSL_RAW_DATA, $iv));
								$file = $orderID."_".$nName.".txt";
								$filename = $remoteFolderC."/".$file;

								file_put_contents($filename,$encrypted_message);
							}
					}
				if ($value == "ai")
					{
						$ARelationship="";
						$AName = "";
						$APresent = "";
						$AFav = "";
						$ANaughty = "";
						$AJob = "";
						$APJob = "";
						$AAchieve = "";
						$ALifeA = "";
						$ALaugh = "";
						$AOldSchool = "";
						$ATeacher = "";
						$AFavC = "";
						$AFavM = "";
						$AProud ="";
						$AWish="";
						$AMess="";
						$AMessChild="";
						if (isset($_REQUEST['relationship_entered'])){$ARelationship = str_replace(',',':',$_REQUEST['relationship_entered']);}
						if (isset($_REQUEST['childhood_entered'])){$APresent = str_replace(',',':',$_REQUEST['childhood_entered']);}
						if (isset($_REQUEST['Naughty_entered'])){$ANaughty = str_replace(',',':',$_REQUEST['Naughty_entered']);}
						if (isset($_REQUEST['job_entered'])){$AJob = str_replace(',',':',$_REQUEST['job_entered']);}
						if (isset($_REQUEST['previous_entered'])){$APJob = str_replace(',',':',$_REQUEST['previous_entered']);}
						if (isset($_REQUEST['adultachievement_entered'])){$AAchieve = str_replace(',',':',$_REQUEST['adultachievement_entered']);}
						if (isset($_REQUEST['lifetimeAchievement_entered'])){$ALifeA = str_replace(',',':',$_REQUEST['lifetimeAchievement_entered']);}
						if (isset($_REQUEST['laugh_entered'])){$ALaugh = str_replace(',',':',$_REQUEST['laugh_entered']);}
						if (isset($_REQUEST['oldSchool_entered'])){$AOldSchool = str_replace(',',':',$_REQUEST['oldSchool_entered']);}
						if (isset($_REQUEST['teacher_entered'])){$ATeacher = str_replace(',',':',$_REQUEST['teacher_entered']);}
						if (isset($_REQUEST['favouriteMemory_entered'])){$AFavM = str_replace(',',':',$_REQUEST['favouriteMemory_entered']);}
						if (isset($_REQUEST['proud_entered'])){$AProud = str_replace(',',':',$_REQUEST['proud_entered']);}
						if (isset($_REQUEST['wish_entered'])){$AWish = str_replace(',',':',$_REQUEST['wish_entered']);}
						if (isset($_REQUEST['special_entered'])){$AMess = str_replace(',',':',$_REQUEST['special_entered']);}
						
						$nName="";
						$orderID="";
						if (isset($_REQUEST['name_entered'])) {$nName = $_REQUEST['name_entered'];}
						if (isset($_REQUEST['ref_entered'])) {$orderID = $_REQUEST['ref_entered'];}
						if($nName == "")
							{
							}
						else
							{
								$ToSave = $name.",".$ARelationship.",".$AName.",".$APresent.",".$AFav.",".$ANaughty.",".$AJob.",".$APJob.",".$AAchieve.",".$ALifeA.",".$ALaugh.",".$AOldSchool.",".$ATeacher.",".$AFavC.",".$AFavM.",".$AProud.",".$AWish.",".$AMess.",".$AMessChild;
				
								//$ToSave = $name.",".$ARelationship.",".$AName.",".$APresent.",".$AFav.",".$ANaughty.",".$AJob.",".$APJob.",".$AAchieve.",".$ALifeA.",".$ALaugh.",".$AOldSchool.",".$ATeacher.",".$AFavC.",".$AFavM.",".$AProud.",".$AWish.",".$AMess.",".$AMessChild;
						
								$encrypted_message =base64_encode(openssl_encrypt($ToSave, $method, $key, OPENSSL_RAW_DATA, $iv));
								$file = $orderID."_".$nName.".txt";
								$filename = $remoteFolderA."/".$file;
								file_put_contents($filename,$encrypted_message);
							}
					}
				
				
						
				if ($value == "fi")
					{
						//variables
						$FMention="";
						$FGames="";
						$FBefore="";
						$FTraditions="";
						$FLeave="";
						$FKeep="";
						if (isset($_REQUEST['mention_entered'])) {$FMention = str_replace(',',':',$_REQUEST['mention_entered']);}
						if (isset($_REQUEST['games_entered'])) {$FGames = str_replace(',',':',$_REQUEST['games_entered']);} 		
						if (isset($_REQUEST['before_entered'])) {$FBefore = str_replace(',',':',$_REQUEST['before_entered']);} 	
						echo $_REQUEST['before_entered'];
						if (isset($_REQUEST['leave_entered'])) {$FLeave = str_replace(',',':',$_REQUEST['leave_entered']);} 	
						if (isset($_REQUEST['keep_entered'])) {$FKeep = str_replace(',',':',$_REQUEST['keep_entered']);} 	
						if (isset($_REQUEST['traditions_entered'])) {$FTraditions = str_replace(',',':',$_REQUEST['traditions_entered']);} 	

						$orderID="";
						if (isset($_REQUEST['ref_entered'])) {$orderID = $_REQUEST['ref_entered'];}			
						
						if($orderID == "")
							{
								echo "Failed";
							}
						else
							{
								$ToSave = $FMention.",".$FGames.",".$FBefore.",".$FTraditions.",".$FLeave.",".$FKeep;
								
								$encrypted_message =base64_encode(openssl_encrypt($ToSave, $method, $key, OPENSSL_RAW_DATA, $iv));
								$file = $orderID."_Family.txt";
								$filename = $remoteFolderF."/".$file;

								file_put_contents($filename,$encrypted_message);
							}
					} 

				if ($value == "cpp")
					{
						$file = $name."_Port_".$orderID;
						$messType = "Portrait";
						$target_dir = $remoteFolderC."/";
					}
				if ($value == "cpr")
					{
						$file = $name."_Pres_".$orderID;
						$messType ="Present";
						$target_dir = $remoteFolderC."/";
					}
				if ($value == "cpa")
					{
						 $file = $name."_Achieve_".$orderID;
						 $messType="Achievement";
						 $target_dir = $remoteFolderC."/";
					}
				if ($value == "cpf")
					{
						$file = $name."_Famous_".$orderID;
						$messType = "Famous";
						$target_dir = $remoteFolderC."/";
					}
				if ($value == "act")
					{
						$file = $name."_ChristmasToy_".$orderID;
						$messType="ChirstmasToy";
						$target_dir = $remoteFolderA."/";
					}
				if ($value == "ach")
				{
					$file = $name."_Childhood_".$orderID;
					$messType = "Childhood";
					$target_dir = $remoteFolderA."/";
				}
				if ($value == "fg")
					{
						$file = "Family_Group_".$orderID;
						$messType = "Family Group";
						$target_dir=$remoteFolderF."/";
					}
				if ($value == "fh")
					{
						$file = "Family_Holiday_".$orderID;
						$messType = "Family Holiday";
						$target_dir=$remoteFolderF."/";
					}	
				if ($value == "cpp" || $value == "cpr" || $value == "cpa" || $value == "cpf" || $value == "act" || $value == "ach" || $value == "fg" || $value == "fh")
					{
						$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
						//echo $target_file;
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						
						//check if old file exists and type of file
						$filename = $target_dir."/".$file;
						$file_type=0;
						if (file_exists($filename.".jpg"))
							{
								$file_type = 1;
								$del_name = $filename.".jpg";
							}
						if (file_exists($filename.".png"))
							{
								$file_type=2;	
								$del_name = $filename.".png";
							}
						if (file_exists($filename.".jpeg"))
							{
								$file_type=3;
								$del_name = $filename.".jpeg";
							}
							
						// Check if image file is a actual image or fake image
						if(isset($_POST["submit"]))
						{
							$checkS = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
							if($checkS !== false)
								{
									//echo "File is an image - " . $check["mime"] . ".";
									$uploadOk = 1;
								}
							else 
								{
									//echo "File is not an image.";
									$uploadOk = 0;
								}
						}
						
						// Allow certain file formats
						if($imageFileType != "jpg"&& $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType !="gif" && $imageFileType !="bmp") 
						{
							echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							$uploadOk = 0;
						}
						
						$name=str_replace(' ','-',$name);
						if ($value == "cpp") {$new_name=$name."_Port_".$orderID.".".$imageFileType;}
						if ($value == "cpr") {$new_name=$name."_Pres_".$orderID.".".$imageFileType;}
						if ($value == "cpa") {$new_name=$name."_Achieve_".$orderID.".".$imageFileType;}
						if ($value == "cpf") {$new_name=$name."_Famous_".$orderID.".".$imageFileType;}
						if ($value == "fh"){$new_name="Family_Holiday_".$orderID.".".$imageFileType;}
						if ($value == "fg"){$new_name="Family_Group_".$orderID.".".$imageFileType;}
						if ($value == "ach"){$new_name=$name."_Childhood_".$orderID.".".$imageFileType;}
						if ($value == "act"){$new_name=$name."_ChristmasToy_".$orderID.".".$imageFileType;}
						$target_file = $target_dir.$new_name;
						
						
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) 
							{
								 echo "Sorry, your file was not uploaded.";
								// if everything is ok, try to upload file
							} 
						else 
							{		
								if ($_FILES["fileToUpload"]["size"] > $limit) 
									{		
										$res = 100-(($limit/$_FILES["fileToUpload"]["size"])*100);
								
										$tmp_name1 = $_FILES["fileToUpload"]["tmp_name"];	
										if ($imageFileType == "jpg")
											{
												$image = imagecreatefromjpeg($tmp_name1);
												$target_file = preg_replace('"\.jpg"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $target_file;
											}
										if ($imageFileType == "png")
											{
												$image = imagecreatefrompng($tmp_name1);
												$target_file = preg_replace('"\.png"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $target_file;
											}
										if ($imageFileType =="jpeg")
											{
												$image = imagecreatefromjpeg($tmp_name1);
												$target_file = preg_replace('"\.jpeg"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $target_file;
											}
										if ($imageFileType =="gif")
											{
												$image = imagecreatefromgif($tmp_name1);
												$target_file = preg_replace('"\.gif"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $xa;
											}
										if ($imageFileType =="bmp")
											{
												$image = imagecreatefrombmp($tmp_name1);
												$target_file = preg_replace('"\.bmp"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $xa;
											}

										if ($xa == True)
											{
												ucwords($name)."'s ".$messType." Picture has uploaded successfully<BR>";
												$message = "Picture Successfully uploaded";
												//echo "<p align='center'><font color=red font face='arial' size='2'>".$message."</font></p>";
												//echo "<p align='center'><font color=red font face='arial' size='2'>Please refresh browser to see your picture/s<BR></font></p>";
												//header("Refresh:0");
											} 
										else 
											{
													echo "Sorry, there was an error uploading your file. Error 1";
											}
									}		
									else
									{
										$res = $_FILES["fileToUpload"]["size"];
										$tmp_name1 = $_FILES["fileToUpload"]["tmp_name"];	
										if ($imageFileType == "jpg")
											{
												$image = imagecreatefromjpeg($tmp_name1);
												$target_file = preg_replace('"\.jpg"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $target_file;
											}
										if ($imageFileType == "png")
											{
												$image = imagecreatefrompng($tmp_name1);
												$target_file = preg_replace('"\.png"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $target_file;
											}
										if ($imageFileType =="jpeg")
											{
												$image = imagecreatefromjpeg($tmp_name1);
												$target_file = preg_replace('"\.jpeg"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $target_file;
											}
										if ($imageFileType =="gif")
											{
												$image = imagecreatefromgif($tmp_name1);
												$target_file = preg_replace('"\.gif"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $xa;
											}
										if ($imageFileType =="bmp")
											{
												$image = imagecreatefrombmp($tmp_name1);
												$target_file = preg_replace('"\.bmp"','.jpg',$target_file);
												$xa = imagejpeg($image,$target_file,$res);
												//echo $xa;
											}

										//if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
										if ($xa == True)
											{	
												$message = ucwords($name)."'s ".$messType." Picture has uploaded successfully<BR>";
												//echo "<p align='center'><font color=red font face='arial' size='2'>".$message."</font></p>";
												//echo "<p align='center'><font color=red font face='arial' size='2'>Please refresh browser to see your picture/s<BR></font></p>";
												//header("Refresh:0");
											}	 
										else 
											{
													echo "Sorry, there was an error uploading your file. Error 2";
											}
									}
							
							}
				$check=1;							
						
					}
				

				//if coming from login page
				if($opt==0)
					{

					}
				//clicking on Children button
				if($opt=="children")
					{
						?>
							<nav id="vertical-menu">
								<ul class="main-menu">
									<li class=""><a href="#"><i class="fa fa-child"></i><u><font size = "4">Children</font size></u></a></li>
									<?php
										$i =0;
										while ($i<$childCount)
										{
												?>
													 <li class="contain-submenu"><a href="#"><i class="fa fa-child"></i><font size = "4"><?php echo $childName[$i]; ?></font size></a>
															<ul class="submenu-1">
																<li><a href=<?php echo $childHref[$i]."&type=info&place=".$place[$i]; ?>><font size = "4"><i class="fa fa-info"></i></font size><font size = "4"><?php echo " Update information about ".$childName[$i]; ?></font size></a></li>
																<li><a href=<?php echo $childHref[$i]."&type=pics&place=".$place[$i];; ?>><i class="fa fa-camera"></i><font size = "4"><?php echo " Upload pictures of ".$childName[$i]; ?></font size></a></li>
															</ul>
													</li>
												<?php
													$i=$i+1;
										}
									?>
									
								</ul>
							</nav>
							<?php
							if ($type == "")
									{
										?>
											<div class="login-boxM1">
												<h2>Children Information</h2>
													<div class="user-box">
														<label>Use this area to answer questions about the children in your family</label>
														<br><br>
													</div>
													
													<?php
													$i=0;
													while ($i<$childCount)
														{
															?>
																<div class="user-box">
																	<label><?php echo "Add personal information and pictures for ".$childName[$i]; ?></label>
																</div>
																<form action=<?php echo $childHref[$i]."&type=info&place=".$place[$i]; ?> method=post enctype='multipart/form-data'>					
																	<a>
																		<span></span>
																		<span></span>
																		<span></span>
																		<span></span>
																		<input type=submit value="<?php echo "Upload information about ".$childName[$i]; ?>" style="font-size:25px">
																	</a>	
																</form>
																<form action=<?php echo $childHref[$i]."&type=pics&place=".$place[$i];; ?> method=post enctype='multipart/form-data'>					
																	<a>
																		<span></span>
																		<span></span>
																		<span></span>
																		<span></span>
																		<input type=submit value="<?php echo "Upload Pictures about ".$childName[$i]; ?>" style="font-size:25px">
																	</a>	
																</form>
															<?php
															$i=$i+1;
														}
													?>
											</div>
										<?php
									}
							
							
									
							if ($name =="none")
							{
								
							}
							else
							{
								
								
								
								
								if ($type=="info")
									{								
										//variables
										$DOB="";
										$Present = "";
										$Special = "";
										$Pets = "";
										$Best = "";
										$School = "";
										$TV = "";
										$Sports = "";
										$Club = "";
										$Achievements = "";
										$Gender = "";
										$Lockdown = "";
										$LastYearPre = "";
										$SpecialMess = "";
										
										//open file
										echo $i;
										$var_child = $response['booking'][$i]['25']['answer'];
										$var_child=str_replace(' ','-',$name);
										$file = $orderId."_".$var_child.".txt";
										$filename = $remoteFolderC."/".$file;
										
										$method = 'aes-256-cbc';
										$password = "TFI4gOfiMnABxa4UG9BuJAh4fUjayi5ySGHVB0XeT3qrgdFh8gj27ArwUUH8pBFZ";
										$key = substr(hash('sha256', $password, true), 0, 32);
										// IV must be exact 16 chars (128 bit)
										$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
										
										if (file_exists($filename))
											{
												$Ofile = fopen($filename,"r");
												while (! feof($Ofile))
												{
													$line = fgets($Ofile);
												}
												fclose($Ofile);
												$decrypted = openssl_decrypt(base64_decode($line), $method, $key, OPENSSL_RAW_DATA, $iv);
												list($var_child,$DOB,$Present,$Special,$Pets,$Best,$School,$TV,$Sports,$Club,$Achievements,$Lockdown,$LastYearPre,$SpecialMess,$Gender)=explode(',',$decrypted);
											}
										
										
										
										?>
											<body class="background">
												<div class="login-boxM1">
													<h2><?php echo "Enter Personal details for ".$name; ?></h2>
														<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data'>
															<div class="user-box">
																<label>Please enter personal details to use during your Magical Christmas Adventure</label>
																	<br><br><br><br>
																</div>
															<div class="user-box">
																<label>Hover over a section to learn where the information maybe used.</label>
																	<br><br><br><br>
																	</div>
															<div class="user-box">
																	<input type="text" name="dob_entered" required="" value = "<?php echo $DOB; ?>" required title="So we can know how old they are and be prepared to talk to them">
																	<label><?php echo $name."'s Date of Birth"; ?> </label>
																</div>
															<div class="user-box">
																	<input type="text" name="present_entered" required="" value = "<?php echo $Present; ?>" required title="So Santa knows what present your child wants">
																	<label><?php echo "What present is ".$name." expecting?"; ?></label>
																</div>
															<div class="user-box">
																	<input type="text" name="people_entered" value="<?php echo $Special; ?>" required="" required>
																	<label><?php echo "Who are some special people in ".$name."'s life?"; ?></label>
																</div>
															<div class="user-box">
																	<input type="text" name="pets_entered" value="<?php echo $Pets; ?>">
																	<label>Do they have any pets</label>
																</div>
															<div class="user-box">
																	<input type="text" name="best_entered" value="<?php echo $Best; ?>">
																	<label>Who are their best friends?</label>
																</div>
															<div class="user-box">
																	<input type="text" name="school_entered"  value="<?php echo $School; ?>"maxlength="20" title="Bartholomew may talk to your child about this">
																	<label>School they attend</label>
																</div>
															<div class="user-box">
																	<input type="text" name="tv_entered" value="<?php echo $TV; ?>">
																	<label>Do they have a favourite TV show? What is it?</label>
																</div>
															<div class="user-box">
																	<input type="text" name="sports_entered" value="<?php echo $Sports; ?>">
																	<label>Do they do any sports? Do they have a favourite team?</label>
																</div>
															<div class="user-box">
																	<input type="text" name="clubs_entered" value="<?php echo $Club; ?>">
																	<label>Do they attend any clubs? What are they?</label>
																</div>
															<div class="user-box">
																	<input type="textarea" name="achievements_entered" value="<?php echo $Achievements; ?>"required="" required>
																	<label>Have they achieved anything amazing this year?</label>
																</div>
															<div class="user-box">
																	<input type="text" name="lockdown_entered" value="<?php echo $Lockdown; ?>">
																	<label>Did they do anything special during lockdown?</label>
																</div>
															<div class="user-box">
																	<input type="text" name="last_entered" value="<?php echo $LastYearPre; ?>">
																	<label>What was their main or favourite present from last year</label>
																</div>
															<div class="user-box">
																	<input type="text" name="gender_entered" value="<?php echo $Gender; ?>"required="" required>
																	<label>What is their gender?</label>
															</div>
															<a>
																<span></span>
																<span></span>
																<span></span>
																<span></span>
																<input type=submit value="<?php echo "Update ".$name."'s Information"; ?>" style="font-size:25px">
															</a>
															<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
															<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
															<input type="hidden" name="value_entered" value="ci">
													</form>
												</div>
											</body>
										<?php
									}
								if ($type=="pics")
								{
									$var_child = $response['booking'][$i]['25']['answer'];
									$var_child=str_replace(' ','-',$var_child);
									
									$portPic = $remoteFolderC."/".$name."_Port_".$orderId.".jpg";
									$presPic = $remoteFolderC."/".$name."_Pres_".$orderId.".jpg";
									$achPic = $remoteFolderC."/".$name."_Achieve_".$orderId.".jpg";
									$famousPic = $remoteFolderC."/".$name."_Famous_".$orderId.".jpg";
									
									$picCount=0;
									if (file_exists($portPic)) {$picCount = $picCount+1;}
									if (file_exists($presPic)) {$picCount = $picCount+1;}
									if (file_exists($achPic)) {$picCount = $picCount+1;}
									if (file_exists($famousPic)) {$picCount = $picCount+1;}
									
									if ($picCount <3){$class = "login-boxM1";}
									if ($picCount ==3){$class = "login-boxMv1";}
									if ($picCount ==4){$class = "login-boxMv2";}
										
									?>
									
									<body class="background">
										<div class=<?php echo $class; ?>>
											<h2><?php echo "Upload photos for ".$name; ?></h2>
												<div class="user-box">
													<label>You can upload photos for your child to personalise the experience more</label>
													<br><br><br><br>
												</div>
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label><?php echo "Portrait picture of ".$name; ?></label>
														<br><br>
													</div>
													<?php
														if (file_exists($portPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $portPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center>Replace Portrait picture:</center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpp">
																	<center><input type="submit" value="Replace Portrait Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><?php echo "Upload a portrait picture of ".$name; ?></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpp">
																	<center><input type="submit" value="Upload New Portrait Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>
												
												
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label><?php echo "Picture of the present ".$name." is expecting"; ?></label>
														<br><br>
													</div>
													<?php
														if (file_exists($presPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $presPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center>Replace Picture of Present:</center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpr">
																	<center><input type="submit" value="Replace Present Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><?php echo "Upload a picture of ".$name. "'s expected present"; ?></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpr">
																	<center><input type="submit" value="Upload New Present Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label><?php echo "Upload a picture of an achievement ".$name." has done"; ?></label>
														<br><br>
													</div>
													<?php
														if (file_exists($achPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $achPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center>Replace Achievement Picture</center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpa">
																	<center><input type="submit" value="Replace Achievement Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><?php echo "Upload a picture of an achievement ".$name. " has done this year"; ?></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpa">
																	<center><input type="submit" value="Upload New Achievement Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label><?php echo "Upload a picture of a famous person ".$name." has met"; ?></label>
														<br><br>
													</div>
													<?php
														if (file_exists($famousPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $famousPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center>Replace Famous Meeting Picture</center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpf">
																	<center><input type="submit" value="Replace Famous Meeting Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><?php echo "Upload a picture of a famous person ".$name. " has met"; ?></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="cpf">
																	<center><input type="submit" value="Upload New Famous Meeting Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>						
										</div>
									</body>
									<?php
								}
								if ($type=="pics")
									{
									}
									
							}
					}
				if ($opt == "adults")
					{
						?>
							<nav id="vertical-menu">
								<ul class="main-menu">
									<li class=""><a href="#"><i class="fa fa-users"></i><u><font size = "4">Adults</font size></u></a></li>
									<?php
										$i =0;
										while ($i<$adultCount)
										{
												?>
													 <li class="contain-submenu"><a href="#"><i class="fa fa-users"></i><font size = "4"><?php echo $adultName[$i]; ?></font size></a>
															<ul class="submenu-1">
																<li><a href=<?php echo $adultHref[$i]."&type=info&place=".$place[$i]; ?>><font size = "4"><i class="fa fa-info"></i></font size><font size = "4"><?php echo " Update information about ".$adultName[$i]; ?></font size></a></li>
																<li><a href=<?php echo $adultHref[$i]."&type=pics&place=".$place[$i];; ?>><i class="fa fa-camera"></i><font size = "4"><?php echo " Upload pictures of ".$adultName[$i]; ?></font size></a></li>
															</ul>
													</li>
												<?php
													$i=$i+1;
										}
									?>
									
								</ul>
							</nav>
							<?php	
						if ($type == "")
							{
								?>
									<div class="login-boxM1">
										<h2>Adult Information</h2>
											<div class="user-box">
												<label>Use this area to answer questions about the adults in your family</label>
												<br><br>
											</div>
											
											<?php
											$i=0;
											while ($i<$adultCount)
												{
													?>
														<div class="user-box">
															<label><?php echo "Add personal information and pictures for ".$adultName[$i]; ?></label>
														</div>
														<form action=<?php echo $adultHref[$i]."&type=info&place=".$place[$i]; ?> method=post enctype='multipart/form-data'>					
															<a>
																<span></span>
																<span></span>
																<span></span>
																<span></span>
																<input type=submit value="<?php echo "Upload information about ".$adultName[$i]; ?>" style="font-size:25px">
															</a>	
														</form>
														<form action=<?php echo $adultHref[$i]."&type=pics&place=".$place[$i];; ?> method=post enctype='multipart/form-data'>					
															<a>
																<span></span>
																<span></span>
																<span></span>
																<span></span>
																<input type=submit value="<?php echo "Upload Pictures about ".$adultName[$i]; ?>" style="font-size:25px">
															</a>	
														</form>
													<?php
													$i=$i+1;
												}
											?>
									</div>
								<?php
							}

								
								
						if ($type=="info")
							{		
								
								if ($name =="none")
									{	
									}
								else
									{			
										//variables
										$ARelationship="";
										$AName = "";
										$APresent = "";
										$AFav = "";
										$ANaughty = "";
										$AJob = "";
										$APJob = "";
										$AAchieve = "";
										$ALifeA = "";
										$ALaugh = "";
										$AOldSchool = "";
										$ATeacher = "";
										$AFavC = "";
										$AFavM = "";
										$AProud ="";
										$AWish="";
										$AMess="";
										$AMessChild="";
								
										//echo $i;
										//$var_adult = $response['booking'][$i]['37']['answer'];
										//$var_adult=str_replace(' ','-',$var_adult);
										$file = $orderId."_".$name.".txt";
										$filename = $remoteFolderA."/".$file;
										
										$method = 'aes-256-cbc';
										$password = "TFI4gOfiMnABxa4UG9BuJAh4fUjayi5ySGHVB0XeT3qrgdFh8gj27ArwUUH8pBFZ";
										$key = substr(hash('sha256', $password, true), 0, 32);
										// IV must be exact 16 chars (128 bit)
										$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
										
										if (file_exists($filename))
											{
												$Ofile = fopen($filename,"r");
												while (! feof($Ofile))
												{
													$line = fgets($Ofile);
												}
												fclose($Ofile);
												$decrypted = openssl_decrypt(base64_decode($line), $method, $key, OPENSSL_RAW_DATA, $iv);
												list($var_adult,$ARelationship,$AName,$APresent,$AFav,$ANaughty,$AJob,$APJob,$AAchieve,$ALifeA,$ALaugh,$AOldSchool,$ATeacher,$AFavC,$AFavM,$AProud,$AWish,$AMess,$AMessChild)=explode(',',$decrypted);
											}
										?>
										<body class="background">
											<div class="login-boxM1">
												<h2><?php echo "Adult information for ".$name; ?></h2>
													<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data'>
														<div class="user-box">
															<label>Please enter personal details to use during your Magical Christmas Adventure</label>
																<br><br><br><br>
															</div>
														<div class="user-box">
															<label>Hover over a section to learn where the information maybe used.</label>
															<br><br><br><br>
														</div>
														<div class="user-box">
															<input type="text" name="relationship_entered" value="<?php echo $ARelationship; ?>" required="" required title="So we know if they are mum, dad, grandad, etc.">
															<label><?php echo $name."'s Relationship to the children"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="childhood_entered" value="<?php echo $APresent; ?>" required="" required title="So Santa knows what the adult had as a present as a child">
															<label><?php echo $name." Favourite Childhood present?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="Naughty_entered" value="<?php echo $ANaughty; ?>" required="" required>
															<label><?php echo "What is something naughty that ".$name." has done this year?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="job_entered" value="<?php echo $AJob; ?>" required="" required>
															<label><?php echo "What is ".$name." 's job?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="previous_entered" value="<?php echo $APJob; ?>" >
															<label><?php echo "What is ".$name." previous job?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="adultachievement_entered"  value="<?php echo $AAchieve; ?>" maxlength="20" title="Bartholomew may talk to your child about this">
															<label><?php echo "What is an achievement ".$name." has done this year?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="lifetimeAchievement_entered" value="<?php echo $ALifeA; ?>" >
															<label><?php echo "What is ".$name."'s lifetime achievment?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="laugh_entered" value="<?php echo $ALaugh; ?>" required="" required>
															<label><?php echo "Is ".$name." up for a laugh?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="oldSchool_entered"  value="<?php echo $AOldSchool; ?>" >
															<label><?php echo "What school did ".$name." used to attend when a child?"; ?></label>
														</div>
														<div class="user-box">
															<input type="textarea" name="teacher_entered" value="<?php echo $ATeacher; ?>" >
															<label><?php echo "Who was ".$name." favourite teacher at school?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="favouriteMemory_entered" value="<?php echo $AFavM; ?>">
															<label><?php echo "Does ".$name." have a favourite childhood memory?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="proud_entered" value="<?php echo $AProud; ?>">
															<label><?php echo "Is ".$name." proud of any of the children? And if so why?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="wish_entered" value="<?php echo $AWish; ?>" >
															<label><?php echo "Does ".$name." have any Christmas wishes?"; ?></label>
														</div>
														<div class="user-box">
															<input type="text" name="special_entered" value="<?php echo $AMess; ?>">
															<label><?php echo "Does ".$name." have a special message for their children?"; ?></label>
														</div>
														<a>
															<span></span>
															<span></span>
															<span></span>
															<span></span>
															<input type=submit value='Save' style="font-size:25px">
														</a>
														
														<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
															<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
															<input type="hidden" name="value_entered" value="ai">
													</form>
												</div>
											</body>
										<?php
									}
							}
					if ($type=="pics")
							{
								
									$christmastoyPic = $remoteFolderA."/".$name."_ChristmasToy_".$orderId.".jpg";
									$childhoodPic =$remoteFolderA."/".$name."_Childhood_".$orderId.".jpg";
									?>
									
									<body class="background">
										<div class="login-boxM1">
											<h2><?php echo "Upload Pictures for ".$name; ?></h2>
												<div class="user-box">
													<label><?php echo "Upload pictures for ".$name." to personalise their visit"; ?></label>
													<br><br><br><br>
												</div>
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label><?php echo "A picture of ".$name." as a child."; ?></label>
														<br><br>
													</div>
													<?php
														if (file_exists($childhoodPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $childhoodPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><?php echo "Replace Childhood picture of ".$name;?></center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="ach">
																	<center><input type="submit" value="Replace Childhood Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><<?php echo "Upload a picture of ".$name."as a child";?>></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="ach">
																	<center><input type="submit" value="Upload New Childhood Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label><?php echo "Upload a picture of a toy ".$name." had as a child";?></label>
														<br><br>
													</div>
													<?php
														if (file_exists($christmastoyPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $christmastoyPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><?php echo "Replace picture of ".$name." childhood toy";?></center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="act">
																	<center><input type="submit" value="Replace Childhood toy Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><<?php echo "Upload a picture of a toy ".$name." had as a child";?>></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="act">
																	<center><input type="submit" value="Upload New Childhood Toy Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>
										</div>
									</body>
									<?php
							}
							
							
					}
								
				if ($opt == "family")
					{
						?>
							<nav id="vertical-menu">
								<ul class="main-menu">
									<li class=""><a href="#"><i class="fa fa-house"></i><u><font size = "4">Family</font size></u></a></li>
									<li class=""><a href=<?php echo "test.php?opt=family&id=".$orderId."&type=info"; ?>><i class="fa fa-info"></i><font size = "4">Family Information</font size></a>
									<li class=""><a href=<?php echo "test.php?opt=family&id=".$orderId."&type=pics";?>><i class="fa fa-camera"></i><font size = "4">Family Photos</font size></a>
								</ul>
							</nav>
						<?php
						if ($type == "")
							{
								?>
									<div class="login-boxM1">
										<h2>Family Information</h2>
											<div class="user-box">
												<label>Use this area to answer questions about your family as a whole</label>
												<br><br><br>
											</div>
											<form action=<?php echo $_SERVER['REQUEST_URI']."&type=info"; ?> method=post enctype='multipart/form-data'>					
												<a>
													<span></span>
													<span></span>
													<span></span>
													<span></span>
													<input type=submit value='Complete Information about your family' style="font-size:25px">
												</a>	
											</form>
											<br>
											<form action=<?php echo $_SERVER['REQUEST_URI']."&type=pics"; ?> method=post enctype='multipart/form-data'>					
												<a>
													<span></span>
													<span></span>
													<span></span>
													<span></span>
													<input type=submit value='Upload photos of your family' style="font-size:25px">
												</a>	
											</form>
									</div>
								<?php
							}
						if ($type == "info")
							{
								
								//variables
								$FMention="";
								$FGames="";
								$FBefore="";
								$FTraditions="";
								$FLeave="";
								$FKeep="";
								
								//open file
								$file = $orderId."_Family.txt";
								$filename = $remoteFolderF."/".$file;
									
								$method = 'aes-256-cbc';
								$password = "TFI4gOfiMnABxa4UG9BuJAh4fUjayi5ySGHVB0XeT3qrgdFh8gj27ArwUUH8pBFZ";
								$key = substr(hash('sha256', $password, true), 0, 32);
								// IV must be exact 16 chars (128 bit)
								$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
								
								if (file_exists($filename))
									{
										$Ofile = fopen($filename,"r");
										while (! feof($Ofile))
										{
											$line = fgets($Ofile);
										}
										fclose($Ofile);
										$decrypted = openssl_decrypt(base64_decode($line), $method, $key, OPENSSL_RAW_DATA, $iv);
										list($FMention,$FGames,$FBefore,$FTraditions,$FLeave,$FKeep)=explode(',',$decrypted);
									}
								
								
								
								
			
								?>
									<div class="login-boxM1">
										<h2>Family Information</h2>
											<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data'>
												<div class="user-box">
													<label>Please enter personal details to use during your Magical Christmas Adventure</label>
													<br><br><br><br>
												</div>
												<div class="user-box">
													<label>Hover over a section to learn where the information maybe used.</label>
													<br><br><br><br>
												</div>
												<div class="user-box">
													<input type="text" name="mention_entered" value="<?php echo $FMention; ?>">
													<label>Is there anything we shouldn't mention? Such as upsetting information or family details</label>
												</div>
												<div class="user-box">
													<input type="text" name="games_entered" value="<?php echo $FGames; ?>">
													<label>Are there any family games you play over the Christmas Period</label>
												</div>
												<div class="user-box">
													<input type="text" name="before_entered" value="<?php echo $FBefore; ?>">
													<label> Have you and your family been before</label>
												</div>
												<div class="user-box">
													<input type="text" name="leave_entered" value="<?php echo $FLeave; ?>">
													<label>Is there anything you leave out on Christmas Eve? If so what?</label>
												</div>
												<div class="user-box">
													<input type="text" name="traditions_entered" value="<?php echo $FTraditions; ?>">
													<label>Has your family got any traditions and if so what?</label>
												</div>
												<div class="user-box">
													<input type="text" name="keep_entered" value="<?php echo $FKeep; ?>">
													<label>Can we keep you information on file, this would be used if you bring your family next year?</label>
												</div>
												<a>
													<span></span>
													<span></span>
													<span></span>
													<span></span>
													<input type=submit value='Submit' style="font-size:25px">
												</a>
												<input type="hidden" name="name_entered" value= >
												<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
												<input type="hidden" name="value_entered" value="fi">
											</form>
									</div>
								<?php
							}
						if ($type=="pics")
							{
								
									$holidayPic = $remoteFolderF."/Family_Holiday_".$orderId.".jpg";
									$groupPic = $remoteFolderF."/Family_Group_".$orderId.".jpg";
									?>
									
									<body class="background">
										<div class="login-boxM1">
											<h2>Upload Pictures for your Family</h2>
												<div class="user-box">
													<label>You can upload photos for your Family to personalise the experience more</label>
													<br><br><br><br>
												</div>
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label>A picture of your family on holiday</label>
														<br><br>
													</div>
													<?php
														if (file_exists($holidayPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $holidayPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center>Replace Holiday picture:</center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="fh">
																	<center><input type="submit" value="Replace Holiday Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><Upload a picture of your family on holiday></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="fh">
																	<center><input type="submit" value="Upload New Holiday Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>
												
												<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data' id="imageform" name="imageform">
													<div class="user-box">
														<label>A picture of your whole family</label>
														<br><br>
													</div>
													<?php
														if (file_exists($groupPic))
														{
															?>
																<p class="alignleft">
																	<img class="center" src=<?php echo $groupPic; ?> alt="centered image" width="250" height="250"/>
																</p>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center>Replace Group picture:</center>
																	<center><input type="file" name="fileToUpload" id="fileToUpload" value="Choose file to replace"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="fg">
																	<center><input type="submit" value="Replace Group Picture" name="submit"></center>
																</a>
															<?php
														}
														else
														{
															?>
																<a>
																	<span></span>
																	<span></span>
																	<span></span>
																	<span></span>
																	<center><Upload a picture of your whole family></center>
																	<br>
																	<center><input type="file" name="fileToUpload" id="fileToUpload"></center>
																	<input type="hidden" name="name_entered" value=<?php echo $name; ?>>
																	<input type="hidden" name="ref_entered" value=<?php echo $orderId; ?>>
																	<input type="hidden" name="value_entered" value="fg">
																	<center><input type="submit" value="Upload New Group Picture" name="submit"></center>
																</a>
															<?php
														}
													?>
												</form>
										</div>
									</body>
									<?php
							}
							
							
					}
				if ($opt == "why")
					{
						?>
							<div class="login-boxM1">
								<h2>Why we do this!</h2>
									<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data'>
										<div class="user-box">
											<label>During your tour around the magical christmas adventure your family will meet a range of people who will use the personal information you input to personalise and create a magical experience</label>
											<br><br><br><br>
										</div>
										<div class="user-box">
											<label>All information entered may or may not be used; we will try our best to ensure the data is used but due to circumstances outside our control some or all of it may not be used</label>
											<br><br><br><br>
										</div>
										<div class="user-box">
											<label>Please see this video below</label>
											<br><br><br><br>
										</div>
										<center><video width="640" height="360" autoplay controls>
											<source src="Videos\86475.mp4" type="video/mp4">
											<source src="movie.ogg" type="video/ogg">
											Your browser does not support the video tag.
										</video></center>
										<div class="user-box">
											<label>Here are a few of the characters who will use your personal information</label>
											<br><br><br><br>
										</div>
										<div class="user-box">
											<label>Santa</label>
											<br><br><br><br>
										</div>
										<p class="alignleft">
											<img class="img" src="Santa.JPG" alt="centered image" width="250" height="250"/>
										</p>
										<div class="user-box">
											<label>Santa will talk about the childrens favourite presents, achievements and show pictures</label>
										</div>
										<div class="user-box">
											<label>Reindeers</label>
											<br><br><br><br>
										</div>
										<p class="alignleft">
											<img class="img" src="Reindeers.JPG" alt="centered image" width="250" height="250"/>
										</p>
										<div class="user-box">
											<label>Reindeers may talk to your children about their school, friends, pets, etc.</label>
										</div>
									</form>
							</div>
						<?php
					}
				if ($opt == "change")
					{
						?>
							<div class="login-boxM2">
								<h2>Change your password</h2>
									<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data'>
										<div class="user-box">
											<input type="password" name="old_entered" required="" required  minlength="8">
											<label>Current Password</label>
										</div>
										<div class="user-box">
											<input type="password" name="new1_entered" required="" required  minlength="8">
											<label>New Password</label>
										</div>
										<div class="user-box">
											<input type="password" name="new2_entered" required="" required  minlength="8">
											<label>Repeat New Password</label>
										</div>
										<a>
											<span></span>
											<span></span>
											<input type=submit value='Change Password' style="font-size:25px">
										</a>
									</form>
							</div>
						<?php
					}
				if ($opt == "contact")
					{
						?>
							<div class="login-boxM2">
								<h2>Contact us</h2>
									<form action=<?php echo $_SERVER['REQUEST_URI']; ?> method=post enctype='multipart/form-data'>
										<div class="user-box">
											<label>If you have any problems or suggestions please drop us an email below</label>
											<br><br><br><br>
										</div>
										<div class="user-box">
											<input type="text" name="email_entered" required="" required  minlength="8">
											<label>Your email address</label>
										</div>
										<div class="user-box">
											<input type="text" name="content_entered" required="" required  minlength="8">
											<label>Message</label>
										</div>
										<a>
											<span></span>
											<span></span>
											<span></span>
											<span></span>
											<input type=submit value='Send' style="font-size:25px">
										</a>
										<div class="user-box">
											<label>You can also ring us between 9:30am and 5:30pm Monday to Friday on 01635 269678</label>
											<br><br><br><br>
										</div>
									</form>
							</div>
						<?php
					}	
			?>

		</html>

		<?php

			
	}
else
	{
		?>
		<p class="alignleft">
			<img class="img" src="The Magical Christmas Adventure Logo.png" alt="centered image" width="150" height="150"/>
		</p>

		<div class="login-boxM1">
			<h2>Unrecognised email or Password</h2>
				<form action="LoginNew.php" method=post enctype='multipart/form-data'>
					<div class="user-box">
						<label>The email address and/or password wasn't recognised, please return and try again</label>
					</div>
					
					<a>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<input type=submit value='Return to Login' style="font-size:25px">
					</a>
				</form>
			</div>
		<?php
	}
	
	// Example classes to connect to the web service and call the methods
			// You shouldn't need to make any changes to these functions!

			class FuseMetrixWebService_SOAP {
				private $client;
				private $username;
				private $password;
				private $token;
				private $headersGenerated;

				function __construct($username, $password, $url) {
					$this->client = new SoapClient(null, array("location" => $url, "uri" => "fusemetrix", "soap_version" => SOAP_1_2));
					$this->username = $username;
					$this->password = $password;
					$this->getToken();
					$this->headersGenerated = false;
				}

				private function getToken($force = false) {
					if($force || !isset($_SESSION["fmxwebservice_soap"]["token"])) {
						$this->token = $this->client->requestToken($this->username);
						$_SESSION["fmxwebservice_soap"]["token"] = $this->token;
					} else {
						$this->token = $_SESSION["fmxwebservice_soap"]["token"];
					}
				}

				private function generateHeaders() {
					$digest = md5($this->password . $this->token);
					$usernameToken = new SoapHeaderUsernameToken($this->username, $digest);
					
					$soapHeaders[] = new SoapHeader("fusemetrix", "auth", $usernameToken);

					$this->client->__setSoapHeaders($soapHeaders);
				}

				public function __call($function, $arguments) {
					if(!$this->headersGenerated) {
						$this->generateHeaders();
					}
					try {
						return $this->client->__soapCall($function, $arguments);
					} catch (SoapFault $e) {
						if($e->faultcode == "0002") {
							$this->client->__setSoapHeaders(null);
							$this->getToken(true);
							$this->generateHeaders();
							return $this->client->__soapCall($function, $arguments);
							throw($e);
						}
					}
				}
			}

			class SoapHeaderUsernameToken {
				public $digest;
				public $username;

				public function __construct($l, $d) {
					$this->digest = $d;
					$this->username = $l;
				}
			}
?>