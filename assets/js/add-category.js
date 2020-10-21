function pageBack() {
    window.history.back();
}

var addCategoryForm = document.getElementById('add-category-form');
var categoryName = document.querySelector('#category-name');
var addButton = document.querySelector('#add-button');
var allInput = document.querySelectorAll('input');
var allLabel = document.querySelectorAll('.label');

function enableButton(number) {    
    if (number == '1') {
        if (
            (categoryName.value.length >= 1)
        ) {
            addButton.style.background = '#03a9f4';
            addButton.style.color = '#ffffff';
        } else {
            addButton.style.background = '#dddddd';
            addButton.style.color = '#999999';
        }
    }
}

function addCategory(restaurantId) {
    addButton.value = 'Please Wait';
    addButton.setAttribute('disabled', 'disabled');
    addButton.style.background = '#dddddd';
    addButton.style.color = '#999999';

    if (
        (categoryName.value.length >= 1)
    ) {
        for (var i = 0; i < allInput.length - 1; i++) {
            allLabel[i].style.color = '#0f0f0f';
        }

        var http = new XMLHttpRequest();
        var url = '../requests/add-category.php';
        var params = 
        'restaurantId='+restaurantId+
        '&categoryName='+categoryName.value
        ;

        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                if(http.responseText == 'true') {
                    setTimeout(function() {
                        addButton.value = 'Added';
                        addButton.style.background = '#03a9f4';
                        addButton.style.color = '#ffffff';

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }, 2000);
                }
            }
        }
        http.send(params);
    } else {
        setTimeout(function() {
            addButton.value = 'Add';
            addButton.removeAttribute('disabled');

            if (categoryName.value == '') {
                allLabel[0].style.color = '#FF5722';
            } else {
                allLabel[0].style.color = '#0f0f0f';
            }
        }, 1000);
    }
}