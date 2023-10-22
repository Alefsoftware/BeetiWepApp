<!-- BEGIN: Dark Mode Switcher-->
<div data-url="side-menu-dark-dashboard-overview-2.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
    <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
    <div class="dark-mode-switcher__toggle border"></div>
</div>
<!-- END: Dark Mode Switcher-->

<!-- BEGIN: JS Assets-->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
<script src="{{asset('adminpanel/js/app.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


{{-- get zone from gov --}}
<script>
    // Wait for the document to finish loading
    $(document).ready(function() {
      // Get a reference to the category and subcategory select inputs
      var categorySelect = $('#gov-select');
      var subcategorySelect = $('#zone-select');

      // Add a change event listener to the category select input
      categorySelect.change(function() {
        // Make an AJAX request to retrieve the subcategories for the selected category
        $.ajax({
          url: '/get-subcategories/'+ categorySelect.val(),
          type: 'GET',

          dataType: 'json',
          success: function(data) {
            // Update the options of the subcategory select input
            subcategorySelect.empty().append('<option value="">Select a Zone...</option>');
            $.each(data, function(index, subcategory) {
              subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
            });
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
          }
        });
      });
    });
  </script>
{{-- end script zone --}}


{{-- image preview product --}}
<script>
    $(document).ready(function() {
        $('#horizontal-form-1').on('change', function() {
            var files = $(this)[0].files;
            var filePreviews = [];

            $('#previewContainer').empty();

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var file = e.target.result;
                    filePreviews.push(file);

                    var imagePreview = $('<div>').addClass('image-preview');
                    imagePreview.css('background-image', 'url(' + file + ')');
                    $('#previewContainer').append(imagePreview);

                    // var removeButton = $('<span>').addClass('remove-button');
                    // removeButton.html('<i class="fas fa-trash"></i>');
                    // imagePreview.append(removeButton);

                    // removeButton.on('click', function() {
                    //     var index = $(this).parent('.image-preview').index();
                    //     filePreviews.splice(index, 1);
                    //     $(this).parent('.image-preview').remove();
                    // });
                }
                reader.readAsDataURL(files[i]);
            }

            // Use the filePreviews array for further processing or upload excluding the removed image.
            console.log(filePreviews);
        });
    });
</script>
{{-- end preview --}}


<script>
    $(document).ready(function() {
    // Event listener for the first select element
        $('#dropdown1').val();
    $('#dropdown1').change(function() {
        var parentId = $(this).val();

        if (parentId) {
            // Make an AJAX request to fetch the zones based on the selected parent zone
            $.ajax({
                // url: "{{ url('admin/dropdown1')}}",
                url: '/setCountry/' + parentId,
                type: "GET",
                // data: { parent_id: parentId },
                success: function(response) {
                  console.log('success');
                }
            });
        } else {
            console.log('error');
        }
    });
    });
    // Event listener for the second select element

    $('#dropdown2').change(function() {
    var parentId = $(this).val();
    if (parentId) {
    // Make an AJAX request to fetch the zones based on the selected parent zone
    $.ajax({
     url: '/dropdown2/'+ parentId  ,
    type: "GET",
    data: { parent_id: parentId },
    success: function(response) {
    // Update the options of the third select element
    $('#dropdown3').html('<option value="">Select Zone 3</option>');
    $.each(response, function(key, zone) {
    $('#dropdown3').append('<option value="' + zone.id + '">' + zone.name + '</option>');
});
}
});
} else {
    // Reset the third select element if the second select element is changed back to the default option
    $('#zone3').html('<option value="">Select Zone 3</option>');
}
});

        $( function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    } );


</script>
{{--    $(document).ready(function() {--}}
{{--        // Handle category change event--}}
{{--        $('#dropdown1').change(function() {--}}
{{--            var categoryId = $(this).val();--}}
{{--            var subcategoryDropdown = $('#dropdown2');--}}

{{--            // Clear existing options--}}
{{--            subcategoryDropdown.empty();--}}

{{--            // Add default option--}}
{{--            subcategoryDropdown.append('<option value="">Select Subcategory</option>');--}}

{{--            // Make AJAX request to retrieve subcategory options--}}
{{--            if (categoryId) {--}}
{{--                $.ajax({--}}
{{--                    url: '/dropdown2/'+categoryId, // Replace with your server endpoint--}}
{{--                    method: 'GET',--}}
{{--                    data: { categoryId: categoryId },--}}
{{--                    success: function(response) {--}}
{{--                        // Add subcategory options based on the AJAX response--}}
{{--                        $.each(response.categoryId, function(index, value) {--}}
{{--                            alert(value);--}}
{{--                            subcategoryDropdown.append('<option value="' + value + '">' + value + '</option>');--}}
{{--                        });--}}
{{--                    },--}}
{{--                    error: function() {--}}
{{--                        console.log('Error occurred while retrieving subcategories.');--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}

<script>
    $(document).ready(function() {
        $('.checkboxId').change(function() {
            var checkboxValue = $(this).is(':checked')? 1 : 0;;
            var ctegoryId = $(this).data('category-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('checkbox.update') }}',
                type: 'GET',
                data: {
                    checkboxValue: checkboxValue,
                    ctegoryId: ctegoryId
                },
                success: function(response) {
                    console.log('Checkbox updated successfully');
                },
                error: function(xhr) {
                    console.log('Error updating checkbox');
                }
            });
        });


        // dynamic input prices

    //     var i = 0;

    //    $("#add").click(function(){

    //        ++i;

    //        $("#dynamicTable").append('<tr><td><input type="text" name="prices['+i+'][title]" placeholder="Enter your Title" class="form-control" /></td><td><input type="text" name="prices['+i+'][title_ar]" placeholder="Enter your Title Ar" class="form-control" /></td><td><input type="text" name="prices['+i+'][price]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    //    });

    //    $(document).on('click', '.remove-tr', function(){
    //         $(this).parents('tr').remove();
    //    });

        // end


    });
</script>


<script>
    $('#row1').hide();
$('#row2').hide();
$('#row3').hide();
$('#row4').hide();
var c = 0;
$('#add').click(function() {
    c +=1;
if(c <= 4){
    $('#row'+c).show();
}

        });
</script>



{{-- notification --}}

<script type="text/javascript">
    $(document).ready(function() {

        $('#providers_list').hide();
        $('#customers_list').hide();
        $('#type').on('change', function(e) {
            var type = e.target.value;
            if (type == 'all providers') {
                $('#providers_list').hide();
                $('#customers_list').hide();
                $('#notify_form').attr('action', '{{url("/admin/notifications/all-provider")}}');
            } else if (type == 'all customers') {
                $('#providers_list').hide();
                $('#customers_list').hide();
                $('#notify_form').attr('action', '{{url("/admin/notifications/all-customer")}}');
            } else if (type == 'provider') {
                $('#providers_list').show();
                $('#customers_list').hide();
                $('#notify_form').attr('action', '{{url("/admin/notifications/provider")}}');
            } else if (type == 'customer') {
                $('#customers_list').show();
                $('#providers_list').hide();
                $('#notify_form').attr('action', '{{url("/admin/notifications/customer")}}');
            }
        });
    });
</script>
<script>
    $('#row1').hide();
    $('#row2').hide();
    var c = 0;
    $('#morePrices').click(function() {
        c += 1;
        if (c <= 2) {
            $('#row' + c).show();
        }
    });
</script>
<script>
    var counter = 0

    function add_more_field() {
        counter += 3;
        html = '<div class="row" id="row' + counter + '">\
                <div class="col-3">\
                    <label>{{__("Title")}}</label>\
                    <input type="text" class="form-control" name="prices[' + counter + '][title]" placeholder="{{__("Title")}}">\
                </div>\
                <div class="col-3">\
                    <label>{{__("Title")}} {{__("Ar")}}</label>\
                    <input type="text" class="form-control" name="prices[' + counter + '][title_ar]" placeholder="{{__("Title")}} {{__("Ar")}}">\
                </div>\
                <div class="col-3">\
                    <label>{{__("Price")}}</label>\
                    <input type="text" class="form-control" name="prices[' + counter + '][price]" placeholder="{{__("L.E.")}}">\
                </div>\
</div>';
        $('#price_field').append(html);
    }
</script>

{{-- select 2 --}}
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
{{-- end select 2 --}}
{{-- end notifications --}}

<!-- END: JS Assets-->
</body>
</html>
