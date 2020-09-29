
<?php
  require 'config.php';
  session_start(); 
  if(!empty($_SESSION))
  {
    $user_ID = $_SESSION['UserID'];

    if(isset($_POST['img-upload'] )  ){
  
      $folderName = $_POST['fName'];
      // echo "dd".$folderName;
      $name = $_FILES['file']['name'];
      $dirname = "./".$folderName."/";
      
      $target_file = $dirname . basename($_FILES["file"]["name"]);
  
  
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
      // Valid file extensions
      $extensions_arr = array("jpg","jpeg","png");
  
      // Check extension
      if( in_array($imageFileType,$extensions_arr) ){
                      
            // Upload file
          if(move_uploaded_file($_FILES['file']['tmp_name'],$dirname.''.$name) ){
                // Insert record
                $query = "insert into images(UserID,imgName, path) values('".$user_ID."', '".$name."','".$folderName."' )";
             
                mysqli_query($con,$query) or die(mysqli_error($con));
    
                echo "Image uploaded successfully";
  
            }
          else{
              echo "Failed to upload image";
          }
          
      }
  
    }
  
  }
  else{
    header("location: index.php"); 
  }

  

?>

<!DOCTYPE html>
<html lang="en">
  <title>Bootstrap Example</title>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .border
    {
      border-right: 2px solid black;
    }
  </style>
</head>
<body>
<?php require_once 'header.php' ; ?>

  <section>
    
    <div class="container">
    <form name="form" method="post" action="" enctype='multipart/form-data' >
      <div class="row">
        <div class="col-sm-4 border">
            <br><br>
            <h3>Folders Details</h3><hr>
            <button type="submit" id="Create-Folders" class="btn btn-primary">Create Folders</button>
            <br><br><hr>
  
            <ul style="list-style-type: none; cursor: pointer;" id="folders-display">
            
            </ul>            

        </div>

        <div class="col-8 border" >
          <br><br>
          <h3 id="View-con">Select Folder</h3>
          <hr>

          <div class="row" id ="btns" style="display:none" >
              <form>
              <div class="col-4">
                  <button type="submit" name= "img-upload" class="btn btn-primary">Upload Image</button>
                  <input type="file" name="file" />
                  <input type="hidden" name="fName" id="fName" value="">
              </div>  
              </form>
          </div>
          <hr><br>

          <div class="row" id="img-result" >
            
          </div>  
        </div>
      </div>
  </form>
    </div>
  </section>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
        $.ajax({
        url: 'getfolder.php',
              type: 'POST',
              processData: false,
              contentType: false,
              success: function(data)
              {
                data = JSON.parse(data);
                var list = "";
                for(i=0; i<data.length; i++)
                {
                  list +="<li data-fname='"+data[i]+"'>"+data[i]+"</li>";
                }
                $("#folders-display").html(list);

              }
        })
      //------------------ create folder -------------------

      $("#Create-Folders").click(function(e){
        e.preventDefault();
        $.ajax({
              url: 'createfolder.php',
              type: 'POST',
              processData: false,
              contentType: false,
              success: function(data){
                data = JSON.parse(data);
                var list = "";
                list +="<li data-fname='"+data+"'>"+data+"</li>";
                $("#folders-display").append(list);
              },
              error: function(){
                  console.log("The request failed");
              }

        })
      })

      //------------------ display folder ------------------------------
      
      $("#folders-display").on('click','li',function (){
        $("#btns").show();

        var folderName = $(this).data("fname");        
        // var folderName = $(this).text();
        $("#View-con").text(folderName);
        $("#fName").val(folderName);

          let formData = new FormData();
          formData.append('uid', <?php echo $user_ID; ?>);
          formData.append('folderName', folderName);

          $.ajax({
              url: 'getimage.php',
              type: 'POST',
              processData: false,
              contentType: false,
              data:formData,
              success: function(data){
                data = JSON.parse(data);
                if(data != "")
                {
                  var list = "";
                  for(i=0; i<data.length; i++)
                  {
                    list +=`<div class="col-4">
                      <img width="100%"  src="${data[i]}" />
                      <button class="btn btn-danger del-img alert-danger"  data-img="${data[i]}" class="btn-primary">Delete</button>

                     </div>
                    `;
                    
                  }
                  $("#img-result").empty().append(list);

                }else{
                  $("#img-result").text("No Image Found");
                }

              }
        })


       })


    })
      //----------------delete image -------------------------------

      $(document).on("click",".del-img",function(e){
        var imgname = $(this).data("img");        

        let val = new FormData();
          val.append('iname', imgname);
         
         $.ajax({
            url :'deleteimage.php',
            type:'POST',
            processData: false,
            contentType: false,
            data: val,
            success: function(data){
                 alert(data);
            }

         }) 
      })
     

  </script>

</body>

</html>
