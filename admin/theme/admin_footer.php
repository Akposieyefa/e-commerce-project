 <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/clothmax/assets/backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/clothmax/assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="/clothmax/assets/backend/plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="/clothmax/assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- overlayScrollbars -->
<script src="/clothmax/assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/clothmax/assets/backend/dist/js/adminlte.js"></script>
<!-- Summernote -->
<script src="/clothmax/assets/backend/plugins/summernote/summernote-bs4.min.js"></script>

<!-- PAGE PLUGINS -->

<!-- InputMask -->
<script src="/clothmax/assets/backend/plugins/moment/moment.min.js"></script>
<script src="/clothmax/assets/backend/plugins/inputmask/jquery.inputmask.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="/clothmax/assets/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- jQuery Mapael -->
<script src="/clothmax/assets/backend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/clothmax/assets/backend/plugins/raphael/raphael.min.js"></script>
<script src="/clothmax/assets/backend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/clothmax/assets/backend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="/clothmax/assets/backend/plugins/chart.js/Chart.min.js"></script>

<!-- JQuery Form Validation -->
<script src="/clothmax/assets/backend/plugins/jquery-validation/jquery.validate.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="/clothmax/assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/clothmax/assets/backend/plugins/jszip/jszip.min.js"></script>
<script src="/clothmax/assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/clothmax/assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/clothmax/assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

    $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

    $("#discountlist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#discountlist_wrapper .col-md-6:eq(0)');

    $("#payoutlist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#payoutlist_wrapper .col-md-6:eq(0)');

    $("#transferlist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#transferlist_wrapper .col-md-6:eq(0)');

    $("#vendorprojectlist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#vendorprojectlist_wrapper .col-md-6:eq(0)');


    // Initialize Select2 Elements
    $('.select2').select2()

    // Summernote
    $('#summernote').summernote()

    // Initialize SweetAlert
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    // Form validator
    $("#project-edit-form").validate({
        submitHandler:function(){
            let postdata = $("#project-edit-form").serialize()+"&action=edit_project";
            
            // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_edit'); ?>',
              data: postdata,
               beforeSend: function() {
                  // setting a timeout
                  $("#submit_btn").html('Saving...');
                  $("#submit_btn").attr('disabled', true);
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Successfully Updated.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.')
                },
                complete: function() {
                  $("#submit_btn").html('Save');
                  $("#submit_btn").attr('disabled', false);
                },
            });

              return false;

        }
    });

    $("#uplaod-project-abstract-file").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_abstract_file'); ?>',
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
               beforeSend: function() {
                  // setting a timeout
                  $("#abstract_file_submit_btn").html('Saving...');
                  $("#abstract_file_submit_btn").attr('disabled', true);
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Successfully Uploaded.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  $("#abstract_file_submit_btn").html('Save');
                  $("#abstract_file_submit_btn").attr('disabled', false);
                },
                complete: function() {
                  $("#abstract_file_submit_btn").html('Save');
                  $("#abstract_file_submit_btn").attr('disabled', false);
                },
            });

            return false;
    })

    $(".btn-delete-abstract").click(function(e){
      e.preventDefault();

      const delete_id = $(this).attr("data-id");
      const abstract_file_name = $(this).attr("data-title");
      const postdata = "delete_id="+delete_id+"&abstract_file_name="+abstract_file_name+"&action=delete_abstract";

            // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_abstract_delete'); ?>',
              data: postdata,
               beforeSend: function() {
                 Toast.fire({
                    icon: 'warning',
                    title: 'Deleting...'
                  });
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Deleted Successfully.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  
                },
                complete: function() {
                  
                },
            });

            return false;
    });


    $(".approve_btn").click(function(e){
      e.preventDefault();

      const approve_id = $(this).attr("data-id");
      const abstract_file_name = $(this).attr("data-title");
      const postdata = "approve_id="+approve_id+"&abstract_file_name="+abstract_file_name+"&action=approve_abstract";

            // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_abstract_approve'); ?>',
              data: postdata,
               beforeSend: function() {
                 Toast.fire({
                    icon: 'warning',
                    title: 'Updating...'
                  });
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Approved Successfully.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  
                },
                complete: function() {
                  
                },
            });

          return false;
    });

    $(".dis_approve_btn").click(function(e){
      e.preventDefault();

      const approve_id = $(this).attr("data-id");
      const abstract_file_name = $(this).attr("data-title");
      const postdata = "approve_id="+approve_id+"&abstract_file_name="+abstract_file_name+"&action=dis_approve_abstract";

            // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_abstract_approve'); ?>',
              data: postdata,
               beforeSend: function() {
                 Toast.fire({
                    icon: 'warning',
                    title: 'Updating...'
                  });
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Dis-Approved.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  
                },
                complete: function() {
                  
                },
            });

          return false;
    });

    /*
    *
    * Project Material file upload
    *
    */

    $("#uplaod-project-material-file").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_material_file'); ?>',
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
               beforeSend: function() {
                  // setting a timeout
                  $("#material_file_submit_btn").html('Saving...');
                  $("#material_file_submit_btn").attr('disabled', true);
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Successfully Uploaded.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  $("#material_file_submit_btn").html('Save');
                  $("#material_file_submit_btn").attr('disabled', false);
                },
                complete: function() {
                  $("#material_file_submit_btn").html('Save');
                  $("#material_file_submit_btn").attr('disabled', false);
                },
            });

            return false;
    })

    $(".btn-delete-material").click(function(e){
      e.preventDefault();

      const delete_id = $(this).attr("data-id");
      const material_file_name = $(this).attr("data-title");
      const postdata = "delete_id="+delete_id+"&material_file_name="+material_file_name+"&action=delete_material";

            // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_material_delete'); ?>',
              data: postdata,
               beforeSend: function() {
                 Toast.fire({
                    icon: 'warning',
                    title: 'Deleting...'
                  });
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Deleted Successfully.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  
                },
                complete: function() {
                  
                },
            });

            return false;
    });

    $(".material_approve_btn").click(function(e){
      e.preventDefault();

      const approve_id = $(this).attr("data-id");
      const material_file_name = $(this).attr("data-title");
      const id = $(this).attr("id");
      
      if (id == 'approve'){

        const postdata = "approve_id="+approve_id+"&material_file_name="+material_file_name+"&action=approve_material";

        // The AJAX
           $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_material_approve'); ?>',
              data: postdata,
               beforeSend: function() {
                 Toast.fire({
                    icon: 'warning',
                    title: 'Updating...'
                  });
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Approved Successfully.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  
                },
                complete: function() {
                  
                },
            });

      }else if(id == 'disapprove'){

        const postdata = "approve_id="+approve_id+"&material_file_name="+material_file_name+"&action=dis_approve_material";

        // The AJAX
            $.ajax({
              type: 'POST',
              url: '<?php echo site_url('backend/ajax/handle_project_material_approve'); ?>',
              data: postdata,
               beforeSend: function() {
                 Toast.fire({
                    icon: 'warning',
                    title: 'Updating...'
                  });
              },
              success:function(response){
                let data = $.parseJSON(response);
                if(data.status==0){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, try again! Please no fields should be empty.'
                  });
                  //$('span').html('Something went wrong, try again!');
                }else{
                  Toast.fire({
                      icon: 'success',
                      title: 'Dis Approved.'
                    });

                  setTimeout(function() { 
                    location.reload();
                  }, 5000);
                }
              },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.');
                  
                },
                complete: function() {
                  
                },
            });

      }

      return false;
    });


    /*
    *
    * Generating Coupon Code
    *
    */

    $("#inputGenerateCoupon").click(function(e){
      e.preventDefault();

      const vendor_id = $("#vendor_id").val();
      const inputMonth = $("#inputMonth").val();
      const inputCouponLength = $("#inputCouponLength").val();

      if(inputCouponLength == ''){
        Toast.fire({
          icon: 'warning',
          title: 'Compulsory field(s) should not be empty'
        });
        return false;
      }

      const postdata = "vendor_id="+vendor_id+"&inputMonth="+inputMonth+"&inputCouponLength="+inputCouponLength+"&action=generate_coupon";

      // The AJAX
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('backend/ajax/handle_generate_coupon'); ?>',
        data: postdata,
         beforeSend: function() {
           Toast.fire({
              icon: 'info',
              title: 'Generating...'
            });
        },
        success:function(response){
          let data = $.parseJSON(response);
          if(data.status==0){
            Toast.fire({
              icon: 'error',
              title: 'Something went wrong, try again! Please no fields should be empty.'
            });
          }else{
            (data.data[0].vendor_id) ? $("#vendor").val(data.data[0].vendor_id) : $("#vendor").val('null');
            $("#outputCouponCode").val(data.data[0].newcoupon);
            //$("#vendor_id").val(data.data[0].vendor_id);
            Toast.fire({
                icon: 'success',
                title: 'Generated Successfully.'
              });

            setTimeout(function() { 
              //location.reload();
            }, 5000);
          }
        },
          error:function(){
            alert('Whoops! This didn\'t work. Please contact us.');
            
          },
          complete: function() {
            
          },
      });

      return false;

    });

    $("#saveCouponCodeBtn").click(function(e){
      e.preventDefault();

      const vendor = $("#vendor").val();
      const newcoupon = $("#outputCouponCode").val();
      const discount = $("#discount").val();
      const expiry = $("#expiry").val();
      const postdata = "vendor="+vendor+"&newcoupon="+newcoupon+"&discount="+discount+"&expiry="+expiry+"&action=save_coupon";

      if(newcoupon != '' && discount != ''){

        // The AJAX
        $.ajax({
          type: 'POST',
          url: '<?php echo site_url('backend/ajax/handle_save_generated_coupon'); ?>',
          data: postdata,
           beforeSend: function() {
              // setting a timeout
              $("#saveCouponCodeBtn").html('Saving...');
              $("#saveCouponCodeBtn").attr('disabled', true);
          },
          success:function(response){
            let data = $.parseJSON(response);
            if(data.status==0){
              Toast.fire({
                icon: 'error',
                title: 'Something went wrong, try again! Please no fields should be empty.'
              });
              //$('span').html('Something went wrong, try again!');
            }else if(data.status==4){
              Toast.fire({
                  icon: 'error',
                  title: 'Coupon code already exists.'
                });

              setTimeout(function() { 
                //location.reload();
              }, 5000);
            }else{
              Toast.fire({
                  icon: 'success',
                  title: 'Successfully Saved.'
                });

              setTimeout(function() { 
                //location.reload();
              }, 5000);
            }
          },
            error:function(){
              alert('Whoops! This didn\'t work. Please contact us.');
              $("#saveCouponCodeBtn").html('Save');
              $("#saveCouponCodeBtn").attr('disabled', false);
            },
            complete: function() {
              $("#saveCouponCodeBtn").html('Save');
              $("#saveCouponCodeBtn").attr('disabled', false);
            },
        });

        return false;
      }else{
        Toast.fire({
            icon: 'error',
            title: 'Some fields are empty.'
          });

        setTimeout(function() { 
          //location.reload();
        }, 5000);
      }
      
    });

    /*
    *
    * Create New Vendor script 
    *
    */

    $("#updateVendorProfileBtn").click(function(e){
      e.preventDefault();

      const formdata = $("#formVendorEdit").serialize();
      const postdata = formdata+"&action=update_vendor_profile";
     
        // The AJAX
        $.ajax({
          type: 'POST',
          url: '<?php echo site_url('backend/ajax/handle_update_vendor_profile'); ?>',
          data: postdata,
           beforeSend: function() {
              // setting a timeout
              $("#updateVendorProfileBtn").html('Updating...');
              $("#updateVendorProfileBtn").attr('disabled', true);
          },
          success:function(response){
            let data = $.parseJSON(response);
            if(data.status==0){
              Toast.fire({
                icon: 'error',
                title: 'Something went wrong, try again! Failed to update.'
              });
              //$('span').html('Something went wrong, try again!');
            }else{
              Toast.fire({
                  icon: 'success',
                  title: 'Update Saved.'
                });

              setTimeout(function() { 
                location.reload();
              }, 5000);
            }
          },
            error:function(){
              alert('Whoops! This didn\'t work. Please contact us.');
              $("#updateVendorProfileBtn").html('Update');
              $("#updateVendorProfileBtn").attr('disabled', false);
            },
            complete: function() {
              $("#updateVendorProfileBtn").html('Update');
              $("#updateVendorProfileBtn").attr('disabled', false);
            },
        });

        return false;
    });

    $("#addVendorWithdrawalAcctBtn").click(function(e){
      e.preventDefault();

      const formdata = $("#formAddVendorWithdrawalAcct").serialize();
      const postdata = formdata+"&action=add_withdrawal_acct";

       // The AJAX
        $.ajax({
          type: 'POST',
          url: '<?php echo site_url('backend/ajax/handle_add_vendor_withdrawal_acct'); ?>',
          data: postdata,
           beforeSend: function() {
              // setting a timeout
              $("#addVendorWithdrawalAcctBtn").html('Submiting...');
              $("#addVendorWithdrawalAcctBtn").attr('disabled', true);
          },
          success:function(response){
            let data = $.parseJSON(response);
            if(data.status==0){
              Toast.fire({
                icon: 'error',
                title: data.message
              });
              //$('span').html('Something went wrong, try again!');
            }else{
              Toast.fire({
                  icon: 'success',
                  title: 'Update Saved.'
                });

              setTimeout(function() { 
                location.reload();
              }, 5000);
            }
          },
            error:function(){
              alert('Whoops! This didn\'t work. Please contact us.');
              $("#addVendorWithdrawalAcctBtn").html('Submit');
              $("#addVendorWithdrawalAcctBtn").attr('disabled', false);
            },
            complete: function() {
              $("#addVendorWithdrawalAcctBtn").html('Submit');
              $("#addVendorWithdrawalAcctBtn").attr('disabled', false);
            },
        });

        return false;

    });

    $("#addNewProjectBtn").click(function(e){
      e.preventDefault();

      const formdata = $("#formCreateNewProject").serialize();
      const postdata = formdata+"&action=create_project";

      // The AJAX
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('backend/ajax/handle_create_new_project'); ?>',
        data: postdata,
         beforeSend: function() {
            // setting a timeout
            $("#addNewProjectBtn").html('Submiting...');
            $("#addNewProjectBtn").attr('disabled', true);
        },
        success:function(response){
          let data = $.parseJSON(response);
          if(data.status==0){
            Toast.fire({
              icon: 'error',
              title: data.message
            });
            //$('span').html('Something went wrong, try again!');
          }else{
            Toast.fire({
                icon: 'success',
                title: data.message
              });

            setTimeout(function() { 
              location.reload();
            }, 5000);
          }
        },
          error:function(){
            alert('Whoops! This didn\'t work. Please contact us.');
            $("#addNewProjectBtn").html('Submit');
            $("#addNewProjectBtn").attr('disabled', false);
          },
          complete: function() {
            $("#addNewProjectBtn").html('Submit');
            $("#addNewProjectBtn").attr('disabled', false);
          },
      });

      return false;

    });

    $("#changePasswordBtn").click(function(e){
      e.preventDefault();

      const formdata = $("#formChangePassword").serialize();
      const postdata = formdata+"&action=change_vendor_password";

      // The AJAX
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('backend/ajax/handle_change_vendors_password'); ?>',
        data: postdata,
         beforeSend: function() {
            // setting a timeout
            $("#changePasswordBtn").html('Submiting...');
            $("#changePasswordBtn").attr('disabled', true);
        },
        success:function(response){
          let data = $.parseJSON(response);
          if(data.status==0){
            Toast.fire({
              icon: 'error',
              title: data.message
            });
            //$('span').html('Something went wrong, try again!');
          }else{
            Toast.fire({
                icon: 'success',
                title: data.message
              });

            setTimeout(function() { 
              location.reload();
            }, 5000);
          }
        },
          error:function(){
            alert('Whoops! This didn\'t work. Please contact us.');
            $("#changePasswordBtn").html('Submit');
            $("#changePasswordBtn").attr('disabled', false);
          },
          complete: function() {
            $("#changePasswordBtn").html('Submit');
            $("#changePasswordBtn").attr('disabled', false);
          },
      });

      return false;

    });


    $("#vendorPayoutBtn").click(function(e){
      e.preventDefault();

      const formData = $("#formVendorPayout").serialize();
      const postdata = formData+'&action=vendor_payout';

      // The AJAX
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('backend/ajax/handle_vendor_payout'); ?>',
        data: postdata,
         beforeSend: function() {
            // setting a timeout
            $("#vendorPayoutBtn").html('Proccessing...');
            $("#vendorPayoutBtn").attr('disabled', true);
        },
        success:function(response){
          let data = $.parseJSON(response);
          if(data.status==1){
            Toast.fire({
              icon: 'success',
              title: data.message
            });
            setTimeout(function() { 
              location.reload();
            }, 5000);
            //$('span').html('Something went wrong, try again!');
          }else{
            Toast.fire({
                icon: 'error',
                title: data.message
              });
          }
        },
          error:function(){
            alert('Whoops! This didn\'t work. Please contact us.');
            $("#vendorPayoutBtn").html('Submit');
            $("#vendorPayoutBtn").attr('disabled', false);
          },
          complete: function() {
            $("#vendorPayoutBtn").html('Submit');
            $("#vendorPayoutBtn").attr('disabled', false);
          },
      });

      return false;

    });

    $("#vendorBonusTransferFundBtn").click(function(e){
      e.preventDefault();

      const formData = $("#formVendorBonusTransferFund").serialize();
      const postdata = formData+"&action=vendor_transfer_bonus";

      // The AJAX
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('backend/ajax/handle_vendor_bonus_transfer'); ?>',
        data: postdata,
         beforeSend: function() {
            // setting a timeout
            $("#vendorBonusTransferFundBtn").html('Proccessing...');
            $("#vendorBonusTransferFundBtn").attr('disabled', true);
        },
        success:function(response){
          let data = $.parseJSON(response);
          if(data.status==1){
            Toast.fire({
              icon: 'success',
              title: data.message
            });
            setTimeout(function() { 
              location.reload();
            }, 5000);
            //$('span').html('Something went wrong, try again!');
          }else{
            Toast.fire({
                icon: 'error',
                title: data.message
              });
          }
        },
          error:function(){
            alert('Whoops! This didn\'t work. Please contact us.');
            $("#vendorBonusTransferFundBtn").html('Transfer');
            $("#vendorBonusTransferFundBtn").attr('disabled', false);
          },
          complete: function() {
            $("#vendorBonusTransferFundBtn").html('Transfer');
            $("#vendorBonusTransferFundBtn").attr('disabled', false);
          },
      });

      return false;
      
    });

  });



</script>
</body>
</html>
