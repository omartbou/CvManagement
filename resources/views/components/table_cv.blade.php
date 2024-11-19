<table id="example" class="table table-bordered">
    <thead class="table-light">
    <tr>
        <th class="text-secondary border-end-0">CV</th>
        <th class="text-secondary border-0">Due Date</th>
        <th class="text-secondary border-0">Ville</th>
        <th class="text-secondary border-0">Métier</th>
        <th class="text-secondary border-0">Email</th>
        <th class="text-secondary border-0">Ajouté par</th>
        <th class="text-secondary border-0">Langue</th>
        <th class="text-secondary border-0">Contact</th>
        <th class="text-secondary border-start-0">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cvs as $cv)
        <tr >
            <td class="text-center">
                <a href="{{ asset('storage/' . $cv->FilePath) }}" download>
                    {{$cv->contact_name}}</a>
            </td>
            <td class="text-center">
                {{ $cv->due_date->format('d M Y') }}
            </td>
            <td class="text-center">
                {{$cv->city->name}}
            </td>
            <td class="text-center d-flex justify-content-center text-danger">
                <span class="badge-metier">{{$cv->job->name}}</span>
            </td>
            <td >
                <i class="bi bi-envelope"></i> {{$cv->email}}
            </td>
            <td class="text-center">
                {{$cv->user->name}}
            </td>
            <td class="text-center">
                {{$cv->language->code}}
            </td>
            <td class="text-center d-flex justify-content-center">
                <div class="form-check form-switch me-2" style="transform: scale(1.5);">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>
                <i class="bi bi-info-circle fs-5"></i>
            </td>
            <td class="text-center">
                <form action="{{ route('cv.destroy', $cv->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this CV?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn p-0">
                        <i class="bi bi-trash fs-5"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
