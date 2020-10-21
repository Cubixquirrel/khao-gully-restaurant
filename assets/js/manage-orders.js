function pageBack() {
    window.history.back();
}

function updateOrderStatus(orderId, userId, orderStatus) {
    if (orderStatus == 'Order Placed') {
        var buttonNewText = 'Finish Cooking';
        var newOrderStatus = 'In Cooking';
    }
    else if (orderStatus == 'In Cooking') {
        var buttonNewText = 'Completed';
        var newOrderStatus = 'Cooking Finished';
    }

    var updateStatusButton = event.currentTarget;

    updateStatusButton.innerHTML = 'Please Wait';
    updateStatusButton.removeAttribute('onclick');

    var http = new XMLHttpRequest();
    var url = '../requests/update-order-status.php';
    var params = 
    'orderId='+orderId+
    '&userId='+userId+
    '&orderStatus='+orderStatus+
    '&newOrderStatus='+newOrderStatus
    ;

    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            // console.log(http.responseText);
            if(http.responseText == 'true') {
                setTimeout(function() {
                    updateStatusButton.innerHTML = buttonNewText;
                    updateStatusButton.previousElementSibling.innerHTML = newOrderStatus;
                    if (orderStatus == 'Order Placed') {
                        updateStatusButton.setAttribute('onclick', 'updateOrderStatus("'+orderId+'", "'+userId+'", "'+newOrderStatus+'")');
                    } else if (orderStatus == 'In Cooking') {
                        updateStatusButton.setAttribute('class', 'update-status-button active');
                    }
                }, 2000);
            }
        }
    }
    http.send(params);
}