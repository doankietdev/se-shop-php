<?php
require_once  dirname(__DIR__) . "/inc/init.php";
$conn = require_once dirname(__DIR__) . '/inc/db.php';
?>

<?php require_once "./inc/components/header.php" ?>;

<style>
  .search-set .btn-delete-by-select {
    min-width: 34px;
    height: 34px;
    margin-right: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 17px;
  }
</style>

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h3>Category List</h3>
        <h4>Manage your categories</h4>
      </div>
      <div class="page-btn" data-bs-toggle="modal" data-bs-target="#addModal">
        <button href="add-product.php" class="btn btn-added box-shadow">
          <img src="assets/img/icons/plus.svg" alt="img" class="me-1" />
          Add New Category
        </button>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <a class="btn btn-filter" id="filter_search">
                <img src="assets/img/icons/filter.svg" alt="img" />
                <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
              </a>
            </div>
            <div class="search-path">
              <a class="btn btn-danger btn-delete-by-select" id="deleteBySelectBtn">
                <i class="fas fa-trash-alt"></i>
              </a>
            </div>
            <div class="search-input">
              <a class="btn btn-searchset">
                <i class="fas fa-search"></i>
              </a>
            </div>
          </div>
          <!-- <div class="wordset">
            <ul>
              <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img" /></a>
              </li>
              <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img" /></a>
              </li>
              <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img" /></a>
              </li>
            </ul>
          </div> -->
        </div>

        <div class="card mb-2" id="filter_inputs">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="row">
                  <div class="col-lg-2 col-sm-6 col-12">
                    <div class="form-group m-3">
                      <select class="select">
                        <option>Choose Category</option>
                        <option>Computers</option>
                        <option>Fruits</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-6 col-12">
                    <div class="form-group m-3">
                      <select class="select">
                        <option>Price</option>
                        <option>150.00</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg col-sm-6 col-12">
                    <div class="form-group m-3">
                      <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img" /></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table" id="table">
            <thead class="table-light">
              <tr>
                <th>
                  <label class="checkboxs">
                    <input type="checkbox" id="select-all" />
                    <span class="checkmarks"></span>
                  </label>
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" aria-hidden="true" aria-labelledby="addModalLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addModalLabel">Add New Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form id="addForm" action="add-product.php" method="POST">
          <div class="row gx-5">
            <div class="col-lg-12 col-sm-12 col-12">
              <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" autofocus />
              </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-submit me-2">Add</button>
        <button type="reset" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editProductModal" aria-hidden="true" aria-labelledby="editProductModalLabel" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editProductModalLabel">Edit Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form id="editProductForm" action="add-product.php" method="POST" enctype="multipart/form-data">
          <div class="row gx-5">
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" autofocus />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-submit me-2">Update</button>
        <button type="reset" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<?php require_once "./inc/components/footer.php" ?>;

<script>
  $(document).ready(function() {
    const DEFAULT_PAGE = 1
    const DEFAULT_LIMIT = 10
    const DEFAULT_SEARCH = ''
    const DEFAULT_SORT_BY = 'createdAt'
    const DEFAULT_ORDER = 'asc'
    const tableEle = $('#table')

    const clearForm = (modal, form) => {
      modal.modal('hide');
      form.find('input, textarea').val('')
    }

    // handle render products to table
    const table = tableEle.DataTable({
      processing: true,
      serverSide: true,
      bFilter: true,
      sDom: 'fBtlpi',
      pagingType: 'numbers',
      ordering: true,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All']
      ],
      language: {
        search: '',
        sLengthMenu: '_MENU_',
        searchPlaceholder: 'Search...',
        info: '_START_ - _END_ of _TOTAL_ items'
      },
      order: [
        [3, 'asc']
      ],
      ajax: {
        url: 'actions/get-categories.php',
        type: 'GET',
        data: function(d, settings) {
          return {
            page: d.start / d.length + 1,
            limit: d.length,
            search: d.search?.value,
            sortBy: d.columns[d.order[0]?.column]?.name || 'createdAt',
            order: d.order[0]?.dir || 'asc',
            draw: d.draw
          }
        },
        dataFilter: function(data) {
          const dataObj = jQuery.parseJSON(data);
          return JSON.stringify({
            draw: dataObj.data.draw,
            recordsTotal: dataObj.data.totalItems,
            recordsFiltered: dataObj.data.totalItems,
            data: dataObj.data.items,
            totalPages: dataObj.data.totalPages
          });
        },
      },
      columnDefs: [{
          targets: 0,
          orderable: false,
          searchable: false,
        },
        {
          name: 'id',
          targets: 1
        },
        {
          name: 'name',
          targets: 2
        },
        {
          name: 'createdAt',
          targets: 3
        },
        {
          targets: 4,
          orderable: false,
          searchable: false,
        },
      ],
      columns: [{
          render: function(data, type, row, meta) {
            return `
                <label class="checkboxs">
                  <input data-id=${row.id} type="checkbox" />
                  <span class="checkmarks"></span>
                </label>
              `
          }
        },
        {
          render: function(data, type, row, meta) {
            return `
              <a class="text-linear-hover" href="product-details.php?id=${row.id}">
                ${row.id}
              </a>
            `
          }
        },
        {
          render: function(data, type, row, meta) {
            return `
              <a class="text-linear-hover" href="product-details.php?id=${row.id}">
                ${row.name}
              </a>
            `
          }
        },
        {
          data: 'createdAt'
        },
        {
          render: function(data, type, row, meta) {
            return `
              <a class="me-2 action" href="product-details.php?id=${row.id}">
                <img class="action-icon" src="assets/img/icons/eye.svg" alt="img" />
              </a>
              <a
                class="me-2 edit-product-button action"
                data-id="${row.id}"
                href="javascript:void(0)"
              >
                <img class="action-icon" src="assets/img/icons/edit.svg" alt="img" />
              </a>
              <a class="action" data-id="${row.id}" id="delete-btn" href="javascript:void(0)">
                <img class="action-icon" src="assets/img/icons/delete.svg" alt="img" />
              </a>
              `
          }
        },
      ],
      initComplete: (settings, json) => {
        $('.dataTables_filter').appendTo('#tableSearch')
        $('.dataTables_filter').appendTo('.search-input')
      },
    })

    // handle add product
    const addFormId = '#addForm'
    const addModalId = '#addModal'
    const addForm = $(addFormId)
    const addModal = $(addModalId)
    const addFormSubmitButton = $(addModalId + ' .modal-footer button[type="submit"]')
    addFormSubmitButton.click(function() {
      addForm.submit()
    })
    addForm.validate({
      rules: {
        name: {
          required: true
        }
      },
    })
    addForm.submit(async function(event) {
      try {
        event.preventDefault()
        if ($(this).valid()) {
          const data = addForm.serializeArray().reduce((acc, item) => {
            return {
              ...acc,
              [item.name]: item.value
            }
          }, {})

          const response = await $.ajax({
            url: 'actions/add-category.php',
            type: 'POST',
            dataType: 'json',
            data,
          })
          if (response.status) {
            table.ajax.reload(function(json) {
              // Fix bug: put in setTimeout => added item and move last page
              // but records are still at page = 1, limit = 10
              // Ref: https://datatables.net/forums/discussion/31857/page-draw-is-not-refreshing-the-rows-on-the-table
              setTimeout(function() {
                table.page(json.totalPages - 1).draw('page');
              }, 0);
              toastr.success('Add category successfully')
            });
          } else {
            toastr.error(response.message)
          }
          clearForm(addModal, addForm);
        }
      } catch (error) {
        clearForm(addModal, addForm);
        toastr.error('Something went wrong')
      }
    })

    // handle edit product
    const editProductFormId = '#editProductForm'
    const editProductModalId = '#editProductModal'
    const editProductForm = $(editProductFormId)
    const editProductFormSubmitButton = $(editProductModalId + ' .modal-footer button[type="submit"]')
    $('#table tbody').on('click', '.edit-product-button', async function(event) {
      try {
        const id = $(this).data('id')
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editProductModal'))

        const getProduct = $.ajax({
          url: `actions/get-product-by-id.php?id=${id}`,
          type: 'GET',
          dataType: 'json'
        })
        const getCategories = $.ajax({
          url: `actions/get-categories.php`,
          type: 'GET',
          dataType: 'json'
        })
        const [getProductResponse, getCategoriesResponse] = await Promise.all([
          getProduct, getCategories
        ])

        if (getProductResponse.status) {
          const product = getProductResponse.data.product;
          const categories = getCategoriesResponse.data.categories
          const categorySelect = editProductForm.find('select[name="categoryId"]')

          editProductForm.attr('data-id', product.id)
          editProductForm.find('input[name="name"]').val(product.name)
          editProductForm.find('input[name="price"]').val(product.price)
          editProductForm.find('input[name="stockQuantity"]').val(product.stockQuantity)
          editProductForm.find('input[name="screen"]').val(product.screen)
          editProductForm.find('input[name="operatingSystem"]').val(product.operatingSystem)
          editProductForm.find('input[name="processor"]').val(product.processor)
          editProductForm.find('input[name="ram"]').val(product.ram)
          editProductForm.find('input[name="storageCapacity"]').val(product.storageCapacity)
          editProductForm.find('input[name="weight"]').val(product.weight)
          editProductForm.find('input[name="batteryCapacity"]').val(product.batteryCapacity)
          editProductForm.find('input[name="color"]').val(product.color)
          editProductForm.find('textarea[name="description"]').val(product.description)
          editProductForm.find('.preview-image img').attr('src', product.imageUrl).show()
          editProductForm.find('.preview-image').css({
            'border': 'none'
          })
          editProductForm.find('input[name="currentImageUrl"]').val(product.imageUrl)
          categories.forEach((category) => {
            let selectedAttr = '';
            if (category.id === product.categoryId) {
              selectedAttr = 'selected'
            }
            categorySelect.append(`
              <option value="${category.id}" ${selectedAttr}>
                ${category.name}
              </option>
            `)
          })

          modal.show();
        } else {
          toastr.error('Something went wrong')
        }
      } catch (error) {
        console.log(error);
        toastr.error('Something went wrong')
      }
    })
    editProductFormSubmitButton.click(function() {
      editProductForm.submit()
    })
    editProductForm.validate({
      rules: {
        name: {
          required: true
        },
        categoryId: {
          required: true
        },
        price: {
          required: true,
          number: true
        },
        stockQuantity: {
          required: true,
          number: true
        },
        ram: {
          number: true
        },
        storageCapacity: {
          number: true
        },
        weight: {
          number: true
        },
        batteryCapacity: {
          number: true
        }
      },
    })
    editProductForm.submit(async function(event) {
      try {
        event.preventDefault()
        if ($(this).valid()) {
          const id = $(this).data('id')
          const formData = new FormData($(this)[0])
          formData.append('id', id)

          const response = await $.ajax({
            url: 'actions/edit-product.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
          })
          if (response.status) {
            const currentPage = table.page.info().page;
            table.page(currentPage).draw('page')
            toastr.success('Edit product successfully')
          } else {
            toastr.error('Edit product failed')
          }
          clearForm(editProductModal, editProductForm);
        }
      } catch (error) {
        clearForm(editProductModal, editProductForm);
        toastr.error('Something went wrong')
      }
    })

    // handle delete
    $('#table tbody').on('click', '#delete-btn', function() {
      const id = $(this).data('id')
      Swal
        .fire({
          title: 'Delete Product?',
          text: 'This action cannot be reverted. Are you sure?',
          showCancelButton: true,
          confirmButtonText: 'Delete',
          confirmButtonClass: 'btn btn-danger',
          cancelButtonClass: 'btn btn-cancel me-3 ms-auto',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          buttonsStyling: !1,
          reverseButtons: true
        })
        .then(async function(result) {
          try {
            if (result.isConfirmed) {
              const response = await $.ajax({
                url: 'actions/delete-product.php',
                type: 'POST',
                dataType: 'json',
                data: {
                  id
                },
              })

              if (response.status) {
                const currentPage = table.page.info().page
                table.page(currentPage).draw('page')
                toastr.success('Delete product successfully')
              } else {
                toastr.error('Delete product failed')
              }
            }
          } catch (error) {
            toastr.error('Something went wrong')
          }
        })
    })

    // handle delete by select
    $('#deleteBySelectBtn').click(function() {
      const selectAll = tableEle.find('#select-all')
      const checkedBoxes = tableEle.find(
        'input[type="checkbox"]:checked:not([id="select-all"])'
      )
      let checkedIds = [];
      checkedBoxes.each(function() {
        checkedIds = [...checkedIds, $(this).data('id')]
      })

      Swal
        .fire({
          title: 'Delete Selected Products?',
          text: 'This action cannot be reverted. Are you sure?',
          showCancelButton: true,
          confirmButtonText: 'Delete',
          confirmButtonClass: 'btn btn-danger',
          cancelButtonClass: 'btn btn-cancel me-3 ms-auto',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          buttonsStyling: !1,
          reverseButtons: true
        })
        .then(async function(result) {
          try {
            if (result.isConfirmed) {
              const response = await $.ajax({
                url: 'actions/delete-product-by-ids.php',
                type: 'POST',
                dataType: 'json',
                data: {
                  ids: checkedIds
                },
              })

              if (response.status) {
                const currentPage = table.page.info().page
                const lastPage = table.page.info().pages
                let pageAfterDelete = currentPage
                const isAtLastPage = currentPage === lastPage - 1;
                if (selectAll.is(':checked') && isAtLastPage) {
                  pageAfterDelete = currentPage - 1;
                }
                setTimeout(() => {
                  table.page(pageAfterDelete).draw('page')
                })
                toastr.success('Delete selected products successfully')
              } else {
                toastr.error('Delete selected products failed')
              }
            }
          } catch (error) {
            toastr.error('Something went wrong')
          }
        })
    })
  })
</script>