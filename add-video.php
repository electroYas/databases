<html>

<head>
	<title>Raspberry Web Server</title>
</head>

<body>

<?php
$db=mysql_connect('localhost','yas','test1234') or die('Unable to connect.');
	
mysql_select_db('video_db',$db) or die(mysql_error($db));
	
?>
<h2>Add Video Information</h2>
<form action="add-video-action.php" method="post">
<table>
<tr>
    <td>Title:</td><td><input type="text" name="title"></td>
</tr>
<tr>
    <td>Introduction:</td><td><input type="text" name="intro"></td>
</tr>
<tr>
    <td>Year:</td><td><input type="text" name="year"></td>
</tr>
<tr>
    <td>Type:</td><td>
    <select name="type_id">

<?php
$query = 'SELECT type_id,type FROM type_tb';
$result=mysql_query($query,$db) or die(mysql_error($db));      

while ($row = mysql_fetch_assoc($result)){
    echo '<option value="'. $row['type_id'] .'">'.$row['type'].'</option><br>';
}
?>

    </select></td>
</tr>
<tr>
<td>Genre:</td><td>

<?php
$query = 'SELECT genre_id,genre FROM genre_tb';
$result=mysql_query($query,$db) or die(mysql_error($db));      

while ($row = mysql_fetch_assoc($result)){
    echo '<input type="checkbox" name="genre_list[]" value="'. $row['genre_id'] .'">'.$row['genre'].'<br>';
}
?>
</td>

</tr>
<tr>
<td>Language:</td><td>
<select name="lang_id">
<?php
$query = 'SELECT lang_id,lang FROM lang_tb';
$result=mysql_query($query,$db) or die(mysql_error($db));      

while ($row = mysql_fetch_assoc($result)){
    echo '<option value="'. $row['lang_id'] .'">'.$row['lang'].'</option><br>';
}
?>
</select></td>
</tr>
<tr><td></td><td>
<input type="submit" name="video-submit" value="Submit">
</td>
</tr>
</table>
</form> 
<br>

<hr>

<h2>Add Type</h2>
<form action="add-video-action.php" method="post">
Type:<br>
<input type="text" name="type">
<input type="submit" name="type-submit" value="Submit">
</form>
(eg:drama,movie...)
<br>

<h2>Add Genre</h2>
<form action="add-video-action.php" method="post">
Genre:<br>
<input type="text" name="genre">
<input type="submit" name="genre-submit" value="Submit">
</form>

<h2>Add Language</h2>
<form action="add-video-action.php" method="post">
Genre:<br>
<input type="text" name="lang">
<input type="submit" name="lang-submit" value="Submit">
</form>


</body>
</html>
