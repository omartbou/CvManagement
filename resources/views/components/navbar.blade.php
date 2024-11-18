@extends('layout.app')

<nav class="navbar border-bottom">
    <div class="container-fluid">
        <div class="navbar-brand bg-body-tertiary">
            <a href="#">
                <img src="images/logo.png" alt="Groupe MCE Logo" />
            </a>

        </div>
        <div class="toggle-navbar">
            <button class="btn btn-light" id="toggleSidebarButton">
                <i class="bi bi-code"></i>
            </button>
        </div>
        <div class="d-flex justify-content-end">
            <a href="#" class="d-flex align-items-center text-decoration-none text-dark me-4">
                <i class="bi bi-question-circle me-1"></i> Help Center
            </a>
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle me-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/person.webp')}}" alt="Profile" class="rounded-circle me-2" width="30" height="30">
                    {{$user->name}}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

