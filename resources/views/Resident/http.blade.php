@extends('layouts.app')

@section('content')
<div class="container p-3">
  <h1>By Laravel Http Driver</h1>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createResidentModal">
    Create Resident
  </button>

  <div class="modal fade" id="createResidentModal" tabindex="-1" aria-labelledby="createResidentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createResidentModalLabel">Create Resident</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="createResidentForm" method="POST" action="{{ route('resident.post') }}">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <textarea rows="2" class="form-control" id="address" name="address" required></textarea>
            </div>
            <div class="form-group">
              <label for="identity_number">Identity Number</label>
              <input type="text" class="form-control" id="identity_number" name="identity_number" required
                maxlength="16">
            </div>
            <!-- Gender and Birthdate will be auto-detected from Identity Number -->
            <div class="form-group">
              <label for="gender">Gender</label>
              <input type="text" class="form-control" id="gender" name="gender" readonly>
            </div>
            <div class="form-group">
              <label for="birthdate">Birthdate</label>
              <input type="text" class="form-control" id="birthdate" name="birthdate" readonly type="date">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <form action="{{ route('residents.http') }}" method="GET" class="mt-3 mb-3">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search by Name, Email, or Identity Number"
        aria-label="Search" name="filter" value="{{ request('filter') }}">
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>
          <a href="{{ route('residents.http', ['sort_by' => 'name', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'name' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
            class="d-flex align-items-center gap-1 text-decoration-none text-reset">
            <span> Name </span>
            @if(request('sort_by') == 'name')
            @if(request('sort_dir') == 'asc')
            <i class="bi bi-caret-up-fill small"></i>
            @else
            <i class="bi bi-caret-down-fill small"></i>
            @endif
            @else
            <span class="d-flex flex-column">
              <i class="bi bi-caret-up-fill small" style="margin-bottom:-6px;margin-top:-4px;"></i>
              <i class="bi bi-caret-down-fill small" style="margin-top:-6px;margin-bottom:-6px;"></i>
            </span>
            @endif
          </a>
        </th>
        <th><a
            href="{{ route('residents.http', ['sort_by' => 'email', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'email' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
            class="d-flex align-items-center gap-1 text-decoration-none text-reset">
            <span> Email </span>
            @if(request('sort_by') == 'email')
            @if(request('sort_dir') == 'asc')
            <i class="bi bi-caret-up-fill small"></i>
            @else
            <i class="bi bi-caret-down-fill small"></i>
            @endif
            @else
            <span class="d-flex flex-column">
              <i class="bi bi-caret-up-fill small" style="margin-bottom:-6px;margin-top:-4px;"></i>
              <i class="bi bi-caret-down-fill small" style="margin-top:-6px;margin-bottom:-6px;"></i>
            </span>
            @endif
          </a>
        </th>
        <th><a
            href="{{ route('residents.http', ['sort_by' => 'address', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'address' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
            class="d-flex align-items-center gap-1 text-decoration-none text-reset">
            <span> Address </span>
            @if(request('sort_by') == 'address')
            @if(request('sort_dir') == 'asc')
            <i class="bi bi-caret-up-fill small"></i>
            @else
            <i class="bi bi-caret-down-fill small"></i>
            @endif
            @else
            <span class="d-flex flex-column">
              <i class="bi bi-caret-up-fill small" style="margin-bottom:-6px;margin-top:-4px;"></i>
              <i class="bi bi-caret-down-fill small" style="margin-top:-6px;margin-bottom:-6px;"></i>
            </span>
            @endif
          </a>
        </th>
        <th><a
            href="{{ route('residents.http', ['sort_by' => 'identity_number', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'identity_number' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
            class="d-flex align-items-center gap-1 text-decoration-none text-reset">
            <span> Identity Number </span>
            @if(request('sort_by') == 'identity_number')
            @if(request('sort_dir') == 'asc')
            <i class="bi bi-caret-up-fill small"></i>
            @else
            <i class="bi bi-caret-down-fill small"></i>
            @endif
            @else
            <span class="d-flex flex-column">
              <i class="bi bi-caret-up-fill small" style="margin-bottom:-6px;margin-top:-4px;"></i>
              <i class="bi bi-caret-down-fill small" style="margin-top:-6px;margin-bottom:-6px;"></i>
            </span>
            @endif
          </a>
        </th>
        <th>Gender</th>
        <th>Birthdate</th>
      </tr>
    </thead>
    <tbody>
      @foreach($residents as $resident)
      <tr>
        <td>{{ ($residents->currentPage() - 1) * $residents->perPage() + ($loop->iteration) }}</td>
        <td>{{ $resident->name }}</td>
        <td>{{ $resident->email }}</td>
        <td>{{ $resident->address }}</td>
        <td>{{ $resident->identity_number }}</td>
        <td>{{ $resident->gender }}</td>
        <td>{{ $resident->birthdate }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  @if ($residents->lastPage() > 1)
  <nav aria-label="table pagination">
    <ul class="pagination">
      @if ($residents->currentPage() === 1)
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      @else
      <li class="page-item">
        <a class="page-link" href="{{ routeWithQuery('residents.http', ['page' => $residents->currentPage() - 1]) }}">Previous</a>
      </li>
      @endif
      @for ($i = 1; $i <= $residents->lastPage(); $i++)
        @if ($i === $residents->currentPage())
        <li class="page-item active">
          <a class="page-link" href="{{ routeWithQuery('residents.http', ['page' => $i]) }}">{{$i}}</a>
        </li>
        @else
        <li class="page-item">
          <a class="page-link" href="{{ routeWithQuery('residents.http', ['page' => $i]) }}">{{$i}}</a>
        </li>
        @endif
        @endfor
        @if ($residents->currentPage() === $residents->lastPage())
        <li class="page-item disabled">
          <a class="page-link">Next</a>
        </li>
        @else
        <li class="page-item">
          <a class="page-link" href="{{ routeWithQuery('residents.http', ['page' => $residents->currentPage() + 1]) }}">Next</a>
        </li>
        @endif
    </ul>
  </nav>
  @endif

</div>
@endsection

@section('scripts')
<script>
  document.getElementById('identity_number').addEventListener('input', function() {
      const residentId = this.value;
      if (residentId.length === 16) {
          var shortBirthdate = residentId.substr(6, 6);
          var day = shortBirthdate.substr(0, 2);
          var month = shortBirthdate.substr(2, 2);
          var year = shortBirthdate.substr(4, 2);
          var currentYear = new Date().getFullYear();
          var actualYear = +`20${year}` - currentYear > 0  ? `19${year}` : `20${year}`;
          var actualDay = ((day < 40) ? +day : +day - 40)?.toString()?.padStart(2, '0');
          var birthdate = actualYear + '-' + month + '-' + actualDay;
          var gender = (day < 40) ? 'Male' : 'Female';
          document.getElementById('gender').value = gender;
          document.getElementById('birthdate').value = birthdate;
      } else {
          document.getElementById('gender').value = '';
          document.getElementById('birthdate').value = '';
      }
  });
</script>
@endsection