<?php
include('config.php');
date_default_timezone_set("Asia/Calcutta");
session_start();
if(!isset($_SESSION['username'])){
    header('Location:./');
}else{
$username=$_SESSION['username'];
$date=date('d/m/Y h:i:s A');
if(isset($_POST['message']) && isset($_POST['send'])){
    $message=$_POST['message'];
    $sql="INSERT INTO messages(sender,message,sent_at) VALUES('$username','$message','$date')";
    $result=mysqli_query($conn,$sql);
    if($result){
    header('Location: something.php');
    }else{
        
    }
}

if(isset($_POST['upload'])){
    $target_dir = __DIR__."/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $message='<img src="./images/'.basename($_FILES["image"]["name"]).'" class="boximg">';
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  uploaded
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        
        $sql="INSERT INTO messages(sender,message,sent_at) VALUES('$username','$message','$date')";
        if(mysqli_query($conn,$sql)){
            header('Location:./something.php');
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  something went wrong
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        }
    }else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  fail to upload try again
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    
}

$temp_username=$_SESSION['username'];
$sql="SELECT * FROM users WHERE username !='$temp_username'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    $chat_with=$row['name'];
    $image_url=$row['image_url'];
    $status=$row['status'];
}
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name="robots" content="noindex, nofollow">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        main {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        main>.container1 {
            max-width: 800px;
            min-width: 350px;
            border: 1px solid black;
            background-color: whitesmoke;
            height: 90vh;
        }

        main>.container1>.header {
            width: 100%;
            height: 60px;
            border-bottom: 1px solid black;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: start;
            padding-left: 20px;
        }

        main>.container1>.header>.dp {
            display: flex;
            flex-direction: row;
            align-items: center;

        }

        main>.container1>.header>.dp>.dp-details {
            height: 50px;
            width: 200px;
            display: flex;
            align-items: start;
            justify-content: center;
            flex-direction: column;
            padding-left: 10px;
        }

        main>.container1>.header>.dp>.dp-details span {
            padding: 7px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main>.container1>.header>.dp>img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        main>.container1>.messages {
            width: 100%;
            height: 70vh;
            display:flex;
            flex-direction:column;
            overflow-y: scroll;
            padding: 5px;
        }
        .starter-msg{
            width:100%;
            position:relative;
            top:50%;
            bottom:50%;
            text-align:center;
        }
        main>.container1>.messages section {
            min-width: 60%;
            height: auto;
            padding: 5px;
            border: 1px solid black;
            margin: 5px;
            display:flex;
            flex-direction:column;
        }
        main>.container1>.messages section span{
            text-transform:capitalize;
            display:flex;
            align-items:center;
            justify-content:space-between;

        }

        main>.container1>.messages section p {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .left {
            align-self: flex-start;
        }

        .right {
            align-self: flex-end;
        }

        .footer {
            width: 100%;
            height: 90px;
            border-top: 1px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3px;
            z-index: 2;
        }

        .footer>.footer-components,
        form {
            width: 100%;
            height: 60px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
        }

        .footer>.footer-components label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            font-size: 25px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            cursor: pointer;
        }

        .footer>.footer-components input {
            width: 68%;
            height: 35px;
            font-size: 15px;
            padding-left: 10px;
            overflow-y: scroll;
            outline: none;
            border: none;
        }

        .footer>.footer-components #image {
            display: none;
        }

        .footer>.footer-components button {
            padding: 5px;
            height: 35px;
            cursor: pointer;
            transition: 1s;
        }

        .footer>.footer-components button:hover {
            background-color: rgb(101, 91, 91);
            color: white;
        }

        .date {
            font-size: 10px;
            float: right;
        }

        .overlay {
            max-width: 800px;
            min-width: 350px;
            min-height: 30vh;
            position: absolute;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            left: 0;
            bottom: 20vh;
            transition: 0.4s ease;
        }

        .emojis {
            display: none;
        }

        .images {
            display: none;
        }

        main .footer .images #img {
            width: 350px;
            height: auto;
            margin: auto;
            background-size: cover;
            background-repeat: no-repeat;
            border: 3px solid green;
        }

        .emojis {
            width: 350px;
            display: none;
            flex-wrap: wrap;
            justify-content: center;
            background-color: whitesmoke;
            border: 4px solid black;
        }

        .emojis .emoji {
            font-size: 24px;
            margin: 5px;
            cursor: pointer;
        }
        .fa-remove{
            font-size:25px;
            margin:10px;
            cursor: pointer;
        }
        .boximg{
            width:250px;
            height:auto;
            padding:5px;
            border:5px solid black;

        }
        #image{
            display:none;
        }
        .fa-image{
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            cursor: pointer;
            margin:10px;

        }
        input[type='file']{
            display:none;
        }
        .fa{
            cursor:pointer;
        }
        .status{
            font-size:10px;

        }
        .modal-body{
            width:290px;
            height:auto;
        }
    </style>
    <title>ChatBox</title>
</head>

<body>
    <main>
        <div class='container1'>
            <div class='header'>
                <div class='dp'>
                    <img src='<?php echo $image_url;?>' alt='dp'>
                    <div class='dp-details'>
                    <?php
                     echo"<span> <strong>$chat_with</strong></span>
                        <span class='status'>$status</span>";
                    ?>
                    </div>
                </div>
                <a href='./logout.php' style='float:left;'>Logout</a>
            </div>
            <div class='messages' id='message-box'>
            <?php
                $sql="SELECT * FROM messages ORDER BY id ASC";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                        $date=$row['sent_at'];
                        $message=$row['message'];
                        $sender=$row['sender'];
                        if($sender!=$_SESSION['username']){
                            $name=$sender;
                            $direction="left";
                        }if($sender==$_SESSION['username']){
                            $name="You";
                            $direction="right";
                        }
                        echo"<section class='$direction'>
                    <span><strong>$name</strong><span class='date'>$date</span></span>
                    <p>$message</p>
                </section>";
                    }
                }else{
                    echo'<p class="starter-msg">no message</p>';
                }
            ?>
            </div>

            <div class='footer'>
                <div class='emojis overlay'>
                    <i class='fa fa-remove'></i>
                    <div class='emoji' onclick='insertEmoji("🎉")'>🎉</div>
                    <div class='emoji' onclick='insertEmoji("😀")'>😀</div>
                    <div class='emoji' onclick='insertEmoji("🌟")'>🌟</div>
                    <div class='emoji' onclick='insertEmoji("❤️")'>❤️</div>
                    <div class='emoji' onclick='insertEmoji("👍")'>👍</div>
                    <div class='emoji' onclick='insertEmoji("😊")'>😊</div>
                    <div class='emoji' onclick='insertEmoji("😄")'>😄</div>
                    <div class='emoji' onclick='insertEmoji("😃")'>😃</div>
                    <div class='emoji' onclick='insertEmoji("😆")'>😆</div>
                    <div class='emoji' onclick='insertEmoji("😍")'>😍</div>
                    <div class='emoji' onclick='insertEmoji("🥳")'>🥳</div>
                    <div class='emoji' onclick='insertEmoji("🤩")'>🤩</div>
                    <div class='emoji' onclick='insertEmoji("🤗")'>🤗</div>
                    <div class='emoji' onclick='insertEmoji("🙌")'>🙌</div>
                    <div class='emoji' onclick='insertEmoji("🎈")'>🎈</div>
                    <div class='emoji' onclick='insertEmoji("🎊")'>🎊</div>
                    <div class='emoji' onclick='insertEmoji("🔥")'>🔥</div>
                    <div class='emoji' onclick='insertEmoji("✨")'>✨</div>
                    <div class='emoji' onclick='insertEmoji("💖")'>💖</div>
                    <div class='emoji' onclick='insertEmoji("💯")'>💯</div>
                    <div class='emoji' onclick='insertEmoji("🙏")'>🙏</div>
                    <div class='emoji' onclick='insertEmoji("👏")'>👏</div>
                    <div class='emoji' onclick='insertEmoji("🌺")'>🌺</div>
                    <div class='emoji' onclick='insertEmoji("🌞")'>🌞</div>
                    <div class='emoji' onclick='insertEmoji("🌈")'>🌈</div>
                    <div class='emoji' onclick='insertEmoji("🍕")'>🍕</div>
                    <div class='emoji' onclick='insertEmoji("🍦")'>🍦</div>
                    <div class='emoji' onclick='insertEmoji("🍓")'>🍓</div>
                    <div class='emoji' onclick='insertEmoji("🎵")'>🎵</div>
                    <div class='emoji' onclick='insertEmoji("🎮")'>🎮</div>
                    <div class='emoji' onclick='insertEmoji("⭐")'>⭐</div>
                </div>
                <div class='footer-components'>
                    <form action='./something.php' method='POST'>
                        <label class='fa fa-smile-o' id='emoji'></label>
                        <i class='fa fa-image' data-toggle='modal' data-target='#exampleModal'></i>
                        <input type='text' id='message' name='message' placeholder='How are you?' required>
                        <button class='btn btn-info' type='submit' name='send'>Send</button>
                    </form>
                </div>
            </div>
        </div>
        

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload and Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action='./something.php' method='POST' enctype='multipart/form-data'>
                        <label class='fa fa-upload' for='img1'></label>
                        <input type='file' name='image' id='img1' required hidden>
                        
        <button class='btn btn-info' type='submit' name='upload'>Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>
    </main>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    label = document.querySelectorAll('label');
    label.forEach(label => {
        label.addEventListener('click', () => {
            if (label.id == 'emoji') {
                document.querySelector('.emojis').style.display = 'flex';
            }
            if (label.id == 'images') {
                document.querySelector('.emojis').style.display = 'none';
            }

        })
    });

    function insertEmoji(emoji) {
        var inputField = document.getElementById('message');
        inputField.value += emoji;
    }
    remove=document.querySelector('.fa-remove');
        remove.addEventListener('click',()=>{
            document.querySelector('.emojis').style.display = 'none';
        })


var message = document.querySelector('.messages');
message.scrollTop = message.scrollHeight - message.clientHeight;

var fileInput = document.getElementById('img1');

// Add event listener for the 'change' event
fileInput.addEventListener('change', function(event) {
  // Get the selected file
  var file = event.target.files[0];

  // Check if a file is selected
  if (file) {
    // Create a FileReader object
    var reader = new FileReader();

    // Set up the FileReader onload event
    reader.onload = function() {
      // Create an image element
      var imgElement = document.createElement('img');

      // Set the image source to the FileReader result (base64 encoded image)
      imgElement.src = reader.result;

      // Add the image element to the modal body or any other container
      var modalBody = document.querySelector('.modal-body');
      modalBody.appendChild(imgElement);
    };

    // Read the selected file as Data URL
    reader.readAsDataURL(file);
  }
});

window.addEventListener('load', function() {
  var input = document.getElementById('message');
  input.focus();
});


</script>

</html>