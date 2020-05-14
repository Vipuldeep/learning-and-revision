<?php 
	
	$errors = "";
	$db = mysqli_connect("localhost", "root", "", "todolist");
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$query = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $query);
			header('location: index.php');
		}
	}	
	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];
		mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
		header('location: index.php');
	}
	$tasks = mysqli_query($db, "SELECT * FROM tasks");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./learningsass/css/main.css">
    <title>The Journey</title>
</head>
<body>
    <div id="bg"></div>
    <header>
        <a href="index.php">
            <p class="home-title">
                <span>The <strong>Journey</strong></span>
            </p>
        </a>
    </header>

    <main>
        <section id="card">
        <form method="post" action="index.php" class="input_form">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<input type="text" name="task" class="task_input" placeholder="Enter task">
		<button type="submit" name="submit" id="add_btn" class="add_btn"></button>
	</form>


	<table>
		<thead>
			<tr>
				<th></th>
				<th>Tasks</th>
				<th style="width: 60px;">Action</th>
			</tr>
		</thead>

		<tbody>
			<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td class="task"> <?php echo $row['task']; ?> </td>
					<td class="delete"> 
						<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
					</td>
				</tr>
			<?php $i++; } ?>	
		</tbody>
	</table>
        </section>
        <section>
            <h1 id="primaryheading">To Do list</h1>
        </section>
    </main>

</body>
</html>