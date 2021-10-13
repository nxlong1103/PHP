<?php
	function sourceImage($imageName,$val){
		return '<li><img src="./images/'.$imageName.'" />' . $val .' - F </li>';	
	}
	function showAll($path, &$newString, $level=0){
		$data	= array_merge(scandir($path));
		$newString .= '<ul>';
		foreach($data as $key => $value){				
			if($value != '.' && $value != '..'){			
				$dir	= $path . '/' . $value;
				if(is_dir($dir)){
					$level +=1 ;
					$newString .= '<li><img src="./images/folder.png" />' . $value .' - D - level: ' . '<a style="color: red;font-size: 20px;font-weight: 600;">'.$level.'</a>';
					showAll($dir, $newString,$level);
					$newString .= '</li>'; $level=0;
				}else{			
					
					$ext = pathinfo($value,PATHINFO_EXTENSION);	
						
					switch($ext){
						case "html":
						case "css":
						case "php":							
							$newString .= sourceImage("code.png",$value);							
							break;
						case "png":
						case "jpg":
						case "jpeg":
							$newString .= sourceImage("picture.png",$value);			
							break;
						case "txt":
							$newString .= sourceImage("file.png",$value);
							break;
						case "mp4":
						case "mp3":
						case "avi":	
							$newString .= sourceImage("video.png",$value);
							break;
						default:
							$newString .= sourceImage("default.png",$value);	
					}									
				}
			}	
		}	
		$newString .= '</ul>';		
	}
	
	showAll('.', $newString);
	echo $newString; 



	
