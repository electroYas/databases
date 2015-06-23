<?php
$db=mysql_connect('localhost','yas','test1234') or die('Unable to connect.');
	
mysql_select_db('video_db',$db) or die(mysql_error($db));

if($_POST['video-submit'] == "Submit") 
{
  
 
   if(safeSQL($_POST['title']) == ''){
    header("Location: add-video.php");
    exit;
   }
   
    $title = $_POST['title'];
   $intro = $_POST['intro'];
   $year = $_POST['year'];
   $type_id = $_POST['type_id'];
   $lang_id = $_POST['lang_id'];
   
   //get next video id
   
   $query='SHOW TABLE STATUS WHERE Name= "video_tb"';
   $result = mysql_query($query,$db);
   $data = mysql_fetch_assoc($result);
   $next_increment = $data['Auto_increment'];
   
   //add to video_genre_tb table
   foreach($_POST['genre_list'] as $selected) {
    $query = 'INSERT INTO video_genre_tb (video_id,genre_id) VALUES
    ('.
    $next_increment.','.
    prepSQL($selected).')';
    mysql_query($query,$db) or die(mysql_error($db));   
   }
   
   //add to video_tb table
   $query = 'INSERT INTO video_tb (title,intro,year,type_id,lang_id) VALUES 
    ('. 
    prepSQL($title). ','.
    prepSQL($intro). ','.
    prepSQL($year). ','.
    prepSQL($type_id). ','.
    prepSQL($lang_id). ')';

    mysql_query($query,$db) or die(mysql_error($db));    
    mysql_close($db);
    header('Location: add-video.php');
    exit;
    
}

if($_POST['type-submit'] == "Submit") 
{
   $type = $_POST['type'];


   if(safeSQL($type) == ''){
    header("Location: add-video.php");
    exit;
   }
 
   
   $query = 'INSERT INTO type_tb (type) VALUES 
    ('. 
    prepSQL($type). ')';

    mysql_query($query,$db) or die(mysql_error($db));
     mysql_close($db);
    header("Location: add-video.php");
    exit;
    
}

if($_POST['genre-submit'] == "Submit") 
{
   $genre = $_POST['genre'];
   if(safeSQL($genre) == ''){
    header("Location: add-video.php");
    exit;
   }
   
   $query = 'INSERT INTO genre_tb (genre) VALUES 
    ('. 
    prepSQL($genre). ')';

    mysql_query($query,$db) or die(mysql_error($db));   
    mysql_close($db);
    header("Location: add-video.php");
    exit;
    
}

if($_POST['lang-submit'] == "Submit") 
{
   $lang = $_POST['lang'];
   if(safeSQL($lang) == ''){
    header("Location: add-video.php");
    exit;
   }
   
   $query = 'INSERT INTO lang_tb (lang) VALUES 
    ('. 
    prepSQL($lang). ')';

    mysql_query($query,$db) or die(mysql_error($db));   
    mysql_close($db);
    header("Location: add-video.php");
    exit;
    
}

function prepSQL($value)
{
    // Stripslashes
    if(get_magic_quotes_gpc()) 
    {
        $value = stripslashes($value);
    }
 
    // Quote
    $value = "'" . mysql_real_escape_string($value) . "'";
 
    return($value);
} 

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

//***********Useful Functions*******//

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
	
//**************SEARCH**************//
if($_POST['search-submit'] == "Submit") 
{
    
    $type_id_t = safeSQL($_POST['type_id']);
    $lang_id_t = safeSQL($_POST['lang_id']);
    $genre_id_t = safeSQL($_POST['genre_id']);

    if($type_id_t == '0'){
        $type_id_t='%';
    }else{
        echo 'type:'.get_type($type_id_t);
        echo '<br>';
    }
                
    if($lang_id_t == '0'){
        $lang_id_t='%';
    }else{
        echo 'lang:'.get_lang($lang_id_t);
        echo '<br>';
    }
    
    if($genre_id_t == '0'){
        $genre_id_t='%';
    }else{
        echo 'genre:'.get_genre($genre_id_t);
        echo '<br>';
    }
    
   
   
    echo '<h2>Search Results</h2>';
    echo '<table  border="1" cellpadding="2" cellspacing="2" 
	  style="width:70%;margin-left:auto;margin-right:auto;">';

    echo '<tr>';
	   
    echo '   <th>Title</th>';
    echo '   <th>Year</th>';
    echo '   <th>Type</th>';
    echo '   <th>Genre</th>';
    echo '   <th>Language</th>';
    echo '  </tr>';
    
    $query = 'SELECT DISTINCT video_id FROM video_genre_tb WHERE genre_id LIKE "'.$genre_id_t.'"';
    $genre_result=mysql_query($query,$db) or die(mysql_error($db));
    
    while ($row=mysql_fetch_assoc($genre_result)){
                
                
                $query3 = 'SELECT id,title,year,type_id,lang_id FROM video_tb 
                     WHERE id="'.$row['video_id'].'" AND lang_id LIKE "'.$lang_id_t.'" AND type_id LIKE "'.$type_id_t.'"';
	  	
   		$result3=mysql_query($query3,$db) or die(mysql_error($db));
   		
   		while ($row3=mysql_fetch_assoc($result3)){
   			extract($row3);
	  		$type=get_type($type_id);
	  	
	  		$lang=get_lang($lang_id);
	  		echo '<tr>';
	
	  		echo '<td>' . $title . '</td>';
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
	}
    echo '</table>';
    mysql_close($db);
    echo '<a href="index.php">Back</a>';
    
}


?>
