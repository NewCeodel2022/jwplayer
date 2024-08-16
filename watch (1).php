<?php 
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Estás viendo películas/series de LDR PLAYER</title>
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
		<meta name="robots" content="noindex">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ssl.p.jwpcdn.com/player/v/8.22.0/jwplayer.js"></script>
	
	<script type="text/javascript">jwplayer.key="XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo";</script>
	<style type="text/css" media="screen">html,body{padding:0;margin:0;height:100%}#ykstream-player{width:100%!important;height:100%!important;overflow:hidden;background-color:#000}</style>
	<? include('ads.php'); ?>
</head>
<body>

<?php 
		error_reporting(0);
		
		$data = (isset($_GET['data'])) ? $_GET['data'] : '';

		if ($data != '') {
			
			include_once 'config.php';

			$data = json_decode(decode($data));
			
			$title = (isset($data->title)) ? $data->title : '';
			
			$slug = (isset($data->slug)) ? $data->slug : '';

			$link = (isset($data->link)) ? $data->link : '';

			$sub = (isset($data->sub)) ? $data->sub : '';

			$poster = (isset($data->poster)) ? $data->poster : '';

			$tracks = '';
			
			foreach ($sub as $key => $value) {
			    $tracks .= '{ 
						        file: "'.$value.'", 
						        label: "'.$key.'",
						        kind: "captions",
						        "default": true
							   },';
			}

			include_once 'curl.php';

			$curl = new cURL();

			$directLink = $link;
			
			
			$download_button .= 'player.addButton(
										"https://i.imgur.com/QsPDuIn.png",
										"Download Movie",
										function () {
											var win = window.open("'.$directLink.'","_blank");
											win.focus();
										},
										"download"
									)';
            
			$xlogo ='player.addButton(
										"/assets/images/logoweb.png",
										"CreditOs de Code4alls",
										function () {
											var win = window.open("https://code4alls.online/","_blank");
											win.focus();
										},
										"facebook"
									)';
		    $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$directLink.'"}]';

			$result = '<div id="ykstream-player"></div>';

			$data = 'var player = jwplayer("ykstream-player");
						player.setup({
							sources: '.$sources.',
							aspectratio: "16:9",
							startparam: "start",
							primary: "html5",
							autostart: false,
							preload: "auto",
							title: "'.$title.'",
							description: "'.$slug.'",
							image: "'.$poster.'",
							 				
	
										
											
								
								 
							abouttext: "LDR PLAYER",
                            aboutlink: "https://code4alls.online/",
							skin: {
                                name: "netflix"
                              },
                            
                            logo: {
                                file: ""
                              },
						    captions: {
						        color: "#ffffff",
						        fontSize: 16,
						        backgroundOpacity: 0,
						        fontfamily: "Helvetica",
						        edgeStyle: "raised"
						    },
						    tracks: ['.$tracks.']
						});
						'.$download_button.';
						
						'.$xlogo.';
			            player.on("setupError", function() {
			              swal("Server Error!", "Please contact us to fix it asap. Thank you!", "error");
			            });
						player.on("error" , function(){
							swal("Server Error!", "Please contact us to fix it asap. Thank you!", "error");
						});';
						
						   
						
						
						
						
						
						
						
						
			
			$packer = new Packer($data, 'Normal', true, false, true);

			$packed = $packer->pack();

			$result .= '<script type="text/javascript">' . $packed . '</script>';

			echo $result;

		} else echo 'Empty link!';

?>
<div id="loading" class="pop-wrap">
    
                <div class="loading-container">
                    <div class="loading-ani"></div>
                    <div class="loading-text">Cargando...</div>
                </div>
            
        
    </div>
</div>


</body>
</html>

