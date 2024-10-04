<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/courses.css') }}">
    <title>SmartBudget</title>
</head>
<body>
    
<div class="container">
    <div class="sidebar">
        <h1>ADMIN PORTAL</h1>
        <ul class="menu-sidebar">
            <!-- Users Management -->
            <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <span class="label">Users Management</span>
                </a>
            </li>

            <!-- Course Management -->
            <li class="{{ Route::is('admin.courses.index') ? 'active' : '' }}">
                <a href="{{ route('admin.courses.index') }}">
                    <span class="label">Course Management</span>
                </a>
            </li>

            <!-- Category Management -->
            <li class="{{ Route::is('admin.category.index') ? 'active' : '' }}">
                <a href="{{ route('admin.category.index') }}">
                    <span class="label">Category Management</span>
                </a>
            </li>
            
            <!-- Client Environment -->
            <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="client-env">
                    <span class="label">Test Client Environment</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="logout-form">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket" alt="Logout Icon"></i>
                        LOG OUT
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content">
            <h1>ADMIN COURSES INDEX PAGE</h1>

            <!-- Add Course Button -->
            <div class="add-btn">
                <button id="openModalBtn">Add Course</button>
            </div>

            <!-- Table for displaying courses -->
            <table class="custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th colspan="100">Operations</th>
        </tr>
    </thead>
    <tbody>
        @if($courses)
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->course }}</td>
                    <td>
                        <button class="edit-btn" data-id="{{ $course->id }}"><i class="fa-solid fa-pen-to-square"></i></button>
                    </td>
                    <td>
                        <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button"><i class="fa-solid fa-delete-left"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


<!-- Modal for Adding Course -->
<div id="courseModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add a New Course</h2>
        <div id="addCourseFormContainer"></div>
    </div>
</div>

<!-- Modal for Editing Course -->
<div id="editCourseModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Course</h2>
        <div id="editCourseFormContainer"></div>
    </div>
</div>

<!-- JavaScript to Handle AJAX and Modal Visibility -->
<script>
// Get the modal elements
var courseModal = document.getElementById("courseModal");
var editCourseModal = document.getElementById("editCourseModal");

// Get the button that opens the course modal
var btn = document.getElementById("openModalBtn");

// Get the close (X) buttons for both modals
var closeButtons = document.getElementsByClassName("close");

// When the user clicks the button, open the modal 
btn.onclick = function() {
    // Fetch the add form via AJAX
    fetch('/SmartBudget/admin/courses/create')
        .then(response => response.text())
        .then(html => {
            document.getElementById('addCourseFormContainer').innerHTML = html;
            courseModal.style.display = "block"; // Show the modal
        })
        .catch(error => console.error('Error fetching the add form:', error));
}

// Function to close modals
function closeModal(modal) {
    modal.style.display = "none";
}

// Close modals when the close button (X) is clicked
Array.from(closeButtons).forEach(function(button) {
    button.onclick = function() {
        closeModal(button.closest('.modal'));
    };
});

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == courseModal) {
        closeModal(courseModal);
    } else if (event.target == editCourseModal) {
        closeModal(editCourseModal);
    }
}

    // Open the edit modal and fetch the edit form via AJAX
    document.querySelectorAll('.edit-btn').forEach(function(button) {
        button.onclick = function(event) {
            event.preventDefault(); // Prevent the default action
            var courseId = this.getAttribute('data-id'); // Get the course ID

            // Fetch the edit form via AJAX
            fetch(`/SmartBudget/admin/courses/edit/${courseId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Return the HTML of the form
                })
                .then(html => {
                    // Populate the modal with the HTML response
                    document.getElementById('editCourseFormContainer').innerHTML = html;
                    document.getElementById('editCourseModal').style.display = "block"; // Show the modal
                })
                .catch(error => console.error('Error fetching the edit form:', error));
        };
    });

</script>

</body>
</html>