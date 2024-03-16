<?php
require_once  dirname(dirname(__DIR__)) . "/inc/init.php";
require_once  dirname(dirname(__DIR__)) . "/inc/utils.php";
$conn = require_once  dirname(dirname(__DIR__)) . "/inc/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
  return redirectByServer(APP_URL . '/admin/orders/');
}
if (!isset($_GET['id'])) {
  return redirectByServer(APP_URL . '/admin/orders/');
}

$orderId = $_GET['id'];

$getOrderResult = Order::getOrderByIdV2($conn, $orderId);
if (!$getOrderResult['status']) {
  return redirect(APP_URL . '/admin/500.php');
}

$order = $getOrderResult['data']['order'];
if (!$order) {
  return redirect(APP_URL . '/admin/404.php');
}

?>

<?php require_once  dirname(__DIR__) . "/inc/components/header.php" ?>;

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h3>Order Details</h3>
        <h4>Full details of a order</h4>
      </div>
      <div class="page-btn">
        <a data-id="<?php ?>" id="delete-btn" class="btn btn-danger" href="javascript:void(0)">Delete</a>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-8 col-md-6 col-12">
            <h6 class="fw-bold">Customer Information</h6>
            <div class="row gx-3 mt-3">
              <div class="col-lg-3">
                <img style="border-radius: 8px; width: 100%; height: 100%; object-fit: contain;" src="
                  <?php
                  echo $order->customerImageUrl ?
                    $order->customerImageUrl
                    : APP_URL . '/admin/assets/img/no-image.png'
                  ?>">
              </div>
              <div class="col-lg-9 mt-1">
                <div class="row">
                  <div class="col-lg-3 d-flex gap-2 flex-column align-items-start">
                    <p class="fw-bold me-1">Full Name:</p>
                    <p class="fw-bold me-1">Email:</p>
                    <p class="fw-bold me-1">Phone:</p>
                    <p class="fw-bold me-1">Address:</p>
                  </div>
                  <div class="col-lg-9 d-flex gap-2 flex-column align-items-start">
                    <p>
                      <?php echo $order->customerFirstName . ' ' . $order->customerLastName ?>
                    </p>
                    <p><?php echo $order->customerPhoneNumber ?></p>
                    <p><?php echo $order->customerEmail ?></p>
                    <p><?php echo $order->customerAddress ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <h6 class="fw-bold">Order Information</h6>
            <div class="mt-3 mt-1">
              <div class="row">
                <div class="col-lg-6 d-flex gap-2 flex-column align-items-start">
                  <p class="fw-bold me-1">ID:</p>
                  <p class="fw-bold me-1">Shipping Phone:</p>
                  <p class="fw-bold me-1">Shipping Address:</p>
                  <p class="fw-bold me-1">Status:</p>
                </div>
                <div class="col-lg-6 d-flex gap-2 flex-column align-items-end">
                  <p><?php echo $order->id ?></p>
                  <p><?php echo $order->phoneNumber ?></p>
                  <p><?php echo $order->shipAddress ?></p>
                  <p class="badges
                    <?php
                    echo $order->statusId == PENDING ? 'bg-lightred' : 'bg-lightgreen'
                    ?>">
                    <?php echo $order->statusName ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <a class="btn btn-filter" id="filter_search">
                <img src="<?php echo APP_URL; ?>/admin/assets/img/icons/filter.svg" alt="img" />
                <span><img src="<?php echo APP_URL; ?>/admin/assets/img/icons/closes.svg" alt="img" /></span>
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
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="table-bottom">
          <div class="d-flex justify-content-end align-items-center gap-3">
            <span class="fw-bold red-text-color">Total Payment:</span>
            <span class="badges bg-lightred"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex gap-3">
      <a class="btn btn-primary" href="<?php echo APP_URL; ?>/admin/orders">Back</a>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" aria-hidden="true" aria-labelledby="addModalLabel" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addModalLabel">Add New Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form id="addForm">
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

<div class="modal fade" id="editModal" aria-hidden="true" aria-labelledby="editModalLabel" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit Product in Order</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
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
        <button type="submit" class="btn btn-submit me-2">Update</button>
        <button type="reset" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<?php require_once dirname(__DIR__) . "/inc/components/footer.php" ?>;

<script>
  $(document).ready(function() {
    const DEFAULT_PAGE = 1
    const DEFAULT_LIMIT = 10
    const DEFAULT_SEARCH = ''
    const DEFAULT_SORT_BY = 'createdAt'
    const DEFAULT_ORDER = 'asc'
    const tableEle = $('#table')
    const totalPaymentBadge = $('.card .table-bottom .badges')

    const clearForm = (modal, form) => {
      modal.modal('hide');
      form.find('input, textarea').val('')
    }

    // handle render items to table
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
        [5, 'asc']
      ],
      ajax: {
        url: '<?php echo GET_PRODUCTS_OF_ORDER_API . "?id=$orderId" ?>',
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
            draw: dataObj.data?.draw,
            recordsTotal: dataObj.data?.totalItems,
            recordsFiltered: dataObj.data?.totalItems,
            data: dataObj.data?.items,
            totalPages: dataObj.data?.totalPages,
            totalPayment: dataObj.data?.totalPayment
          });
        },
      },
      columnDefs: [{
          targets: 0,
          orderable: false,
          searchable: false,
        },
        {
          name: 'name',
          targets: 1
        },
        {
          name: 'price',
          targets: 2
        },
        {
          name: 'quantity',
          targets: 3
        },
        {
          name: 'totalPrice',
          targets: 4
        },
        {
          name: 'createdAt',
          targets: 5
        },
        {
          targets: 6,
          orderable: false,
          searchable: false,
        },
      ],
      columns: [{
          render: function(data, type, row, meta) {
            return `
                <label class="checkboxs">
                  <input data-order-id=${row.orderId} data-product-id=${row.id} type="checkbox" />
                  <span class="checkmarks"></span>
                </label>
              `
          }
        },
        {
          render: function(data, type, row, meta) {
            return `
              <div class="name-img-wrapper">
                <a class="product-img details-btn text-linear-hover d-flex align-items-center gap-2" href="<?php echo APP_URL; ?>/admin/products/details.php?id=${row.id}">
                  <img src="${row.imageUrl}" />
                  <span> ${row.name}</span>
                </a
              </div>
            `
          }
        },
        {
          data: 'price'
        },
        {
          render: function(data, type, row, meta) {
            return `
              <div class="edit-order-product">
                <input 
                  type="number"
                  min="1"
                  name="quantity"
                  value="${row.quantity}"
                  style="display: none;"
                />
                <span>${row.quantity}</span>
              </div>
            `
          }
        },
        {
          data: 'totalPrice'
        },
        {
          data: 'createdAt'
        },
        {
          render: function(data, type, row, meta) {
            return `
              <div class="confirm-buttons">
                <button
                  class="btn btn-primary update-order-product-submit-button"
                  data-product-id="${row.id}"
                  data-order-id="${row.orderId}"
                >
                  Update
                </button>
                <button class="btn btn-cancel update-order-product-cancel-button">Cancel</button>
              </div>
              <div class="actions">
                <a class="me-2 action details-btn" href="<?php echo APP_URL; ?>/admin/products/details.php?id=${row.id}">
                  <img class="action-icon" src="<?php echo APP_URL; ?>/admin/assets/img/icons/eye.svg" alt="img" />
                </a>
                <a
                  class="me-2 edit-button action"
                  href="javascript:void(0)"
                >
                  <img class="action-icon" src="<?php echo APP_URL; ?>/admin/assets/img/icons/edit.svg" alt="img" />
                </a>
                <a
                  class="action"
                  data-product-id="${row.id}"
                  data-orderId="${row.orderId}"
                  id="delete-btn"
                  href="javascript:void(0)"
                >
                  <img class="action-icon" src="<?php echo APP_URL; ?>/admin/assets/img/icons/delete.svg" alt="img" />
                </a>
              </div>
              `
          }
        },
      ],
      initComplete: (settings, json) => {
        $('.dataTables_filter').appendTo('#tableSearch')
        $('.dataTables_filter').appendTo('.search-input')

        // In order to switch to old page of deleted item
        if (sessionStorage.getItem('pageInfo')) {
          const pageInfo = JSON.parse(sessionStorage.getItem('pageInfo'));
          sessionStorage.removeItem('pageInfo');
          const numberItemsBeforeDelete = pageInfo.end - pageInfo.start
          let currentPage = pageInfo.page
          if (numberItemsBeforeDelete <= 1) {
            currentPage = currentPage - 1;
          }
          setTimeout(() => {
            table.page(currentPage).draw('page')
          }, 0)
        }
      },
    })

    // handle add item
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
            url: '<?php echo ADD_CATEGORY_API; ?>',
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

    // handle edit quantity of product
    $('#table').on('draw.dt', function(event, settings) {
      const {
        totalPayment
      } = settings.json || {}
      // change total payment on UI
      totalPaymentBadge.text(totalPayment);

      $('#table tbody tr').each(async function() {
        const tr = $(this)
        const editButton = tr.find('.actions .edit-button')
        const confirmButtons = tr.find('.confirm-buttons')
        const actions = tr.find('.actions')
        const quantityInput = tr.find('.edit-order-product input[name]')
        const valueSpan = tr.find('.edit-order-product span')
        const submitButton = tr.find('.update-order-product-submit-button')
        const cancelButton = tr.find('.update-order-product-cancel-button')

        const toggleUpdateOrderProduct = () => {
          if (actions.css('display') === 'none') {
            actions.show()
            valueSpan.show()
            confirmButtons.hide()
            quantityInput.hide()
            return;
          }
          actions.hide()
          valueSpan.hide()
          confirmButtons.show()
          quantityInput.show()
        }
        editButton.click(function() {
          toggleUpdateOrderProduct();
        })

        submitButton.click(async function() {
          try {
            const orderId = $(this).data('orderId')
            const productId = $(this).data('productId')
            const quantityInputValue = quantityInput.val();
            if (quantityInputValue === '') {
              toastr.error('Quantity is required');
              return;
            }
            const quantity = parseInt(quantityInput.val())
            if (quantity < 1) {
              toastr.error('Quantity must be greater than 0');
              return;
            }

            const response = await $.ajax({
              url: `<?php echo UPDATE_ORDER_PRODUCT_API; ?>`,
              type: 'POST',
              dataType: 'json',
              data: {
                productId,
                orderId,
                quantity
              }
            })

            if (response.status) {
              const currentPage = table.page.info().page;
              toggleUpdateOrderProduct();
              table.page(currentPage).draw('page')
              totalPaymentBadge.text(response.data.totalPayment);
              toastr.success('Update quantity successfully')
              return;
            }
            toggleUpdateOrderProduct();
            toastr.error(response.message)
          } catch (error) {
            toggleUpdateOrderProduct();
            toastr.error('Something went wrong')
          }
        })

        cancelButton.click(function() {
          toggleUpdateOrderProduct();
        })
      })
    })
    // handle delete a item
    $('#table tbody').on('click', '#delete-btn', function() {
      const id = $(this).data('id')
      Swal
        .fire({
          title: 'Delete Category?',
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
                url: '<?php echo DELETE_CATEGORY_BY_ID_API ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                  id
                },
              })

              if (response.status) {
                const pageInfo = table.page.info()
                const numberItemsBeforeDelete = pageInfo.end - pageInfo.start
                let currentPage = pageInfo.page
                if (numberItemsBeforeDelete <= 1) {
                  currentPage = currentPage - 1;
                }
                table.page(currentPage).draw('page')
                toastr.success(response.message)
              } else {
                toastr.error(response.message)
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
                url: '<?php echo DELETE_CATEGORY_BY_IDS_API; ?>',
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
                toastr.success(response.message)
              } else {
                toastr.error(response.message)
              }
            }
          } catch (error) {
            toastr.error('Something went wrong')
          }
        })
    })

    // In order to switch to old page of deleted item
    $('#table tbody').on('click', '.details-btn', function() {
      sessionStorage.setItem('pageInfo', JSON.stringify(table.page.info()))
    })
  })
</script>