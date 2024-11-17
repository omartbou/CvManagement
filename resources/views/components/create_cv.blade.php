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
                        <input type="file" name="cv" class="form-control" id="cv" required>
                        <small class="form-text text-muted">Formats acceptés : PDF, Doc, Docx. Taille max : 20MB.</small>
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville</label>
                        <select name="ville" id="ville" class="form-control">
                            <option>Casablanca</option>
                            <option>Rabat</option>
                            <option>El Jadida</option>
                            <!-- Add more options -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="metier" class="form-label">Métier <span class="text-danger">*</span></label>
                        <select name="metier" id="metier" class="form-control" required>
                            <option>UI/UX Designer</option>
                            <option>Full Stack Developer</option>
                            <option>Marketing Digital</option>
                            <!-- Add more options -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="exemple@exemple.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="langue" class="form-label">Langue</label>
                        <select name="langue" id="langue" class="form-control">
                            <option>Français</option>
                            <option>Anglais</option>
                            <option>Arabe</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter le CV</button>
                </div>
            </form>
        </div>
    </div>
</div>
