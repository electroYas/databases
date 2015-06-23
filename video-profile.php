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
<table cellpadding="2" cellspacing="2" style="width:70%;">
<?php
function safeSQL($value)
{
    // Stripslashes
    if(get_magic_quotes_gpc()) 
    {
        $value = stripslashes($value);
    }
 
    // Quote
    $value = mysql_real_escape_string($value);
 
    return($value);
} 

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
	
	

$id = safeSQL($_GET['id']);
echo "ID:".$id."<br>";
$query = 'SELECT title,intro,year,type_id,lang_id FROM video_tb WHERE id="'.$id.'"';
	
$result = mysql_query($query,$db) or die(mysql_error($db));

 

while ($row=mysql_fetch_assoc($result)){
    extract($row);
    $type=get_type($type_id);
	  	
    $lang=get_lang($lang_id);
    
    echo '<tr>';
    echo "<th>Title:</th>";
    echo '<td>' . $title . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th valign="top">Introduction:</th>';
    echo '<td>' . $intro . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo "<th>Year:</th>";
    echo '<td>' . $year . '</td>';
    echo '</tr>';
    
    echo '<tr>';
    echo "<th>Type:</th>";
    echo '<td>' . $type . '</td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<th valign="top">Genre:</th>';
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
    echo '</tr>';
    
    echo '<tr>';
    echo "<th>Language:</th>";
    echo '<td>' . $lang . '</td>';
    echo '</tr>';
        
	  	
}
mysql_close($db);
?>

</table>
</body>
</html>
 
