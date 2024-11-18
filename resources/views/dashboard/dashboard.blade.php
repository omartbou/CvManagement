<style>
    /* Sidebar styling */
    .table-container {
        overflow-x: auto;
    }
    .sidebar {
        min-height: 100vh;
        width: 250px;
        background-color: #f8f9fa;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 11;
        padding-top: 80px; /* Adjust to make room for navbar */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        transition: all 0.3s ease;
        padding-left: 10px;

    }

    .toggle-navbar {
        position: absolute;
        top: 10px;
        left: 215px;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 20;

    }
    /* Sidebar closed */
    .sidebar-closed {
        width: 0;
        padding-top: 0;
        overflow: hidden;
    }

    /* Navbar styling */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 12;
    }

    /* Content */
    .content {
        margin-left: 257px;
        transition: margin-left 0.3s ease;
        padding: 20px;
    }

    .content-closed {
        margin-left: 0;
    }

    .btn-filter {
        background-color: #232F68 !important;
        color: white !important;

    }
    .btn-clear{
        color:#232F68 !important;
        border: 1px solid #232F68 !important;
    }
    /* Styling for logo */
    .navbar-brand img {
        max-height: 40px; /* Adjust the height of the logo */
        object-fit: contain;
    }

    .drop-zone {
        border: 2px dashed #ccc;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        color: #ccc;
    }

    .drop-zone.dragover {
        border-color: #000;
        color: #000;
    }
    .bootstrap-select .dropdown-menu {
        max-height: 300px !important;
        overflow-y: auto !important;
    }
    .page-item {
        margin-right: 5px;
    }

    .page-item.active .page-link {
        color: white !important;
        background-color: #232F68 !important;
        border-color: #232F68 !important;
    }

    .page-link {
        color: #232F68 !important;
    }

    .page-link:hover {
        background-color: #232F68 !important;
        color: white !important;
    }

    .page-item .next-button {
        border: 2px solid #232F68; /* Border for the Next button */
        border-radius: 5px; /* Optional: adds rounded corners */
    }

    .page-item .page-link {
        cursor: pointer;
    }
    .nav-link.active {
        color: #232F68 !important;
        background-color: #97bdf5 !important;
        border-radius: 5px;
    }
    .table-active {
        color: #232F68 !important;
    }
</style>

@extends('layout.app')


@section('content')

    <x-sidebar></x-sidebar>
    @include('components.navbar')
    <!-- Main Content -->
    <div class="content" id="content">
        <!-- Buttons and Filters -->
        <div class="d-flex justify-content-between align-items-center border-bottom mb-4 pb-2" style="width: 100%;">
            <div class="d-flex align-items-center">
                <h5 class="me-5" style="color:#232F68 !important;">Task</h5>
                <a class="nav-link me-4 text-secondary" href="#" id="list-link">
                    <i class="bi bi-list-task"></i> List
                </a>
                <a class="nav-link table-active " href="#" id="table-link">
                    <i class="bi bi-table" ></i> Table
                </a>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-clear me-2">
                    <i class="bi bi-x"></i> Clear
                </button>
                <button class="btn btn-filter me-3">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <div class="border-end me-3" style="height: 40px;"></div>
                <button class="btn btn-danger border-left" data-bs-toggle="modal" data-bs-target="#createCvModal">
                    <i class="bi bi-plus"></i> Ajouter un CV
                </button>
            </div>
        </div>
        <div class="filter-row" style="display: none;">
            <div class="row">
                <!-- Métier Select Field -->
                <div class="col-md-2 mb-3">
                    <select name="metier" id="metier" class="form-control" data-live-search="true">
                        <option disabled selected>Métier</option>
                        @foreach($jobs as $job)
                            <option value="{{ $job->name }}">{{ $job->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Email Input Field -->
                <div class="col-md-2 mb-3">
                    <input type="text" id="filter-email" class="form-control" placeholder="Email">
                </div>
            </div>

        </div>
        <div id="success-message"></div>

        <!-- Data Table -->
        <div class="table-container">
            @include('components.table_cv')
        </div>
        <div class="d-flex justify-content-end">

            {{ $cvs->links('vendor.pagination.default') }}

        </div>

    <!-- Modal for Adding CV -->
    <div class="modal fade" id="createCvModal" tabindex="-1" aria-labelledby="createCvModalLabel" aria-hidden="true">
        @include('components.create_cv')
    </div>
    <script>
       $(document).ready(function() {
            $('select').selectpicker();
        });
        $(document).ready(function () {
            var table = $('#example').DataTable({
                dom: '<"top"i>rt<"bottom"p>',
                paging: false,
                info: false,
                searching: true,
                lengthChange: false,
            });
            $('.btn-filter').on('click', function () {
                $('.filter-row').toggle();
            });


            $('#metier').on('changed.bs.select', function () {
                table.column(3).search($(this).val()).draw();
            });

            // Filter for "Email" column (index 4)
            $('#filter-email').on('input', function () {
                table.column(4).search($(this).val()).draw();
            });

            // Clear all filters
            $('.btn-clear').on('click', function () {
                $('#metier').selectpicker('val', '');
                $('#filter-email').val('');
                table.search('').columns().search('').draw();
            });
        });
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleSidebarButton = document.getElementById('toggleSidebarButton');

        toggleSidebarButton?.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-closed');
            content.classList.toggle('content-closed');
        });

       const dropZone = document.getElementById('drop-zone');
       const fileInput = document.getElementById('cv');

       // Trigger file input click when drop-zone is clicked
       dropZone.addEventListener('click', () => fileInput.click());

       // Show drag-over effect
       dropZone.addEventListener('dragover', (e) => {
           e.preventDefault();
           dropZone.classList.add('dragover');
       });

       // Remove drag-over effect
       dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));

       // Handle file drop
       dropZone.addEventListener('drop', (e) => {
           e.preventDefault();
           dropZone.classList.remove('dragover');

           const files = e.dataTransfer.files;
           fileInput.files = files;  // Assign the dropped files to the file input

           // Update drop-zone text to show the name of the uploaded file
           if (files.length > 0) {
               dropZone.innerHTML = `<i class="bi bi-file-earmark-arrow-up"></i><p>${files[0].name}</p>`;
           }
       });

       // Update file name when file is selected from file input
       fileInput.addEventListener('change', () => {
           const file = fileInput.files[0];
           if (file) {
               dropZone.innerHTML = `<i class="bi bi-file-earmark-arrow-up"></i><p>${file.name}</p>`;
           }
       });
       $('#createCvModal').on('hidden.bs.modal', function () {
           // Manually remove any existing modal backdrop
           $('.modal-backdrop').remove();
           // Reset any modal body content or other changes if needed
           $(this).find('.modal-body').html('');
       });

       const observer = new MutationObserver((mutations) => {
           mutations.forEach((mutation) => {
               if (mutation.type === 'childList') {
                   if (!$('#createCvModal').hasClass('show')) {
                       $('.modal-backdrop').remove();
                   }
               }
           });
       });

       observer.observe(document.body, {
           childList: true,
           subtree: true
       });

       $(document).ready(function() {
           $('#cvForm').on('submit', function(event) {
               event.preventDefault(); // Prevent the default form submission

               // Clear previous error messages
               $('#cv-error').html('');
               $('#ville-error').html('');
               $('#metier-error').html('');
               $('#email-error').html('');
               $('#langue-error').html('');

               // Send the form data using AJAX
               $.ajax({
                   url: $(this).attr('action'),
                   method: 'POST',
                   data: new FormData(this),
                   processData: false,
                   contentType: false,
                   success: function(response) {
                       if (response.success) {
                           // Show success message in the index (in the success-message div or elsewhere)
                           $('#success-message').html('<div class="alert alert-success">' + response.message + '</div>');
                       }
                       $('#createCvModal').modal('hide');

                       // Optionally reset the form
                       $('#cvForm')[0].reset();
                   },
                   error: function(xhr) {
                       // Show error messages for each field
                       var errors = xhr.responseJSON.errors;
                       if(errors.cv) {
                           $('#cv-error').html('<div class="text-danger">' + errors.cv[0] + '</div>');
                       }
                       if(errors.ville) {
                           $('#ville-error').html('<div class="text-danger">' + errors.ville[0] + '</div>');
                       }
                       if(errors.metier) {
                           $('#metier-error').html('<div class="text-danger">' + errors.metier[0] + '</div>');
                       }
                       if(errors.email) {
                           $('#email-error').html('<div class="text-danger">' + errors.email[0] + '</div>');
                       }
                       if(errors.langue) {
                           $('#langue-error').html('<div class="text-danger">' + errors.langue[0] + '</div>');
                       }
                   }
               });
           });
       });

    </script>
@endsection
