<?php
function main(array $args) : array
{
  echo "Create, insert, update, delete data in a MySQL instance\n";
  $pdo = new PDO(sprintf('mysql:host=%s;port=%d;dbname=%s', $args['MYSQL_HOSTNAME'], 3306, $args['MYSQL_DATABASE']), $args['MYSQL_USERNAME'], $args['MYSQL_PASSWORD']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $name = $args['name'];
  $color = $args['color'];
  $cats = array();

  echo "Create the database\n";
  $pdo->exec('CREATE TABLE IF NOT EXISTS `cats` (`id` INT AUTO_INCREMENT PRIMARY KEY, `name` VARCHAR(256) NOT NULL, `color` VARCHAR(256) NOT NULL)');

  echo "Insert into it\n";
  $stmt = $pdo->prepare('INSERT INTO `cats` (`name`, `color`) VALUES(:name, :color)');
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':color', $color, PDO::PARAM_STR);
  $stmt->execute();

  echo "Read from it\n";
	$stmt = $pdo->query('SELECT * FROM `cats`');
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cats[] = array('id' => $row['id'], 'name' => $row['name'], 'color' => $row['color']);
  }

  echo "Update it\n";
  $id = $cats[0]['id'];
  $name = 'Tahoma';
  $color = 'Tabby';
  $stmt = $pdo->prepare('UPDATE `cats` SET `name` = :name, `color` = :color WHERE `id` = :id');
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':color', $color, PDO::PARAM_STR);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  echo "Delete from it\n";
  $pdo->query('DELETE FROM `cats`');

  return ["success" => true];
}
