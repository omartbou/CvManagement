<style>
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
        padding-top: 80px;
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

    .sidebar-closed {
        width: 0;
        padding-top: 0;
        overflow: hidden;
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 12;
    }

    .sidebar .nav-link i {
        margin-right: 8px;
        font-weight: 700 !important;
        color: #232F68;
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #232F68;
    }

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

    .btn-clear {
        color: #232F68 !important;
        border: 1px solid #232F68 !important;
    }

    .navbar-brand img {
        max-height: 40px;
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
        border: 2px solid #232F68;
        border-radius: 5px;
    }

    .page-item .page-link {
        cursor: pointer;
    }

    .nav-link.active {
        color: #232F68 !important;
        background-color: #E6E9FA !important;
        border-radius: 5px;
        padding-right: 100px;
    }

    .table-active {
        color: #232F68 !important;
        font-weight: 500 !important;
        padding: 0px 20px 30px 20px !important;
        border-bottom: solid !important;
    }

    .table-active i {
        margin-right: 5px;
    }

    #list-link i {
        margin-right: 5px;
    }

    .bi {
        font-weight: bold !important;
    }

    .badge-metier {
        background-color: #FFEBED;
        padding: 6px;
        border-radius: 15px;
        font-size: 12px;
    }

    .btn-add_cv {
        background-color: #232F68 !important;
        width: 80%;
    }

    .form-check-input:checked {
        background-color: #0dd73c !important;
        border-color: #0dd73c !important;
    }
</style>

@extends('layout.app')
@section('title','dashboard')

@section('content')
    <x-sidebar></x-sidebar>
    @include('components.navbar')

    <div class="content" id="content">
        <div class="d-flex justify-content-between align-items-center border-bottom mb-4 pb-0" style="width: 100%;">
            <div class="d-flex align-items-top">
                <h4 class="me-5" style="color: #232F68 !important;">Task</h4>
                <a class="nav-link me-4 text-secondary" href="#" id="list-link">
                    <i class="bi bi-list"></i> List
                </a>
                <a class="nav-link table-active pb-4.5" href="#" id="table-link">
                    <i class="bi bi-table"></i> Table
                </a>
            </div>
            <div class="d-flex align-items-center pb-3">
                <button class="btn btn-clear me-2">
                    <i class="bi bi-x fs-5"></i> Clear
                </button>
                <button class="btn btn-filter me-3">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <div class="border-end me-3" style="height: 40px;"></div>
                <button class="btn btn-danger border-left" data-bs-toggle="modal" data-bs-target="#createCvModal">
                    <i class="bi bi-plus fs-5"></i> Ajouter un CV
                </button>
            </div>
        </div>

        <div class="filter-row" style="display: none;">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <select name="metier" id="metier" class="form-control" data-live-search="true">
                        <option disabled selected>Métier</option>
                        @foreach($jobs as $job)
                            <option value="{{ $job->name }}">{{ $job->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <input type="text" id="filter-email" class="form-control" placeholder="Email">
                </div>
            </div>
        </div>

        <div id="success-message"></div>

        <div class="table-container">
            @include('components.table_cv')
        </div>

        <div class="d-flex justify-content-end">
            {{ $cvs->links('vendor.pagination.default') }}
        </div>

        <div class="modal fade" id="createCvModal" tabindex="-1" aria-labelledby="createCvModalLabel" aria-hidden="true" >
            @include('components.create_cv')
        </div>

        <script>

            $(document).ready(function () {
                const toggleSidebarButton = $('#toggleSidebarButton');
                const sidebar = $('.sidebar');
                const content = $('.content');

                // Handle sidebar toggle
                toggleSidebarButton.on('click', function () {
                    sidebar.toggleClass('sidebar-closed');
                    content.toggleClass('content-closed');
                });


                $('select').selectpicker();
                var table = $('#example').DataTable({
                    dom: '<"top"i>rt<"bottom"p>',
                    paging: false,
                    info: false,
                    searching: true,
                    lengthChange: false,
                    columnDefs: [{ "targets": [7, 8], "orderable": false }],
                });

                $('.btn-filter').on('click', function () {
                    $('.filter-row').toggle();
                });

                $('#metier').on('changed.bs.select', function () {
                    table.column(3).search($(this).val()).draw();
                });

                $('#filter-email').on('input', function () {
                    table.column(4).search($(this).val()).draw();
                });

                $('.btn-clear').on('click', function () {
                    $('#metier').selectpicker('val', '');
                    $('#filter-email').val('');
                    table.search('').columns().search('').draw();
                });

                const dropZone = $('#drop-zone');
                const fileInput = $('#cv');
                dropZone.on('click', () => fileInput.click());

                dropZone.on('dragover', (e) => {
                    e.preventDefault();
                    dropZone.addClass('dragover');
                });

                dropZone.on('dragleave', () => dropZone.removeClass('dragover'));

                dropZone.on('drop', (e) => {
                    e.preventDefault();
                    dropZone.removeClass('dragover');
                    const files = e.dataTransfer.files;
                    fileInput[0].files = files;
                    if (files.length > 0) {
                        dropZone.html(`<i class="bi bi-file-earmark-arrow-up"></i><p>${files[0].name}</p>`);
                    }
                });

                fileInput.on('change', () => {
                    const file = fileInput[0].files[0];
                    if (file) {
                        dropZone.html(`<i class="bi bi-file-earmark-arrow-up"></i><p>${file.name}</p>`);
                    }
                });

                $('#createCvModal').on('hidden.bs.modal', function () {
                    $('.modal-backdrop').remove();
                    $(this).find('.modal-body').html('');
                });

                $('#cvForm').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('#success-message').html('<div class="alert alert-success">' + response.message + '</div>');
                            $('#createCvModal').modal('hide');
                            $('#cvForm')[0].reset();
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000)
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(key => {
                                $(`#${key}-error`).html(`<div class="text-danger">${errors[key][0]}</div>`);
                            });
                        }
                    });
                });

            });
        </script>
@endsection
