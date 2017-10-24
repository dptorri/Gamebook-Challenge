<?php include_once 'db.php';
$query = "
SELECT 
`chapter`.`id` AS `chapter_id`,
`chapter`.`text` AS `chapter_text`,
`choice`.`text` AS `chapter_options`,
`choice`.`goto_id` AS `next_chapter_id`
FROM `chapter`
RIGHT JOIN
`choice`
    ON `chapter`.`id`=`choice`.`chapter_id`
WHERE
    `chapter`.`id`= '3'
";
$statement = db::query($query);
$data = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gamebook</title>
    <style>
    body {
        background:url(background-adventure.jpg);
        //background: linear-gradient(brown, white);
        display:flex;
        flex-direction:column;
    }
.book {
    background:url(notes.png);
    background-repeat: no-repeat; 
}
.header{
    flex-direction:column;
//    background-color:yellow;
}
.story{
    flex-direction:column;
  //  background-color:blue;
}
.options{
    flex-direction:column;
}
.next{
    flex-direction:column;
    
}
    </style>
</head>
<body>
<a href="https://fontmeme.com/uncharted-font/"><img src="https://fontmeme.com/permalink/171021/72eee9a680ba143057a68d8c3405bc2a.png" alt="uncharted-font" border="0"></a>
<ul>Exercise
<li>create multi-choice game.</li>
</ul>
<div class="book">
<?php 
//Call to the first element of the $data array (they repeat in the query anyways!)
           echo '<div class="header">Chapter '.$data[0]['chapter_id'].'</div>';
           echo '<div class="story">'.$data[0]['chapter_text'].'</div>';
//we display the options as they can be 1,2,3..etc ?>
            <form>
            <?php 
           foreach ($data as $innerArray => $value){
            echo '<button id="'.$value['next_chapter_id'].'"class="options">'.$value['chapter_options'].
            '</button><br>';
           }?></form>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  /*  $( ".options" ).click(function() {
        var text = $(this).text()
        alert(text);
  $( this ).slideUp();
});*/
//runs as soon as the document is ready
$("document").ready(function(){
//bind the click event on the button with a function
$('.options').bind('click', getInfoFromServer);
});
//AJAX function
    function getInfoFromServer(){
        $.ajax({
            type: "GET",
            url: "textFromServer.txt",
            success: postToPage});
    }   
    
</script>
</html>