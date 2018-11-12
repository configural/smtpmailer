
<form action="actions/deleterecepient.php" method="post">
    
    <p>Удалить электронный ящик: <br><input name="email" type="email" value="" required></p>
    
    <button>Да, удалить</button>
</form>

<p> 
    <a href="?view=recipients&id=<?=$id;?>"><< К списку группы</a>
</p>