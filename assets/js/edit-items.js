function pageBack() {
    window.history.back();
}

function editItem(id) {
    var currentEditButton = event.currentTarget;
    currentEditButton.style.background = '#dddddd';
    currentEditButton.style.border = '1px solid #dddddd';
    currentEditButton.style.color = '#999999';

    setTimeout(() => {
        window.location.href = '../views/edit-item.php?id='+id;        
    }, 300);
}

function saveChangeStock(id) {
    var changeStockMain = document.querySelector('.change-stock-main');
    var changeStockButton = document.querySelector('.change-stock-button');
    var changeStockId = document.querySelector('[name="stock-id"]');

    changeStockButton.removeAttribute('onclick');
    changeStockButton.setAttribute('disabled', 'disabled');
    changeStockButton.style.background = '#dddddd';
    changeStockButton.style.color = '#999999';
    changeStockButton.value = 'Please Wait';

    var http = new XMLHttpRequest();
    var url = '../requests/save-change-stock.php';
    var params = 
    'foodId='+id+
    '&stockId='+changeStockId.value
    ;

    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            if(http.responseText == 'true') {
                setTimeout(function() {
                    changeStockButton.value = 'Saved';
                    changeStockButton.style.background = '#03a9f4';
                    changeStockButton.style.color = '#ffffff';

                    setTimeout(() => {
                        closeChangeStock();
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    }, 1000);
                }, 2000);
            }
        }
    }
    http.send(params);
}

function openChangeStock(id, stock) {    
    var bodyMain = document.querySelector('body');
    var shadowMain = document.querySelector('.shadow-main');
    var changeStockMain = document.querySelector('.change-stock-main');
    var changeStockButton = document.querySelector('.change-stock-button');

    changeStockButton.setAttribute('onclick', 'saveChangeStock("'+id+'")');
    changeStockButton.setAttribute('disabled', 'disabled');
    changeStockButton.style.background = '#dddddd';
    changeStockButton.style.color = '#999999';
    changeStockButton.value = 'Save';

    bodyMain.style.overflow = 'hidden';
    shadowMain.style.display = 'block';
    changeStockMain.style.transform = 'translateY(0)';

    var stockMain = document.querySelector('.stock-main');
    var stockMainSpan = stockMain.querySelectorAll('span');
    for (var i = 0; i < stockMainSpan.length; i++) {
        stockMainSpan[i].removeAttribute('class');
    }
    if (stock == 'in') {
        stockMain.querySelector('span:first-child').setAttribute('class', 'stock-box-active');
    } else if (stock == 'out') {
        stockMain.querySelector('span:last-child').setAttribute('class', 'stock-box-active');
    }
}

function updateChangeStock() {
    var stockMain = document.querySelector('.stock-main');
    var stockMainSpan = stockMain.querySelectorAll('span');
    var currentStockMainSpan = event.currentTarget;
    var changeStockMain = document.querySelector('.change-stock-main');
    var changeStockButton = document.querySelector('.change-stock-button');
    var changeStockId = document.querySelector('[name="stock-id"]');

    for (var i = 0; i < stockMainSpan.length; i++) {
        stockMainSpan[i].removeAttribute('class');
    }

    currentStockMainSpan.setAttribute('class', 'stock-box-active');
    changeStockButton.removeAttribute('disabled');
    changeStockButton.style.background = '#03a9f4';
    changeStockButton.style.color = '#ffffff';

    changeStockId.value = currentStockMainSpan.getAttribute('data-stock-id');
}

function closeChangeStock() {
    var bodyMain = document.querySelector('body');
    var shadowMain = document.querySelector('.shadow-main');
    var changeStockMain = document.querySelector('.change-stock-main');

    bodyMain.style.overflow = '';
    shadowMain.style.display = 'none';
    changeStockMain.style.transform = 'translateY(120%)';
}

function deleteItem(foodId) {
    var currentDeleteButton = event.currentTarget;
    currentDeleteButton.removeAttribute('onclick');
    currentDeleteButton.innerHTML = 'Deleting';
    currentDeleteButton.style.border = '1px solid #FF5722';
    currentDeleteButton.style.background = '#FF5722';
    currentDeleteButton.style.color = '#ffffff';

    var http = new XMLHttpRequest();
    var url = '../requests/delete-item.php';
    var params = 
    'foodId='+foodId
    ;

    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            if(http.responseText == 'true') {
                setTimeout(function() {                    
                    currentDeleteButton.parentNode.parentNode.parentNode.parentNode.remove();

                    var editItemsMenu = document.querySelector('.edit-items-menu');
                    if (editItemsMenu.innerHTML.trim().length == 0) {
                        editItemsMenu.innerHTML = '<span class="empty-box">No item added</span>';
                    }
                }, 2000);
            }
        }
    }
    http.send(params);
}