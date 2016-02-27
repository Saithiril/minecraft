<div class="text">
<table width=100% align="center">
<tbody>
<tr><td width=80%>

<?php	
//	echo '<div class="text">';
	echo '<table width=80% align="center">';
	echo '<tbody>';
		echo '<tr><td align="right">Имя персонажа:</td><td>'.ucfirst($name).'</td></tr>';
		if($mail=='your@email.com'){
      		echo '<tr><td align="right">Электронная почта:</td><td><a href=".?pg=setmail">Указать</a></td></tr>';
      	}
    	else{
      		echo '<tr><td align="right">Электронная почта:</td><td>'.$mail.'</td></tr>';
      
      		/*if($row['mailver']==0){
      			echo '<tr><td align="right">Почтовый ящик не подтверждён:</td><td><a href=".?pg=mailver">Выслать код</a></td></tr>';	
      		}
      		else{
      			echo '<tr><td align="right">Введите код подтверждения:</td>';
      			echo '<td><form action="./?pg=mailvergo" method="post" id="text">';
      			echo '<input name="code" value="" type="text" />';
      			echo '<input value="Войти" type="submit" /></td></tr>';
     	}*/
     	}
    
    
	//	echo '<tr><td align="right">Пароль:</td><td><a href=.?pg=pass-req>Выслать на почту</a></td></tr>';
		echo '<tr><td align="right">Сейчас:</td><td>';
      if($isLogged==1){
          echo 'В сети';
        }
        else{
          echo 'Не в сети';
        }
        echo '</td></tr>';
    echo '<tr><td align="right">Последний раз заходил:</td><td>'.$lastlogin.' (GMT+3)</td></tr>';
    echo '<tr><td align="right">Персонаж в измерении:</td><td>'.ucfirst($world).'</td></tr>';
    
		echo '<tr><td align="right">Статус:</td><td>';
		
		
			echo $parent.'  ';
	
		
	//	if($rowg['parent']!="player" and $rowg['parent']!=null and $rowg['parent']!="owner"){
	//		echo ' до '.$row['end'];}
	echo '</td></tr></tbody></table>';

	
	echo '</td><td align="center">';

// Скины отключены
	echo '<img src="http://178.162.70.179:8000/tiles/faces/body/'.ucfirst($name).'.png" width=128 height=128>';
//	echo '<img src="http://skinsystem.ely.by/textures/'.$row['name'].'?version=2&minecraft_version=1.7.2" width=128 height=128>';
?>

<!-- Для возбращения скина добавить между </td> и </td> </tr><tr> -->
</td><td></td><td align="center">

<?php
	echo $balance.'  '.$currency;
?>
</td></tr>
</tbody></table></div>
<?php /*
	echo '<frameset>
		  <frame src="178.162.70.179:8000?worldname='.$row['world'].'&mapname=flat&zoom=6&x='.$row['x'].'&y='.$row['y'].'&z='.$row['z'].'" name="map" scrolling="no" noresize>
		  </frameset>';
//	 '<img src="178.162.70.179:8000?worldname='.$row['world'].'&mapname=flat&zoom=6&x='.$row['x'].'&y='.$row['y'].'&z='.$row['z'].'">';
*/

//echo '<div>';
//include '178.162.70.179:8000/index.html?worldname='.$world.'&mapname=flat&zoom=6&x='.$x.'&y='.$y.'&z='.$z;
//echo '</div>';

?>

