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

</style>

@extends('layout.app')


@section('content')

    <x-sidebar></x-sidebar>
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <div class="content" id="content">
        <!-- Buttons and Filters -->
        <div class="d-flex justify-content-between align-items-center border-bottom mb-4 pb-2" style="width: 100%;">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 me-3">Task</h4>
                <a class="nav-link me-2" href="#">
                    <i class="bi bi-list-task"></i> List
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-table"></i> Table
                </a>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-clear me-2">
                    <i class="bi bi-x"></i> Clear
                </button>
                <button class="btn btn-filter me-2">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createCvModal">
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
        <!-- Data Table -->
        <div class="table-container">
            <table id="example" class="table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>CV</th>
                    <th>Due Date</th>
                    <th>Ville</th>
                    <th>Métier</th>
                    <th>Email</th>
                    <th>Ajouté par</th>
                    <th>Langue</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cvs as $cv)
                    <tr>
                        <td><a href="#">{{$cv->user->name}}</a></td>
                        <td>{{ now()->format('d M Y') }}</td>
                        <td>{{$cv->city->name}}</td>
                        <td  class="text-center"><span class="badge-metier">{{$cv->job->name}}</span></td>
                        <td   ><i class="bi bi-envelope"></i> {{$cv->user->email}}</td>
                        <td  class="text-center">{{$cv->user->name}}</td>
                        <td  class="text-center">{{$cv->language->code}}</td>
                        <td  class="text-center">
                            <div class="toggle-switch">
                                <input type="checkbox" checked>
                                <i  class="bi bi-info-circle"></i>
                            </div>
                        </td>
                        <td  class="text-center"><i class="bi bi-trash"></i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <!-- Modal for Adding CV -->
    <div class="modal fade" id="createCvModal" tabindex="-1" aria-labelledby="createCvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="cvForm" action="{{ route('cv.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCvModalLabel">Ajouter un CV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cv" class="form-label">Uploader le CV <span class="text-danger">*</span></label>
                            <div class="drop-zone" id="drop-zone">
                                <i class="bi bi-file-earmark-arrow-up"></i>
                                <p>Drag files here or Browse</p>
                            </div>
                            <input type="file" name="cv" class="form-control d-none" id="cv" required>
                            <div class="d-flex justify-content-between">
                                <small class="form-text text-muted">Formats supported: PDF, Doc, Docx.</small>
                                <small class="form-text text-muted">Max file size: 20MB.</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <select name="ville" id="ville" class="form-control" data-live-search="true">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="metier" class="form-label">Métier <span class="text-danger">*</span></label>
                            <select name="metier" id="metier" class="form-control" data-live-search="true">
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}">{{$job->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="exemple@exemple.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="langue" class="form-label">Langue</label>
                            <select name="langue" id="langue" class="form-control" data-live-search="true">
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ajouter le CV</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
       $(document).ready(function() {
            $('select').selectpicker();
        });
        $(document).ready(function () {
            var table = $('#example').DataTable({
                dom: '<"top"i>rt<"bottom"p>',
                paging: true,
                info: false,
                searching: true,
                lengthChange: false
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
        dropZone.addEventListener('click', () => fileInput.click());
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const files = e.dataTransfer.files;
            fileInput.files = files;
            dropZone.textContent = files[0].name;
        });


    </script>
@endsection
