@extends('layouts.app')

@section('content')
<div class="container p-3">
  <h1>By Jquery Ajax</h1>

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

  <form action="{{ route('residents.ajax') }}" method="GET" class="mt-3 mb-3">
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
          <a href="{{ route('residents.ajax', ['sort_by' => 'name', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'name' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
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
            href="{{ route('residents.ajax', ['sort_by' => 'email', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'email' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
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
            href="{{ route('residents.ajax', ['sort_by' => 'address', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'address' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
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
            href="{{ route('residents.ajax', ['sort_by' => 'identity_number', 'sort_dir' => request('sort_dir', 'asc') == 'asc' && request('sort_by', 'name') == 'identity_number' ? 'desc' : 'asc', 'filter' => request('filter')]) }}"
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
    <tbody id="residentTableBody">
    </tbody>
  </table>

  <nav aria-label="table pagination" id="residentPagination" class="d-none">
    <ul class="pagination" id="residentTablePagination">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="{{ paginateUrl(1) }}">Previous</a>
      </li>
      <li class="page-item active">
        <a class="page-link" href="{{ paginateUrl(1) }}">{{1}}</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="{{ paginateUrl(1) }}">{{1}}</a>
      </li>

      <li class="page-item disabled">
        <a class="page-link">Next</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="{{ paginateUrl(1) }}">Next</a>
      </li>
    </ul>
  </nav>

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

  function setDataTable(data, page, limit) {
    var tableBody = $('#residentTableBody');
    tableBody.html('');
    
    $.each(data, function(index, resident) {
      var tableRow = `<tr>
                        <td><span>${((page - 1) * limit) + (index + 1)}</td>
                        <td><span>${resident.name}</td>
                        <td><span>${resident.email}</td>
                        <td><span>${resident.address}</td>
                        <td><span>${resident.identity_number}</td>
                        <td><span>${resident.gender}</td>
                        <td><span>${resident.birthdate}</td>
                      </tr>`;
      tableBody.append(tableRow);
    });
  }

  function setPagination(meta) {
    var pagination = $('#residentPagination');
    var paginationBody = $('#residentTablePagination');
    pagination.addClass('d-none');
    paginationBody.html('');

    if (meta?.last_page > 1) {
      pagination.removeClass('d-none');
      $.each(meta?.links || [], function(index, item) {
        if (!item.url) {
          var paginationItem = `<li class="page-item disabled">
                                  <a class="page-link">${item?.label}</a>
                                </li>`;
          paginationBody.append(paginationItem);
        } else {
          var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
          var pageParams = new URLSearchParams(window.location.search);
          var paginationParams = new URLSearchParams(item.url?.split('?')?.[1] || '');
          pageParams.set('page', paginationParams.get('page') || 1)

          var paginationItem = `<li class="page-item ${item?.active ? "active" : ''}">
            <a class="page-link" href="${url + "?" + pageParams.toString()}">${item?.label}</a>
            </li>`;
            paginationBody.append(paginationItem);
          }
      });
    }
  }

  function fetchResidents() {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 1;
    const limit = urlParams.get('limit') || 10;
    const sort_by = urlParams.get('sort_by') || 'name';
    const sort_dir = urlParams.get('sort_dir') || 'asc';
    const filter = urlParams.get('filter') || '';
    $.ajax({
        url: '/api/residents',
        type: 'GET',
        data: {
          limit,
          page,
          sort_by,
          sort_dir,
          filter
        },
        success: function(response) {
            setDataTable(response?.data, page, limit);
            setPagination(response);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
    }

    // Call the fetchResidents function on initial page load
    $(document).ready(function() {
        fetchResidents();
    });
</script>
@endsection