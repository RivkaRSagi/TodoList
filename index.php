<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>MyKia</title>

    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="index.css">

</head>
<body>

    <div class="header">
        <h2 class="headerTitle"> To do List</h2>
        <?php
            if(!empty($_SESSION["uname"])){
            echo "<h3 style='padding-right: 25px;'> Welcome, ". $_SESSION["uname"]."</h3>";
            }else {
                echo "<h3 style='padding-right: 25px;'> Welcome, User</h3>";
            }
        ?>
        <!-- <h3 style="padding-right: 6px;"> Welcome, User!!</h3> -->
    </div>



    <h1>My To-Do List</h1>

        <!-- Input and Buttons to add new tasks -->
        <input type="text" id="newTask" placeholder="Add a new task">
        <!-- Date input for the deadline -->
        <input type="date" id="taskDeadline">
        <!-- Dropdown for priority level -->
        <select id="taskPriority">
            <option value="">Select Priority</option>
            <option value="1">1 (Highest)</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>


            <option value="10">10 (Lowest)</option>
        </select>
        <button onclick="addTask()">Add Task</button>
        <button onclick="sortTasksDescending()">Sort by Priority (High to Low)</button>
        <button onclick="sortTasksAscending()">Sort by Priority (Low to High)</button>

        <!-- Unordered list for the tasks -->
        <ul id="taskList">
            <!-- List items will be added here -->
        </ul>

        <script>
            // JavaScript function to add a new task
            function addTask() {
                var task = document.getElementById("newTask").value;
                var deadline = document.getElementById("taskDeadline").value;
                var priority = document.getElementById("taskPriority").value;

                if (task.trim() === '') {
                    alert('Please enter a task');
                    return;
                }

                var li = document.createElement("li");
                li.textContent = task;

                // Add deadline if set
                if (deadline) {
                    var deadlineText = document.createElement("span");
                    deadlineText.textContent = ` (Deadline: ${deadline})`;
                    li.appendChild(deadlineText);
                }

                // Add priority if set
                if (priority) {
                    var priorityText = document.createElement("span");
                    priorityText.textContent = ` (Priority: ${priority})`;
                    priorityText.style.marginLeft = "10px";
                    li.appendChild(priorityText);
                }

                li.setAttribute('data-priority', priority || "0"); // Set data attribute for priority

                // Create a delete button and append it to each task
                var deleteBtn = document.createElement("button");
                deleteBtn.textContent = "Remove";
                deleteBtn.style.marginLeft = "10px";
                deleteBtn.onclick = function() {
                    li.remove();
                };
                li.appendChild(deleteBtn);

                document.getElementById("taskList").appendChild(li);

                // Clear the input fields after adding a task
                document.getElementById("newTask").value = '';
                document.getElementById("taskDeadline").value = '';
                document.getElementById("taskPriority").value = '';
            }

            // Function to sort tasks by priority descending
            function sortTasksDescending() {
                sortTasks(true);
            }

            // Function to sort tasks by priority ascending
            function sortTasksAscending() {
                sortTasks(false);
            }

            // General function for sorting tasks
            function sortTasks(descending = true) {
                var list, i, switching, b, shouldSwitch;
                list = document.getElementById("taskList");
                switching = true;
                while (switching) {
                    switching = false;
                    b = list.getElementsByTagName("LI");
                    for (i = 0; i < (b.length - 1); i++) {
                        shouldSwitch = false;
                        if ((descending && parseInt(b[i].getAttribute('data-priority')) < parseInt(b[i + 1].getAttribute('data-priority'))) ||
                            (!descending && parseInt(b[i].getAttribute('data-priority')) > parseInt(b[i + 1].getAttribute('data-priority')))) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {
                        b[i].parentNode.insertBefore(b[i + 1], b[i]);
                        switching = true;
                    }
                }
            }
        </script>


</body>
</html>