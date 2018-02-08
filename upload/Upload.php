<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>上传文件</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<style>
    div{
        border : 1px solid black;
        margin : 10px 20px 30px 40px;
    }
</style>
<script> 
    var uploadFiles = new Array();

    $(function(){ 
        //阻止浏览器默认行为。 
        $(document).on({ 
            dragleave:function(e){    //拖离 
                e.preventDefault(); 
            }, 
            drop:function(e){  //拖后放 
                e.preventDefault(); 
            }, 
            dragenter:function(e){    //拖进 
                e.preventDefault(); 
            }, 
            dragover:function(e){    //拖来拖去 
                e.preventDefault(); 
            } 
        }); 

        var box = document.getElementById('dropbox'); //拖拽区域 

        box.addEventListener("drop",function(e){ 
            e.preventDefault(); //取消默认浏览器拖拽效果 
            var fileList = e.dataTransfer.files; //获取文件对象 
            //检测是否是拖拽文件到页面的操作 
            if(fileList.length == 0){ 
                return false; 
            } 
            AddFiles(fileList);
        },false); 
    }); 

    function Refresh(){
        location.reload();
    }

    function Upload(){

        AddFiles(new Array());
        if(uploadFiles.length <= 0){
            Refresh();
            return;
        }

        uploadcount = uploadFiles.length ;

        var FileController = "SaveFile.php";                    // 接收上传文件的后台地址
        // FormData 对象

        var form = new FormData();
        form.append("file", uploadFiles[0]); 
        // XMLHttpRequest 对象
        var xhr = new XMLHttpRequest();
        xhr.open("post", FileController, true);
        xhr.onload = function () {
            Upload();
        };
        xhr.send(form);
        uploadFiles.splice(0,1);
    }

    function onc(){
        var files = document.getElementById("file").files;

        if(files.length < 0){
            return ;
        }
        AddFiles(files);
    }

    function AddFiles(files){
        var errstr = "";
        for(var i=0; i< files.length; i++){
            var filename = files[i].name;
            var isfind = false;
            for(var j=0; j< uploadFiles.length; j++){
                if(uploadFiles[j].name == filename){
                    isfind = true;
                    break;
                }
            }

            var index1=filename.lastIndexOf(".");  
            var index2=filename.length;
            var postf=filename.substring(index1+1,index2);//后缀名  
            var myarray = new Array('JPG','jpg','jpeg','JPEG','gif','GIF','png','PNG');

            if($.inArray(postf,myarray) == -1){
                errstr += filename + "/";
                continue;
            }
            if(isfind == false){
                uploadFiles.push(files[i]);
            }
        }

        if(errstr != ""){
            alert("文件格式错误:"+errstr);
        }

        var fileliststring = "";

        for(var j=0; j< uploadFiles.length; j++){
            fileliststring += uploadFiles[j].name + " 大小:" + (uploadFiles[j].size / 1000) + "k" + "</br>";
        }

        document.getElementById("fileliststring").innerHTML=fileliststring;
    }

</script> 
<body>
    <div name="single" style="text-align: center; ">
        <A class=btn_addPic href="javascript:void(0);"><SPAN>选择文件</SPAN>
    	   <input  id="file"  class="filePrew" type="file" name="file" multiple="multiple" onchange="javascript:onc();" />
        </A>
    </div>  

    <div name="dropbox" id="dropbox" style="font-size:30px;color:#333333;background-color:#888888;min-width:300px;min-height:100px;border:3px dashed silver;">
        <p style="line-height: 100px;">拖拽文件上传</p>
    </div>  

    <div style="text-align: center; ">
        <button class="button" type="submit" onclick="javascript:Upload();">上传</button>
    </div>  

    <div id="fileliststring" style="background-color:#cccccc;  color:#333333; ">
    </div>

</body>
</html>