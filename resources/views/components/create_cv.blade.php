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
                    <input type="file" name="cv" class="form-control d-none" id="cv">
                    <div class="d-flex justify-content-between">
                        <small class="form-text text-muted">Formats supported: PDF, Doc, Docx.</small>
                        <small class="form-text text-muted">Max file size: 20MB.</small>
                    </div>
                    <div id="cv-error"></div>
                </div>
                <div class="mb-3">
                    <label for="ville" class="form-label">Choisir une ville <span class="text-danger">*</span></label>
                    <select name="ville" id="ville" class="form-control" data-live-search="true">
                        <option disabled selected>Ville</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div id="ville-error"></div>
                </div>
                <div class="mb-3">
                    <label for="metier" class="form-label">Choisir un métier <span class="text-danger">*</span></label>
                    <select name="metier" id="metier" class="form-control" data-live-search="true">
                        <option disabled selected>Métier</option>
                    @foreach($jobs as $job)
                            <option value="{{$job->id}}">{{$job->name}}</option>
                        @endforeach
                    </select>
                    <div id="metier-error"></div>
                </div>
                <div class="mb-3">
                    <label for="contact_name" class="form-label">Le nom du contact <span class="text-danger">*</span></label>
                    <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Le nom du contact">
                    <div id="contact_name-error"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="exemple@exemple.com">
                    <div id="email-error"></div>
                </div>
                <div class="mb-3">
                    <label for="langue" class="form-label">Langue de contact <span class="text-danger">*</span> </label>
                    <select name="langue" id="langue" class="form-control" data-live-search="true">
                        <option disabled selected>Langue</option>
                    @foreach($languages as $language)
                            <option value="{{$language->id}}">{{$language->name}}</option>
                        @endforeach
                    </select>
                    <div id="langue-error"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-add_cv text-light">Ajouter le CV</button>
            </div>
        </form>
    </div>
</div>
