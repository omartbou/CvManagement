<table id="example" class="table table-bordered">
    <thead class="table-light">
    <tr>
        <th class="text-secondary">CV</th>
        <th class="text-secondary">Due Date</th>
        <th class="text-secondary">Ville</th>
        <th class="text-secondary">Métier</th>
        <th class="text-secondary">Email</th>
        <th class="text-secondary">Ajouté par</th>
        <th class="text-secondary">Langue</th>
        <th class="text-secondary">Contact</th>
        <th class="text-secondary">Action</th>
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
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <i  class="bi bi-info-circle"></i>
                </div>
            </td>
            <td  class="text-center"><i class="bi bi-trash"></i></td>
        </tr>
    @endforeach
    </tbody>
</table>
