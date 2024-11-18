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
                    <input type="file" name="cv" class="form-control d-none" id="cv" >
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
