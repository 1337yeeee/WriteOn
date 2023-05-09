$(document).ready(function() {
  var quantity = parseInt($('#quantity').text());
  if (quantity == 0) {
    $('#quantNull').show();
    $('#quantIs').hide();
  } else {
    $('#quantNull').hide();
    $('#quantIs').show();
  }
});

function addToCart(productId) {
    $.ajax({
        type: 'POST',
        url: '{{ route("add.to.cart") }}',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
        },
        success: function(response) {
            // Handle the response
            if (response.quantity > 0) {
                // Update the quantity and show the +/- buttons
                $('#quantity').text(response.quantity);
                $('#quantNull').hide();
                $('#quantIs').show();
            } else {
                // Show the big button
                $('#quantity').text(response.quantity);
                $('#quantNull').show();
                $('#quantIs').hide();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(productId);
            console.log(errorThrown);
        }
    });
}

function decFromCart(productId) {
    $.ajax({
        type: 'POST',
        url: '{{ route("dec.from.cart") }}',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
        },
        success: function(response) {
            // Handle the response
            if (response.quantity > 0) {
                // Update the quantity
                $('#quantity').text(response.quantity);
                $('#quantNull').hide();
                $('#quantIs').show();
            } else {
                // Show the big button
                $('#quantity').text(response.quantity);
                $('#quantNull').show();
                $('#quantIs').hide();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(productId);
            console.log(errorThrown);
        }
    });
}

function delFromCart(productId) {
    $.ajax({
        type: 'POST',
        url: '{{ route("del.from.cart") }}',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
        },
        success: function(response) {
            // Handle the response
            $('#quantity').text(response['quantity'])
            console.log(productId);
            console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(productId);
            console.log(errorThrown);
        }
    });
}