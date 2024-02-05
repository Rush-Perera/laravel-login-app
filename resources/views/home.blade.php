@extends('layouts.app')

@section('content')
<!-- Include jQuery -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table" id="users-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Preview</th>
                                <th>Deactivate</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- User data will be loaded dynamically --}}
                        </tbody>
                    </table>

                    <div id="pagination-links"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for User Details -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             
                <form id="userDetailsForm" data-user-id="">
                    <div class="form-group">
                        <label for="modalUsername">Username:</label>
                        <input type="username" class="form-control" id="modalUsername" >
                    </div>
                    <div class="form-group">
                        <label for="modalName">Name:</label>
                        <input type="text" class="form-control" id="modalName" >
                    </div>
                    <div class="form-group">
                        <label for="modalEmail">Email:</label>
                        <input type="email" class="form-control" id="modalEmail" >
                    </div>
                    <div class="form-group">
                        <label for="modalUserType">User Type:</label>
                        <select class="form-control" id="modalUserType" >
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesBtn" onclick="saveChanges()">Save Changes</button>
            </div>
        </div>
    </div>
</div>



<script>
    $('#saveChangesBtn').click(function () {
 
        var username = $('#modalUsername').val();
        var name = $('#modalName').val();
        var email = $('#modalEmail').val();
        var userType = $('#modalUserType').val();

       
        if (!username || !name || !email || !userType) {
            alert('Please fill in all fields.');
            return;
        }

        var userId = $('#userDetailsForm').data('user-id');

        $.ajax({
            url: '/update-user/' + userId,
            method: 'POST',
            data: {
                username: username,
                name: name,
                email: email,
                user_type: userType
            },
            success: function (data) {
                alert('Changes saved successfully!');
                $('#userDetailsModal').modal('hide');
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error saving changes. Please try again.');
            }
        });
    });
    function openUserDetailsModal(userId) {
        $.ajax({
            url: '/user-details/' + userId,
            method: 'GET',
            success: function (data) {
                $('#modalUsername').val(data.username);
                $('#modalName').val(data.name);
                $('#modalEmail').val(data.email);
                $('#userDetailsForm').attr('data-user-id', userId);
          
                if (data.is_active) {
                    $('#saveChangesBtn').show();
                } else {
                    $('#saveChangesBtn').hide();
                }
                $('#modalUserType').val(data.user_type);
                $('#userDetailsModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function deactivateUser(userId) {
        if (confirm('Are you sure you want to deactivate this user?')) {
            $.ajax({
                url: '/deactivate-user/' + userId,
                method: 'POST',
                success: function (data) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }

    function activateUser(userId) {
        if (confirm('Are you sure you want to deactivate this user?')) {
            $.ajax({
                url: '/activate-user/' + userId,
                method: 'POST', 
                success: function (data) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        function loadUsers() {
            $.ajax({
                url: '{{ route("get.users") }}',
                method: 'GET',
                success: function (data) {
                    updateTable(data.data);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateTable(users) {
            var tableBody = $('#users-table tbody');
            tableBody.empty();

            $.each(users, function (index, user) {
                var deactivateButton = '<button class="btn btn-danger btn-sm" onclick="deactivateUser(' + user.id + ')">Deactivate</button>';
                var activateButton = '<button class="btn btn-success btn-sm" onclick="activateUser(' + user.id + ')">Activate</button>';

                var statusButton = user.is_active ? deactivateButton : activateButton;

                var row = '<tr>' +
                    '<td>' + user.id + '</td>' +
                    '<td>' + user.username + '</td>' +
                    '<td>' + user.name + '</td>' +
                    '<td>' + user.email + '</td>' +
                    '<td>' + user.user_type + '</td>' +
                    '<td><button class="btn btn-primary btn-sm" onclick="openUserDetailsModal(' + user.id + ')">Preview</button></td>' +
                    '<td>' + statusButton + '</td>' +
                    '</tr>';

                tableBody.append(row);
            });
        }

        loadUsers();

        

    });


</script>

@endsection