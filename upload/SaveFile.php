<?php   
	$file = $_FILES['file'];//得到传输的数据
    
    if($file != null){
        //得到文件名称
        $name = $file['name'];

		$names = explode('.',$name); 
        if(count($names) < 2){
        	exit();
        }

        $allow_type = array('JPG','jpg','jpeg','JPEG','gif','GIF','png','PNG'); //定义允许上传的类型

		//判断文件类型是否被允许上传
		if(in_array($names[count($names)-1], $allow_type)){
			move_uploaded_file($file['tmp_name'],"file/".$file['name']);
		}
    }
?>


