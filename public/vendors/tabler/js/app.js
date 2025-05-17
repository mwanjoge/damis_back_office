$(document).ready( function () {
    console.log(jQuery.fn.jquery);
   // $('.datatable').DataTable();
} );

var options = {
  valueNames: [ 'embassy', 'country' ]
};

var userList = new List('users', options);