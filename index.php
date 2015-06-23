<?php
    $db=mysql_connect('localhost','yas','test1234') or
    die('Unable to connect.');

    mysql_select_db('video_db',$db) or die(mysql_error($db));
?>
<html>

<head>
	<title>Raspberry Web Server</title>
</head>

<body>

	<H1>Raspberry Pi Web Server</H1>
	<h3><a href="add-video.php">Add Content</a></h3>
	<h3>Search</h3>
	<form action="add-video-action.php"  method="post">
	<table cellpadding="2" cellspacing="2" 
	  style="margin-left:5%;margin-right:auto;">
	<tr>
            <th>Language</th><th>Genre</th><th>Type</th>
	</tr>
	<tr>
            <td>
            <select name="lang_id">
            <option value="0"> --- </option><br>
<?php
$query = 'SELECT lang_id,lang FROM lang_tb';
$result=mysql_query($query,$db) or die(mysql_error($db));      

while ($row = mysql_fetch_assoc($result)){
    echo '<option value="'. $row['lang_id'] .'">'.$row['lang'].'</option><br>';
}
?>
            </select>

            </td>
            <td>
            <select name="genre_id">
            <option value="0"> --- </option><br>
<?php
$query = 'SELECT genre_id,genre FROM genre_tb';
$result=mysql_query($query,$db) or die(mysql_error($db));      

while ($row = mysql_fetch_assoc($result)){
    echo '<option value="'. $row['genre_id'] .'">'.$row['genre'].'</option><br>';
}
?>
            </select>
            </td>
            <td>
            <select name="type_id">
            <option value="0"> --- </option><br>
<?php
$query = 'SELECT type_id,type FROM type_tb';
$result=mysql_query($query,$db) or die(mysql_error($db));      

while ($row = mysql_fetch_assoc($result)){
    echo '<option value="'. $row['type_id'] .'">'.$row['type'].'</option><br>';
}
?>
            </select>

            </td>
            
        </tr>
        
        <tr>
            <td></td> <td></td><td><input type="submit" name="search-submit" value="Submit"></td>
        </tr>
        </table>
        
        </form>
        
        
	<?php
	function get_type($type_id_t){
	
		global $db;
		
		$query='SELECT 
		type 
		FROM 
		type_tb 
		WHERE 
		type_id = ' . $type_id_t;
		
		$result=mysql_query($query,$db) or die(mysql_error($db));
		$row=mysql_fetch_assoc($result);
		extract($row);
		return $type; 

	}
	
	
	
	function get_genre($genre_id_t){
	
		global $db;
		
		$query='SELECT 
		genre 
		FROM 
		genre_tb 
		WHERE 
		genre_id = ' . $genre_id_t;
		
		$result=mysql_query($query,$db) or die(mysql_error($db));
		$row=mysql_fetch_assoc($result);
		extract($row);
		return $genre; 
	}
	
	function get_lang($lang_id_t){
	
		global $db;
		
		$query='SELECT 
		lang 
		FROM 
		lang_tb 
		WHERE 
		lang_id = ' . $lang_id_t;
		
		$result=mysql_query($query,$db) or die(mysql_error($db));
		$row=mysql_fetch_assoc($result);
		extract($row);
		return $lang; 

	}
	

	
	$query = 'SELECT id,title,year,type_id,lang_id FROM video_tb ORDER BY title';
	
	$result = mysql_query($query,$db) or die(mysql_error($db));
	
	$num_rows=mysql_num_rows($result);
	?>
	<div style="test-align:center;">
	
	  <h2>Video Information Database</h2>
	  
	  <table border="1" cellpadding="2" cellspacing="2" 
	  style="width:70%;margin-left:auto;margin-right:auto;">
	  <tr>
	   
	   <th>Title</th>
	   <th>Year</th>
	   <th>Type</th>
	   <th>Genre</th>
	   <th>Language</th>
	  </tr>
	  <?php
	  while ($row=mysql_fetch_assoc($result)){
	  	extract($row);
	  	$type=get_type($type_id);
	  	
	  	$lang=get_lang($lang_id);
	  	echo '<tr>';
	
	  	echo '<td><a href="video-profile.php?id='.$id.'">' . $title . '</a></td>';
	  	echo '<td>' . $year . '</td>';
	  	echo '<td>' . $type . '</td>';
	  	echo '<td>';
	  	$query2 = 'SELECT genre_id FROM video_genre_tb WHERE video_id="'.$id.'"';
	  	$result2 = mysql_query($query2,$db) or die(mysql_error($db));
	  	while($row2=mysql_fetch_assoc($result2)){
                    extract($row2);
                    $genre=get_genre($genre_id);
                    echo $genre;
                    echo '<br>';
	  	}
	  	echo '</td>';
	  	echo '<td>' . $lang . '</td>';
	  	echo '</tr>';
        
	  	
	  }
	  mysql_close($db);
	  ?>
	  
	 
	  </table>
	  </div>
	
	




</body>
</html>
