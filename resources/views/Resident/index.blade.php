<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Resident Management</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body class="font-sans">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="user-create-form">
            @csrf
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <textarea name="address" id="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <label for="nomor_ktp">Nomor KTP:</label>
              <input type="text" name="nomor_ktp" id="nomor_ktp" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="gender">Gender:</label>
              <input type="text" name="gender" id="gender" class="form-control" disabled>
            </div>
            <div class="form-group">
              <label for="birthdate">Birthdate:</label>
              <input type="text" name="birthdate" id="birthdate" class="form-control" disabled>
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


  <button id="retrieve-users-btn">Retrieve Users</button>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Nomor KTP</th>
        <th>Gender</th>
        <th>Birthdate</th>
      </tr>
    </thead>
    <tbody id="users-table-body">
    </tbody>
  </table>

</body>

</html>