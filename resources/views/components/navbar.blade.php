@extends('layout.app')

<nav class="navbar border-bottom">
    <div class="container-fluid">
        <div class="navbar-brand bg-body-tertiary">
            <a href="#">
                <!-- Ensure the path to the logo image is correct -->
                <img src="images/logo.png" alt="Groupe MCE Logo" />
            </a>
        </div>
        <div style="margin-right:67%">
            <button class="btn btn-light" id="toggleSidebarButton">
                <i class="bi bi-code"></i> <!-- Hamburger icon to toggle sidebar -->
            </button>
        </div>
        <div class="d-flex justify-content-end">
            <a href="#" class="d-flex align-items-center text-decoration-none text-dark me-4">
                <i class="bi bi-question-circle me-1"></i> Help Center
            </a>
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="path/to/profile-image.jpg" alt="Profile" class="rounded-circle me-2" width="30" height="30">
                    Brian F.
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

