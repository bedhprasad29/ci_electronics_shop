// auth apis
var SIGNUP_API = '/api/sign-up'
var SIGNIN_API = '/api/sign-in'

// apis
var PRODUCT_API = '/api/v1/products'
var CATEGORY_API = '/api/v1/categories'
var ROLE_API = '/api/v1/roles'
var USER_API = '/api/v1/users'
var PROFILE_API = '/api/profile'

// set axios header with authorization token
axios.interceptors.request.use(function (config) {
  const token = localStorage.getItem('token');
  config.headers.Authorization = "Bearer "+token;
  return config;
});

axios.interceptors.response.use(function (response) {
  return response;
}, function (error) {
  var res = error.response.data;
  if (res.error == 'Expired token' || res.error == 'Missing or invalid JWT in request') {
    localStorage.setItem('token', '');
    window.location = '/logout';
  }
  return Promise.reject(error);
});

function resetErrors(formId)
{
  $(formId+" span.error").html('');
  $(formId+" input", formId+" textarea", formId+" select").removeClass('is-invalid');
}

function showErrors(error, formId) {
  if ('response' in error && 'data' in error.response) {
    var errors = error.response.data;
    resetErrors(formId);
    for (const property in errors) {
      $("#error-"+property).text(errors[property]);
      $(".form-control#"+property).addClass('is-invalid');
    }
  }
}

// signUp form in register.php
var signUpForm = '#register-form';
$(document).on('submit', signUpForm, function(e) {
  e.preventDefault();

  let form = document.querySelector(signUpForm);
  var data = new FormData(form);
  // data.append('file', $('#profile')[0].files[0]);

  axios({
      method: 'POST',
      url: SIGNUP_API,
      data: data,
      headers: { 'Content-Type': $(this).prop('enctype') },
  })
  .then(function (response) {
    var res = response.data;
    if (res.access_token != '') {
      localStorage.setItem('token', res.access_token);
      window.location = '/u/profile'
    }
  })
  .catch(function (error) {
    showErrors(error, signUpForm);
  });
})

function prepareCategoryDropDown(dropDownSelector) {
  axios({
    method: 'GET',
    url: CATEGORY_API,
  })
  .then(function (response) {
      var categories = '<option value="">--Select--</option>';
      $.each( response.data, function( i, val ) {
          categories += `<option value="${val.id}">${val.name}</option>`;
      });
      $(dropDownSelector).html(categories);
  })
  .catch(function (error) {
      console.log(error)
  });
}

function resetPassword(resetForm, id) {
  axios({
      method: 'POST',
      url: PROFILE_API+'/reset/'+id,
      data: $(resetForm).serialize(),
  })
  .then(function (response) {
    alert("Password reset successfully.");
    window.location = '/u/profile';
  })
  .catch(function (error) {
    showErrors(error, resetForm);
  });
}


// PRODUCTS
// product lists
function getProductList() {
  axios({
    method: 'GET',
    url: PRODUCT_API
  })
  .then(function (response) {
    var products = '';
    $.each( response.data, function( i, val ) {
        products += `
            <tr>
                <td>${val.name}</td>
                <td>${val.category_name}</td>
                <td>${(val.status == 'A') ? 'Active': 'Inactive'}</td>
                <td>
                <a href="/u/products/${val.id}" title="View Blog" class="btn btn-success btn-sm">
                  <i class="fa fa-eye"></i>
                  View
                </a>
                <a href="/u/products/${val.id}/edit" title="Edit Blog" class="btn btn-primary btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit
                </a>
                <form method="POST" action="" accept-charset="UTF-8" style="display:inline">
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Blog" onclick="return deleteProduct(${val.id})">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </form>
                </td>
            </tr>
        `;
    });
    $("#product-list tbody").html(products);
  })
  .catch(function (error) {
    alert("error occured while loading product list");
  });
}

// product create
function createProduct(productForm) {
  let form = document.querySelector(productForm);
  var data = new FormData(form);

  axios({
      method: 'POST',
      url: PRODUCT_API,
      data: data,
      headers: { 'Content-Type': $(this).prop('enctype') },
  })
  .then(function (response) {
    alert("Product added successfully.");
    window.location = '/u/products';
  })
  .catch(function (error) {
    showErrors(error, productForm);
  });
}

function getSingleProduct(id, page = 'show') {
  axios({
    method: 'GET',
    url: PRODUCT_API+'/'+id
  })
  .then(function (response) {
    var res = response.data;

    if (page == 'show') {
      $('div#name span').html(res.name);
      $('div#category_name span').html(res.category_name);
      $('div#description span').html(res.description);
      $('div#price span').html(res.price);
      $('div#status span').html((res.status == 'A') ? 'Active': 'Inactive');
    } else {
      $('#name').val(res.name);
      $('#category_id>option[value="' + res.category_id + '"]').prop('selected', true);
      $('#description').val(res.description);
      $('#price').val(res.price);
      $('#status>option[value="' + res.status + '"]').prop('selected', true);
    }
  })
  .catch(function (error) {
    console.log(error);
    alert("error occured while loading product");
  });
}

// product update
function updateProduct(productForm, id) {
  // let form = document.querySelector(productForm);
  // var data = new FormData(form);

  axios({
      method: 'PUT',
      url: PRODUCT_API+"/"+id,
      data: $(productForm).serialize(),
  })
  .then(function (response) {
    alert("Product update successfully.");
    window.location = '/u/products';
  })
  .catch(function (error) {
    showErrors(error, productForm);
  });
}

// product delete
function deleteProduct(id) {
  var c = confirm('Are you sure you want to delete?');
  if (c) {
    axios({
      method: 'DELETE',
      url: PRODUCT_API+'/'+id
    })
    .then(function (response) {
      alert("Product deleted successfully.");
      window.location = '/u/products';
    })
    .catch(function (error) {
      alert("error occured while deleting category");
    });
  }
}


// CATEGORIES
// category lists
function getCategoryList() {
  axios({
    method: 'GET',
    url: CATEGORY_API
  })
  .then(function (response) {
    var categories = '';
    $.each( response.data, function( i, val ) {
      categories += `
            <tr>
                <td>${val.name}</td>
                <td>${(val.status == 'A') ? 'Active': 'Inactive'}</td>
                <td>
                <a href="/u/categories/${val.id}" title="View Category" class="btn btn-success btn-sm">
                  <i class="fa fa-eye"></i>
                  View
                </a>
                <a href="/u/categories/${val.id}/edit" title="Edit Category" class="btn btn-primary btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit
                </a>
                <form method="POST" action="" accept-charset="UTF-8" style="display:inline">
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Blog" onclick="return deleteCategory(${val.id})">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </form>
                </td>
            </tr>
        `;
    });
    $("#category-list tbody").html(categories);
  })
  .catch(function (error) {
    console.log(error);
    alert("error occured while loading category list");
  });
}

// category create
function createCategory(categoryForm) {
  let form = document.querySelector(categoryForm);
  var data = new FormData(form);

  axios({
      method: 'POST',
      url: CATEGORY_API,
      data: data,
      headers: { 'Content-Type': $(this).prop('enctype') },
  })
  .then(function (response) {
    alert("Category added successfully.");
    window.location = '/u/categories';
  })
  .catch(function (error) {
    showErrors(error, categoryForm);
  });
}

function getSingleCategory(id, page = 'show') {
  axios({
    method: 'GET',
    url: CATEGORY_API+'/'+id
  })
  .then(function (response) {
    var res = response.data;

    if (page == 'show') {
      $('div#name span').html(res.name);
      $('div#status span').html((res.status == 'A') ? 'Active': 'Inactive');
    } else {
      $('#name').val(res.name);
      $('#status>option[value="' + res.status + '"]').prop('selected', true);
    }
  })
  .catch(function (error) {
    console.log(error);
    alert("error occured while loading category");
  });
}

// category update
function updateCategory(categoryForm, id) {
  axios({
      method: 'PUT',
      url: CATEGORY_API+"/"+id,
      data: $(categoryForm).serialize(),
  })
  .then(function (response) {
    alert("Category update successfully.");
    window.location = '/u/categories';
  })
  .catch(function (error) {
    showErrors(error, categoryForm);
  });
}

// category delete
function deleteCategory(id) {
  var c = confirm('Are you sure you want to delete?');
  if (c) {
    axios({
      method: 'DELETE',
      url: CATEGORY_API+'/'+id
    })
    .then(function (response) {
      alert("Category deleted successfully.");
      window.location = '/u/categories';
    })
    .catch(function (error) {
      alert("error occured while deleting category");
    });
  }
}


// ROLES
// role lists
function getRoleList() {
  axios({
    method: 'GET',
    url: ROLE_API
  })
  .then(function (response) {
    var roles = '';
    $.each( response.data, function( i, val ) {
      roles += `
            <tr>
                <td>${val.name}</td>
                <td>${(val.status == 'A') ? 'Active': 'Inactive'}</td>
                <td>
                <a href="/u/roles/${val.id}" title="View Role" class="btn btn-success btn-sm">
                  <i class="fa fa-eye"></i>
                  View
                </a>
                <a href="/u/roles/${val.id}/edit" title="Edit Role" class="btn btn-primary btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit
                </a>
                <form method="POST" action="" accept-charset="UTF-8" style="display:inline">
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Blog" onclick="return deleteRole(${val.id})">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </form>
                </td>
            </tr>
        `;
    });
    $("#role-list tbody").html(roles);
  })
  .catch(function (error) {
    alert("error occured while loading role list");
  });
}

// role create
function createRole(roleForm) {
  let form = document.querySelector(roleForm);
  var data = new FormData(form);

  axios({
      method: 'POST',
      url: ROLE_API,
      data: data,
  })
  .then(function (response) {
    alert("Role added successfully.");
    window.location = '/u/roles';
  })
  .catch(function (error) {
    showErrors(error, roleForm);
  });
}

function getSingleRole(id, page = 'show') {
  axios({
    method: 'GET',
    url: ROLE_API+'/'+id
  })
  .then(function (response) {
    var res = response.data;

    if (page == 'show') {
      $('div#name span').html(res.name);
      $('div#status span').html((res.status == 'A') ? 'Active': 'Inactive');
    } else {
      $('#name').val(res.name);
      $('#status>option[value="' + res.status + '"]').prop('selected', true);
    }
  })
  .catch(function (error) {
    alert("error occured while loading role");
  });
}

// role update
function updateRole(roleForm, id) {
  axios({
      method: 'PUT',
      url: ROLE_API+"/"+id,
      data: $(roleForm).serialize(),
  })
  .then(function (response) {
    alert("Role update successfully.");
    window.location = '/u/roles';
  })
  .catch(function (error) {
    showErrors(error, roleForm);
  });
}

// role delete
function deleteRole(id) {
  var c = confirm('Are you sure you want to delete?');
  if (c) {
    axios({
      method: 'DELETE',
      url: ROLE_API+'/'+id
    })
    .then(function (response) {
      alert("Role deleted successfully.");
      window.location = '/u/roles';
    })
    .catch(function (error) {
      alert("error occured while deleting role");
    });
  }
}



// USERS
// user lists
function getUserList() {
  axios({
    method: 'GET',
    url: USER_API
  })
  .then(function (response) {
    var users = '';
    $.each( response.data, function( i, val ) {
      users += `
            <tr>
                <td>${val.username}</td>
                <td>${val.email}</td>
                <td>${val.role_name}</td>
                <td>${val.mobile}</td>
                <td>${val.state}</td>
                <td>${val.pincode}</td>
                <td>
                <a href="/u/users/${val.id}" title="View Employee" class="btn btn-success btn-sm">
                  <i class="fa fa-eye"></i>
                  View
                </a>
                <a href="/u/users/${val.id}/edit" title="Edit Employee" class="btn btn-primary btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit
                </a>
                <form method="POST" action="" accept-charset="UTF-8" style="display:inline">
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Employee" onclick="return deleteUser(${val.id})">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </form>
                </td>
            </tr>
        `;
    });
    $("#user-list tbody").html(users);
  })
  .catch(function (error) {
    alert("error occured while loading employee list");
  });
}

// user create
function createUser(userForm) {
  let form = document.querySelector(userForm);
  var data = new FormData(form);

  axios({
      method: 'POST',
      url: USER_API,
      data: data,
  })
  .then(function (response) {
    alert("Employee added successfully.");
    window.location = '/u/users';
  })
  .catch(function (error) {
    showErrors(error, userForm);
  });
}

function getSingleUser(id, page = 'show') {
  axios({
    method: 'GET',
    url: USER_API+'/'+id
  })
  .then(function (response) {
    var res = response.data;

    if (page == 'show') {
      $('div#username span').html(res.username);
      $('div#dob span').val(res.dob);
      $('div#email span').html(res.email);
      $('div#role_name span').html(res.role_name);
      $('div#mobile span').html(res.mobile);
      $('div#state span').html(res.state);
      $('div#pincode span').html(res.pincode);
      $('div#address span').html(res.address);
    } else {
      $('#username').val(res.username);
      $('#dob').val(res.dob);
      $('#email').val(res.email);
      $('#role_id').val(res.role_id);
      $('#mobile').val(res.mobile);
      $('#state').val(res.state);
      $('#pincode').val(res.pincode);
      $('#address').val(res.address);
    }
  })
  .catch(function (error) {
    alert("error occured while loading employee");
  });
}

// user update
function updateUser(userForm, id) {
  axios({
      method: 'PUT',
      url: USER_API+"/"+id,
      data: $(userForm).serialize(),
  })
  .then(function (response) {
    alert("Employee update successfully.");
    window.location = '/u/users';
  })
  .catch(function (error) {
    showErrors(error, userForm);
  });
}

// user delete
function deleteUser(id) {
  var c = confirm('Are you sure you want to delete?');
  if (c) {
    axios({
      method: 'DELETE',
      url: USER_API+'/'+id
    })
    .then(function (response) {
      alert("Employee deleted successfully.");
      window.location = '/u/users';
    })
    .catch(function (error) {
      alert("error occured while deleting employee");
    });
  }
}